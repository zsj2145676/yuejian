var yj_login = {
	queryUser: function() {
		var name, pass;
		var oThis = this;
		name = $('#username').val();
		pass = $('#password').val();
		req_log_reg.ajaxQueryUser(name, pass, function(data) {
			data = eval('(' + data + ')');
			if (data.data == 0) {
				$('.log_reg_alert').html('用户名或密码错误').show();
			} else {
				$('.log_reg_alert').hide();
				window.location.href = 'index.php';
			}
		}, function() {
			yj_base.alertBackground();
		});
	},
	isAdmin: function() {
		//alert('success!hello!');	
		//管理员
	},
	isGuest: function() {
		//买家跳转
	},
	isSell: function() {
		//卖家跳转 这里区分买家卖家，显示底部我要卖时间
	},
	forgetPassword: function(username) {
		var ss = yj_base.testMailorPhone(username);
		if (ss != 'phone' && ss != 'mail') {
			$('.log_reg_alert').html("请输入正确的用户名").show();
			return;
		}
		req_log_reg.ajaxFindPasswd(username, ss, function(data) {
			if (data == 1 && ss == "mail") {
				$('.log_reg_alert').html("已经向您的邮箱中发送了邮件，请查收").show();
			} else if (data == 1 && ss == "phone") {
				$('.log_reg_alert').html("已经向您的绑定手机发送了新密码，请查收").show();
			} else {
				$('.log_reg_alert').html("用户名错误").show();
			}
		}, function() {
			yj_base.alertBackground();
		});
	}
};
var yj_register = {
	queryName: function() {
		var username;
		var oThis = this;
		username = $('#reg_username').val();
		req_log_reg.ajaxQueryName(username, function(data) {
			data = eval('(' + data + ')');
			if (data.data == 1) $('.log_reg_alert').html('用户名已经存在').show();
			else $('.log_reg_alert').hide();
		}, function() {
			yj_base.alertBackground();
		});
	},
	queryName: function() {
		var username;
		var oThis = this;
		username = $('#reg_username').val();
		req_log_reg.ajaxQueryName(username, function(data) {
			data = eval('(' + data + ')');
			if (data.data == 1) $('.log_reg_alert').html('用户名已经存在').show();
			else $('.log_reg_alert').hide();
		}, function() {
			yj_base.alertBackground();
		});
	},
	registerNew: function() {
		var username, passwd;
		var cat = [];
		var oThis = this;
		username = $('#reg_username').val();
		passwd = $('#reg_password').val();
		if (!yj_base.testMailorPhone(username)) {
			$('.log_reg_alert').html('请使用邮箱或者手机号码作为您的用户名。').show();
			return;
		}
		if (!yj_base.testPassword(passwd)) {
			$('.log_reg_alert').html('密码为6-32位字符（字母，数字<br/>或下划线）组成，区分大小写').show();
			return;
		}
		if ($('#reg_sepassword').val() != $('#reg_password').val()) {
			$('.log_reg_alert').html('两次密码输入不一致。').show();
			return;
		}
		if (!$('.agree_btn').hasClass('clicked')) {
			$('.log_reg_alert').html('请先同意我们的用户注册申明。').show();
			return;
		}
		$('.registertype').find('ul').find('li').each(function() {
			if ($(this).find('a').hasClass('a_cur')) {
				var ss = $(this).attr('name');
				cat.push(ss);
			}
		});
		if (cat.length == 0) cat = null;
		req_log_reg.ajaxRegister(username, passwd, cat, function(data) {
			data = eval('(' + data + ')');
			if (data.uid != '') {
				alert("注册成功！");
				window.location.href = "index.php";
			}
		}, function() {
			yj_base.alertBackground();
		});
	}
};