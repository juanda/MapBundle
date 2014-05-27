<?php

namespace Jazzyweb\MapBundle;

use Doctrine\ORM\EntityManagerInterface;

class DoctrineMarkerManager implements  MarkerManagerInterface {

    private $em;
    private $repoCentros;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
        $this->repoCentros = $this->em->getRepository('JwMapBundle:CentroMarker');
    }

    public function getAll()
    {
        $centros = $this->repoCentros->findAll();

        return $centros;
    }

    public function getAllByProvincia($provincia)
    {
        $centros = $this->repoCentros->findPorProvincia($provincia);

        return $centros;
    }

    public function getAllByAutonomia($autonomia)
    {
        $centros = $this->repoCentros->findPorAutonomia($autonomia);

        return $centros;
    }

    public function getAllByLocalidad($localidad)
    {
        $centros = $this->repoCentros->findPorLocalidad($localidad);

        return $centros;
    }
}