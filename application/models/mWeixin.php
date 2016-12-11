<?php
class MWeixin extends CI_Model{

public function __construct()
	{
		$this->load->database();
	}
/*
|-----------------------------------------------------------------------------------
|半命题作文模型
|-----------------------------------------------------------------------------------
*/


//获取所有文章
public function mGetArticle($pages)
{
	$this->db->order_by('articlesId','DESC');
	$result = $this->db->get_where('articles',null,10,$pages);
	$userId=$this->session->userdata('weixin_userId');
	$this->mAddLog($userId,'微信端打开主页（获取所有文章）');
	return $result->result_array();
}


//计算总文章数，实现分页
public function mCount(){
	return $this->db->count_all('articles');
}


//获取指定文章
public function mGetEachArticle($id)
{
	$userId=$this->session->userdata('weixin_userId');
	$this->mAddLog($userId,'微信端获取'.$id.'文章详情');
	$result = $this->db->get_where('articles',array('articlesId'=>$id));
	return $result->result_array();
}


//添加博客内容
public function mDoAddBlog($title,$content)
{
	$userId=$this->session->userdata('weixin_userId');
	$mail=$this->session->userdata('weixin_user');
	if($userId!='')
	{
		$result = $this->db->insert('articles',array('userId'=>$userId,'mail'=>$mail,'title'=>$title,'content'=>$content));
		if($result)
		{
			$this->mAddScore('sub',$userId,10);
			$this->mAddLog($userId,'微信端添加文章');
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


//用户登录验证
public function mDoLogin($mail,$password)
{
	$result=$this->db->get_where('user',array('mail'=>$mail,'password'=>$password,'state'=>1));
	$data = $result->result_array();
	$num=count($data);
	if($num==1)
	{
		$userId = $data[0]['userId'];
		$nickName = $data[0]['nickName'];
		$this->session->set_userdata('weixin_userId',$userId);
		$this->session->set_userdata('weixin_nickName',$nickName);
		$this->session->set_userdata('weixin_user',$mail);
		$this->mAddLog($userId,'微信端用户登录');
		return true;
	}
	else
	{
		return false;
	}
}


//注册用户
public function mDoRegiste($mail,$password,$username,$check,$state)
{
	$result=$this->db->get_where('user',array('mail'=>$mail));
	$num=count($result->result_array());
	if($num==0)
	{
		$result2=$this->db->insert('user',array('mail'=>$mail,'password'=>$password,'nickName'=>$username,'check'=>$check,'state'=>$state));
		if($result2)
		{
			$this->mAddLog('','微信端新用户注册');
			return 'right';
		}
		else{
			return 'wrong';
		}
	}
	else
	{
		return 'has';
	}
}


//验证邮箱
public function mCheckMail($mail,$check)
{
	$result=$this->db->get_where('user',array('mail'=>$mail,'check'=>$check));
	$num=count($result->result_array());
	if($num==1)
	{
		$this->db->where(array('mail'=>$mail));
		$result2 = $this->db->update('user',array('state'=>1));
		if($result2)
		{
			$result3 = $this->db->get_where('user',array('mail'=>$mail));
			$data = $result3->result_array();
			//$mail = $result_array[$i]['userId'];
			if(count($data)>0)
			{
				//为新注册用户添加模块
				$userId = $data[0]['userId'];
				$part = array(
					array('userId'=>$userId,'title'=>'常用','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>1),
					array('userId'=>$userId,'title'=>'性能优化','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>2),
					array('userId'=>$userId,'title'=>'CSS3','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>3),
					array('userId'=>$userId,'title'=>'HTML5','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>4),
					array('userId'=>$userId,'title'=>'设计','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>5),
					array('userId'=>$userId,'title'=>'鸡汤','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>6),
					array('userId'=>$userId,'title'=>'音乐','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>7),
					array('userId'=>$userId,'title'=>'个人博客','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>8),
					array('userId'=>$userId,'title'=>'个人作品','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>9),
					array('userId'=>$userId,'title'=>'消遣','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>10),
					array('userId'=>$userId,'title'=>'Web前端','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>11),
					array('userId'=>$userId,'title'=>'时尚','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>12),
					array('userId'=>$userId,'title'=>'生活常识','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>13),
					array('userId'=>$userId,'title'=>'PHP','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>14),
					array('userId'=>$userId,'title'=>'JavaScript','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>15),
					array('userId'=>$userId,'title'=>'个人修养','state'=>1,'private'=>1,'password'=>'','order'=>0,'from'=>'','otherPassword'=>'','sort'=>16),
				);
				for($i=0;$i<16;$i++)
				{
					$this->db->insert('parts',array('userId'=>$part[$i]['userId'],'title'=>$part[$i]['title'],'state'=>$part[$i]['state'],'private'=>$part[$i]['private'],'password'=>$part[$i]['password'],'order'=>$part[$i]['order'],'from'=>'','otherPassword'=>$part[$i]['otherPassword'],'sort'=>$part[$i]['sort']));
				}
				//修改模块内容来源为自己
				$result4 = $this->db->get_where('parts',array('userId'=>$userId));
				$result_array = $result4->result_array();
				
				for($i=0;$i<16;$i++)
				{	
					$this->db->where(array('partsId'=>$result_array[$i]['partsId']));
					$this->db->update('parts',array('from'=>$result_array[$i]['partsId']));
				}
				$this->mAddScore('add',$userId,200);
				$this->mAddLog($userId,'微信端新用户邮箱验证成功');
			}
			
			return 'right';
		}
		else{
			return 'false';
		}
	}
	else{
		return 'wrong';
	}
}


//添加评论
public function mAddComment($id,$toUserId,$userId,$userName,$comment){
	$result = $this->db->insert('messages',array('articlesId'=>$id,'fromUserId'=>$userId,'fromUserName'=>$userName,'content'=>$comment));
	if($result){
		$this->mAddScore('add',$toUserId,1);
		$this->mAddScore('sub',$userId,1);
		$this->mAddLog($userId,'微信端评论'.$id.'成功');
		return true;
	}else{
		return false;
	}
}


//获取评论
public function mGetComments($id){
	$this->db->order_by('messagesId','DESC');
	$result = $this->db->get_where('messages',array('articlesId'=>$id));
	$userId=$this->session->userdata('weixin_userId');
	$this->mAddLog($userId,'微信端获取'.$id.'评论成功');
	return $result->result_array();
}


//向用户的评论
public function mDoAddMessage($articlesId,$toUserId,$toUserName,$content,$fromUserName,$fromUserId){
	$result = $this->db->insert('messages',array(
		'articlesId'=>$articlesId,
		'toUserId'=>$toUserId,
		'toUserName'=>$toUserName,
		'content'=>$content,
		'fromUserName'=>$fromUserName,
		'fromUserId'=>$fromUserId,
	));
	if($result){
		$this->mAddScore('add',$toUserId,1);
		$this->mAddScore('sub',$fromUserId,1);
		$this->mAddLog($fromUserId,'微信端在文章'.$articlesId.'向'.$toUserId.'评论成功');
		return true;
	}else{
		return false;
	}
}


//获取积分信息
public function mGetScore(){
	$userId=$this->session->userdata('weixin_userId');
	$result = $this->db->get_where('score',array('userId'=>$userId));
	return $result->result_array();
}

//生成日志记录
private function mAddLog($userId='',$detail){
	$userAddress = $_SERVER["REMOTE_ADDR"];
	$this->db->insert('logs',array('userId'=>$userId,'detail'=>$detail, 'address'=>$userAddress));
}


//加减积分
private function mAddScore($operation,$userId,$addScore){
	$result = $this->db->get_where('score',array('userId'=>$userId));
	$result_array = $result->result_array();
	if(count($result_array)==1){
		$oddScore = $result_array[0]['score'];
		if($operation == 'add'){
			$newScore = $oddScore+$addScore;
		}else if($operation == 'sub'){
			$newScore = $oddScore-$addScore;
		}else{
			$newScore =$oddScore;
		}
		$this->db->where('userId',$userId);
		$result2= $this->db->update('score',array('score'=>$newScore));
		if($result2){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}


}
?>