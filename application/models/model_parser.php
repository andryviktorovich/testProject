<?php

require('application/lib/phpQuery/phpQuery.php');

class Model_Parser extends Model
{
    public $params = [];
    public $url = 'http://www.bn.ru/api2/search/secondary/load-more/?';

    public function getApartments() {
        $result = json_decode(file_get_contents($this->url . http_build_query($this->params)));
        if (isset($result->code) && $result->code == 200) {
            return $result->response->offers;
        }
        return null;
    }

    public function getMetroStations() {
        $metroStations = [];
        $results_page = file_get_contents("http://www.bn.ru/zap_fl_w.phtml");
        $results = phpQuery::newDocumentHTML($results_page, $charset = 'utf-8');
        $select = $results->find('select#metro');
        $options = pq($select)->find('option');
        foreach($options as $item) {
            if(pq($item)->attr('value') > 0) {
                $metroStations[pq($item)->attr('value').'0'] = pq($item)->text();
            }
        }
        return $metroStations;
    }

    public function setParams(int $roomsFrom = NULL, int $roomsTo = NULL, float $priceMin = NULL, float $priceMax = NULL, array $metroStations = array(), int $page = 1){
        $this->params = [];
        //page
        if($page > 0) {
            $this->params['page'] = $page;
        }
        //комнаты
        if(isset($roomsFrom) && $roomsFrom > 0 && $roomsFrom <=4) {
            $this->params['roomsFrom'] = $roomsFrom;
        }
        if(isset($roomsTo) && $roomsTo > 0 && $roomsTo <=4) {
            $this->params['roomsTo'] = $roomsTo;
        }
        if(isset($this->params['roomsFrom']) && isset($this->params['roomsTo']) && $this->params['roomsTo'] < $this->params['roomsFrom']) {
            $temp = $this->params['roomsTo'];
            $this->params['roomsTo'] = $this->params['roomsFrom'];
            $this->params['roomsFrom'] = $temp;
        }
        //цены
        if(isset($priceMin) && $priceMin > 0) {
            $this->params['from'] = $priceMin;
        }
        if(isset($priceMax) && $priceMax > 0) {
            $this->params['to'] = $priceMax;
        }
        if(isset($this->params['from']) && isset($this->params['to']) && $this->params['to'] < $this->params['from']) {
            $temp = $this->params['to'];
            $this->params['to'] = $this->params['from'];
            $this->params['from'] = $temp;
        }
        //станции метро
        if(!empty($metroStations)){
            $this->params['metro'] = $metroStations;
        }
    }

}
