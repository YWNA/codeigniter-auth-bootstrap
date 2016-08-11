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
}
