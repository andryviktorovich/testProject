<?php

require_once("application/models/model_parser.php");

class Model_Main extends Model
{
	public $roomsFrom;
	public $roomsTo;
	public $priceFrom;
	public $priceTo;
	public $metro = [];

	public $apartments = [];
	public $errorMsg = [];

	public function validate(){
		if(!is_null($this->roomsFrom) && filter_var($this->roomsFrom, FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 4]) === false){
			$this->errorMsg['roomsFrom'] = 'Количество комнат ОТ указано неверно';
		}
		if(!is_null($this->roomsTo) && filter_var($this->roomsTo, FILTER_VALIDATE_INT, ['min_range' => 1, 'max_range' => 4]) === false){
			$this->errorMsg['roomsTo'] = 'Количество комнат ДО указано неверно';
		}
		if($this->roomsTo < $this->roomsFrom) {
			$this->errorMsg['rooms'] = 'Количество комнат ОТ не должно превышать количество комнат ДО';
		}
		if(!is_null($this->priceFrom) && filter_var($this->priceFrom, FILTER_VALIDATE_INT, ['min_range' => 1]) === false){
			$this->errorMsg['priceFrom'] = 'Цена ОТ указана неверно';
		}
		if(!is_null($this->priceTo) && filter_var($this->priceTo, FILTER_VALIDATE_INT, ['min_range' => 1]) === false){
			$this->errorMsg['priceTo'] = 'Цена До указана неверно';
		}
		if($this->priceTo < $this->priceFrom) {
			$this->errorMsg['price'] = 'Цена ОТ не должно превышать цену ДО';
		}
		return empty($this->errorMsg);
	}

	public function getListMetro(){
		$parser = new Model_Parser();
		return $parser->getMetroStations();
	}
	
	public function getData()
	{
		$parser = new Model_Parser();
		$parser->setParams($this->roomsFrom,
								$this->roomsTo,
								$this->priceFrom,
								$this->priceTo,
								$this->metro);
		$this->apartments = $parser->getApartments();
	}
}
