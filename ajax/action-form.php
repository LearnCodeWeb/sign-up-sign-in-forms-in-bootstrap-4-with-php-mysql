<?php
include_once('../config.php');

if(isset($_REQUEST['forgotemail']) and $_REQUEST['forgotemail']!=""){
	extract($_REQUEST);
	$getUsers	=	$db->getAllRecords('tb_user','*',' AND ((useremail="'.$forgotemail.'") OR (username="'.$forgotemail.'")) ');
	if(isset($getUsers[0]['id']) and $getUsers[0]['id']!=""){
		
		$token		=	md5(uniqid('lcw-'.mt_rand(),true));
		$update		=	$db->update('tb_user',array('token'=>$token),array('id'=>$getUsers[0]['id']));
		
		$tokenUrl	=	home_url.'password.php?token='.$token;
		
		/*
		** Email sent to register user
		*/
		
		$body	=	'<table bgcolor="#FFFFFF" width="560" style="border:1px solid #ccc; opacity:0.8; font-family:Arial; font-size:14px; line-height:18px;" cellspacing="0" cellpadding="5" border="0" align="center">
						<tbody>
							<tr>
								<td align="center"><strong style="color:#55BDE8; font-size:3em; font-weight:bolder; text-align:center; margin:0px;">PASSWORD UPDATED</strong><br /><br /></td>
							</tr>
							<tr>
								<td><strong>Request</strong></td>
							</tr>
							<tr>
								<td style="color:#4da6e1; font-size: 25px; padding-bottom: 10px; border-bottom: 1px solid #000;">Dear '.isset($getUsers[0]['username'])?$getUsers[0]['username']:'User'.',</td>
							</tr>
							<tr>
								<td valign="top" align="left">
									<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>You can contact us any time by</p>
								</td>
							</tr>
							<tr>
								<td align="center"><a href="" style=" background: #007bff; color: #fff; padding: 10px; border-radius: 5px; border: 4px solid #0167d4; text-decoration:none;" target="_blank">Change Password</a></td>
							</tr>
							<tr>
								<td width="100%" valign="middle" align="center" style="text-align: center; width: 100%; padding: 5px; color:#FFF; height:60px; background:linear-gradient(to bottom, #33BDBE 0, #06184d 100%);">
									<p style="font-size: 14px; padding-top: 10px;">
									<a style="color: #fff;text-decoration:none;" href="" target="_blank">Terms of Use</a> |
									<a style="color: #fff;text-decoration:none;" href="" target="_blank">Privacy Policy</a> |
									<a style="color: #fff;text-decoration:none;" href="" target="_blank">Licensing &amp; Compliance</a>
									</p>
								</td>
							</tr>
						</tbody>
					</table>';
		
		$name		=	'Learn Code Web';
		$email		=	'help@learncodeweb.com';
		$to			=	$getUsers[0]['useremail'];
		
		$header 	=	"From: \"".$name."\" <".$email.">\n";
		$header 	.=	"To: \"".$name."\" <".$to.">\n";
		$header 	.=	"Return-Path: <".$email.">\n";
		$header 	.=	"MIME-Version: 1.0\n";
		$header 	.=	"Content-Type: text/HTML; charset=ISO-8859-1\n";

		
		$subject	=	'FORGET PASSWORD';
		$mail		=	mail($to,$subject,$body,$header);
		
		if(!$mail) {
			echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Email not send!</div>|***|0';
			exit;
		}else{
			echo '<div class="alert alert-success p-1 mt-1"><i class="fa fa-fw fa-thumbs-up"></i> Cheack you email!</div>|***|1|***|index.php';
			exit;
		}
	}else{
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Invalid user!</div>|***|0';
		exit;
	}
}

if(isset($_REQUEST['signinname']) and $_REQUEST['signinname']!=""){
	extract($_REQUEST);
	$getUsers	=	$db->getAllRecords('tb_user','id,username,useremail,userpassword',' AND ((useremail="'.$signinname.'") OR (username="'.$signinname.'")) AND userstatus=1 ');
	if(isset($getUsers[0]['userpassword']) and $getUsers[0]['userpassword']!=""){
		/*
		** Get and varify user password
		*/
		$hash	=	$getUsers[0]['userpassword'];
		
		if(password_verify($signinpassword, $hash)){
			$_SESSION['id']			=	$getUsers[0]['id'];
			$_SESSION['name']		=	$getUsers[0]['username'];
			echo '<div class="alert alert-success p-1 mt-1"><i class="fa fa-fw fa-thumbs-up"></i> Login successfully <strong>Please wait..!</strong></div>|***|1|***|home.php';
			exit;
		} else {
			echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Invalid password!</div>|***|0';
			exit;
		}
	}else{
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> User not exist or not varified!</div>|***|0';
		exit;
	}
	
}

