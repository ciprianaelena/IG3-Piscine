<?php
	class Model {

		protected $var;

		// Getter generic
		public function __get($key) {
			return $this->var[$key];
		}

		// Setter generic
  		public function __set($key, $value) {
  			$this->var[$key] = $value;
  		}
	}
?>