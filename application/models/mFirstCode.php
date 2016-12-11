<?php
class MFirstCode extends CI_Model{

public function __construct()
	{
		$this->load->database();
	}
/*
|-----------------------------------------------------------------------------------
|新年第一行代码模型
|-----------------------------------------------------------------------------------
*/
//用户首次访问添加用户
	public function mAddUser()
	{
		$this->db->insert('firstcode_user',array('Id'=>0));
		$user = $this->db->insert_id();
		$this->session->set_userdata('firstCode_user',$user);
	}
//随机选择一种语言
	public function mChoose()
	{
		$length =$this->db->count_all('firstcode_storage');
		$choose = rand(0,$length-1);
		$result1 = $this->db->get('firstcode_storage'); 
		$result1_array = $result1->result_array();
		$id = $result1_array[$choose];
		//print_r($id);
		return $id ;
		//$result = $this->db->get_where('firstcode_storage',array('Id'=>$id));
		//$str = $result->result_array();
		//return  $str;
	}
//获取总访问量
	public function mGetTotalLog()
	{
		return $this->db->count_all('firstcode_log');
	}
//获取总使用量
	public function mGetTotalShare()
	{
		$result = $this->db->get_where('firstcode_log',array('action'=>1));
		return count($result->result_array());
	}
//添加日志，记录用户访问量
	public function mAddLog($user,$from)
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$this->db->insert('firstcode_log',array('user'=>$user,'fromId'=>$from,'ip'=>$ip));
		return $this->db->insert_id();
	}
//记录用户是否分享
	public function mUpdateLog($id)
	{
		$this->db->where(array('id'=>$id));
		$result = $this->db->update("firstcode_log",array('action'=>1));
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
//输入内容
	public function mInputStorage()
	{
		$language = $this->input->post('language');
		$code = $this->input->post('code');
		$describe = $this->input->post('describe');
		$result = $this->db->insert('firstcode_storage',array('language'=>$language,'code'=>$code,'describe'=>$describe));
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>