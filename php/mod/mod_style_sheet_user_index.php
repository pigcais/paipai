<script>
	$(document).ready(function(){
		//user_info表单显示
		$("#user_info_ctl").click(function(){
			$.post("action/user_info.php", {}, function(data){
				var json = eval ("(" + data + ")");

				if(json.result == "success"){
					$("input[name=name]").val(json.name);
					$("input[name=pwd]").val(json.pwd);
					$("input[name=confirm]").val(json.pwd);
					$("input[name=gender]").val(json.gender);
					$("input[name=mail]").val(json.mail);
					$("input[name=address]").val(json.address);
					$("input[name=phone]").val(json.phone);
					$("input[name=qq]").val(json.qq);
				}
			});
			$("#form_user_info").toggle();
		});//end
		$("#user_info_close").click(function(){
			$("#form_user_info").toggle();
		});
		//user_info表单编辑
		$("#user_info_submit").click(function(){
			$.post("action/user_info_edit.php", $('#form_user_info').serialize(), function(data){
				var json = eval ("(" + data + ")");

				if(json.result == "success"){
					alert('success');
				}
			});
		});//end

		//merchant_info表单提交
		$("#merchant_info_submit").click(function(){
			$.post("action/merchant_info_submit.php", $('#form_merchant_info').serialize(), function(data){
				var json = eval ("(" + data + ")");

				if(json.result == "success"){
					alert('success');
					$("#merchant_state").html("<a href='merchant_index.php'>我的商店</a>");
					$("#form_merchant_info").toggle();
				}
			});
		});//end
		$("#merchant_info_ctl, #merchant_info_close").click(function(){
			$("#form_merchant_info").toggle();
		});

		//user_queue控制
		$("#user_queue_ctl").click(function(){
			$("#form_user_queue_info").toggle();
			$("#user_queue_refresh").toggle();
		});
		$("#user_queue_ctl, #user_queue_refresh").click(function(){
			//生成该用户排队信息
			
			//设置ajax为同步，若不设置则会在执行.post之前把hmtl()执行
			$.ajaxSetup({ 
			    async : false 
			});        
			var trs = "";
			$.post("action/user_queue_info.php", {}, function(data){
				var json = eval ("(" + data + ")");

				$.each(json, function(index, obj){
					//生成uid的详细队列情况,每次一行tr
					var tr = "";
					tr += "<tr>";
					tr += "<td class='business_name'>"+obj.business_name+"</td>";
					tr += "<td class='queue_bar'>"+yourLocation(obj.current_num-obj.current_serve, obj.old_length)+"</td>";//暂时考虑忽略空号影响
					tr += "<td class='current_serve'>"+obj.current_serve+"/</td>";
					tr += "<td class='user_loc'>"+obj.current_num+"</td>";
					tr += "<td class='state'>"+(obj.state==1?"营业":"暂停排队")+"</td>";
					tr += "<td class='action'><a name='"+obj.business_id+"' class='out_business_ctrl' href='javascript:void(0);'>离开</a></td>";
					tr += "</tr>";
					trs += tr;
				});
			});

			var business = "<table border='0'>"
							+"<thead>"
							    +"<tr>"
							      +"<th>业务项目</th>"
							      +"<th>您的位置</th>"
							      +"<th></th>"
							      +"<th></th>"
							      +"<th>队列状态</th>"
							      +"<th>操作</th>"
							    +"</tr>"
							+"</thead>"
							+"<tbody>";
			business += trs;
			business += "</tbody></table>";

			$("#form_user_queue_info").html(business);
		});
	});
</script>














