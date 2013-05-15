<!DOCTYPE html>
<!--扫描一个文件目录下所有图片，缩放后放在另一个目录-->
<html>
<head>
    <meta charset="utf-8" />
    <title>图片批量缩放</title>
    <style type="text/css">
        label{width:150px;display: inline-block;}
    </style>
</head>
    <?php

    class tool_slt_resize{
        public $width=null;
        public $height=null;
        public $Msg=null;
        public $extension=array('jpg','gif','jpeg','png','bmp');
        public function __construct(){
            header('Content-type: text/html; charset=UTF-8');
        }

        /**
         * 读取一个文件夹下所有的文件
         * @param $src  文件夹路径
         * @return bool
         */
        public function getAllFile($src,$new){
            set_time_limit(0);                                                   //php脚本运行时间无限时
            ob_end_clean();     //关键1
            echo str_pad('',1024);     //关键2

            $handle=opendir($src);                                               //打开一个目录句柄
            while(($file=readdir($handle)) !== false){                           //循环遍历目录下的所有文件
                if($file != '.' && $file != '..' ){                              //如果不是当前目录或者上层目录
                    $fullPath = $src.'/'.$file;                                  //得到当前文件的全路径
                    $newPath  = $new.'/'.$file;                                        //新的文件存放路径
                    $dir=dirname($newPath);
                    if(!file_exists($dir)){
                        mkdir($dir);
                    }
                    if(is_dir($fullPath)){                                       //判断是否表示一个文件夹
                        $this->getAllFile($fullPath,$newPath);                   //是文件夹的话再递归执行一次函数
                    }else{                                                       //开始图像处理
                      $extentsion=$this->get_extension($fullPath);
                      if(in_array($extentsion,$this->extension)){               //后缀是否合法
    //                          echo $newPath.'</br>';
                            $im =  imagecreatefromjpeg($fullPath);
                            $width  = imagesx($im);
                            $height = imagesy($im);
                            $this->resize_to($im,$width,$height,$this->width,$this->height,$fullPath,$newPath);
                            $msg= $fullPath.'处理完成</br>';
                            echo $msg;
                            flush();    //刷新输出缓冲
                        }
                    }
                }
            }
            echo '全部处理完成';
        }


        /**
         * 获得一些图像的信息
         * getimagesize返回一个四个单元的数组($width, $height, $type, $attr)
         * @param $src
         * @return array
         */
        public function getImgInfo($src){
            return getimagesize($src);
        }

        /**
         * 获得文件后缀
         * @param $file
         * @return mixed
         */
        function get_extension($file){
            $info = pathinfo($file);
            return strtolower($info['extension']);
        }
        //图像缩放
        public function resize_to($image,$width,$height,$dst_width,$dst_height,$path,$dstpath){
    //            set_time_limit(0);
            $resize_width  = 0;
            $resize_height = 0;
            if($dst_width && $width > $dst_width ){
                $resize_width   = 1;
                $width_ratio    = $dst_width/$width;
            }
            if($dst_height && $height > $dst_height){
                $resize_height  = 1;
                $height_ratio   = $dst_height/$height;
            }
            if($resize_height&&$resize_width){
                //宽度优先
                if($width_ratio < $height_ratio){
                    $scale_org[0] = $width * $width_ratio;
                    $scale_org[1] = $height * $width_ratio;
                }
                //高度优先
                else{
                    $scale_org[0] = $width * $height_ratio;
                    $scale_org[1] = $height * $height_ratio;
                }
            }
            elseif($resize_width){
                $scale_org[0] = $dst_width;
                $scale_org[1] = $dst_width*$height/$width;
            }
            elseif($resize_height){
                $scale_org[0] = $dst_height*$width/$height;
                $scale_org[1] = $dst_height;
            }
            if(function_exists("imagecopyresampled")){
                $newim = imagecreatetruecolor($scale_org[0], $scale_org[1]);
                imagecopyresampled($newim, $image, 0, 0, 0, 0, $scale_org[0], $scale_org[1], $width, $height);
            }else{
                $newim = imagecreate($scale_org[0], $scale_org[1]);
                imagecopyresized($newim, $image, 0, 0, 0, 0,$scale_org[0], $scale_org[1], $width, $height);
            }
            ImageJpeg ($newim,$dstpath);
            ImageDestroy ($newim);
        }
    }

    $a=new tool_slt_resize();                                   //接受表单数据开始处理图片
    $oldPath=isset($_GET['oldPath'])?$_GET['oldPath']:'';
    $newPath=isset($_GET['newPath'])?$_GET['newPath']:'';
    $width=isset($_GET['width'])?$_GET['width']:'';
    $height=isset($_GET['height'])?$_GET['height']:'';
    $a->width=$width;
    $a->height=$height;
    if(isset($_GET['submit'])){
        if($oldPath==''||$newPath==''||$width==''){
            echo '请正确填写表单';
            exit;
        }else{
            $a->getAllFile($oldPath,$newPath);

        }
    }
    ?>
    <h1>图片批量缩放</h1>
    <body>
        <form action="" method="get">
            <label>原图文件夹</label><input type="text" name="oldPath" value=""></br></br>
            <label>缩略图文件夹</label><input type="text" name="newPath" value=""></br></br>
            <label>缩略图宽度</label><input type="text" name="width"   value=""></br></br>
            <label>缩略图高度</label><input type="text" name="height"  value=""></br></br>
            <input type="submit" name="submit" value="提交">
        </form>
    </body>
</html>