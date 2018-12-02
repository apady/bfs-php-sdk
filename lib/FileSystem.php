<?php
/**
 * @author lishen chen <frankchenls@outlook.com>
 */
namespace BFS;

use BFS\Exception\IOException;
use BFS\Exception\ClientException;


class FileSystem
{
    const OK=0;
    const BAD_PARAMETER=-1;
    const PERMISSION_DENIED=-2;
    const NOT_ENOUGH_QUOTA=-3;
    const NETWORK_UNAVAILABLE=-4;
    const TIMEOUT=-5;
    const NOT_ENOUGH_SPACE=-6;
    const OVERLOAD=-7;
    const META_NOT_AVAILABLE=-8;
    const UNKNOWN_ERROR=-9;
    private $bfs;
    private $response_list= array("ok","bad parameter",
        "permission denied", "not enough quota", "network unavailable",
        "timeout", "not enough space", "overload", "meta not available",
        "unknown error");
    private $exception=array("Bad source ",
            "Open local file fail " ,
           "Get local file stat fail " ,
           "Open bfs file fail " ,
          "Write bfs file fail " ,
        "Close bfs file fail " );

    private function getResponseStatus($result){
        return $this->response_list[-$result];
    }


    public function __construct($bfs_flag_file_path){

        $this->bfs=new \BFS();
        if(!$this->bfs->init($bfs_flag_file_path)){
            throw new ClientException(null, 0, null, $bfs_flag_file_path);

        }
    }


    public function mkdir($dir){
        
           $res=$this->bfs->mkdir($dir);
           if($res!=0){
            throw new IOException(sprintf('Create Directory  "%s" failed, exception: %s.',
             $dir,$this->getResponseStatus($res)), 0, null, $dir);
            
           }
        
    }


    public function rmdir($dir,$recursive=true){
               
            $res=$this->bfs->rmdir($dir,$recursive);
            if($res!=0){
                 throw new IOException(sprintf('Remove Directory  "%s" failed, exception: %s.',
             $dir,$this->getResponseStatus($res)), 0, null, $dir);
            }
                
        }


    public function remove($file){
             
            $res=$this->bfs->remove($file);
            if($res!=0){
             throw new IOException(sprintf('Remove file  "%s" failed, exception: %s.',
             $file,$this->getResponseStatus($res)), 0, null, $file);
            }      
    }


    public function rename($old_path,$new_path){
       
        $res=$this->bfs->rename($old_path,$new_path);
        if ($res!=0) {
            throw new IOException(sprintf('Rename file  "%s" failed, exception: %s.',
             $old_path,$this->getResponseStatus($res)), 0, null, $old_path);
        }


    }

    public function chmod($mode,$path){

        $res=$this->bfs->chmod($mode,$path);
        if ($res!=0) {
             throw new IOException(sprintf('Chmod  "%s" failed, exception: %s.',
             $path,$this->getResponseStatus($res)), 0, null, $path);
        }

    }

    public function du($path){

        $size=$this->bfs->du($path);
        if($size!=0){
            throw new IOException(sprintf('Compute disk usage  "%s" failed, exception: %s.',
             $path,$this->getResponseStatus($size)), 0, null, $path);
        }

        return $size;

    }


    public function exists($files){
        $maxPathLength = PHP_MAXPATHLEN - 2;
        foreach ($this->toIterable($files) as $file) {
            if (\strlen($file) > $maxPathLength) {
               return false;
            }
            $res=$this->bfs->ls($file);
            if ($res!=0) {
                return false;
            }
        }
        return true;

    }

    public function put($local,$bfs){
       
            $res=$this->bfs->put($local,$bfs);
            if ($res!=0) {
                throw new IOException(sprintf('Put  "%s" to "%s" failed, exception: %s.',
             $local,$bfs,$this->exception[$res-1]), 0, null, $local);
            }        

    }

    public function get($bfs,$local){

        $res=$this->bfs->get($bfs,$local);
        if ($res!=0) {
              throw new IOException(sprintf(' Get "%s" from "%s" failed, exception: %s.',
             $bfs,$local,$this->exception[$res-1]), 0, null, $bfs);
        }

    }

    public function status(){

        $res=$this->bfs->status();
        if (\is_numeric($res)) {
              throw new IOException(sprintf(' Get BFS status failed, exception: %s.'
               ,$this->getResponseStatus($res),0, null, null));
        }
        return $res;

    }
     /**
     * @param mixed $files
     *
     * @return array|\Traversable
     */
    private function toIterable($files)
    {
        return \is_array($files) || $files instanceof \Traversable ? $files : array($files);
    }




}