#!/usr/bin/env bash

apidoc -i ./../controllers -o ./doc -f ".*\\.php$"
sed -i 's/waitSeconds: 15/waitSeconds: 0/g' ./doc/main.js