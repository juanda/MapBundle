<?php

namespace Jazzyweb\MapBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CentrosMarkerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CentroMarkerRepository extends EntityRepository
{
    public function findPorProvincia($provincia)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM JwMapBundle:CentroMarker c WHERE c.provincia LIKE :provincia'
            )
            ->setParameter('provincia', $provincia)
            ->getResult();
    }

    public function findPorAutonomia($autonomia)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM JwMapBundle:CentroMarker c WHERE c.autonomia LIKE :autonomia'
            )
            ->setParameter('autonomia', $autonomia)
            ->getResult();
    }

    public function findPorLocalidad($localidad)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM JwMapBundle:CentroMarker c WHERE c.localidad LIKE :localidad'
            )
            ->setParameter('localidad', $localidad)
            ->getResult();
    }
}