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

	

	<div class="container">
		<div class="row" style="border-bottom:1px solid gray; padding-bottom:20px">
			<div class="col-xs-4" style="padding-top: 3%">
				<img src="<?php echo $bookDetails->images; ?>" style="width: 70%">
			</div>
			<div class="col-xs-8">
				<p class="detail-book-name">
					<?php echo $bookDetails->book_name; ?>
				</p>
				<p>
					<b>Author: <?php echo $bookDetails->author_name; ?></b>
				</p>
				<p class="ratings-container" style="position: relative; width: 85px">
					<span class="ratings-inner" style="width: <?php echo $bookDetails->rating * 20 ."%"; ?>">
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
					</span>
				</p>
				
				<?php if($bookDetails->description != "") { ?>
					<p  class="book-description">
						<p><b>About the Book:</b></p>
						<p><?php echo $bookDetails->description; ?></p>
					</p>
				<?php } ?>
				<div class="col-xs-8" >
					<form name="buy_now" method="post" action="<?php echo c_baseurl; ?>books/buy" style="display: inline;">
						<input type="hidden" name="book_id" value="<?php echo $bookDetails->id; ?>">
						<button class="btn btn-success" type="submit">Buy Now</button>
					</form>
					<button class="btn btn-primary" data-carturl="<?php echo c_baseurl; ?>books/addToCart" id="addToCart">Add to Cart</button>
				
				</div>
			</div>						
		</div>

		<div class="row" style="border-bottom:1px solid gray; padding-bottom:20px">
			<div class="col-xs-12">
				<h3>Book Specifications</h3>
				
			</div>
			<div class="col-xs-8">
				<ul class="list-group">
					<li class="list-group-item">
						<b>Cover Type:</b> 
						<?php echo $bookDetails->cover_type; ?> 
					</li>
					<li class="list-group-item">
						<b>ISBN Number:</b> 
						<?php echo $bookDetails->isbn_code; ?> 
					</li>
					<li class="list-group-item">
						<b>Publication Year:</b>
						<?php echo $bookDetails->publication_year; ?> 
					</li>
					<li class="list-group-item">
						<b>Size:</b> 
						<?php echo $bookDetails->book_size != "" ? $bookDetails->book_size : "Details Not available" ; ?> 
					</li>
					<li class="list-group-item">
						<b>Weight:</b>
						<?php echo $bookDetails->book_weight != "" ? $bookDetails->book_weight : "Details Not available" ;; ?> 
					</li>
				</ul>
			</div>
		</div>

		<div class="row" style="border-bottom:1px solid gray; padding-bottom:20px">
			<div class="col-xs-12">
				<h3 style="float: left"> Reader Comments</h3>
				<div style="float: right; margin-top:20px">
					<button class="btn btn-info" data-toggle="modal" data-target="#writeReview">Write a Review</button>
				</div>
			</div>
			<div class="col-xs-12">
			<?php if(!empty($bookReviews)) { ?>

				<ul class="list-group">
					<?php foreach($bookReviews as $bookReview) { ?>
						<?php if($bookReview->user_review_title != ""){?>
							<li class="list-group-item">
								<p>
									<b><?php echo $bookReview->user_review_title; ?></b>
								</p>	
								<p class="ratings-container" style="position: relative; width: 60px">
									<span class="ratings-inner" style="font-size:10px; width: <?php echo $bookReview->user_rating == 0 ? "20%" : $bookReview->user_rating * 20 ."%"; ?>">
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
									</span>
								</p>

								<p>
									<?php echo $bookReview->user_review; ?>
								</p>
							</li>
						<?php } ?>
					<?php } ?>
					
				</ul>

			<?php } else{ ?>
				<b>No user reviews yet!</b>
			<?php } ?>
			</div>
		</div>
		
		
	</div>

	<?php $this->load->view("commonFooterView.php") ?>

	<div id="writeReview" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="addReview" id="addReviewForm" method="post" action="<?php echo c_baseurl; ?>books/addReview">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Review</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input type="text" placeholder="Review Title" class="form-control" name="userReviewTitle" >
						</div>
						<div class="form-group">
							<textarea class="form-control" placeholder="Add Review Here..." rows="5" name="userReview"></textarea>
							<input type="hidden" name="bookId" value="<?php echo $bookDetails->id; ?> ">
						</div>
						<div class="form-group">
							<select class="form-control" name="userRating">
								<option>Rate this book</option>
								<option value="5">5</option>
								<option value="4">4</option>
								<option value="3">3</option>
								<option value="2">2</option>
								<option value="1">1</option>
							</select>
							<input type="hidden" name="bookId" value="<?php echo $bookDetails->id; ?> ">
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btnn-primary" id="addReview">Add Review</button>
					</div>
				</form>

		</div>
	</div>
	
	
	
	<script type="text/javascript">
		$(function() {

			$("#addReviewForm").on("submit", function(e) {
				e.preventDefault();
				$("#addReview").attr("disabled", "disabled");

				$.ajax({
					url: $(this).attr("action"), 
					type: $(this).attr("method"), 
					data: $(this).serialize(), 
					success: function(d){ 
						$("#writeReview").modal("toggle");
						window.location.reload(false);
					} 
				});
			});


			$("#addToCart").on("click", function(e) {
				e.preventDefault();
				var bookId = $("[name='book_id']").val();

				if(typeof(bookId) != "undefined" && !isNaN(bookId) ) {
					$.ajax({
						url: $(this).data("carturl"),
						type: "post",
						data: {bookId: bookId},
						success: function(d) {
							
							if(d.trim() == "ALREADY_EXIST_IN_CART") {
								alert("Item exist in cart already");
							}else {
								d = JSON.parse(d);
								console.log(d);
								$("#cartListDynamic").empty();
								$("#cartListDynamic").append(d.cart_book);
								$("#book_ids").val(d.book_ids);	
								$("#cart-container").show(100);
							}
							
						}
					})
				}

			})

		});
	</script>

</body>
</html>