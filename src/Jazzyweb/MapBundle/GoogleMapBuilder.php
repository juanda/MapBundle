<?php

namespace Jazzyweb\MapBundle;

use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMapBundle\Model\MapBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\InfoWindowBuilder;
use Ivory\GoogleMapBundle\Model\Overlays\MarkerBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;

class GoogleMapBuilder {

    protected $mapBuilder;
    protected $markerBuilder;
    protected $infoWindowBuilder;
    protected $requestStack;
    protected $coordTable;

    public function __construct(MapBuilder $mapBuilder, MarkerBuilder $markerBuilder, InfoWindowBuilder $infoWindowBuilder, RequestStack $requestStack){
        $this->mapBuilder = $mapBuilder;
        $this->markerBuilder = $markerBuilder;
        $this->infoWindowBuilder = $infoWindowBuilder;
        $this->requestStack = $requestStack;
        $this->coordTable = array();
    }

    public function build(array $jwMarkers, $filter = null){

        $map = $this->mapBuilder->build();
        $map->markersWithoutLonLat = 0;
        $map->totalMarkers = 0;

        if(is_null($filter)){
            $filter = function($m) {return true;};
        }

        $request = $this->requestStack->getCurrentRequest();

        $coordTable = array();

        foreach($jwMarkers as $m){

            if(!$filter($m)) continue;

            if(!$m instanceof MarkerInterface){
                throw new \Exception('element must implement MarkerInterface');
            }

            $map->totalMarkers ++;
            $marker = $this->markerBuilder->build();

            if(is_null($m->getLon()) || is_null($m->getLat())){
                $map->markersWithoutLonLat ++;

            }else{

                $content = $this->buildCoordContent($m);

                $marker->setPosition($m->getLat(), $m->getLon());
                $infoWindow  = $this->infoWindowBuilder->build();
                $infoWindow->setOpenEvent(MouseEvent::CLICK);
                $infoWindow->setContent($content);
                $marker->setInfoWindow($infoWindow);
                $marker->setIcon(str_replace('/app_dev.php', '', $request->getUriForPath($m->getIcon())));

                $map->addMarker($marker);
            }
        }

        return $map;
    }

    /**
     * En algunos casos varios centros se geolocalizan con las mismas coordenadas.
     * En tal caso añadimos la info de varios centros a la misma ventana de info
     * del marker. Para ello llevamos la cuenta de las coordenadas de los marker
     * con una tabla. Esto es lo que hace esta función.
     *
     * @param MarkerInterface $m
     * @return string
     *
     */
    protected function buildCoordContent(MarkerInterface $m){
        $key = md5((string) $m->getLon() . (string) $m->getLat());
        if(isset($this->coordTable[$key])) {
            $content = $this->coordTable[$key] . "<br/>". $m->getContent();
        }else{
            $content = $m->getContent();
        }

        $this->coordTable[$key] =  $content;

        return $content;
    }
}