<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>欢迎来到我的主页</title>
	<meta property="qc:admins" content="0555364617662553145633716450600077543755716450" />
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>欢迎来到我的主页！</h1>

	<div id="body">
		<p>本平台是一个在线书签，也是一个Web-app</p>

		<p>通过自定义添加网址并将本网站设为主页，可为您提供一个个性化的导航页面，没有多余的东西，全是你需要的</p>
		<code>立即使用 <a href="http://www.freesite.cc/pages/index.php">“我的主页”</a></code>

		<p>通过模块功能，您可以快速找到自己想到去的网站而不用再去“百度一下”费力打老半天的字再搜索点击找到自己想要的网站</p>
		<code>做最好的主页书签————<small>福瑞斯特</small></code>

		<p>通过我们定制的插件你可以方便地添加书签 <a href="user_guide/">下载</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?> Copyright © Daliu 2013-2015.<a href="http://www.freesite.cc/index.php/welcome/help">help.</a></p>
</div>

</body>
</html>