<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FirstCode extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MFirstCode');
		$this->load->helper('cookie');
		$this->load->library('session');
	}
	//默认主页，一般不显示只在用户输入错误时显示
	public function index($from='')
	{
		$user = $this->session->userdata('firstCode_user');
		if($user=='')
		{
			$this->MFirstCode->mAddUser();
		}
		$user = $this->session->userdata('firstCode_user');
		$data['language'] = $la = $this->MFirstCode->mChoose();
		$data['id'] = $this->MFirstCode->mAddLog($user,$from);
		$data['totalLog'] = $this->MFirstCode->mGetTotalLog();
		$data['totalShare'] = $this->MFirstCode->mGetTotalShare();
		$data['from'] = $from;
		$data['self'] = $user;
		$this->load->view('firstCode/index',$data);
	}
	//更新用户长按时间记录表中的action字段，用于记录用户是否分享了
	public function updateLog()
	{
		$id = $_POST['id'];
		$result = $this->MFirstCode->mUpdateLog($id);
		if($result==true)
		{
			echo true;
		}
		else
		{
			echo false;
		}
	}
//加载添加数据页
	public function loadAdd()
	{
		$this->load->view('firstCode/add');
	}
//添加数据
	public function inputStorage()
	{
		$result = $this->MFirstCode->mInputStorage();
		if($result==true)
		{
			$this->load->view('firstCode/add');
		}
		else
		{
			echo "wrong!";
		}
	}
}