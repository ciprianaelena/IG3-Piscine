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

		public function setArrayType($array) {
			foreach ($array as $key => $value) {
				$nullPos = strpos($key, '(null)');
				if ($nullPos !== false) {
					$key = substr($key, $nullPos + 6);
					if ($value == '') {
						$value = NULL;
					}
				}
				$intPos = strpos($key, '(int)');
				if ($intPos !== false) {
					$key = substr($key, $intPos + 5);
					if (!is_null($value)) {
						$value = (int) $value;
					}
				}

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