<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
		  	<a class="navbar-brand" href="<?php echo c_baseurl; ?>">// The Book Store //</a>
		</div>	
		<ul class="nav navbar-nav navbar-right">
	      	<li>
	      		<a href="#" id="cartBtn"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
	      	</li>
	    </ul>
		
	</div>
</nav>	

<div style="margin-bottom:100px"></div>

<div id="cart-container" class="cart-container" >
	
	<span class="glyphicon glyphicon-remove" style="position: absolute; right: 10px; top: 10px; cursor: pointer" id="closeCart"></span>


	
	<ul class='list-group' style='margin-top:30px' id="cartListDynamic">
		<?php  
			echo (empty($this->session->userdata("cart_book"))) ? "<li class='list-group-item'>Your Cart is Empty</li>" : $this->session->userdata("cart_book");
		?>
	</ul>
	

	<form method="post" action="<?php echo c_baseurl; ?>books/buy">
		<input type="hidden" name="book_ids" id="book_ids" value="<?php echo $this->session->userdata("unique_cart") ?>">
		<button type="submit"  class="btn btn-info" style="margin-left: 30%">Checkout</button>
	</form>
</div>

<script type="text/javascript">
	$(function() {
		$("#cartBtn, #closeCart").on("click", function() {
			$("#cart-container").toggle(100);
			return false;
		})
	})
</script>