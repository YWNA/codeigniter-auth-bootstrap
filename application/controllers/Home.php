<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
    }
	public function index()
	{
		$this->load->view('home/index',array('title'=>'管理页'));
	}
    public function poster()
    {
        $this->load->view('home/poster',array('title'=>'添加海报'));   
    }
    public function poster_link()
    {
        $this->load->view('home/poster_link',array('title'=>'添加推广链接'));   
    }
    public function spread()
    {
        $this->load->view('home/spread',array('title'=>'添加海报'));   
    }
}
