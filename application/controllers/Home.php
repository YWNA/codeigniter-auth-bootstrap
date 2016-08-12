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
        $this->db->where('uguid', $_SESSION['guid']);
        $poster = $this->db->get('poster')->result_array();
        $this->db->where('uguid',$_SESSION['guid']);
        $spread = $this->db->get('spread')->result_array();
        $this->load->view('home/index',array('title'=>'管理页', 'poster' => $poster, 'spread' => $spread));
	}
    public function poster($guid = NULL, $id)
    {
        $ret = null;
        if (!empty($id) && $id !== '0'){
            $this->db->where(
                array(
                    'id' => $id,
                    'uguid' => $_SESSION['guid'],
                )
            );
            $ret = $this->db->get('poster')->row_array();
        }
        if ($_POST){
            if (isset($_POST['id']) && $_POST['id']){
                $data = array(
                    'img' => $_POST['img'],
                );
                $this->db->where(
                    array(
                        'id' => $_POST['id'],
                        'uguid' => $_SESSION['guid'],
                    )
                );
                $this->db->update('poster', $data);
                redirect('/home#poster');
                return;
            }
            if (isset($_POST['img']) && $_POST['img'] && isset($_POST['guid']) && ($_POST['guid'] !== false)){
                $data = array(
                    'guid' => $_POST['guid'],
                    'create_time' => date('Y-m-d H:i:s', time()),
                    'img' => $_POST['img'],
                    'uguid' => $_SESSION['guid']
                );
                $this->db->insert('poster', $data);
                redirect('/home#poster');
            }
        }
        $this->load->view('home/poster',array('title'=>'添加海报','guid'=>$guid,'ret'=>$ret));
    }
    public function poster_link()
    {
        $this->db->where('uguid',$_SESSION['guid']);
        $ret = $this->db->get('poster_link')->row_array();
        if ($_POST){
            $link = $_POST['link'];
            $weixin = $_POST['weixin'];
            $which = $_POST['which'];
            $data = array(
                'link' => $link,
                'weixin' => $weixin,
                'id' => 0,
                'which' => $which,
                'uguid' => $_SESSION['guid']
            );
            if($ret){
                $this->db->update('poster_link', $data);
            } else {
                $this->db->insert('poster_link', $data);
            }

            redirect('/home');
        }
        $this->load->view('home/poster_link',array('title'=>'添加推广链接', 'ret'=>$ret));
    }
    public function spread($id = NULL)
    {
        $ret = null;
        if (!empty($id)){
            $this->db->where(
                array(
                    'id' => $id,
                    'uguid' => $_SESSION['guid'],
                )
            );
            $ret = $this->db->get('spread')->row_array();
        }
        if ($_POST){
            if (isset($_POST['id']) && $_POST['id']){
                $data = array(
                    'title' => $_POST['title'],
                    'img' => $_POST['img'],
                    'link' => $_POST['link'],
                );
                $this->db->where(
                    array(
                        'id' => $_POST['id'],
                        'uguid' => $_SESSION['guid'],
                    )
                );
                $this->db->update('spread', $data);
                redirect('/home#spread');
                return;
            }
            if (isset($_POST['img']) && $_POST['img']){
                $data = array(
                    'title' => $_POST['title'],
                    'guid' => get_guid(),
                    'img' => $_POST['img'],
                    'link' => $_POST['link'],
                    'uguid' => $_SESSION['guid'],
                    'create_time' => date('Y-m-d H:i:s',time()),
                );
                $this->db->insert('spread', $data);
                redirect('/home#spread');
            }
        }

        $this->load->view('home/spread',array('title'=>'添加海报','ret'=>$ret));
    }
    public function fileupload()
    {
        $this->view_override = false;
        $file = $_FILES['file'];
        $name = $file['name'];
        $type = strtolower(substr($name,strrpos($name,'.')+1));
        $allow_type = array('jpg','jpeg','gif','png');
        if(!in_array($type, $allow_type)){
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ret' => false)));
        }
        //判断是否是通过HTTP POST上传的
        if(!is_uploaded_file($file['tmp_name'])){
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ret' => false)));
        }
        $upload_path = __DIR__ . "/../../public/upload/";
        $name = get_guid() . '.' . $type;
        if(move_uploaded_file($file['tmp_name'],$upload_path.$name)){
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ret' => true, 'url' => '/public/upload/' . $name)));
        }else{
            $this->output->set_content_type('application/json')->set_output(json_encode(array('ret' => false)));
        }
    }
    public function status($id, $status){
        $data = array(
            'status' => $status,
        );
        $this->db->where('id', $id);
        $this->db->update('poster', $data);
        redirect('/home#poster');
    }
    public function spread_status($id, $status){
        $data = array(
            'status' => $status,
        );
        $this->db->where('id', $id);
        $this->db->update('spread', $data);
        redirect('/home');
    }
    public function spread_show($id){
        $this->db->where(
            array(
                'id' => $id,
                'uguid' => $_SESSION['guid'],
            )
        );
        $ret = $this->db->get('spread')->row_array();
        $this->load->view('/home/spread_show',array('ret'=>$ret));
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $ret = $this->db->get('poster')->row_array();
        $path = __DIR__ . "/../.." . $ret['img'];
        unlink($path);
        $this->db->where(
            array(
                'id' => $id,
                'uguid' => $_SESSION['guid'],
            )
        );
        $this->db->delete('poster');
        redirect('/home#poster');
    }
    public function spread_delete($id)
    {
        $this->db->where('id', $id);
        $ret = $this->db->get('spread')->row_array();
        $path = __DIR__ . "/../.." . $ret['img'];
        unlink($path);
        $this->db->where(
            array(
                'id' => $id,
                'uguid' => $_SESSION['guid'],
            )
        );
        $this->db->delete('spread');
        redirect('/home#spread');
    }
}
