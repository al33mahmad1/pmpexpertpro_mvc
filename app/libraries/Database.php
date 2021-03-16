<?php
	/* 
	 * PDO Database Class
	 * Functionalities:
	 * 1: Connection to Database
	 * 2: Perform Create, Read, Update, Delete Operations
	 * 3: Create Prepare Statements and Bind Params
	 * 4: Secure COnnection
	 * 5: Prevention from SQL Injections 
	 * 6: Also Return Rows/Values/Data/Results
	 */

	class Database {
		private $host = DB_HOST;
		private $user = DB_USER;
		private $dbName = DB_NAME;
		private $pwd = DB_PASSWORD;

		private $dbh;
		private $stmt;
		private $error;

		public function __construct() {
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName . ';charset=utf8mb4';
			$options = array(
				PDO::ATTR_PERSISTENT =>true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			// Create PDO Instance
			try {
			 	$this->dbh = new PDO($dsn, $this->user, $this->pwd, $options);
			 } catch (PDOException $e) {
			 	$this->error = $e->getMessage();
			 	echo $this->error;
			 } 
		}

		// Prepare statement with Query
		public function query($sql) {
			$this->stmt = $this->dbh->prepare($sql);
		}

		// Bind Params
		public function bind($param, $value, $type =  PDO::PARAM_STR) {
			if(is_null($type)) {
				switch (true) {
					case is_int($type):
						$type = PDO::PARAM_INT;
						break;
					case is_null($type):
						$type = PDO::PARAM_NULL;
						break;				
					case is_bool($type):
						$type = PDO::PARAM_BOOL;
						break;		
					default:
						$type = PDO::PARAM_STR;
				}
			}

			$this->stmt->bindValue($param, $value, $type);
		}

		// Execute The Prepred Statement
		public function execute() {
			return $this->stmt->execute();
		}

		// Fetch All rows as Objects
		public function resultSet() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		// Fetch All rows as Assiciative Array
		public function resultSetAssocArray() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		// Get Single Object
		public function single() {
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		public function singleAssoc() {
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}

		// Get Rows Count
		public function rowCount() {
			return $this->stmt->rowCount();
		}

		public function lastRecordId() {
			return $this->dbh->lastInsertId();
			// return $this->stmt->rowCount();
		}
		
		public function beginTransaction() {
			$this->dbh->beginTransaction();
		}

		public function commit() {
			$this->dbh->commit();
		}
		
		public function rollback() {
			$this->dbh->rollback();
		}
	}