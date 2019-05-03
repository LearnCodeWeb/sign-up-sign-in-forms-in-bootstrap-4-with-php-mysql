<?php include_once('config.php');?>
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
	
	<title>Ajax base sign in & sign up form</title>
</head>
<body style="background: url(https://images.pexels.com/photos/1558732/pexels-photo-1558732.jpeg) no-repeat center center; background-size:cover;">
	<div class="overlay"></div>
	<div class="container">
		<div class="mt-2 mb-4">
			<div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 ml-auto mr-auto">
				<div class="col-sm-12 border border-primary shadow rounded bg-white py-2 text-center">
					<h1>Welcome <?php echo ucfirst($_SESSION['name']); ?></h1>
					<a href="logout.php" class="text-muted"><i class="fa fa-fw fa-power-off"></i> Logout</a>
				</div>
			</div> <!--/.col-xs-12 col-sm-8 col-md-6 col-lg-4-->
		</div> <!--/.mt-2 mb-4-->
	</div> <!--/.container-->
	
	<!-- Optional JavaScript --> 
	<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> 
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/form-script.js"></script>
</body>
</html>