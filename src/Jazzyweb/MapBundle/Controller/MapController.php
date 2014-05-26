<?php

namespace Jazzyweb\MapBundle\Controller;

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
                break;
            case 'autonomia':
                $markers = $markerManager->getAllByAutonomia($nombre);
                break;
            case 'localidad':
                $markers = $markerManager->getAllByLocalidad($nombre);
                break;
            default:
                $markers = $markerManager->getAll();
        }

//        var_dump($markers);exit;
        $mapBuilder = $this->get('jw_map.builder');

        $map = $mapBuilder->build($markers);

        return $this->render('JwMapBundle:Default:index.html.twig', array('map' => $map));
    }

    protected function getProvincias($term){

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT distinct provincia FROM centros WHERE provincia like  :provincia");
        $statement->bindValue('provincia', '%'.$term.'%');
        $statement->execute();

        $provincias = $statement->fetchAll();

//        echo '<pre>';
//        print_r($provincias);exit;

        return $provincias;
    }

    public function provinciasAction(Request $request)
    {
        $term = $request->query->get('term', null);

        $provincias = $this->getProvincias($term);

        return new JsonResponse($provincias);
    }

    public function autonomiasAction(Request $request)
    {
        $term = $request->query->get('term', null);

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT distinct autonomia FROM centros WHERE autonomia like  :autonomia");
        $statement->bindValue('autonomia', '%'.$term.'%');
        $statement->execute();
        $provincias = $statement->fetchAll();

        return new JsonResponse($provincias);
    }

    public function localidadesAction(Request $request)
    {
        $term = $request->query->get('term', null);

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("SELECT distinct localidad FROM centros WHERE localidad like  :localidad");
        $statement->bindValue('localidad', '%'.$term.'%');
        $statement->execute();
        $provincias = $statement->fetchAll();

        return new JsonResponse($provincias);
    }
}
