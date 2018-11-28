dnl $Id$
dnl config.m4 for extension bfs

dnl Comments in this file start with the string 'dnl'.
dnl Remove where necessary. This file will not work
dnl without editing.

dnl If your extension references something external, use with:

dnl PHP_ARG_WITH(bfs, for bfs support,
dnl Make sure that the comment is aligned:
dnl [  --with-bfs             Include bfs support])

dnl Otherwise use enable:

PHP_ARG_ENABLE(bfs, whether to enable bfs support,
dnl Make sure that the comment is aligned:
[  --enable-bfs           Enable bfs support])

if test "$PHP_BFS" != "no"; then
  dnl Write more examples of tests here...

  dnl # --with-bfs -> check with-path
  dnl SEARCH_PATH="/usr/local /usr"     # you might want to change this
  dnl SEARCH_FOR="/include/bfs.h"  # you most likely want to change this
  dnl if test -r $PHP_BFS/$SEARCH_FOR; then # path given as parameter
  dnl   BFS_DIR=$PHP_BFS
  dnl else # search default path list
  dnl   AC_MSG_CHECKING([for bfs files in default path])
  dnl   for i in $SEARCH_PATH ; do
  dnl     if test -r $i/$SEARCH_FOR; then
  dnl       BFS_DIR=$i
  dnl       AC_MSG_RESULT(found in $i)
  dnl     fi
  dnl   done
  dnl fi
  dnl
  dnl if test -z "$BFS_DIR"; then
  dnl   AC_MSG_RESULT([not found])
  dnl   AC_MSG_ERROR([Please reinstall the bfs distribution])
  dnl fi

  dnl # --with-bfs -> add include path
  dnl PHP_ADD_INCLUDE($BFS_DIR/include)

  dnl # --with-bfs -> check for lib and symbol presence
  dnl LIBNAME=bfs # you may want to change this
  dnl LIBSYMBOL=bfs # you most likely want to change this 

  dnl PHP_CHECK_LIBRARY($LIBNAME,$LIBSYMBOL,
  dnl [
  PHP_ADD_LIBRARY_WITH_PATH(bfs_c,/usr/local/lib, BFS_SHARED_LIBADD)
  dnl   AC_DEFINE(HAVE_BFSLIB,1,[ ])
  dnl ],[
  dnl   AC_MSG_ERROR([wrong bfs lib version or lib not found])
  dnl ],[
  dnl   -L$BFS_DIR/$PHP_LIBDIR -lm
  dnl ])
  PHP_REQUIRE_CXX()
  PHP_ADD_LIBRARY(stdc++, 1, BFS_SHARED_LIBADD)
  PHP_SUBST(BFS_SHARED_LIBADD)

  PHP_NEW_EXTENSION(bfs, bfs.cc, $ext_shared)
fi
