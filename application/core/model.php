<?php

class Model
{
	public function load($data){
		if (is_array($data) && !empty($data)) {
			$attributes = get_class_vars(get_class($this));
			foreach ($data as $name => $value) {
				if (array_key_exists($name,$attributes)) {
					if(empty($value)){
						$value = null;
					}
					$this->$name = $value;
				}
			}
			return true;
		}
		return false;
	}
}