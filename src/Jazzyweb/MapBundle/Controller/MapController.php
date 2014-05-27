<?php

namespace Jazzyweb\MapBundle\Controller;

use Jazzyweb\MapBundle\Centroid;
use Jazzyweb\MapBundle\Form\Type\SelectProvinciaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MapController extends Controller
{
    public function indexAction($agrupacion, $nombre)
    {
        $markerManager = $this->get('jw_map.doctrine_marker_manager');

        switch($agrupacion){
            case 'provincia':
                $markers = $markerManager->getAllByProvincia($nombre);
                $scale = 8;
                break;
            case 'autonomia':
                $markers = $markerManager->getAllByAutonomia($nombre);
                $scale = 7;
                break;
            case 'localidad':
                $markers = $markerManager->getAllByLocalidad($nombre);
                $scale = 10;
                break;
            case 'all':
                $markers = $markerManager->getAll();
                $scale = 6;
                break;
            default:
                $markers = array();
                $scale = 6;
        }

//        var_dump($markers);exit;
        $mapBuilder = $this->get('jw_map.builder');

        $map = $mapBuilder->build($markers);

        $centroid = new \Jazzyweb\Geo\Centroid();
        list($lon, $lat) = $centroid->get($markers);

        $map->setCenter($lat, $lon, true);
        $map->setMapOption('zoom', $scale);

        return $this->render('JwMapBundle:Default:index.html.twig', array('map' => $map));
    }

    protected function getAgrupacion($tipo, $term){

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT distinct $tipo FROM centros WHERE $tipo like  :nombre");
        $statement->bindValue('nombre', '%'.$term.'%');
        $statement->execute();

        $results = $statement->fetchAll();

        return $results;
    }

    public function provinciasAction(Request $request)
    {
        $term = $request->query->get('term', null);

        $provincias = $this->getAgrupacion("provincia", $term);

        return new JsonResponse($provincias);
    }

    public function autonomiasAction(Request $request)
    {
        $term = $request->query->get('term', null);

        $autonomias = $this->getAgrupacion("autonomia", $term);

        return new JsonResponse($autonomias);
    }

    public function localidadesAction(Request $request)
    {
        $term = $request->query->get('term', null);

        $localidades = $this->getAgrupacion("localidad", $term);

        return new JsonResponse($localidades);
    }
}
