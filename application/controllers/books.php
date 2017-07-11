<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model("SearchModel");
		
	}

	public function _remap($param) {
		if($param == "addReview") {
			$this->addReview($param);	
		} elseif($param == "buy") {
			$this->buy($param);
		} elseif($param == "placeOrder") {
			$this->placeOrder($param);
		} elseif($param == "orderId") {
			$this->orderId($param);
		} elseif($param == "addToCart") {
			$this->addToCart($param);
		}



		else {
			$this->index($param);	
		}
		
	}


	public function index($book_id) {
		$this->getBookDetails($book_id);
	}

	public function getBookDetails($book_id) {
		$bookDetails = $this->SearchModel->getBookDetails($book_id)->row();
		$bookReviews = $this->SearchModel->getBookReviews($book_id)->result();

		if(empty($bookDetails)) {
			redirect(c_baseurl);
		}

		$data['bookDetails'] = $bookDetails;
		$data['bookReviews'] = $bookReviews;

		$this->load->view("bookDetailView", $data);


	}

	public function addReview() {
		$userReviewTitle = $this->input->post("userReviewTitle");
		$userReview = $this->input->post("userReview");
		$bookId = $this->input->post("bookId");
		$userRating = $this->input->post("userRating");

		$modelData["userReviewTitle"]  = $userReviewTitle;
		$modelData["userReview"]  = $userReview;
		$modelData["bookId"] = $bookId;
		$modelData["userRating"] = $userRating;



		$this->SearchModel->addUserReview($modelData);
		$this->calculateRatings($bookId);
	}

	public function calculateRatings($book_id) {
		$bookAvgRating = $this->SearchModel->updateBookAvgRating($book_id);
	}

	public function buy() {
		$book_id = $this->input->post("book_id");
		$book_ids = $this->input->post("book_ids");
		
		
		

		if($book_id != "") {
			
			$buyBookSessionData = array(
			        'session_id'  => bin2hex(openssl_random_pseudo_bytes(10)),
			        'book_id'     => $book_id
			);

			$bookDetails = $this->SearchModel->getBookDetails($book_id)->row();
			$data['bookDetails'] = $bookDetails;
		}
		elseif($book_ids != "") {
			
			$book_array = array_filter(explode(",", $book_ids));	
			$buyBookSessionData = array(
				'session_id'  => bin2hex(openssl_random_pseudo_bytes(10)),
			    'book_id'     => implode(",", $book_array)
			);
			
			$bookDetails = [];
			foreach ($book_array as $key) {
				array_push($bookDetails, $this->SearchModel->getBookDetails($key)->row());
			}

			$data['bookDetails_cart'] = $bookDetails;
		}
		else {
			redirect(c_baseurl);
		}

		$this->session->set_userdata($buyBookSessionData);
		$this->load->view("checkoutPageView", $data);
	}

	public function placeOrder() {
		$sessionId = $this->input->post("userSessionId");

		$completeUserData = json_encode($this->input->post());
		
		$data["order_id"] = $sessionId;
		$data["complete_user_data"] = $completeUserData;

		$this->SearchModel->storeUserData($data);


		$this->session->sess_destroy();

		redirect(c_baseurl. "books/orderId?order_id=" .$sessionId);
	}

	public function getSingleBookDetail($book_id) {
		return $this->SearchModel->getSingleBookDetail($book_id)->row();
	}

	public function orderId() {
		$orderId = $this->input->get("order_id");
		$orderDetails = $this->SearchModel->searchOrder($orderId)->row();

		

		if(empty($orderDetails)) {
			redirect(c_baseurl);
		}

		$data["orderDetails"] = json_decode($orderDetails->complete_user_data);
		$book_ids = explode(",",$data["orderDetails"]->book_id);


		$data["bookDetails"] = [];
		foreach ($book_ids as $b) {
			array_push($data["bookDetails"], $this->getSingleBookDetail($b));
		}

		
		if(empty($data["bookDetails"]))	 {
			redirect(c_baseurl);	
		}	

		$data["orderTime"] = $orderDetails->order_time;

		$this->load->view("successfulOrderView", $data);
		

	}

	public function createCartBookList($bookDetails) {
		if(!empty($bookDetails)) {
			$bookList = "<li class='list-group-item'>". "<img src=".$bookDetails->images." style='width: 20%;margin-right:10px '>" . $bookDetails->book_name ."</li>";
			return $bookList;
		}

		return false;
	}

	public function inCart($book_id) { 

		if(!empty($this->session->userdata( "unique_cart"))) {	
			$cartBookIdArray = array_filter(explode(",", $this->session->userdata( "unique_cart")));
			
			if(in_array($book_id, $cartBookIdArray)) {
				return false;
			} else {
				$this->session->set_userdata( "unique_cart", $this->session->userdata("unique_cart").','.$book_id );
				return true;
			}
		} else {
			
			$this->session->set_userdata( "unique_cart", $book_id.',' );
			return true;
		}
	}


	public function addToCart() {
		$book_id = $this->input->post("bookId");

		//check if book already present in session
		if($this->inCart($book_id)) {
			$bookDetails = $this->getSingleBookDetail($book_id);	
			$cartBookList = $this->createCartBookList($bookDetails);
			$this->session->set_userdata( "cart_book", $this->session->userdata("cart_book").$cartBookList );
			$prepareJsonData = array(
										"cart_book" => $this->session->userdata("cart_book"),
										"book_ids"  => $this->session->userdata( "unique_cart")
									);
			echo json_encode($prepareJsonData);
		} else {
			echo "ALREADY_EXIST_IN_CART";
		}

		
		

		
		
	}
  
}


