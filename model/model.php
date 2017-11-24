<?php
	class Model {

		private $var;

		// Getter generic
		function __get($key) {
			return $this->var[$key];
		}

		// Setter generic
  		function __set($key, $value) {
  			$this->var[$key] = $value;
  		}
	}
?>