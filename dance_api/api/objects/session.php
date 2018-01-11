<?php
	class Session {

		private $signed_in;
		public $user_id;

		function __construct() {
			session_start();
		}

		public function IsSignedIn() {
			return $this->signed_in;
		}

		public function Login() {

		}

		private function LoginCheck() {
			if($_SESSION['user_id']) {
				$this->user_id = $_SESSION['user_id'];
			} else {
				unset($this->user_id);
				$this->signed_in = false;
			}
		}
	}
