#!/bin/sh

mkdir -p Build

cd Build
cmake ..
make -j

cd ../bin

echo "{
    \"mysql.master.host\" : \"db\",
    \"mysql.master.port\" : 3306,
    \"mysql.master.username\" : \"osuweb\",
    \"mysql.master.password\" : \"\",
    \"mysql.master.database\" : \"osu\"
}" > config.json

./osu-performance all -m ${MODE} -t ${THREADS}
