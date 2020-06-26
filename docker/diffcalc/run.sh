#!/bin/bash

OUT_DIR='/out'

dotnet run -c:Release -o ${OUT_DIR}

cd ${OUT_DIR}

dotnet osu.Server.DifficultyCalculator.dll all -m ${MODE} -c ${THREADS} -ac
