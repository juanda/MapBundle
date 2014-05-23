<?php
namespace Jazzyweb\MapBundle\Entity;

use Jazzyweb\Geo\AddressToLonLat;
use Jazzyweb\MapBundle\MarkerInterface;

class BasicMarker implements MarkerInterface{

    private $address;
    private $content;
    private $lon;
    private $lat;

    public function __construct($address, $content, $lon = null, $lat=null){
        $this->address = $address;
        $this->content = $content;

        if(is_null($lon) || is_null($lat)){
            $a2c = new AddressToLonLat($this->address);
            echo $this->address. PHP_EOL;
            $this->lon = $a2c->getLon();
            $this->lat = $a2c->getLat();
        }else{
            $this->lon = $lon;
            $this->lat = $lat;
        }
    }
    public function getLon()
    {
        return $this->lon;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getAddress()
    {
        return $this->address;
    }

}
