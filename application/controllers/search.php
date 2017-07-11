<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model("SearchModel");
	}

	//Loads search page.
	public function index() {

		$data = [];
		$data["isBookFound"] = false;

		$data["searchKeyword"] = $searchKeyword = $this->input->get("search");
		
		if($searchKeyword === '') {
			redirect(c_baseurl);
			return;
		}

		$makeSearch = $this->makeSearch($searchKeyword);
		
		if(!empty($makeSearch)) {
			$data["isBookFound"] = true;
			$data["bookCount"] = count($makeSearch);
		}

		$data["books"] = $this->makeSearch($searchKeyword);



		$this->load->view("searchView", $data);
	}

	public function makeSearch($searchKeyword) {
		$searchBooks = $this->SearchModel->searchBooks($searchKeyword)->result();

		if(!empty($searchBooks)) {
			return $searchBooks;
		}

		$searchBooksByWildCard = $this->SearchModel->searchBooksByWildCard($searchKeyword)->result();
		return $searchBooksByWildCard;		
	}
	
}
