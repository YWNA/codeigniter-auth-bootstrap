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
}
