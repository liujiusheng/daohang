<?php
class MLazy extends CI_Model{

public function __construct()
	{
		$this->load->database();
	}
/*
|-----------------------------------------------------------------------------------
|手抖是病模型
|-----------------------------------------------------------------------------------
*/
//用户首次访问添加用户
	public function mAddUser()
	{
		$this->db->insert('lazy_user',array('Id'=>0));
		$user = $this->db->insert_id();
		$this->session->set_userdata('lazy_user',$user);
	}
//添加留言
	public function mAddMessage($user,$content)
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		if($content!='')
		{
			$result = $this->db->insert('lazy_message',array('user'=>$user,'message'=>$content,'ip'=>$ip));
			if($result)
			{
				return true;
			}
			else
			{
				return false;
			}	
		}
		else
		{
			return false;
		}
	}
//获取总访问量
	public function mGetTotalLog()
	{
		return $this->db->count_all('lazy_log');
	}
//获取总使用量
	public function mGetTotalList()
	{
		return $this->db->count_all('lazy_list');
	}
//获取最长时间
	public function mGetMaxTime()
	{
		$this->db->select_max('seconds');
		$query = $this->db->get('lazy_list');
		$result_array = $query->result_array();
		//print_r($result_array);
		$length = count($result_array);
		if($length==1)
		{
			$time = $result_array[0]['seconds'];
			$second = round($time/1000);
			$more = $time - 1000 * $second;
			if($more<0)
			{
				$more = 1000-$more;
				$second =$second-1;
			}
			return $second.".".$more;
		}
		else
		{
			return '';
		}
		
	}
//获取留言
	public function mGetMessage()
	{
		$this->db->order_by('Id','DESC');
		$result = $this->db->get('lazy_message');
		return $result->result_array();
	}
//添加日志，记录用户访问量
	public function mAddLog($user,$from)
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$this->db->insert('lazy_log',array('user'=>$user,'fromId'=>$from,'ip'=>$ip));
	}
//记录每次游戏分数
	public function mAddScore($seconds,$from,$self)
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$result = $this->db->insert('lazy_list',array('fromId'=>$from,'user'=>$self,'seconds'=>$seconds,'ip'=>$ip));
		$id = $this->db->insert_id();
		if($result)
		{
			return $id;
		}
		else
		{
			return false;
		}
	}
//记录用户是否分享
	public function mUpdateLog($id)
	{
		$this->db->where(array('id'=>$id));
		$result = $this->db->update("lazy_list",array('action'=>1));
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
//用户生成session
	public function m_create_session($username,$password)
	{
		$result=$this->db->get_where('user',array('mail'=>$username));
		$userpassword=$result->result_array();
		$mypassword='';
		$length=count($userpassword);
		for($i=0;$i<$length;$i++)
		{
			$mypassword=$userpassword[$i]['password'];
		}
		if($mypassword==$password)
		{
			$this->session->set_userdata('freesite_mail',$username);
			return 'true';
		}
		else
		{
			return 'wrong';
		}
	}
//获取session
	public function m_get_user()
	{
		$result=$this->session->userdata('freesite_mail');
		return $result;
	}


}
?>