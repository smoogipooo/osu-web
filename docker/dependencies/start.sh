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

echo "ES_HOST=elasticsearch:9200" >> .env
echo "ES_SCORES_HOST=elasticsearch:9200" >> .env
echo "Importing data..."

cat ./sql/*.sql | mysql -u osuweb --host=db --database=osu

echo "INSERT INTO phpbb_users (user_id,username,user_warnings,user_type,user_permissions,user_sig,user_occ,user_interests,username_clean,country_acronym) SELECT user_id,username,user_warnings,user_type,0,'','','',username,'AU' FROM sample_users;
 UPDATE phpbb_users SET user_lastvisit=4294967295, osu_playmode=${MODE} WHERE 1;
 INSERT INTO osu_countries (acronym,name,rankedscore,playcount) VALUES ('AU','Australia',0,0);
 INSERT INTO osu_genres (genre_id,name) VALUES (0, 'genre-1');
 INSERT INTO osu_languages (name) VALUES ('language-1');
 UPDATE osu_beatmapsets SET genre_id=1,language_id=1 WHERE 1;
 INSERT INTO osu_counts (name, count) VALUES ('docker_db_step', '1');
 INSERT INTO osu_user_performance_rank (user_id, mode, r0) SELECT user_id, ${MODE}, 1 FROM phpbb_users;" | mysql -u osuweb --host=db --database=osu

echo "Finshed importing data."

php artisan es:index-documents --yes
php artisan laroute:generate
yarn
yarn generate-localizations

exec yarn watch
