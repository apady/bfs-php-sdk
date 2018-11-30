/*
  +----------------------------------------------------------------------+
  | PHP Version 7                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2018 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author:  lishen chen /frankchenls@outlook.com                                                            |
  +----------------------------------------------------------------------+
*/

/* $Id$ */

#ifndef PHP_BFS_H
#define PHP_BFS_H

extern zend_module_entry bfs_module_entry;
#define phpext_bfs_ptr &bfs_module_entry

#define PHP_BFS_VERSION "0.1.0" /* Replace with version number for your extension */

#ifdef PHP_WIN32
#	define PHP_BFS_API __declspec(dllexport)
#elif defined(__GNUC__) && __GNUC__ >= 4
#	define PHP_BFS_API __attribute__ ((visibility("default")))
#else
#	define PHP_BFS_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

/*
  	Declare any global variables you may need between the BEGIN
	and END macros here:
*/
ZEND_BEGIN_MODULE_GLOBALS(bfs)

ZEND_END_MODULE_GLOBALS(bfs)

/* Always refer to the globals in your function as BFS_G(variable).
   You are encouraged to rename these macros something shorter, see
   examples in any other php module directory.
*/
#define BFS_G(v) ZEND_MODULE_GLOBALS_ACCESSOR(bfs, v)

#if defined(ZTS) && defined(COMPILE_DL_BFS)
ZEND_TSRMLS_CACHE_EXTERN()
#endif

#endif	/* PHP_BFS_H */
PHP_METHOD(BFS, __construct);
PHP_METHOD(BFS, __destruct);
PHP_METHOD(BFS, ls);
PHP_METHOD(BFS, init);
PHP_METHOD(BFS, mkdir);
PHP_METHOD(BFS, rmdir);
PHP_METHOD(BFS, chmod);
PHP_METHOD(BFS, put);
PHP_METHOD(BFS, get);
PHP_METHOD(BFS, rename);
PHP_METHOD(BFS, remove);
PHP_METHOD(BFS, du);
PHP_METHOD(BFS, location);
PHP_METHOD(BFS, cat);
PHP_METHOD(BFS, status);
PHP_METHOD(BFS,changeReplicaNum);

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
