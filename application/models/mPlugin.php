<?php
class MPlugin extends CI_Model{

public function __construct()
	{
	$this->load->database();
	}
	
/*
|----------------------------------------------------------------------------
|为插件传递用户已有的模块信息
|----------------------------------------------------------------------------
|
|
|
*/	
	public function mGetName()
	{
		$freesite_userId=$this->session->userdata('freesite_userId');
		if($freesite_userId!='')
		{
			$result=$this->db->get_where('parts',array('userId'=>$freesite_userId));
			return $result->result_array();
		}
	}
/*
|----------------------------------------------------------------------------
|插件向数据库插入链接信息
|----------------------------------------------------------------------------
|1.验证用户名和密码是否正确
|2.通过$menupopup获取model
|3.向link表中插入数据
|
*/	
	public function mAddLink($menupopup,$link_name,$link)
	{
		//$menupopup代表模块的全局唯一标识
		$freesite_userId=$this->session->userdata('freesite_userId');
		if($freesite_userId!='')
		{
			$data['partId']=$menupopup;
			$data['userId']=$freesite_userId;
			$data['name']=$link_name;
			$data['links']=$link;
			//此处没有做防重名处理
			$ok=$this->db->insert('links',$data);
			if($ok)
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
	}
?>