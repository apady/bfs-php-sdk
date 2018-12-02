#!/usr/bin/env bash
set -x -e

########################################
# install php extension for bfs-php-sdk
########################################

cd ~

rm -rf bfs-php-extension

git clone https://github.com/apady/bfs-php-extension.git

cd bfs-php-extension

sudo ./build.sh

cd -

