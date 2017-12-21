<?php
	class Model {

		protected $data = array();

		public function __get($key) {
			return $this->data[$key];
		}

		public function __set($key, $value) {
			$this->data[$key] = $value;
		}

		// Generic setter of dictionnary
		public function setArray($array) {
			foreach ($array as $key => $value) {
				$this->data[$key] = $value;
			}
		}

		public function echo($key) {
			if (isset($this->data[$key])) {
				echo $this->data[$key];
			}
		}
	}
?>