if(isset($_REQUEST['signupemail']) and $_REQUEST['signupemail']!=""){
	extract($_REQUEST);
	
	
	$getUsers	=	$db->getQueryCount('tb_user','id',' AND ((useremail="'.$signupemail.'") OR (username="'.$signupusername.'")) ');
	if($getUsers[0]['total']){
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> User already exist!</div>|***|0';
		exit;
	}
	$termcondition	=	'';
	if(isset($signupcondition)){
		$termcondition	=	1;
	}
	if($signuppassword!=$signupcpassword){
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Passwords does not match!</div>|***|0';
		exit;
	}
	if($termcondition==""){
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Agree with the Terms & Conditions!</div>|***|0';
		exit;
	}
	if(!filter_var($signupemail,FILTER_VALIDATE_EMAIL)){
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Email address is not valid!</div>|***|0';
		exit;
	}
	
	
	$token		=	md5(uniqid('lcw-'.mt_rand(),true));
	$tokenUrl	=	home_url.'varify.php?token='.$token;
	
	/*
	*** Creating hash with cost 12
	*** You can change or can ignore cost as per your need
	*/
	
	$options	=	array('cost' => 12);
	$hash		=	 password_hash($signuppassword, PASSWORD_BCRYPT, $options);
	
	$data		=	array(
						'useremail'=>$signupemail,
						'username'=>$signupusername,
						'userpassword'=>$hash,
						'termcondition'=>$signupcondition,
						'userstatus'=>0,
						'token'=>$token
						);
	$insert		=	$db->insert('tb_user',$data);
	
	if($insert){
		
		/*
		** Email sent to register user
		*/
		
		$body	=	'<table bgcolor="#FFFFFF" width="560" style="border:1px solid #ccc; opacity:0.8; font-family:Arial; font-size:14px; line-height:18px;" cellspacing="0" cellpadding="5" border="0" align="center">
						<tbody>
							<tr>
								<td align="center"><strong style="color:#55BDE8; font-size:3em; font-weight:bolder; text-align:center; margin:0px;">THANK YOU</strong><br /><br /></td>
							</tr>
							<tr>
								<td align="center"><span style="color:#000; font-size:2.2em; text-align:center; margin:0px;">for your registration</span></td>
							</tr>
							<tr>
								<td style="color:#4da6e1; font-size: 25px; padding-bottom: 10px; border-bottom: 1px solid #000;">Dear '.$signupusername.',</td>
							</tr>
							<tr>
								<td valign="top" align="left">
									<p style="color:#000; font-size: 29px; font-weight: normal; margin:15px 0px;">Thank you for</p>
									<p style="color:#000; font-size: 29px; font-weight: normal; margin:15px 0px;">signing up for the free</p>
									<p style="color:#50BBE7; font-size: 29px;font-weight: normal; margin:15px 0px;">LearnCodeWeb Account.</p>
								</td>
							</tr>
							<tr>
								<td valign="top" align="left">
									<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>You can contact us any time by</p>
								</td>
							</tr>
							<tr>
								<td align="center"><a href="https://learncodeweb.com/themeforest/varify.php?token='.$token.'" style=" background: #007bff; color: #fff; padding: 10px; border-radius: 5px; border: 4px solid #0167d4;" target="_blank">Activate Your Account</a></td>
							</tr>
							<tr>
								<td width="100%" valign="middle" align="center" style="text-align: center; width: 100%; padding: 5px; color:#FFF; height:60px; background:linear-gradient(to bottom, #33BDBE 0, #06184d 100%);">
									<p style="font-size: 14px; padding-top: 10px;">
									<a style="color: #fff;text-decoration:none;" href="" target="_blank">Terms of Use</a> |
									<a style="color: #fff;text-decoration:none;" href="" target="_blank">Privacy Policy</a> |
									<a style="color: #fff;text-decoration:none;" href="" target="_blank">Licensing &amp; Compliance</a>
									</p>
								</td>
							</tr>
						</tbody>
					</table>';
		
		
		$name		=	'Learn Code Web';
		$email		=	'noreply@learncodeweb.com';
		$to			=	$signupemail;
		
		$header 	=	"From: \"".$name."\" <".$email."> \n";
		$header 	.=	"To: \"".$name."\" <".$to."> \n";
		$header 	.=	"Return-Path: <".$email."> \n";
		$header 	.=	"MIME-Version: 1.0\n";
		$header 	.=	"Content-Type: text/HTML; charset=ISO-8859-1 \n";

		
		$subject	=	'NEW REGISTRATION';
		$mail		=	mail($to,$subject,$body,$header);
		
		if(!$mail) {
			echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> User created but email not send!</div>|***|0';
			exit;
		}else{
			echo '<div class="alert alert-success p-1 mt-1"><i class="fa fa-fw fa-thumbs-up"></i> Success message goes here!</div>|***|1|***|index.php';
			exit;
		}
	}else{
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Error message goes here!</div>|***|0';
		exit;
	}
}


