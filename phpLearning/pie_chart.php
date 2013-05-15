<?php
/* 
 * 生成饼形图片
 */
class PieChart {
    private $center;    //饼形中点
    private $width;     //饼形直径
    private $image;     //图形对象

    function __construct($width,$backcolor = array(array("r"=>0xFF,"g"=>0xFF,"b"=>0xFF))) {
        $this->width = $width;
        $this->center = $width / 2;
        
        //创建图形对象
        $this->image = imagecreatetruecolor($this->width, $this->width);

        //将初始图形填充为白色
        $color = imagecolorallocate($this->image, $backcolor[0]["r"], $backcolor[0]["g"], $backcolor[0]["b"]);
        imagefill($this->image, 0, 0, $color);
    }

    //设置图形数据
    public function graphData($data, $colors){
        $black = imagecolorallocate($this->image, 0x00, 0x00, 0x00);

        $sum = array_sum($data);

        $start = -90;

        for($i=0; $i<count($data); $i++){
            $color = imagecolorallocate($this->image, $colors[$i]["r"], $colors[$i]["g"], $colors[$i]["b"]);

            $stop = @($data[$i] / $sum * 360) + $start;

            imagefilledarc($this->image, $this->center, $this->center,
                           $this->width, $this->width, $start, $stop, $color, IMG_ARC_PIE);
            imagefilledarc($this->image, $this->center, $this->center,
                           $this->width, $this->width, $start, $stop, $black, IMG_ARC_NOFILL | IMG_ARC_EDGED);

            $start = $stop;
        }
    }

    //生成图形
    public function flushImage(){
        header("Content-type:image/png");
        imagepng($this->image);
    }
}

//根据传入参数自动生成饼图。
$total = $_GET["total"];
$count = $_GET["count"];

$data = array($total-$count,$count);
$colors = array(
    array('r'=>0xDD,'g'=>0xEE,'b'=>0xFF),
    array('r'=>0xFF,'g'=>0xBB,'b'=>0xAA)
);

$chart = new PieChart(200,array(array("r"=>0xF9,"g"=>0xF9,"b"=>0xF9)));
$chart->graphData($data, $colors);
$chart->flushImage();
?>
