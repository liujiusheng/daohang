<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->helper('url');
		$this->load->model('mPlugin');
		$this->load->helper('cookie');
		$this->load->library('session');
	}
/*
|----------------------------------------------------------------------------
|为插件传递用户已有的模块信息
|----------------------------------------------------------------------------
|
|
|
*/
	public function getName()
	{
		$result=$this->mPlugin->mGetName();
		$num=count($result);
		if($num!=0)
		{
			/*$s="";
			for($i=0;$i<$num;$i++)
			{
				$data=$result[$i]['title'];
				$partId = $result[$i]['partsId'];
				$s.="<menuitem label=\"$data\" value=\"$partId\"/>";
			}
			echo $s;*/
			echo json_encode($result);
		}
		else
		{
			echo "notlogin";
		}
	}
/*
|----------------------------------------------------------------------------
|插件向数据库插入链接信息
|----------------------------------------------------------------------------
|
|
|
*/	
public function addLink()
{
	$menupopup=$_POST['menupopup'];
	$link_name=$_POST['link_name'];
	$link=$_POST['link'];
	$result=$this->mPlugin->mAddLink($menupopup,$link_name,$link);
	if($result==true)
	{
		echo "添加成功";
	}
	else
	{
		echo "添加失败";
	}
}
}
?>