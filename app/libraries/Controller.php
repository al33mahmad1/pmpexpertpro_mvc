<?php
	/*
	 * Base Controller Class
	 * Loads Models And Views
	 */
	 class Controller {
	 	public function model($model) {
	 		// Require Model File
	 		require_once("../app/models/". $model .".php");
	 		// Now Create Model Instance And Return it
	 		return new $model();
	 	}

	 	public function view($view, $data = []) {
	 		// Check if view File Exists
	 		if(file_exists("../app/views/". $view . ".php")){
	 			//  Require View
	 			require_once("../app/views/". $view . ".php");
	 		}else{
	 			die("View Not Exists");
	 		}
	 	}
	 } 