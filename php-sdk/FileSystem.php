<?php
/**
 * @author lishen chen <frankchenls@outlook.com>
 */
namespace AppBundle\Service;


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
        $this->bfs->init($bfs_flag_file_path);
    }
    public function mkdir($dirs){
        $fail_list=array();
        foreach ($this->toIterable($dirs) as $dir) {
           $res=$this->bfs->mkdir($dir);
           if($res!=0)
               $fail_list[$dir]=$this->getResponseStatus($res);
        }
        return $fail_list;

    }
    public function rmdir($dirs,$recursive=true){
        $fail_list=array();
        foreach ($this->toIterable($dirs) as $dir) {
            $res=$this->bfs->rmdir($dir,$recursive);
            if($res!=0)
                $fail_list[$dir]=$this->getResponseStatus($res);
        }
        return $fail_list;

    }
    public function remove($files){
        $fail_list=array();
        foreach ($this->toIterable($files) as $file) {
            $res=$this->bfs->remove($file);
            if($res!=0)
                $fail_list[$file]=$this->getResponseStatus($res);
        }
        return $fail_list;

    }
    public function rename($old_path,$new_path){
        $fail_list=array();

        $res=$this->bfs->rename($old_path,$new_path);
        if ($res!=0) {
            $fail_list[$old_path]=$this->getResponseStatus($res);
        }


        return $fail_list;

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
        $fail_list=array();

            $res=$this->bfs->put($local,$bfs);
            if ($res!=0) {
                $fail_list[$bfs]=$this->exception[$res-1];
            }


        return $fail_list;

    }
    public function get($bfs,$local){
        $fail_list=array();

        $res=$this->bfs->get($bfs,$local);
        if ($res!=0) {
            $fail_list[$bfs]=$this->exception[$res-1];
        }


        return $fail_list;

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