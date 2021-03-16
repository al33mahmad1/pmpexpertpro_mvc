<?php
	/*
	 * App Core Class
	 * Creates URL & Loads Core Controller
	 * URL Formate - [domainName]/controller/method/perams
	 */

	Class Core {
		protected $currentController = "Pages";
		protected $currentMethod = "index";
		protected $params = [];

		public function __construct() {
			$url = $this->getUrl();

			// Looking For Controller For First Value 
			if(file_exists("../app/controllers/".ucwords($url[0]).".php")) {
				$this->currentController = ucwords($url[0]);

				unset($url[0]);
			}

			// Requiring the Current Controller
			require_once("../app/controllers/". $this->currentController .".php");
			
			$this->currentController = new $this->currentController;

			// Check For Second part of URL 
			if(isset($url[1])) {
				if(method_exists($this->currentController, $url[1])) {
					$this->currentMethod = $url[1];
					unset($url[1]);
				}
			}

			// Now Check For parameters, Third Part of URL
			$this->params = $url ? array_values($url): [];

			// Now Call A Callback Function
			try {
				call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
			} catch (\Throwable $th) {
				redirect("dashboard/home");
			}
		}

		public function getUrl() {
			if(isset($_GET['url'])) {
				$url = rtrim($_GET['url'], '/');
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;
			}
		}
	}