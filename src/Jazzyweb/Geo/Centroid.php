<?php

namespace Jazzyweb\Geo;

class Centroid{

    public function get($markers){


        if(!is_array($markers)){
            throw new \Exception('El argumento debe ser un array de markers');
        }

        if(count($markers) == 0){
            return array(-3.70388, 40.429701);
        }

        $markersWithLonLat = $this->dropMarkersWithoutLonLat($markers);

        $lon = $markersWithLonLat[0]->getLon();
        $lat = $markersWithLonLat[0]->getLat();

        $numMarkers = count($markersWithLonLat);

        for($i = 1; $i< $numMarkers; $i++){

            $lon = ($lon + $markersWithLonLat[$i]->getLon())/2;
            $lat = ($lat + $markersWithLonLat[$i]->getLat())/2;

        }

        return array($lon, $lat);
    }

    protected function dropMarkersWithoutLonLat($markers){
        $markersWithLonLat = array();

        foreach($markers as $m){
            if(is_null($m->getLon()) || is_null($m->getLat())) continue;
            $markersWithLonLat[] = $m;
        }

        return $markersWithLonLat;
    }
}