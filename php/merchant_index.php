<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="chinaz-site-verification" content="b185ba99-60e7-4f2f-ae5e-e9b87f02680a" />
<?php 
	include_once 'mod/mod_include.php';
	include_once 'mod/mod_style_sheet_merchant_index.php';
?>
</head>
<body>
	<div id="merchant_menu">
		<ul>
			<li>
				<a id="merchant_info_ctl" href="javascript:void(0);">我的商家信息</a>
			</li>
			<li>
				<a id="merchant_business_ctl" href="javascript:void(0);">本店业务管理</a>
			</li>
			<li>
				<a id="merchant_delete_ctl" href="javascript:void(0);">注销本店</a>
			</li>
			<li>
				<a id="merchant_queue_ctl" href="javascript:void(0);">本店排队</a>
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
					<td><a id="merchant_info_submit" href="javascript:void(0);">修改</a></td>
					<td><a id="merchant_info_close" href="javascript:void(0);">关闭</a></td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="business_info" style="display:none;">
		<div>
			<a id="create_business" href="javascript:void(0);">创建业务</a>
			<form id="form_business_info" style="display:none;">
				<table>
					<tr>
						<td>business_name:</td>
						<td><input name="name" type="text" /></td>
					</tr>
					<tr>
						<td>describe:</td>
						<td><input name="describe" type="text" /></td>
					</tr>
					<tr>
						<td><a id="business_info_submit" href="javascript:void(0);">创建</a></td>
						<td><a id="business_info_close" href="javascript:void(0);">关闭</a></td>
					</tr>
				</table>
			</form>
		</div>
		
		<table id="table_business" border="1">
			<thead>
				<tr>
					<td>业务名</td>
					<td>业务描述</td>
					<td>操作</td>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
	
	<?php /////////////////?>
	<div>
		<table id="merchant_queue_info" style="display:none;">
			<thead>
				<tr>
					<th>业务名</th>
					<th>队列人数</th>
					<th>当前服务</th>
					<th>下一位</th>
					<th>号码</th>
					<th>发号</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
	<?php /////////////////?>
	
</body>
</html>















