#!/usr/bin/env bash
set -x -e

########################################
# install php extension for bfs-php-sdk
########################################

WORK_DIR=bfs-php-extension
cd ~

if [ ! -d "${WORK_DIR}/.git" ]; then
  rm -rf bfs-php-extension
  git clone https://github.com/apady/bfs-php-extension.git
  cd bfs-php-extension
  chmod 755 build.sh
  ./build.sh
  cd -
else
  cd bfs-php-extension
  git pull
  ./build.sh
  cd -  
fi

