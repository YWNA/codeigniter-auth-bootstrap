<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
    }
	public function index()
	{
        redirect('/');
		$this->load->view('welcome_message');
	}
	public function login()
    {
        $this->view_override = false;
        if ($_POST) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ( !$this->Company_model->if_exists_username($username) ) {
                show_error($username . '不存在');
            } elseif ($this->Company_model->login($username, $password)) {
                session_conf('username', $username);
                $ret = $this->Company_model->get_company($username);
                if($ret) foreach ($ret as $key => $value) {
                    if($key != 'password') session_conf($key, $value);
                }
                redirect('/home');
            } else {
                redirect('/');
            }
        }
        $this->load->view('login',array('title'=>'登陆'));
    }
    public function register()
    {
        if ($_POST)
        {
            $username = $_POST['username'];
            if ( $this->Company_model->if_exists_username($username) ) {
                show_error($username . '已经用户名存在');
                return;
            } 
            $name = $_POST['name'];
            $type = $_POST['type'];
            $abbreviation = $_POST['abbreviation'];
            $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            $data = array(
                "username" => $username,
                "name" => $name,
                "type" => $type,
                "abbreviation" => $abbreviation,
                "password" => $password,
                "guid" => get_guid(0),
            );
            $this->db->replace('company', $data);
            redirect('/welcome/login');
        }
        $this->load->view('register',array('title'=>'注册'));
    }
    public function logout()
    {
        session_destroy();
        redirect('/');
    }
    public function guid_poster($guid)
    {
        $this->view_override = false;
        $guid = $this->escape_str($guid);
        $poster = $this->db->query("SELECT * FROM `poster` WHERE `uguid` = '".$guid."' AND status = 2 ORDER BY RAND() LIMIT 1
")->row_array();
        $poster_id = $poster['id'];
        $this->db->where('id', $poster_id);
        $data = array(
            'propagation' => $poster['propagation']+1
        );
        $this->db->update('poster', $data);
        $this->load->view('guid_poster',array(
            'poster' => $poster
        ));
    }
    public function guid_spread($guid)
    {
        $this->view_override = false;
        $guid = $this->escape_str($guid);
        $spread = $this->db->query("SELECT * FROM `spread` WHERE `uguid` = '".$guid."' AND status = 2 ORDER BY RAND() LIMIT 3
")->result_array();

        foreach ($spread as $key=>$value){
            $this->db->where('id', $value['id']);
            $data = array(
                'propagation' => $value['propagation']+1
            );
            $this->db->update('spread', $data);
        }
        $this->load->view('guid_spread',array(
            'spread' => $spread
        ));
    }

    function escape_str($str, $like = FALSE)
    {
        if (is_array($str))
        {
            foreach ($str as $key => $val)
            {
                $str[$key] = escape_str($val, $like);
            }

            return $str;
        }

        if (function_exists('mysql_real_escape_string'))
        {
            $str = addslashes($str);
        }
        elseif (function_exists('mysql_escape_string'))
        {
            $str = mysql_escape_string($str);
        }
        else
        {
            $str = addslashes($str);
        }

        // escape LIKE condition wildcards
        if ($like === TRUE)
        {
            $str = str_replace(array('%', '_'), array('\\%', '\\_'), $str);
        }

        return $str;
    }
    public function redirect(){
        $this->db->where('id', $this->escape_str($_GET['id']));
        $read_nums = $this->db->get('spread')->row_array()['read_nums'];
        $data = array(
            'read_nums' => $read_nums+1
        );
        $this->db->where('id', $this->escape_str($_GET['id']));
        $this->db->update('spread', $data);
        $url = base64_decode( urldecode($_GET['url']) );
        if (!preg_match('/^https:\/\//', $url)) {
            $url = "http://" . $url;
        }
        redirect($url);
    }
}
