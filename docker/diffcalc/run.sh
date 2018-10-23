#!/bin/bash

OUT_DIR='/out'

dotnet build -c:Release -o ${OUT_DIR}

cd ${OUT_DIR}

echo "{
  // comments are supported.
  \"ConnectionStrings\": {
    \"master\": \"Server=db;Database=osu;Uid=osuweb;SslMode=None;\"
  },
  \"beatmaps_path\": \"/beatmaps\",
  \"allow_download\": false
}" > appsettings.json

dotnet osu.Server.DifficultyCalculator.dll all -m ${MODE} -c ${THREADS}
