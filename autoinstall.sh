#!/usr/bin/env bash
set -x -e

########################################
# install php extension for bfs-php-sdk
########################################

cd ~

git checkout https://github.com/apady/bfs-php-extension.git

cd bfs-php-extension

./build.sh

cd -

