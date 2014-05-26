<?php

namespace Jazzyweb\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    public function indexAction($agrupacion, $nombre)
    {
        $markerManager = $this->get('jw_map.doctrine_marker_manager');

        switch($agrupacion){
            case 'provincia':
                $markers = $markerManager->getAllByProvincia();
                break;
            case 'comunidad':
                $markers = $markerManager->getAllByComunidad();
                break;
            case 'municipio':
                $markers = $markerManager->getAllByMunicipio();
                break;
            default:
                $markers = $markerManager->getAll();
        }

        $mapBuilder = $this->get('jw_map.builder');

        $map = $mapBuilder->build($markers);

        return $this->render('JwMapBundle:Default:index.html.twig', array('map' => $map));
    }
}
