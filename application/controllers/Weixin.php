<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weixin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('mWeixin');
		$this->load->helper('cookie');
		$this->load->library('session');
	}


	//微信端主页
	public function index($page=0)
	{
		$data['username'] = $this->session->userdata('weixin_user');
		$data['articles'] = $content=$this->mWeixin->mGetArticle($page);
		$this->load->library('pagination');

		$config['base_url'] = base_url('index.php/weixin/index').'/';
		$config['total_rows'] = $this->mWeixin->mCount();
		$config['per_page'] = 10;
		$config['first_link'] = '首页';
		$config['last_link'] = '末页';
		$config['attributes'] = array('class' => 'pages');

		$this->pagination->initialize($config);

		$data['pages'] = $this->pagination->create_links();
		$this->load->view('weixin/index',$data);
	}


	//加载我的主页
	public function min(){
		$data['nickName'] = $this->session->userdata('weixin_nickName');
		$data['mail'] = $this->session->userdata('weixin_user');
		$data['score'] = $this->mWeixin->mGetScore();
		$this->load->view('weixin/min',$data);
	}


	//加载单条博客
	public function each($id)
	{
		$data['username'] = $this->session->userdata('weixin_user');
		$data['details'] = $this->mWeixin->mGetEachArticle($id);
		$data['comments'] = $this->mWeixin->mGetComments($id);
		$this->load->view('weixin/detail',$data);
	}


	//发布页面
	public function add(){
		$data['username'] = $this->session->userdata('weixin_user');
		$this->load->view('weixin/add',$data);
	}


	//登录页
	public function login(){
		$this->load->view('weixin/login');
	}


	//登录验证
	public function dologin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$result = $this->mWeixin->mDoLogin($username,$password);
		if($result){
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>登录成功！<a href="'.base_url('index.php/weixin/index').'">半命题作文-文章列表</a></body></html>';
		}else{
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>登录失败！<a href="'.base_url('index.php/weixin/login').'">半命题作文-登录页</a></body></html>';
		}
	}


	//注册
	public function registe(){
		$this->load->view('weixin/registe');
	}


	//执行注册
	public function doRegiste(){
		$username	=$this->input->post('username');
		$mail		=$this->input->post('mail');
		$password	=$this->input->post('password');
		$check		=MD5($mail);
		$state		=0;
		$result		=$this->mWeixin->mDoRegiste($mail,$password,$username,$check,$state);
		if($result=='right')
		{
			$this->load->library('email');
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'smtp.qq.com';
			$config['smtp_user'] = '891599396@qq.com';
			$config['smtp_pass'] = 'vlzjbnkedrvobeda';
			$config['smtp_port'] = '25';
			$config['smtp_timeout'] = '5';
			$config['crlf']="\r\n";   
			$config['newline']="\r\n";
			$config['charset']='utf-8';
			$this->email->initialize($config);

			$this->email->from('891599396@qq.com', '半命题作文');
			$this->email->to($mail);
			$this->email->subject('半命题作文用户验证');
			//$url=urlencode('?mail='.$mail.'&check='.$check);
			$this->email->message('您好，感谢您注册半命题作文，请点击下面链接完成邮箱验证'.base_url('index.php/weixin/checkMail').'?mail='.$mail.'&check='.$check);

			if($this->email->send())
			{
				echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>离成功只有一步之遥了，赶紧去邮箱验证吧，<a href="'.base_url('index.php/weixin/registe').'">返回注册页面</a></body></html>';
			}
			else
			{
				echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>邮件发不出来<a href="'.base_url('index.php/weixin/registe').'">返回注册页面</a></body></html>';
			}
			
		}
		else if($result=='has')
		{
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>此邮箱已经注册过了<a href="'
			.base_url('index.php/weixin/login').'">返回登录页面</a><a href="'.base_url('index.php/weixin/registe').'">重新注册</a></body></html>';
	}
		else{
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>注册失败<a href="'.base_url('index.php/weixin/registe').'">返回重新注册</a></body></html>';
		}
	}


	//验证邮箱
	public function checkMail()
	{
		$mail=$this->input->get('mail');
		$check=$this->input->get('check');
		$result=$this->mWeixin->mCheckMail($mail,$check);
		
		if($result=='right')
		{
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>您已完成邮箱验证，现在返回登录吧<a href="'.base_url('index.php/weixin/login').'">半命题作文-登录页</a></body></html>';
		}
		else if($result=='has'){
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>您已完成邮箱验证，不需要再验证了，现在返回登录吧<a href="'.base_url('index.php/weixin/login').'">半命题作文-登录页</a></body></html>';
		}
		else{
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>验证失败，请重试</body></html>';
		}
	}


	//添加博客内容
	public function doAddBlog()
	{
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$newdata = nl2br($content);
		if($title!=''&&$content!='')
		{
			$result = $this->mWeixin->mDoAddBlog($title,$newdata);
			if($result)
			{
				$data['username'] = $this->session->userdata('weixin_nickName');
				$data['article'] = $content=$this->mWeixin->mGetArticle();
				redirect('weixin/index');
			}
			else
			{
				$data['username'] = $this->session->userdata('weixin_nickName');
				$data['title']	= $title;
				$data['content'] = $content;
				$this->load->view('add',$data);
			}
		}
		else
		{
			$data['username'] = $this->session->userdata('freesite_nickName');
			$data['title']	= $title;
			$data['content'] = $content;
			$this->load->view('addblog',$data);
		}
	}


	//添加评论
	public function addComment(){
		$id = $this->input->post('id');
		$toUserId = $this->input->post('toUserId');
		$content = $this->input->post('content');
		$userId = $this->session->userdata('weixin_userId');
		$userName = $this->session->userdata('weixin_nickName');
		if($userId !=''){
			$result = $this->mWeixin->mAddComment($id,$toUserId,$userId,$userName,$content);
			if($result){
				echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>评论成功！<a href="'.base_url('index.php/weixin/each').'/'.$id.'">返回</a></body></html>';
			}else{
				echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>评论失败！<a href="'.base_url('index.php/weixin/each').'/'.$id.'">返回</a></body></html>';
			}
		}
		else{
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>你还没有登录！<a href="'.base_url('index.php/weixin/login').'">半命题作文-登录页</a></body></html>';
		}
	}


	//打开向其它人添加评论界面
	public function messagesToUser($toUserId, $toUserName,$articlesId){
		$data['toUserId'] = $toUserId;
		$data['toUserName'] = $toUserName;
		$data['articlesId'] = $articlesId;
		$this->load->view('weixin/messages',$data);
	}
	

	//执行向其它人添加评论
	public function doAddMessage(){
		$toUserId = $this->input->post('toUserId');
		$toUserName = $this->input->post('toUserName');
		$content = $this->input->post('content');
		$articlesId = $this->input->post('articlesId');
		$fromUserName = $this->session->userdata('weixin_nickName');
		$fromUserId = $this->session->userdata('weixin_userId');
		$result = $this->mWeixin->mDoAddMessage($articlesId,$toUserId,$toUserName,$content,$fromUserName,$fromUserId);
		if($result){
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>评论成功！<a href="'.base_url('index.php/weixin/each').'/'.$articlesId.'">返回详情内容</a></body></html>';
		}else{
			echo '<!DOCTYPE html><html><head><meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/></head><body>评论失败！<a href="'.base_url('index.php/weixin/messagesToUser').'/'.$toUserId.'/'.$toUserName.'/'.$articlesId.'">重新评论</a></body></html>';
		}
	}
}