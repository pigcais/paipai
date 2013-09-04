<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="chinaz-site-verification" content="b185ba99-60e7-4f2f-ae5e-e9b87f02680a" />
<?php 
	include_once 'mod/mod_include.php';
	include_once 'mod/mod_style_sheet_user_index.php';
?>
</head>
<body>
	<div id="user_info">
		<form id="form_user_info" style="display:none;">
			<table>
				<tr>
					<td>name:</td>
					<td><input name="name" type="text" readonly /></td>
				</tr>
				<tr>
					<td>pwd:</td>
					<td><input name="pwd" type="password" /></td>
				</tr>
				<tr>
					<td>pwd confirm:</td>
					<td><input name="confirm" type="password" /></td>
				</tr>
				<tr>
					<td>gender:</td>
					<td><input name="gender" type="text" /></td>
				</tr>
				<tr>
					<td>e-mail:</td>
					<td><input name="mail" type="text" /></td>
				</tr>
				<tr>
					<td>address:</td>
					<td><input name="address" type="text" /></td>
				</tr>
				<tr>
					<td>phone:</td>
					<td><input name="phone" type="text" /></td>
				</tr>
				<tr>
					<td>qq:</td>
					<td><input name="qq" type="text" /></td>
				</tr>
				<tr>
					<td><a id="user_info_submit" href="javascript:void(0);">修改</a></td>
					<td><a id="user_info_close" href="javascript:void(0);">关闭</a></td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="merchant_menu">
		<ul>
			<li>
				<a id="user_info_ctl" href="javascript:void(0);">我的信息</a>
			</li>
			<li id="merchant_state">
				<?php if($_SESSION['merchant'] == true){?>
					<a href="merchant_index.php">我的商店</a>
				<?php }else{?>
					<a id="merchant_info_ctl" href="javascript:void(0);">申请开通商家</a>
				<?php }?>
			</li>
			<li>
				<a id="user_queue_ctl" href="javascript:void(0);">我的排队</a>
				<a id="user_queue_refresh" href="javascript:void(0);" style="display:none;">刷新</a>
			</li>
		</ul>
	</div>
	
	<div id="merchant_info">
		<form id="form_merchant_info" style="display:none;">
			<table>
				<tr>
					<td>merchant_name:</td>
					<td><input name="merchant_name" type="text" /></td>
				</tr>
				<tr>
					<td>business_theme:</td>
					<td><input name="business_theme" type="text" /></td>
				</tr>
				<tr>
					<td>url:</td>
					<td><input name="url" type="text" /></td>
				</tr>
				<tr>
					<td>province:</td>
					<td><input name="province" type="text" /></td>
				</tr>
				<tr>
					<td>city:</td>
					<td><input name="city" type="text" /></td>
				</tr>
				<tr>
					<td>county:</td>
					<td><input name="county" type="text" /></td>
				</tr>
				<tr>
					<td>contact:</td>
					<td><textarea name="contact"></textarea></td>
				</tr>
				<tr>
					<td><a id="merchant_info_submit" href="javascript:void(0);">提交</a></td>
					<td><a id="merchant_info_close" href="javascript:void(0);">关闭</a></td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="user_queue_info">
		<form id="form_user_queue_info" style="display:none;">
			
		</form>
	</div>
</body>
</html>















