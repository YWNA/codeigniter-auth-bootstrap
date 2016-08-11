<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function session_conf($key, $value = NULL)
{
	if ( !empty($_SESSION[$key]) ) {
		if ( !empty($value) ) {
			$_SESSION[$key] = $value;
			return TRUE;
		} else {
			return $_SESSION[$key];
		}
	} elseif(!empty($value)) {
		$_SESSION[$key] = $value;
		return TRUE;
	} else {
		return FALSE;
	}
}
function p($var, $isdie=TRUE, $type=null, $isjson=FALSE){
    if($type==1) die(var_dump($var));
    if($isjson){
        echo json_encode(array('code'=>TRUE, 'msg'=>'测试数据','data'=>$var));
        return;
    }else{
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
    if($isdie) die;
}
function get_guid($pw_length = 3){
    $randpwd = '';
    for ($i = 0; $i < $pw_length; $i++) {
        $randpwd .= chr(mt_rand(65, 90));
    }
    return mt_rand(00000000, 99999999) . $randpwd;
}