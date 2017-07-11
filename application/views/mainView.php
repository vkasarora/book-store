<!DOCTYPE html>
<html>
<head>
	<title>The Book Store</title>
	<link rel="stylesheet" 
		type="text/css" 
		href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" 
		type="text/css" 
		href="<?php echo base_url(); ?>/assets/css/custom.css">
	
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>
	
	
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6" style="margin: 0 auto; float:none; padding-top:15%; padding-bottom: 20px; text-align:center">
				<h1>// The Book Store //</h1>
			</div>
			<div class="col-xs-6" style="margin: 0 auto; float:none;   padding-bottom: 15% ">
				<form action="<?php echo c_baseurl;	 ?>	search" method="get">
					<div class="form-group">
						<input type="text" placeholder="Search Books by Name, Author or ISBN Number" style="padding: 2%" class="form-control" name="search">
					</div>
					<button type="submit" style="margin: 0 auto; display: block" class="btn btn-primary">Search</button>
				</form>
			</div>
		</div>
	</div>

	<?php $this->load->view("commonFooterView.php") ?>

</body>
</html>