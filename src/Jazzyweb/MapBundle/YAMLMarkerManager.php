<?php

namespace Jazzyweb\MapBundle;

use Jazzyweb\MapBundle\Entity\BasicMarker;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Yaml\Yaml;

class YAMLMarkerManager implements  MarkerManagerInterface {

    private $yamlFile;
    private $markers;

    public function __construct($yamlFile){
        $this->yamlFile = $yamlFile;
    }

    public function getAll()
    {
        $markers = $this->getMarkers();
        $markerCollection = array();
        foreach($markers as $m){
            $lon = isset($m['lon']) ? $m['lon'] : null;
            $lat = isset($m['lat']) ? $m['lat'] : null;
            $marker = new BasicMarker($m['address'], $m['content'], $lon, $lat);
            $markerCollection[] = $marker;
        }

        //var_dump($markerCollection);exit;
        return $markerCollection;
    }

    public function getAllByProvincia($provincia)
    {
        $markers = $this->getMarkers();
        $markerCollection = array();
        foreach($markers as $m){
            if(isset($m['provincia']) && $m['provincia'] == $provincia){
                $marker = new BasicMarker($m['address'], $m['content']);
                $markerCollection[] = $marker;
            }
        }
        return $markerCollection;
    }

    public function getAllByAutonomia($autonomia)
    {
        $markers = $this->getMarkers();
        $markerCollection = array();
        foreach($markers as $m){
            if(isset($m['autonomia']) && $m['autonomia'] == $autonomia){
                $marker = new BasicMarker($m['address'], $m['content']);
                $markerCollection[] = $marker;
            }
        }
        return $markerCollection;
    }

    public function getAllByLocalidad($localidad)
    {
        $markers = $this->getMarkers();
        $markerCollection = array();
        foreach($markers as $m){
            if(isset($m['localidad']) && $m['localidad'] == $localidad){
                $marker = new BasicMarker($m['address'], $m['content']);
                $markerCollection[] = $marker;
            }
        }
        return $markerCollection;
    }

    protected function getMarkers(){

        if(!file_exists($this->yamlFile)){
            throw new FileNotFoundException();
        }
        if(!is_null($this->markers)){
            return $this->markers;
        }
        $yaml = new Yaml();
        $this->markers = $yaml->parse($this->yamlFile);

        return $this->markers;
    }
}