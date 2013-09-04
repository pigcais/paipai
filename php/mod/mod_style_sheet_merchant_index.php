<script>
	$(document).ready(function(){
		//merchant_info表单显示
		$("#merchant_info_ctl").click(function(){
			$.post("action/merchant_info.php", {}, function(data){
				var json = eval ("(" + data + ")");

				if(json.result == "success"){
					$("input[name=merchant_name]").val(json.merchant_name);
					$("input[name=business_theme]").val(json.business_theme);
					$("input[name=url]").val(json.url);
					$("input[name=province]").val(json.province);
					$("input[name=city]").val(json.city);
					$("input[name=county]").val(json.county);
					$("input[name=contact]").val(json.contact);
				}
			});
			$("#form_merchant_info").toggle();
		});//end

		$("#merchant_info_submit").click(function(){
			$.post("action/merchant_info_edit.php", $('#form_merchant_info').serialize(), function(data){
				var json = eval ("(" + data + ")");

				if(json.result == "success"){
					alert('success');
				}
			});
		});
		$("#merchant_info_close").click(function(){
			$("#form_merchant_info").toggle();
		});

		
		//注销本店
		$("#merchant_delete_ctl").click(function(){
			$.post("action/merchant_delete.php", {}, function(data){
				var json = eval ("(" + data + ")");

				alert(json.msg);
				if(json.result == "success"){
					location.href = "index.php";
				}
			});
		});

		//business管理
		$("#create_business, #business_info_close").click(function(){
			$("#form_business_info").toggle();
		});
		$("#merchant_business_ctl").click(function(){
			$("#business_info").toggle();
			//获取该店全部业务
			$.post("action/merchant_business.php", {}, function(data){
				var json = eval ("(" + data + ")");
				var trs;

				$.each(json, function(index, obj){
					var tr = "<tr id='business_"+obj.id+"'>";
					tr += "<td><input name='name' type='text' value='"+obj.name+"' /></td>";
					tr += "<td><input name='describe' type='text' value='"+obj.describe+"' /></td>";
					tr += "<td><a name='"+obj.id+"' href='javascript:void(0);' class='merchant_business_delete'>删除</a>&nbsp;";
					tr += "<a name='"+obj.id+"' href='javascript:void(0);' class='merchant_business_edit'>修改</a>&nbsp;";
					tr += "<a name='"+obj.id+"' href='javascript:void(0);' class='merchant_business_create'>创建队列</a>&nbsp;</td>";
					tr += "</tr>";
					trs += tr;
				});
				$("#table_business tbody").html(trs);
			});
		});
		
		$("#business_info_submit").click(function(){
			//创建业务
			$.post("action/merchant_business_create.php", $('#form_business_info').serialize(), function(data){
				var json = eval ("(" + data + ")");
				var tr = "<tr id='business_"+json.id+"'>";
					tr += "<td><input name='name' type='text' value='"+json.name+"' /></td>";
					tr += "<td><input name='describe' type='text' value='"+json.describe+"' /></td>";
					tr += "<td><a name='"+json.id+"' href='javascript:void(0);' class='merchant_business_delete'>删除</a>&nbsp;";
					tr += "<a name='"+json.id+"' href='javascript:void(0);' class='merchant_business_edit'>修改</a>&nbsp;";
					tr += "<a name='"+json.id+"' href='javascript:void(0);' class='merchant_business_create'>创建队列</a>&nbsp;</td>";
					tr += "</tr>";
				
				if(json.result == "success"){
					$("#table_business tbody").append(tr);
				}
			});
		});//end

		$("a.merchant_business_delete").live('click', function(){
			var business_id = this.name;
			//删除该业务
			$.post("action/merchant_business_delete.php", {business_id:business_id}, function(data){
				$("tr#business_"+business_id).remove();				
			});
		});
		$("a.merchant_business_edit").live('click', function(){
			var business_id = this.name;
			var name = $(this).parent().parent().find("input[name=name]").val();
			var describe = $(this).parent().parent().find("input[name=describe]").val();

			//修改该业务
			$.post("action/merchant_business_edit.php", {business_id:business_id,name:name,describe:describe}, function(data){
				var json = eval ("(" + data + ")");
			});
		});

		//**********merchant_queue管理**********
		$("#merchant_queue_ctl").click(function(){
			$("#merchant_queue_info").toggle();

			$.post("action/merchant_queue_info.php", {}, function(data){
				var json = eval(data);
				var trs;
				$.each(json, function(index, obj){
					var tr= "<tr>";
					tr += "<td>"+obj.name+"</td>";
					tr += "<td class='queue_sum'>"+(obj.current_num - obj.current_serve)+"</td>";
					tr += "<td class='current_serve'>"+obj.current_serve+"</td>";
					tr += "<td class='next_serve'><a name="+obj.business_id+" href='javascript:void(0);' class='get_next_serve'>下一位</a></td>";
					tr += "<td class='current_num'>"+obj.current_num+"</td>";
					tr += "<td class='next_num'><a name="+obj.business_id+" href='javascript:void(0);' class='get_next_num'>发号</a></td>";
					tr += "<td class='state'>"+(obj.state==1?'营业':'冻结')+"</td>";
					tr += "<td><a name="+obj.business_id+" href='javascript:voide(0);' class='control_queue'>stop</a>&nbsp;&nbsp;";
					tr += "<a name="+obj.business_id+" href='javascript:void(0);' class='restart_queue'>重置</a>&nbsp;&nbsp;";
					tr += "<a name="+obj.business_id+" href='javascript:void(0);' class='delete_queue'>删除</a></td>";
					tr += "</tr>";

					trs += tr;
				});
				$("#merchant_queue_info tbody").html(trs);
			});
		});

		//创建队列
		$("a.merchant_business_create").live('click', function(){
			var business_id = this.name;

			$.post("action/create_queue.php", {business_id:business_id}, function(data){
				var json = eval("(" + data + ")");

				if(json.result == "success"){
					var tr= "<tr>";
					tr += "<td>"+json.name+"</td>";
					tr += "<td class='queue_sum'>0</td>";
					tr += "<td class='current_serve'>0</td>";
					tr += "<td class='next_serve'><a name="+json.business_id+" href='javascript:void(0);' class='get_next_serve'>下一位</a></td>";
					tr += "<td class='current_num'>1</td>";
					tr += "<td class='next_num'><a name="+json.business_id+" href='javascript:void(0);' class='get_next_num'>发号</a></td>";
					tr += "<td class='state'>营业</td>";
					tr += "<td><a name="+json.business_id+" href='javascript:voide(0);' class='control_queue'>stop</a>&nbsp;&nbsp;";
					tr += "<a name="+json.business_id+" href='javascript:void(0);' class='restart_queue'>重置</a>&nbsp;&nbsp;";
					tr += "<a name="+json.business_id+" href='javascript:void(0);' class='delete_queue'>删除</a></td>";
					tr += "</tr>";

					alert('success');
					$("#merchant_queue_info tbody").append(tr);
					$("#merchant_queue_info").show();
				}else{
					alert(json.msg);
				}
			});
		});
		
		//获取服务的下一位
		$("a.get_next_serve").live('click', function(){
			var business_id = this.name;
			var current_serve = $(this).parent().parent().find("td.current_serve").text();
			var current_num = $(this).parent().parent().find("td.current_num").text();

			if(current_num == (parseInt(current_serve)+1)){
				alert('没有可服务的了~~');
//				$(this).parent().parent().find("td.next_serve a").hide();
				return;
			}
						
			$.post("action/get_next_serve.php", {business_id:business_id,current_serve:current_serve}, function(data){
				var json = eval("(" + data + ")");
			});
			
			$(this).parent().parent().find("td.current_serve").text(++current_serve);
		});
		//发号
		$("a.get_next_num").live('click', function(){
			var business_id = this.name;

			$.post("action/get_next_num.php", {business_id:business_id}, function(data){
				var json = eval("(" + data + ")");
			});
			
			var current_num = $(this).parent().parent().find("td.current_num").text();
			$(this).parent().parent().find("td.current_num").text(++current_num);
		});

		//暂停-开启业务
		$("a.control_queue").live('click', function(){
			var business_id = this.name;
			var action = this.text;
			var tr = $(this).parent().parent();
			
			$.post("action/control_queue.php", {business_id:business_id, action:action}, function(data){
				var json = eval("(" + data + ")");
			});

			$(this).text(action=='stop'?'start':'stop');
			var state = (action=='stop'?'冻结':'营业');
			tr.find("td.state").text(state);	
			tr.find("td.next_serve a, td.next_num a").toggle();
		});

		//删除业务，只有当队列中没人排队时
		$("a.delete_queue").live('click', function(){
			var business_id = this.name;
			var tr = $(this).parent().parent();
			var json;
			
			$.post("action/delete_queue.php", {business_id:business_id}, function(data){
				json = eval("(" + data + ")");
				
				alert(json.msg);		
				if(json.result == 'success'){
					tr.toggle();
				}			
			});
		});

		//重置业务，只有当队列中没人排队时，初始化队列
		$("a.restart_queue").live('click', function(){
			var business_id = this.name;
			var tr = $(this).parent().parent();
			var json;
			
			$.post("action/restart_queue.php", {business_id:business_id}, function(data){
				json = eval("(" + data + ")");
				alert(json.msg);		
				
				if(json.result == 'success'){
					tr.find("td.current_num, td.current_serve, td.queue_sum").text("0");
				}			
			});
		});
	});
</script>














