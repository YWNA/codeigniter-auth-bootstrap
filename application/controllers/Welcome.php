<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
	    $this->view_override = false;
		$this->load->view('welcome');
	}
	public function editor(){
        $this->load->view('editor');
    }
    public function feeds()
    {
        //RSS源地址列表数组
        $rssfeed = array("https://segmentfault.com/questions/hottest/feeds");
        //设置编码为UTF-8
        header('Content-Type:text/html;charset= UTF-8');
        for($i=0;$i<sizeof($rssfeed);$i++){//分解开始
            $buff = "";
            $rss_str="";
            //打开rss地址，并读取，读取失败则中止
            $fp = fopen($rssfeed[$i],"r") or die("can not open $rssfeed");
            while ( !feof($fp) ) {
                $buff .= fgets($fp,4096);
            }
            //关闭文件打开
            fclose($fp);

            //建立一个 XML 解析器
            $parser = xml_parser_create();
            //xml_parser_set_option -- 为指定 XML 解析进行选项设置
            xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
            //xml_parse_into_struct -- 将 XML 数据解析到数组$values中
            xml_parse_into_struct($parser,$buff,$values,$idx);
            //xml_parser_free -- 释放指定的 XML 解析器
            xml_parser_free($parser);

            foreach ($values as $val) {
                var_dump($val);
                $tag = $val["tag"];
                $type = $val["type"];
                $value = isset($val["value"]) ? $val['value'] : 'dasd';
                //标签统一转为小写
                $tag = strtolower($tag);
                echo $tag . $type;
                if ($tag == "summary" && $type == "complete"){
                    echo $value . '<br>';
                }
            }
        }
    }
}
