<?php
	class Errors extends Controller {

		public function __construct() {

		}

		public function index() {

			$data = [];
            redirect("pages/home");
			
		}

        public function paymentError() {
            
            $data = [];
			$this->view("errors/payment", $data);
			
        }

	}