<?php
	class Plans extends Controller {

		public function __construct() {

		}

		public function index() {

			$data = [];
			$this->view("plans/basic", $data);
			
		}

        public function basic() {
			$data = [];
			$this->view("plans/basic", $data);
		}

		public function scrum() {
			$data = [];
			$this->view("plans/scrum", $data);
		}

		public function agilePremium() {
			$data = [];
			$this->view("plans/agilePremium", $data);
		}

		public function agileAndScrum() {
			$data = [];
			$this->view("plans/agileAndScrum", $data);
		}

	}