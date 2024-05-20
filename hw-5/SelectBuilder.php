<?php

class SelectBuilder{
	public string $table;

	public function __construct(string $table){
		$this->table = $table;
	}

	public function __toString(){
		return "SELECT * FROM {$this->table}";
	}
}