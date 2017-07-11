<!DOCTYPE html>
<html>
<head>
	<title>The Book Store</title>
	<link rel="stylesheet" 
		type="text/css" 
		href="<?php echo c_baseurl; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo c_baseurl; ?>assets/css/custom.css">
	
	<style type="text/css">
		@media print {
			.donotprint {
				visibility: hidden;
			}
		}
	</style>

	<script type="text/javascript" src="<?php echo c_baseurl; ?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo c_baseurl; ?>assets/js/bootstrap.min.js"></script>
	
	
</head>
<body>
	<?php $this->load->view('commonHeaderView'); ?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				
				<h1>Thank You! Your Order has been placed!</h1>
				<p>Your order has been placed on The Book Store, a confirmation mail has been sent to <b> <?php echo $orderDetails->delivEmailId ?> </b>. Below is your order summary</p>
			</div>
		</div>

		<?php $count=0; foreach ($bookDetails as $bd) { ?>
			
		
			<div class="row" style="border: 1px solid #dedede; padding-bottom: 20px">
				<div class="col-xs-12">
					<div class="col-xs-12">
						<div class="col-xs-4">
							<?php if($count == 0){ ?>
							<h3>Order Id: <?php echo $orderDetails->userSessionId; ?></h3>
							<?php } ?>
							<img style="width: 140px;" src="<?php echo $bd->images; ?>">
							
						</div>

						<div class="col-xs-8" style="padding-top:60px">
							<h4><b><?php echo $bd->book_name; ?></b></h4>
							<small style="display: block">Author Name: <?php echo $bd->author_name; ?></small>
							<small style="display: block">ISBN: <?php echo $bd->isbn_code; ?></small>
							<small style="display: block">Vendor Name: <?php echo "The Book Store" ?></small>
						</div>
						
						
					</div>
				</div>			
			</div>
		<?php $count++; } ?>
		<div class="row" style="border: 1px solid #dedede; padding-bottom: 20px">
			<div class="col-xs-12">
				<div class="col-xs-12">
					<div class="col-xs-4">
						<h3>Delivery Information</h3>
						<h4>Your order will be dispatched shortly.</h4>

						<h4>Delivery Details</h4>
						<p style="line-height: 10px"><?php echo $orderDetails->delivFullName ?></p>
						<p style="line-height: 10px"><?php echo $orderDetails->delivDeliveryAddress ?></p>
						<p style="line-height: 10px"><?php echo $orderDetails->delivDeliveryAddress2 ?></p>
						<p style="line-height: 10px"><?php echo $orderDetails->delivCity  ?></p>
						<p style="line-height: 10px"><?php echo $orderDetails->delivState  ?></p>
						<p style="line-height: 10px"><?php echo $orderDetails->delivZipCode  ?></p>
						<p style="line-height: 10px"><?php echo $orderDetails->delivPhoneNumber  ?></p>
						<p style="line-height: 10px"><?php echo $orderDetails->delivEmailId  ?></p>
					</div>
				</div>
			</div>			
		</div>

		<div class="row" style="border: 1px solid #dedede; padding-bottom: 60px">
			<div style="position: absolute; left: 50%; padding-top:10px">
				<div style="position: relative; left: -50%">
					<button class="btn btn-primary btn-sl donotprint" id="printPageBtn">Print Page</button>
					<a href="<?php echo c_baseurl; ?>">
						<button class="btn btn-primary btn-sl donotprint">Continue Shopping</button>
					</a>	
				</div>
			</div>			
		</div>

	</div>

	<?php $this->load->view("commonFooterView.php") ?>

	<script type="text/javascript">
		$(function() {
			$("#printPageBtn").on("click", function() {
				window.print();	
			})
		}) 
	</script>

</body>

</html>