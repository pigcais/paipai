<script src="../js/jquery-1.4.2.js"></script>
<script>
	$(document).ready(function(){
		//*****LOGIN*****

		//登陆功能
		$("a#submit_form_login").click(function(){
			$.ajax({
				type: "post",
	            dataType: "text",
	            url: "action/login.php",
	            data: $('#form_login').serialize(),
	            success: function(data){
					var json = eval ("(" + data + ")");
					$("#msg_form_login").text(json.msg);	

					if(json.result == "success"){
						//更新页面中部分链接
						$("#user_state").html("会员");
						$("#user_menu").html("<a href='user_index.php'>我的中心</a> <a id='loginoff' href='javascript:void(0);'>注销</a>");
					}
				}
			});
		});//end

		//注销
		$("#loginoff").live('click', function(){
			$.post("action/loginoff.php", {"":""}, function(data){
				var json = eval ("(" + data + ")");

				if(json.result == "success"){
					//更新页面中部分链接
					alert('success');
					location.href = "index.php";
					$("#user_state").html("游客");
					$("#user_menu").html("");
				}
			});
		});
		
		//*****REGISTER*****
		
		//注册功能
		$("#submit_form_register").click(function(){
			$.ajax({
				type: "post",
	            dataType: "text",
	            url: "action/register.php",
	            data: $('#form_register').serialize(),
	            success: function(data){
					var json = eval ("(" + data + ")");
					$("#msg_form_register").text(json.msg);	
				}
			});
		});//end
		//检查用户名是否可用
		$("input#name").blur(function(){
			var str = this.value;
				
			$.post("action/test_register.php",{name:str},function(data){
				var json = eval ("(" + data + ")");
				$("#msg_test_register").text(json.msg);
			});
		});//end


		//*****QUEUE_TABLE*****
		//将用户的搜索信息发送给搜索引擎，然后得到返回的json对象数组，输出所有的商家列表
		$("#submit_search_merchant").click(function (){
			$.ajax({
				type: "post",
	            dataType: "text",
	            url: "action/search_merchant.php",
	            data: $('#form_search_merchant').serialize(),
	            success: function(data){
					var json = eval ("(" + data + ")");
					var trs = "";
					$.each(json, function(index, obj){
						var tr = "";
						tr += "<tr class='merchant_list'>";
						tr += "<td class='merchant_name'><a href='"+obj.url+"'>"+obj.merchant_name+"</a></td>";
						tr += "<td class='business_theme'>"+obj.business_theme+"</td>";
						tr += "<td class='address'>"+ obj.province + obj.city + obj.county +"</td>";
						tr += "<td class='state'>"+(obj.state==1?"营业":"暂停排队")+"</td>";
						tr += "<td class='action'><a name='"+obj.mid+"' class='"+(obj.state==1?"merchant_ctrl":"invalid")+"' href='javascript:void(0);'>排队</a></td>";
						tr += "</tr>";
						trs += tr;
					});
					$("#table_queue tbody").html(trs);
				}
			});
		});
		
		
		//请求商家队列信息，且在相应的merchant后生成其business
		$("a.merchant_ctrl").live('click', function(){
			var mid = this.name;//要请求的商家的id

			if($(this).parent().parent().next().hasClass('business_list')){ //如果页面中已有a->td->tr->tr.next，则终止
				if($(this).parent().parent().next().css("display") == 'table-row'){ 
					$(this).parent().parent().next().hide();
					$(this).text("排队");
				}else{
					$(this).parent().parent().next().show();
					$(this).text("隐藏");
				}
				return;
			}
			$(this).text("隐藏");
			
			//设置ajax为同步，若不设置则会在执行.post之前把hmtl()执行
			$.ajaxSetup({ 
			    async : false 
			});        
			var trs = "";
			$.post("action/queue_merchant.php", {mid:mid}, function(data){
				var json = eval ("(" + data + ")");
				$.each(json, function(index, obj){
					//生成mid的商家详细队列情况,每次一行tr
					var tr = "";
					tr += "<tr>";
					tr += "<td class='business_name'>"+obj.business_name+"</td>";
					tr += "<td class='current_sum'>"+(obj.current_num - obj.current_serve)+"</td>";//计算当前队列的总人数
					tr += "<td class='queue_bar'>"+"</td>";//暂时考虑忽略空号影响
					tr += "<td class='current_serve'>"+"</td>";
					tr += "<td class='user_loc'>"+"</td>";
					tr += "<td class='state'>"+(obj.state==1?"营业":"暂停排队")+"</td>";
					tr += "<td class='action'><a name='"+obj.business_id+"' class='"+(obj.state==1?"insert_business_ctrl":"invalid")+"' href='javascript:void(0);'>插入</a></td>";
					tr += "</tr>";
					trs += tr;
				});
			});
			//制作<tr>business</tr>
			var business = "<tr class='business_list'>";
			business += "<td></td>";
			business += "<td colspan='4'>"
							+"<table border='0'>"
							+"<thead>"
							    +"<tr>"
							      +"<th>业务项目</th>"
							      +"<th>队列人数</th>"
							      +"<th>您的位置</th>"
							      +"<th></th>"
							      +"<th></th>"
							      +"<th>队列状态</th>"
							      +"<th>操作</th>"
							    +"</tr>"
							+"</thead>"
							+"<tbody>";
			business += trs;
			business += "</tbody></table></td></tr>";

			$(this).parent().parent().after(business);
		});//end
		
		
		//队列的维护系列函数：插入
		$("a.insert_business_ctrl").live('click', function(){
			var business_id = this.name;
			var tr = $(this).parent().parent();//需要新的行

			$.post("action/business_insert.php", {business_id:business_id}, function(data){
				var json = eval ("(" + data + ")");

				if(json.result == "success"){
					//更新本行数据
					tr.children(".current_sum").html(json.current_num - json.current_serve+"人");
					tr.children(".queue_bar").html(yourLocation(1, 1));//刚插入队，进度条为满
					tr.children(".current_serve").text(json.current_serve+"/");
					tr.children(".user_loc").text(json.current_num);
					
					//更新链接
					tr.children(".action").html(
						"<a name='"+business_id+"' class='out_business_ctrl' href='javascript:void(0);'>离队</a>"
					);
					//激活刷新，直到用户离开队列
					refresh(tr, business_id);
				}else{
					//插入失败
					alert("sorry,又失败了~~");
					//修改链接
					if(json.state == 0){
						tr.children(".action").html(
							"<a name='"+business_id+"' class='insert_business_ctrl invalid' href='javascript:void(0);'>插入(灰色)</a>"
						);
					}
				}
			});
		});//end insert

		//队列的维护系列函数：刷新
		function refresh(tr, business_id){
			var user_loc = tr.children(".user_loc").text();
			var time;
			
			if(user_loc < 20)	
				time = 5 * 1000;
			if(20 <= user_loc < 100)	
				time = 60 * 1000;
			if(user_loc >= 100)	
				time = 300 * 1000;
			
			var ctr = setInterval(function(){
				$.post("action/business_refresh.php", {business_id:business_id, user_loc:user_loc}, function(data){
					var json = eval ("(" + data + ")");
					user_loc = tr.children(".user_loc").text();
					
					//如果页面中当前位置是数字，意味着此队用户正在排
					if(!isNaN(user_loc)){
						//更新本行数据	
						if(json.current_num == 0){
						//防止因刷新冲突未取到信息
							return;
						}
						tr.children(".current_sum").text(json.current_num - json.current_serve+"人");
						tr.children(".state").text(json.state?"营业":"暂停排队");

						if(user_loc == json.current_serve){
							//排到了 更新链接为插入
							if(json.state == 0){
								tr.children(".action").html(
									"<a name='"+business_id+"' class='insert_business_ctrl invalid' href='javascript:void(0);'>插入(灰色)</a>"
								);
							}else{
								tr.children(".action").html(
									"<a name='"+business_id+"' class='insert_business_ctrl' href='javascript:void(0);'>插入</a>"
								);
							}
							tr.children(".queue_bar").html("*****");
							tr.children(".user_loc").text("**");
							clearInterval(ctr);
						}else{
							//尚未排到
							tr.children(".queue_bar").html(yourLocation(user_loc-json.current_serve, json.old_length));
						}
					}else{
						clearInterval(ctr);
					}
				});
				
			}, time);
		}//end refresh

		//队列的维护系列函数：离开
		$("a.out_business_ctrl").live('click', function(){
			var business_id = this.name;
			var tr = $(this).parent().parent();//需要刷新的行
			var user_loc = tr.children(".user_loc").text();
			
			$.post("action/business_out.php", {user_loc:user_loc, business_id:business_id}, function(){
				//更新本行数据
				tr.children(".queue_bar").text("*******");
				tr.children(".user_loc").text("**");
			});
			//更新链接
			tr.children(".action").html(
				"<a name='"+business_id+"' class='insert_business_ctrl' href='javascript:void(0);'>插入</a>"
			);
		});//end out

	});

	//商家队列信息，进度条生成函数
	function yourLocation(user_before, old_length){
		var result = "";
		var location = (100 * user_before) / old_length;
	
		result += "<div style='height:20px; width:100px; border:1px solid blue;'>";//后期style去掉 换成id
		result += "<div style='height:20px; width:"+location+"px; background-color:blue;'></div>";
		result += "</div>";
	
		return result;
	}//end
</script>