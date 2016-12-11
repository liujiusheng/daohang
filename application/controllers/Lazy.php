<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lazy extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('mLazy');
		$this->load->helper('cookie');
		$this->load->library('session');
	}
	//默认主页，一般不显示只在用户输入错误时显示
	public function index($from='')
	{
		$user = $this->session->userdata('lazy_user');
		if($user=='')
		{
			$this->mLazy->mAddUser();
		}
		$user = $this->session->userdata('lazy_user');
		$this->mLazy->mAddLog($user,$from);
		$data['totalLog'] = $this->mLazy->mGetTotalLog();
		$data['totalList'] = $this->mLazy->mGetTotalList();
		$data['maxTime'] = $this->mLazy->mGetMaxTime();
		$data['from'] = $from;
		$data['self'] = $user;
		$this->load->view('lazy/index',$data);
	}
	public function message($from='')
	{
		$data['result'] = $this->mLazy->mGetMessage();
		$data['from'] = $from;
		$this->load->view('lazy/message',$data);
	}
	public function addmessage()
	{
		$user = $this->session->userdata('lazy_user');
		$content = $this->input->post('content');
		$result = $this->mLazy->mAddMessage($user,$content);
		if($result==true)
		{
			$data['result'] = "评论成功";
		}
		else
		{
			$data['result'] = "评论失败";
		}
		$this->load->view('lazy/addmessage',$data);
	}
	//添加游戏时间记录
	public function addScore()
	{
		$seconds = $_POST['seconds'];
		$self = $_POST['self'];
		$from =$_POST['fromId'];
		$result = $this->mLazy->mAddScore($seconds,$from,$self);
		if($result!=false)
		{
			echo $result;
		}
		else
		{
			echo false;
		}
	}
	//更新用户长按时间记录表中的action字段，用于记录用户是否分享了
	public function updateLog()
	{
		$id = $_POST['id'];
		$result = $this->mLazy->mUpdateLog($id);
		if($result==true)
		{
			echo true;
		}
		else
		{
			echo false;
		}
	}
}