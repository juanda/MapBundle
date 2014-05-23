<?php
namespace Jazzyweb\Geo;

class AddressToLonLat{

    private $address;
    private $urlString;
    private $status;
    private $lon;
    private $lat;

    public function __construct($address, $urlString = null){
        $this->address = $address;
        $this->urlString = (is_null($urlString)) ? "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=%s" : $urlString;
        $this->status = "NO_COMPUTED";
    }

    public function getLon(){
        if(is_null($this->lon)) $this->convert();

        return $this->lon;
    }

    public function getLat(){
        if(is_null($this->lat)) $this->convert();

        return $this->lat;
    }

    public function getStatus(){
        return $this->status;
    }

    protected function convert(){

        $result = file_get_contents(sprintf($this->urlString, urlencode($this->address)));
        if(!$result){
            $this->status = "CONNECTION_ERROR";
            return false;
        }

        $result = json_decode($result);


        if($result->status == "OK"){
            $this->status="COMPUTED";
            $this->lon = $result->results[0]->geometry->location->lng;
            $this->lat = $result->results[0]->geometry->location->lat;
            return true;
        }else{

            $this->status = "FAIL";
            return false;
        }

    }
}