#!/bin/sh

set -u
set -e

export OSU_INSTALL_DEV=1
export OSU_SKIP_CACHE_PERMISSION_OVERRIDE=1
export OSU_SKIP_ASSET_BUILD=1

scriptdir="$(dirname "${0}")"
cd "${scriptdir}/../.."

test -f .env || cp .env.example .env
"${scriptdir}/wait-for.sh" "${1}" -t 60
./build.sh

# undo config and route caching by the script above
php artisan config:clear
php artisan route:clear

# .env hax.
echo "ES_HOST=elasticsearch:9200" >> .env
echo "ES_SCORES_HOST=elasticsearch:9200" >> .env
echo "QUERY_DETECTOR_ENABLED=0" >> .env
sed -i 's@^.*APP_URL=.*$@'"APP_URL=$HTTP_URL"'@' .env

echo "Importing data..."
SQL_CONN='mysql -u osuweb --host=db --database=osu'

# Initial import.
cat ./sql/*.sql \
  | $SQL_CONN

# Move sample users to phpbb_users (initial import).
echo "INSERT INTO phpbb_users (user_id,username,user_warnings,user_type,user_permissions,user_sig,user_occ,user_interests,username_clean,country_acronym) SELECT user_id,username,user_warnings,user_type,0,'','','',username,'AU' FROM sample_users;" \
  | $SQL_CONN

# Sample data doesn't contain last visit times. Un-gray all users.
echo "UPDATE phpbb_users SET user_lastvisit=4294967295, osu_playmode=${MODE} WHERE 1;" \
  | $SQL_CONN

# Add default country + performance rank (fixes errors on user page).
echo "INSERT INTO osu_countries (acronym,name,rankedscore,playcount) VALUES ('AU','Australia',0,0);
      INSERT INTO osu_user_performance_rank (user_id, mode, r0) SELECT user_id, ${MODE}, 1 FROM phpbb_users;" \
  | $SQL_CONN

# Add default genre + language (fixes errors on beatmap set page).
echo "INSERT INTO osu_genres (genre_id,name) VALUES (0, 'genre-1');
      INSERT INTO osu_languages (name) VALUES ('language-1');
      UPDATE osu_beatmapsets SET genre_id=1,language_id=1 WHERE 1;" \
  | $SQL_CONN

# Notify of completion.
echo "INSERT INTO osu_counts (name, count) VALUES ('docker_db_step', '1');" \
  | $SQL_CONN
echo "Finshed importing data."

# Add default user (u: username, p: password), for the ability to search beatmap listing.
echo '(new App\Libraries\UserRegistration(["username" => "username", "user_email" => "admin@smgi.me", "password" => "password"]))->save();' \
  | php artisan tinker

# undo config and route caching by the script above
php artisan config:clear
php artisan route:clear

php artisan es:index-documents --yes --inplace
php artisan es:create-search-blacklist
yarn

exec yarn watch
