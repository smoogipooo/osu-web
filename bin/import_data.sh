#!/bin/sh

# .env hax.
echo "ES_HOST=elasticsearch:9200" >> /app/.env
echo "ES_SCORES_HOST=elasticsearch:9200" >> /app/.env
echo "QUERY_DETECTOR_ENABLED=0" >> /app/.env
sed -i 's@^.*APP_URL=.*$@'"APP_URL=$HTTP_URL"'@' /app/.env

echo "Importing data..."

MYSQL_ARGS=(
  -sN
  --user="osuweb"
  --host="db"
  --database="osu"
)

users=$(mysql "${MYSQL_ARGS[@]}" -e "SELECT COUNT(*) FROM sample_users")
if [[ ! -z $users ]]; then
  exit 0
fi

# Initial import.
(pv --force -p $(find "/app/sql/" -type f -name "*.sql") | mysql "${MYSQL_ARGS[@]}") 2>&1 | stdbuf -o0 tr '\r' '\n'

# Move sample users to phpbb_users (initial import).
mysql "${MYSQL_ARGS[@]}" -e "INSERT INTO phpbb_users (user_id,username,user_warnings,user_type,user_permissions,user_sig,user_occ,user_interests,username_clean,country_acronym) SELECT user_id,username,user_warnings,user_type,0,'','','',username,'AU' FROM sample_users;"

# Sample data doesn't contain last visit times. Un-gray all users.
mysql "${MYSQL_ARGS[@]}" -e "UPDATE phpbb_users SET user_lastvisit=4294967295, osu_playmode=${MODE} WHERE 1;"

# Prevent the no_profile group from ever being used.
mysql "${MYSQL_ARGS[@]}" -e "INSERT INTO phpbb_groups (group_id,group_name,group_desc) VALUES (999, 'no_profile', 'no_profile');"

# Add default country + performance rank (fixes errors on user page).
mysql "${MYSQL_ARGS[@]}" -e "INSERT INTO osu_countries (acronym,name,rankedscore,playcount) VALUES ('AU','Australia',0,0);
      INSERT INTO osu_user_performance_rank (user_id, mode, r0) SELECT user_id, ${MODE}, 1 FROM phpbb_users;"

# Add default genre + language (fixes errors on beatmap set page).
mysql "${MYSQL_ARGS[@]}" -e "INSERT INTO osu_genres (genre_id,name) VALUES (0, 'genre-1');
      INSERT INTO osu_languages (name) VALUES ('language-1');
      UPDATE osu_beatmapsets SET genre_id=1,language_id=1 WHERE 1;"

# undo config and route caching by the script above
php /app/artisan config:clear
php /app/artisan route:clear

php /app/artisan es:index-documents --yes
php /app/artisan es:create-search-blacklist

# Add default user (u: username, p: password), for the ability to search beatmap listing.
echo '(new App\Libraries\UserRegistration(["username" => "username", "user_email" => "admin@smgi.me", "password" => "password"]))->save();' \
  | php /app/artisan tinker

# Notify of completion.
mysql "${MYSQL_ARGS[@]}" "INSERT INTO osu_counts (name, count) VALUES ('docker_db_step', '1');"

echo "Finshed importing data."
