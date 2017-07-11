<!DOCTYPE html>
<html>
<head>
	<title>The Book Store</title>
	<link rel="stylesheet" 
		type="text/css" 
		href="<?php echo c_baseurl; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo c_baseurl; ?>assets/css/custom.css">
	
	<script type="text/javascript" src="<?php echo c_baseurl; ?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo c_baseurl; ?>assets/js/bootstrap.min.js"></script>
	
	
</head>
<body>

	<?php $this->load->view('commonHeaderView'); ?>
	


	<div class="container" style="padding-bottom: 200px;">
		<?php if(isset($bookDetails)){ ?>
			<div class="row" style="border: 1px solid #dedede; padding-bottom: 20px">
				<div class="col-xs-12">
					<div class="col-xs-12">
						<div class="col-xs-4">
							<h3>You have selected</h3>
							<img style="width: 140px" src="<?php echo $bookDetails->images; ?>">
						</div>

						<div class="col-xs-8" style="padding-top:60px">
							<h4><b><?php echo $bookDetails->book_name; ?></b></h4>
							<small style="display: block">Author Name: <?php echo $bookDetails->author_name; ?></small>
							<small style="display: block">ISBN: <?php echo $bookDetails->isbn_code; ?></small>
						</div>
						
						
					</div>
				</div>			
			</div>
		<?php } else{ ?>

			<?php $count = 0; foreach ($bookDetails_cart as $bd) { ?>
				<div class="row" style="border: 1px solid #dedede; padding-bottom: 20px">
					<div class="col-xs-12">
						<div class="col-xs-12">
							<div class="col-xs-4">
								<?php if($count == 0){ ?>
									<h3>You have selected</h3>
								<?php } else{ ?>
									<h3></h3>
								<?php } ?>
								<img style="width: 140px" src="<?php echo $bd->images; ?>">
							</div>

							<div class="col-xs-8" style="padding-top:60px">
								<h4><b><?php echo $bd->book_name; ?></b></h4>
								<small style="display: block">Author Name: <?php echo $bd->author_name; ?></small>
								<small style="display: block">ISBN: <?php echo $bd->isbn_code; ?></small>
							</div>
							
							
						</div>
					</div>			
				</div>
			<?php $count++; } ?>

		<?php } ?>
		<form action="<?php echo c_baseurl; ?>books/placeOrder" method="post">
		<input type="hidden" name="userSessionId" value="<?php echo $this->session->userdata("session_id") ?>">
		<input type="hidden" name="book_id" value="<?php echo $this->session->userdata("book_id") ?>">
		<input type="hidden" name="book_ids" value="<?php echo $this->session->userdata("book_ids") ?>">
		<div class="row" style="border: 1px solid #dedede;">
			<div class="col-xs-12">
				<div class="col-xs-6">
					<h1>Delivery Address</h1>
					<small>Your delivery and billing addresses are same. <a href="javascript:void(0)" id="showBillingAddress">Click here</a> to add different billing address </small>
					<div class="form-group">
						<label>Full Name</label>
						<input class="form-control" type="text" name="delivFullName">
					</div>
					<div class="form-group">
						<label>Email ID</label>
						<input class="form-control" type="text" name="delivEmailId">
					</div>
					<div class="form-group">
						<label>Phone Number</label>
						<input class="form-control" type="text" name="delivPhoneNumber">
					</div>
					<div class="form-group">
						<label>Delivery Address</label>
						<input class="form-control" type="text" name="delivDeliveryAddress">
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="delivDeliveryAddress2">
					</div>
					
					<div class="form-group">
						<label>City</label>
						<input class="form-control" type="text" name="delivCity">
					</div>
					<div class="form-group">
						<label>State</label>
						<input class="form-control" type="text" name="delivState">
					</div>
					<div class="form-group">
						<label>Zip Code</label>
						<input class="form-control" type="text" name="delivZipCode">
					</div>

					
				</div>

				<div class="col-xs-6" id="billingAddress" style="display: none;">
					<h1>Billing Address</h1>
					<small><a href="javascript:void(0)" id="hideBillingAddress" >Click here</a> to make same as Delivery Address </small>
					<div class="form-group">
						<label>Full Name</label>
						<input class="form-control" type="text" name="billingFullName">
					</div>
					<div class="form-group">
						<label>Email ID</label>
						<input class="form-control" type="text" name="billingEmailId">
					</div>
					<div class="form-group">
						<label>Phone Number</label>
						<input class="form-control" type="text" name="billingPhoneNumber">
					</div>
					<div class="form-group">
						<label>Billing Address</label>
						<input class="form-control" type="text" name="billingAddress">
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="billingAddress2">
					</div>
					
					<div class="form-group">
						<label>City</label>
						<input class="form-control" type="text" name="billingCity">
					</div>
					<div class="form-group">
						<label>State</label>
						<input class="form-control" type="text" name="billingState">
					</div>
					<div class="form-group">
						<label>Zip Code</label>
						<input class="form-control" type="text" name="billingZipCode">
					</div>

				</div>
			</div>
		</div>
		


		<div class="row" style="border: 1px solid #dedede;">
			<div class="col-xs-12" >
				<h3>Enter Payment Details</h3>
				<div class="col-xs-8">
					<div class="radio">
					  	<label><input type="radio" value="cashOnDelivery" checked id="cod" name="payment_method">Cash On Delivery</label>
					</div>
					<div class="radio">
					  	<label><input type="radio" value="cardPayment" id="cc" name="payment_method">Credit or Debit Card</label>
					</div>

					<div class="col-xs-6" id="cardFields" style="display: none">
						<div class="form-group">
							<label>Card Number</label>
							<input type="text" name="card_number" class="form-control">
						</div>
						<div class="form-group">
							<label>Expiry Month</label>
							<input type="text" name="card_expiry_month" class="form-control">
						</div>
						<div class="form-group">
							<label>Expiry Year</label>
							<input type="text" name="card_expiry_year" class="form-control">
						</div>
						<div class="form-group">
							<label>CVV Number</label>
							<input type="text" name="card_cvv" class="form-control">
						</div>
					</div>
				</div>
			</div>

			
		</div>

		<div class="row" style="border: 1px solid #dedede; padding-bottom: 20px">
			<div class="col-xs-12">			
				<button type="submit" class="btn btn-primary btn-lg" style="display: block; margin: 0 auto; margin-top:20px">Place Order</button></div>
		</div>

		</form>

	</div>

	<?php $this->load->view("commonFooterView.php") ?>

<script type="text/javascript">
	$(function() {
		$("#showBillingAddress").on("click", function() {
			$("#billingAddress").show();
		})
		$("#hideBillingAddress").on("click", function() {
			$("#billingAddress").hide();
		})

		$("[name='payment_method']").on("click", function() {
			var paymentMethod;
			if($(this).is(":checked")) {
				paymentMethod = $(this).val();

				if(paymentMethod == "cardPayment") {
					$("#cardFields").show();
				}

				if(paymentMethod == "cashOnDelivery") {
					$("#cardFields").hide();
				}
			}
		})
	})
</script>

</body>
</html>