if(isset($_REQUEST['changepassword']) and $_REQUEST['changepassword']!=""){
	extract($_REQUEST);
	
	if($changepassword!=$changecpassword){
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Passwords does not match!</div>|***|0';
		exit;
	}
	$userData		=	$db->getAllRecords('tb_user','id,username',' AND token="'.$token.'"');
	if(isset($userData[0]['id']) and $userData[0]['id']!=""){
		
		/*
		*** Creating hash with cost 12
		*** You can change or can ignore cost as per your need
		*/
		
		$options	=	array('cost' => 12);
		$hash		=	password_hash($changepassword, PASSWORD_BCRYPT, $options);
		
		$data		=	array(
							'userpassword'=>$hash,
							'token'=>''
							);
		$update		=	$db->update('tb_user',$data,array('id'=>$userData[0]['id']));
		
		if($update){
			
			/*
			** Email sent to Change password
			*/
			
			$body	=	'<table bgcolor="#FFFFFF" width="560" style="border:1px solid #ccc; opacity:0.8; font-family:Arial; font-size:14px; line-height:18px;" cellspacing="0" cellpadding="5" border="0" align="center">
							<tbody>
								<tr>
									<td align="center"><strong style="color:#55BDE8; font-size:3em; font-weight:bolder; text-align:center; margin:0px;">PASSWORD UPDATED</strong><br /><br /></td>
								</tr>
								<tr>
									<td style="color:#4da6e1; font-size: 25px; padding-bottom: 10px; border-bottom: 1px solid #000;">Dear '.$userData[0]['username'].',</td>
								</tr>
								<tr>
									<td valign="top" align="left">
										<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br>You can contact us any time by</p>
									</td>
								</tr>
								<tr>
									<td width="100%" valign="middle" align="center" style="text-align: center; width: 100%; padding: 5px; color:#FFF; height:60px; background:linear-gradient(to bottom, #33BDBE 0, #06184d 100%);">
										<p style="font-size: 14px; padding-top: 10px;">
										<a style="color: #fff;text-decoration:none;" href="" target="_blank">Terms of Use</a> |
										<a style="color: #fff;text-decoration:none;" href="" target="_blank">Privacy Policy</a> |
										<a style="color: #fff;text-decoration:none;" href="" target="_blank">Licensing &amp; Compliance</a>
										</p>
									</td>
								</tr>
							</tbody>
						</table>';
			
			$name		=	'Learn Code Web';
			$email		=	'noreply@learncodeweb.com';
			$to			=	$userData[0]['useremail'];
			
			$header 	=	"From: \"".$name."\" <".$email.">\n";
			$header 	.=	"To: \"".$name."\" <".$to.">\n";
			$header 	.=	"Return-Path: <".$email.">\n";
			$header 	.=	"MIME-Version: 1.0\n";
			$header 	.=	"Content-Type: text/HTML; charset=ISO-8859-1\n";
			
			$subject	=	'PASSWORD CHANGED';
			$mail		=	mail($to,$subject,$body,$header);
			
			if(!$mail) {
				echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Password updated but email not send!</div>|***|0';
				exit;
			}else{
				echo '<div class="alert alert-success p-1 mt-1"><i class="fa fa-fw fa-thumbs-up"></i> Password updated successfully!</div>|***|1|***|index.php';
				exit;
			}
		}
	}else{
		echo '<div class="alert alert-danger p-1 mt-1"><i class="fa fa-fw fa-exclamation-triangle"></i> Invalid token <strong>Please try again!</strong></div>|***|0|***|index.php';
		exit;
	}
}