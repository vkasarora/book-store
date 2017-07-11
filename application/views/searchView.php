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
		<div class="row">
			
			<?php if($isBookFound == false) {?>
				<div class="col-xs-6" id="loaderSection" style="margin: 0 auto; float:none; padding-top:15%; padding-bottom: 20px; text-align:center">
					<h1>// Sorry, no book found. //</h1>
					<small>Try searching with different keywords, author name or isbn code.</small>
				</div>
			<?php } ?>

			<?php if($isBookFound == true) {?>
				<div class="col-xs-12">
					<h3>
						<?php echo $bookCount; ?> result<?php echo $bookCount == 1 ? "" : "s" ; ?> for <i><?php echo $searchKeyword ?></i>
					</h3>
					<div class="col-xs-12">
						<?php foreach($books as $b){ ?>

							<div class="col-xs-3" style="margin-top:35px">
								<div class="col-sm-12 book-container" onclick="window.open('<?php echo c_baseurl . 'books/' . $b->id ; ?>')">
									<div class="cover">
										<img src="<?php echo $b->images; ?>">
									</div> 

									<p class="col-xs-12 book-name"><b><?php echo $b->book_name ?></b></p>
									<p class="col-xs-12 book-author-name"><?php echo "by ". $b->author_name; ?></p>
									<div class="col-xs-12 book-rating-container">
										<span>
											<?php echo "&#8377;". $b->price ."/-"; ?>
										</span>
										
										<p class="ratings-container">
											<span class="ratings-inner" style="width: <?php echo $b->rating * 20 ."%"; ?>">
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
												<span class="glyphicon glyphicon-star"></span>
											</span>
										</p>
										
									</div>
								</div>
							</div>

						<?php } ?>
					</div>
					
				</div>


			<?php } ?>

			
		</div>
	</div>

	<?php $this->load->view("commonFooterView.php") ?>

	<script type="text/javascript" src="<?php echo c_baseurl; ?>assets/js/search.js"></script>

</body>
</html>