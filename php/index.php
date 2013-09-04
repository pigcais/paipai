<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="chinaz-site-verification" content="b185ba99-60e7-4f2f-ae5e-e9b87f02680a" />
<?php 
	include_once 'mod/mod_include.php';
?>
</head>
<body>
<div>
	<ul>
		<li id="user_state">
			<?php 
				if(isset($_SESSION['login'])){
					echo $_SESSION['login']?"会员":"游客";
				}
			?>	
		</li>
		<li id="user_menu">
			<?php if(isset($_SESSION['login']) && $_SESSION['login'] == True){ ?>
					<a href="user_index.php">我的中心</a>
					<a id="loginoff" href="javascript:void(0);">注销</a>
			<?php }?>					
		</li>
	</ul>
</div>

<div id="login">
	<form id="form_login" >
		<table>
			<tr>
				<td>用户名:</td>
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><input type="password" name="pwd" /></td>
			</tr>
			<tr>
				<td>
					<a id="submit_form_login" href="javascript:void(0)">登陆</a>
				</td>
				<td><a href="#">注册</a></td>
			</tr>
			<tr>
				<td></td>
				<td><div id="msg_form_login" style="width:30px; height:20px;"></div></td>
			</tr>
		</table>
	</form>	
</div>

<div id="register">
	<form id="form_register">
		<table>
			<tr>
				<td>用户名:</td>
				<td>
					<input id="name" type="text" name="name" />
					<div id="msg_test_register" style="width:30px; height:20px;"></div>
				</td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><input type="password" name="pwd" /></td>
			</tr>
			<tr>
				<td>密码确认:</td>
				<td><input type="password" name="pwd_confirm" /></td>
			</tr>
			<tr>
				<td>验证码：</td>
				<td>
					<input type="text" name="code" />
					<img src=mod/mod_test_code.php />
				</td>
			</tr>
			<tr>
				<td><a id="submit_form_register" href="javascript:void(0)">提交</a></td>
				<td>
					<a href="#">取消</a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><div id="msg_form_register" style="width:30px; height:20px;"></div></td>
			</tr>
		</table>		
	</form>	
</div>

<div id="search_merchant">
	<form id="form_search_merchant">
		<table>
			<tr>
				<td><a id="submit_search_merchant" href="javascript:void(0)">搜索</a></td>
				<td></td>
			</tr>
		</table>
	</form>
</div>

<div id="queue">
	<table id="table_queue" border="1">
		<thead>
		    <tr>
		      <th>店名</th>
		      <th>服务范围</th>
		      <th>商家地址</th>
		      <th>营业状况</th>
		      <th>操作</th>
		    </tr>
		</thead>
		<tbody>
			<?php //以下紧挨的tr为所有符合用户搜索的商家?>
			<?php //以下紧挨的tr为该店各业务状况table?>
		</tbody>
	</table>
</div>

</body>
</html>



















