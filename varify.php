<?php include_once('config.php'); ?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="css/form-style-z.css" type="text/css">
	
	<title>Ajax base contact us form with google recaptcha</title>
</head>
<body style="background: url(https://images.pexels.com/photos/1558732/pexels-photo-1558732.jpeg) no-repeat center center; background-size:cover;">
	<div class="overlay"></div>
	<div class="container">
		<div class="my-5">
			<?php
				$token			=	isset($_REQUEST['token'])?$_REQUEST['token']:'';
				if($token!=""){
					$userData		=	$db->getQueryCount('tb_user','id',' AND token="'.$token.'"');
					if(isset($userData[0]['total']) and $userData[0]['total']>0){
						$update		=	$db->update('tb_user',array('token'=>"",'userstatus'=>1),array('token'=>$token));
						if($update){
						?>
						<div class="alert alert-success" role="alert">
							<h4 class="alert-heading"><i class="fa fa-fw fa-thumbs-up"></i> Thank You!</h4>
							<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<hr>
							<p class="mb-0">Your account has beed successfully varified, now you can access your account <a href="<?php echo home_url; ?>" class="btn btn-primary"><i class="fa fa-fw fa-sign-in-alt"></i> Sign In</a></p>
						</div>
						<?php
						}
					}else{
				?>
				<div class="alert alert-danger" role="alert">
					<h4 class="alert-heading"><i class="fa fa-fw fa-exclamation-triangle"></i> Warning!</h4>
					<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					<hr>
					<p class="mb-0">You are trying to access wrong page. Please go back to <a href="<?php echo home_url; ?>" class="btn btn-primary"><i class="fa fa-fw fa-sign-in-alt"></i> Sign In</a> page.</p>
				</div>
				<?php }
				}else{
				?>
				<div class="alert alert-danger" role="alert">
					<h4 class="alert-heading"><i class="fa fa-fw fa-exclamation-triangle"></i> Warning!</h4>
					<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
					<hr>
					<p class="mb-0">You are trying to access wrong page. Please go back to <a href="<?php echo home_url; ?>" class="btn btn-primary"><i class="fa fa-fw fa-sign-in-alt"></i> Sign In</a> page.</p>
				</div>
				<?php } ?>
		</div> <!--/.my-5-->
	</div> <!--/.container-->
	
	<!-- Optional JavaScript --> 
	<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/form-script.js"></script>
</body>
</html>