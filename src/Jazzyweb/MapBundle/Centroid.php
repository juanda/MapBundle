<?php

namespace Jazzyweb\MapBundle;

class Centroid{

    public function get($markers){

        if(!is_array($markers)){
            throw new \Exception('El argumento debe ser un array de markers');
        }

        if(count($markers) == 0){
           return array(-3.70388, 40.429701);
        }

        $lon = $markers[0]->getLon();
        $lat = $markers[0]->getLat();

        $numMarkers = count($markers);

        for($i = 1; $i< $numMarkers; $i++){

            $lon = ($lon + $markers[$i]->getLon())/2;
            $lat = ($lat + $markers[$i]->getLat())/2;
        }

        return array($lon, $lat);

    }
}