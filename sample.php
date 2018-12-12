<?php
/**
 * @author lishen chen <frankchenls@outlook.com>
 */
namespace BFS\Test;

use BFS\FileSystem;
use BFS\Exception\IOExceptionInterface;

require __DIR__.'/vendor/autoload.php';
/**
 * Simple test for BFS PHP SDK
 */
try{
	$bfs=new FileSystem('/home/bfs/sandbox/bfs.flag');
	if($bfs->exists("/test"))
		$bfs->rmdir("/test");
	$bfs->mkdir("/test");
	if($bfs->exists("/test/apady.txt"))
		$bfs->remove("/test/apady.txt");
	$bfs->fopen("/test/apady.txt","w");
	$bfs->fwrite("hello apady!!\n");
	$bfs->fwrite("hello world!!\n");
	for($i=0;$i<100;$i++)
		$bfs->fwrite(" ");	
	$bfs->fwrite("hello php!!\n");
	$bfs->fclose();
	$bfs->fopen("/test/apady.txt","r");
	printf($bfs->fread(13));
	$bfs->fclose();
	$bfs->fopen("/test/apady.txt","r");
	$bfs->fseek(126);
	printf($bfs->fread(100));
	$bfs->fclose();

	if($bfs->exists("/link1"))
		$bfs->remove("/link1");
	$bfs->symlink("/test/apady.txt","/link1");
	$bfs->cat("/link1");
	//$bfs->chmod("0755","/apady.txt");
	$bfs->ls("/");
	$bfs->put("/home/bfs/nameserver","/");
	$bfs->get("/nameserver","./");
	$bfs->changeReplicaNum("/nameserver","4");
	echo $bfs->du("/");
	echo $bfs->status();
}catch(IOExceptionInterface $exception){
	echo $exception->getMessage();
}
