<?php 

class SearchModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function searchBooks($searchKeyword) {
    	$this->db->like('book_name', $searchKeyword, "both");
        $this->db->where('book_name', $searchKeyword);
        $this->db->or_where('isbn_code', $searchKeyword);
    	$this->db->or_where('author_name', $searchKeyword);

    	return $this->db->get('books');
    }

    public function searchBooksByWildCard($searchKeyword) {
    	$this->db->like('book_name', $searchKeyword, "both");
    	return $this->db->get('books');
    }


    public function getBookDetails($book_id) {
    	$this->db->where("id", $book_id);
    	return $this->db->get("books");
    }

    public function addUserReview($data) {

    	$data = array(
    			"book_id" => $data["bookId"],
    			"user_review_title" => $data["userReviewTitle"],
    			"user_review" => $data["userReview"],
    			"user_rating" => $data["userRating"]
    	);

    	$this->db->insert("user_review", $data);
    }

    public function getBookReviews($book_id) {
    	$this->db->where("book_id", $book_id);
    	$this->db->order_by("review_post_time", "desc");
    	return $this->db->get("user_review");
    }

    public function updateBookAvgRating($book_id) {
    	$this->db->where("book_id", $book_id);
    	$this->db->select_avg("user_rating");
    	$avgRating = $this->db->get("user_review")->row();
    	$avgRating = $avgRating->user_rating;

    	$this->db->set("rating", $avgRating);
    	$this->db->where("id", $book_id);
    	$this->db->update("books");
    }

    public function storeUserData($data) {
    	$this->db->insert("orders", $data);
    }

    public function searchOrder($orderId) {
    	$this->db->where("order_id", $orderId);
    	return $this->db->get("orders");
    }

    public function getSingleBookDetail($book_id) {
        $this->db->where("id", $book_id);
        return $this->db->get("books");
    }

}


?>


