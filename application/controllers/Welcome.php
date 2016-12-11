<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('mWelcome');
		//$this->load->model('m_user');
		$this->load->helper('cookie');
		$this->load->library('session');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	
	 */
	 
	 /**
	 * 通过分享进入，获取单个模块信息
	 *
	 *
	 */
	public function shareGetPartInfo()
	{
		//此处不用做用户登录验证，因为分享出到接收的用户大多为未知用户，并没有注册我们的网站
		$partsId = $_POST['partsId'];
		$result = $this->mWelcome->mShareGetPartInfo($partsId);
		if($result)
		{
			echo json_encode($result);
		}
		else
		{
			echo "false";
		}
		
	}
	
	
	 /**
	  * 修改设置----修改模块关注来源
	  *
	  *
	  *
	  *
	  */
	public function setChangeFrom()
	{
		$userId=$this->session->userdata('freesite_userId');
		if($userId!='')
		{
			$partsId = $_POST['partsId'];
			$from = $_POST['from'];
			$result = $this->mWelcome->mSetChangeFrom($partsId,$from);
			if($result)
			{
				echo "true";
			}
			else
			{
				echo "false";
			}
		}
		else
		{
			echo 'notlogin';
		}
	}
	
	/**
	  * 修改设置----修改关注模块密码
	  *
	  *
	  *
	  *
	  */
	public function setChangeFromPassword()
	{
		$userId=$this->session->userdata('freesite_userId');
		if($userId!='')
		{
			$partsId = $_POST['partsId'];
			$fromPassword = $_POST['fromPassword'];
			$result = $this->mWelcome->mSetChangeFromPassword($partsId,$fromPassword);
			if($result)
			{
				echo "true";
			}
			else
			{
				echo "false";
			}
		}
		else
		{
			echo 'notlogin';
		}
	}
	
	 /**
	  * 修改设置----修改模块密码
	  *
	  *
	  *
	  *
	  */
	public function setChangePassword()
	{
		$userId=$this->session->userdata('freesite_userId');
		if($userId!='')
		{
			$partsId = $_POST['partsId'];
			$password = $_POST['password'];
			$result = $this->mWelcome->mSetChangePassword($partsId,$password);
			if($result)
			{
				echo "true";
			}
			else
			{
				echo "false";
			}
		}
		else
		{
			echo 'notlogin';
		}
	}
	 /**
	  * 修改设置----修改模块隐私状态
	  *
	  *
	  *
	  *
	  */
	 public function setChangePrivate()
	 {
		$userId=$this->session->userdata('freesite_userId');
		if($userId!='')
		{
			$partsId = $_POST['partsId'];
			$private = $_POST['private'];
			$result = $this->mWelcome->mSetChangePrivate($partsId,$private);
			echo $result;
		}
		else
		{
			echo 'notlogin';
		}
	 }
	 /**
	  * 修改设置----修改模块名称
	  *
	  *
	  *
	  **/
	 public function setChange()
	 {
		$userId=$this->session->userdata('freesite_userId');
		if($userId!='')
		{
		 $partsId = $_POST['partsId'];
		 $title = $_POST['title'];
		 $result = $this->mWelcome->mSetChange($partsId,$title);
		 return $partsId;
		}
		else
		{
			echo 'notlogin';
		}
	 }
	 
	 
	//默认主页，一般不显示只在用户输入错误时显示
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	
	//加载帮助主页
	public function help()
	{
		$data['username'] = $this->session->userdata('freesite_nickName');
		$this->load->view('help',$data);
	}
	
	
	//加载博客主页
	public function blog()
	{
		$data['username'] = $this->session->userdata('freesite_nickName');
		$data['article'] = $content=$this->mWelcome->mGetArticle();
		$this->load->view('blog',$data);
	}
	
	
	//加载单条博客
	public function eachBlog($id)
	{
		$data['username'] = $this->session->userdata('freesite_nickName');
		$data['article'] = $this->mWelcome->mGetEachArticle($id);
		$this->load->view('eachblog',$data);
	}
	
	
	//添加博客页面
	public function addBlog()
	{
		$data['username'] = $this->session->userdata('freesite_nickName');
		$this->load->view('addblog',$data);
	}
	
	
	//添加博客内容
	public function doAddBlog()
	{
		$title = $this->input->post('linkname');
		$content = $this->input->post('content');
		if($title!=''&&$content!='')
		{
			$result = $this->mWelcome->mDoAddBlog($title,$content);
			if($result)
			{
				$data['username'] = $this->session->userdata('freesite_nickName');
				$data['article'] = $content=$this->mWelcome->mGetArticle();
				//$this->load->view('blog',$data);
				redirect('welcome/blog');
			}
			else
			{
				$data['username'] = $this->session->userdata('freesite_nickName');
				$data['title']	= $title;
				$data['content'] = $content;
				$this->load->view('addblog',$data);
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
	
	
	//加载注册页面
	public function loadRegiste()
	{
		$data['username'] = $this->session->userdata('freesite_nickName');
		$this->load->view('registe',$data);
	}
	
	
	//注册
	public function doRegiste()
	{
		$username	=$this->input->post('username');
		$mail		=$this->input->post('mail');
		$password	=$this->input->post('password');
		$check		=MD5($mail);
		$state		=0;
		$result		=$this->mWelcome->mDoRegiste($mail,$password,$username,$check,$state);
		if($result=='right')
		{
			$this->load->library('email');
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'smtp.qq.com';
			$config['smtp_user'] = '891599396@qq.com';
			$config['smtp_pass'] = 'sheng93';
			$config['smtp_port'] = '25';
			$config['smtp_timeout'] = '5';
			$config['crlf']="\r\n";   
			$config['newline']="\r\n";
			$config['charset']='utf-8';
			$this->email->initialize($config);

			$this->email->from('891599396@qq.com', '我的主页');
			$this->email->to($mail);
			$this->email->subject('我的主页用户验证');
			//$url=urlencode('?mail='.$mail.'&check='.$check);
			$this->email->message('您好，感谢您注册我的主页，请点击下面链接完成邮箱验证'.base_url('index.php/welcome/checkMail').'?mail='.$mail.'&check='.$check);

			if($this->email->send())
			{
				header("Content-type: text/html; charset=utf-8");
				echo '离成功只有一步之遥了，赶紧去邮箱验证吧，<a href="'.base_url('index.php/welcome/loadRegiste').'">返回注册页面</a>';
			}
			else
			{
				header("Content-type: text/html; charset=utf-8");
				echo '邮件发不出来<a href="'.base_url('index.php/welcome/loadRegiste').'">返回注册页面</a>';
			}
			
		}
		else if($result=='has')
		{
			header("Content-type: text/html; charset=utf-8");
				echo '此邮箱已经注册过了<a href="'.base_url('index.php/welcome/loadLogin').'">返回登录页面</a><a href="'.base_url('index.php/welcome/loadRegiste').'">重新注册</a>';
		}
		else{
			header("Content-type: text/html; charset=utf-8");
			echo '注册失败<a href="'.base_url('index.php/welcome/loadRegiste').'">返回重新注册</a>';
		}
	}
	
	
	//验证邮箱
	public function checkMail()
	{
		$mail=$this->input->get('mail');
		$check=$this->input->get('check');
		$result=$this->mWelcome->mCheckMail($mail,$check);
		
		if($result=='right')
		{
			header("Content-type: text/html; charset=utf-8");
			echo '您已完成邮箱验证，现在返回登录吧<a href="'.base_url('index.php/welcome/loadLogin').'">我的主页</a>';
		}
		else if($result=='has'){
			header("Content-type: text/html; charset=utf-8");
			echo '您已完成邮箱验证，不需要再验证了，现在返回登录吧<a href="'.base_url('index.php/welcome/loadLogin').'">我的主页</a>';
		}
		else{
			header("Content-type: text/html; charset=utf-8");
			echo '验证失败，请重试';
		}
	}
	
	
	//加载登录页面
	public function loadLogin()
	{
		$data['username'] = $this->session->userdata('freesite_nickName');
		$this->load->view('login',$data);
	}
	
	
	//注销
	public function logout()
	{
		$data['username'] = $this->session->userdata('freesite_nickName');
		if($result=$this->session->sess_destroy())
		{
			$this->load->view('logoutWrong',$data);
		}
		else
		{
			$this->load->view('logout',$data);//echo $this->session->userdata('freesite_mail');
		}
	}
	
	
	//登录
	public function doLogin()
	{
		$data['username'] = $this->session->userdata('freesite_nickName');
		$mail = $this->input->post('mail');
		$password = $this->input->post('password');
		$result = $this->mWelcome->mDoLogin($mail,$password);
		if($result==true)
		{
			$this->load->view('ok',$data);
		}
		else
		{
			$this->load->view('wrong',$data);
		}
	}
	
	
	//获取session
	public function getSession()
	{
		echo $this->session->userdata('freesite_nickName');
	}
	
	
	//添加链接
	public function addLinks()
	{
		$userId=$this->session->userdata('freesite_userId');
		if($userId!='')
		{
			$partsId = $_POST['partsId'];
			$linkName = $_POST['linkName'];
			$links = $_POST['links'];
			if($this->mWelcome->mAddLinks($userId,$partsId,$linkName,$links))
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
		else
		{
			echo 'notlogin';
		}
	}
	
	
	//删除链接
	public function delLinks()
	{
		$userId=$this->session->userdata('freesite_userId');
		if($userId!='')
		{
			$id = $_POST['id'];
			if($this->mWelcome->mDelLinks($userId,$id))
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
		else
		{
			echo 'notlogin';
		}
	}
	
	
	//获取要显示的模块
	public function getParts()
	{
		$result = $this->mWelcome->mGetParts();
		echo json_encode($result);
	}
	
	
	//获取模块链接
	public function getLinks()
	{
		$partsId = $_POST['partsId'];
		$result = $this->mWelcome->mGetLinks($partsId);
		echo json_encode($result);
	}
	
	
	//重排序链接
	public function resortLink()
	{
		$partId = $_POST['partId'];
		$sort = $_POST['sort'];
		if($partId!=''&&$sort!='')
		{
			$result = $this->mWelcome->mResortLink($partId,$sort);
			if($result)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
		else
		{
			echo 'false';
		}
	}
	
	
	//加载QQ登录页面
	function loadQQLogin()
	{
		$this->load->view('qqlogin');
	}
	
	
	//QQ登录
	function QQLogin()
	{
		$nickName = $_POST['nickName'];
		$unionId = $_POST['unionId'];
		$accessToken = $_POST['accessToken'];
		$result = $this->mWelcome->mQQLogin($nickName,$unionId);
		//echo $nickName.":".$unionId.":".$accessToken;
		if($result)
		{
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}
	
	
	//记录用户百度搜索框搜索的关键词
	function recordKeyWord(){
		$keyWord = $_POST['keyWord'];
		$result = $this->mWelcome->mRecordKeyWord($keyWord);
		if($result == true){
			echo 'true';
		}else{
			echo 'false';
		}
	}
}
