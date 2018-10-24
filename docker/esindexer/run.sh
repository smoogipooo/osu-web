#!/bin/bash

OUT_DIR='/out'

dotnet build -c:Release -o ${OUT_DIR}

cd ${OUT_DIR}

echo "{
  \"ConnectionStrings\": {
    \"osu\": \"Server=db;Database=osu;Uid=osuweb;SslMode=None;\"
  },
  \"elasticsearch\": {
    \"host\": \"http://elasticsearch:9200\"
  },
  \"modes\": \"osu,mania,fruits,taiko\",
  \"buffer_size\": 5
}" > appsettings.json

dotnet osu.ElasticIndexer.dll
