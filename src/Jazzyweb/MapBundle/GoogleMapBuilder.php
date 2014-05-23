<?php

namespace Jazzyweb\MapBundle;

use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMapBundle\Model\MapBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerBuilder;

class GoogleMapBuilder {

    protected $mapBuilder;
    protected $markerBuilder;
    protected $infoWindowBuilder;

    public function __construct(MapBuilder $mapBuilder, MarkerBuilder $markerBuilder, InfoWindowBuilder $infoWindowBuilder){
        $this->mapBuilder = $mapBuilder;
        $this->markerBuilder = $markerBuilder;
        $this->infoWindowBuilder = $infoWindowBuilder;
    }

    public function build(array $jwMarkers){

        $map = $this->mapBuilder->build();

        foreach($jwMarkers as $m){

            if(!$m instanceof MarkerInterface){
                throw new \Exception('element must implement MarkerInterface');
            }

            $marker = $this->markerBuilder->build();
            $marker->setPosition($m->getLat(), $m->getLon());
            $infoWindow  = $this->infoWindowBuilder->build();
            $infoWindow->setOpenEvent(MouseEvent::CLICK);
            $infoWindow->setContent($m->getContent());

            $marker->setInfoWindow($infoWindow);

            $map->addMarker($marker);

        }

        return $map;
    }
}