<?php

namespace Jazzyweb\MapBundle;

class DoctrineMarkerManager implements  MarkerManagerInterface {

    public function __construct(){

    }

    public function getAll()
    {
        echo "all";exit;
        // TODO: Implement getAll() method.
    }

    public function getAllByProvincia($provincia)
    {
        echo "provincia";exit;
        // TODO: Implement getAllByProvincia() method.
    }

    public function getAllByComunidad($comunidad)
    {
        echo "comunidad";exit;
        // TODO: Implement getAllByComunidad() method.
    }

    public function getAllByMunicipio($municipio)
    {
        echo "municipio";exit;
        // TODO: Implement getAllByMunicipio() method.
    }
}