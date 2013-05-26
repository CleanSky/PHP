<?php
//禁止掉某地区的IP访问网站，不过滤搜索引擎的蜘蛛

function get_ip_data(){   
    $ip=file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".get_client_ip());
    $ip = json_decode($ip);
    if($ip->code){
        return false;
    }
    $data = (array) $ip->data;
    if($data['region']=='湖北省' && !isCrawler()){
        exit('http://www.lvtao.net');
    }
}

function isCrawler() {
        $spiderSite= array(
                        "TencentTraveler",
                        "Baiduspider+",
                        "BaiduGame",
                        "Googlebot",
                        "msnbot",
                        "Sosospider+",
                        "Sogou web spider",
                        "ia_archiver",
                        "Yahoo! Slurp",
                        "YoudaoBot",
                        "Yahoo Slurp",
                        "MSNBot",
                        "Java (Often spam bot)",
                        "BaiDuSpider",
                        "Voila",
                        "Yandex bot",
                        "BSpider",
                        "twiceler",
                        "Sogou Spider",
                        "Speedy Spider",
                        "Google AdSense",
                        "Heritrix",
                        "Python-urllib",
                        "Alexa (IA Archiver)",
                        "Ask",
                        "Exabot",
                        "Custo",
                        "OutfoxBot/YodaoBot",
                        "yacy",
                        "SurveyBot",
                        "legs",
                        "lwp-trivial",
                        "Nutch",
                        "StackRambler",
                        "The web archive (IA Archiver)",
                        "Perl tool",
                        "MJ12bot",
                        "Netcraft",
                        "MSIECrawler",
                        "WGet tools",
                        "larbin",
                        "Fish search",
                );
        if(in_array(strtolower($_SERVER['HTTP_USER_AGENT']),$spiderSite)){
            return true;
        }else{
            return false;
        }
}

//取客户端 ip
function get_client_ip()
{
    if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
    } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
    return $realip;
}
?>