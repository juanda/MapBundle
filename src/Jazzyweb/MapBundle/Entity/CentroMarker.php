<?php

namespace Jazzyweb\MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Jazzyweb\MapBundle\MarkerInterface;

/**
 * CentrosMarker
 */
class CentroMarker implements  MarkerInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $address;

    /**
     * @var float
     */
    private $lon;

    /**
     * @var float
     */
    private $lat;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var string
     */
    private $denoGenerica;

    /**
     * @var string
     */
    private $denoEspecial;

    /**
     * @var string
     */
    private $domicilio;

    /**
     * @var string
     */
    private $cpostal;

    /**
     * @var string
     */
    private $localidad;

    /**
     * @var string
     */
    private $provincia;

    /**
     * @var string
     */
    private $autonomia;

    /**
     * @var string
     */
    private $naturaleza;

    /**
     * @var string
     */
    private $tipoEducacion;

    /**
     * @var string
     */
    private $numAlumnos;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $tipologiaMod18may;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return CentrosMarker
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set lon
     *
     * @param float $lon
     * @return CentrosMarker
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get lon
     *
     * @return float 
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return CentrosMarker
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return CentrosMarker
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        $content = $this->content? $this->content : '<h3>Cod: '. $this-> getCodigo(). '</h3>';

        return $content;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return CentrosMarker
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set denoGenerica
     *
     * @param string $denoGenerica
     * @return CentrosMarker
     */
    public function setDenoGenerica($denoGenerica)
    {
        $this->denoGenerica = $denoGenerica;

        return $this;
    }

    /**
     * Get denoGenerica
     *
     * @return string 
     */
    public function getDenoGenerica()
    {
        return $this->denoGenerica;
    }

    /**
     * Set denoEspecial
     *
     * @param string $denoEspecial
     * @return CentrosMarker
     */
    public function setDenoEspecial($denoEspecial)
    {
        $this->denoEspecial = $denoEspecial;

        return $this;
    }

    /**
     * Get denoEspecial
     *
     * @return string 
     */
    public function getDenoEspecial()
    {
        return $this->denoEspecial;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     * @return CentrosMarker
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set cpostal
     *
     * @param string $cpostal
     * @return CentrosMarker
     */
    public function setCpostal($cpostal)
    {
        $this->cpostal = $cpostal;

        return $this;
    }

    /**
     * Get cpostal
     *
     * @return string 
     */
    public function getCpostal()
    {
        return $this->cpostal;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     * @return CentrosMarker
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return CentrosMarker
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set autonomia
     *
     * @param string $autonomia
     * @return CentrosMarker
     */
    public function setAutonomia($autonomia)
    {
        $this->autonomia = $autonomia;

        return $this;
    }

    /**
     * Get autonomia
     *
     * @return string 
     */
    public function getAutonomia()
    {
        return $this->autonomia;
    }

    /**
     * Set naturaleza
     *
     * @param string $naturaleza
     * @return CentrosMarker
     */
    public function setNaturaleza($naturaleza)
    {
        $this->naturaleza = $naturaleza;

        return $this;
    }

    /**
     * Get naturaleza
     *
     * @return string 
     */
    public function getNaturaleza()
    {
        return $this->naturaleza;
    }

    /**
     * Set tipoEducacion
     *
     * @param string $tipoEducacion
     * @return CentrosMarker
     */
    public function setTipoEducacion($tipoEducacion)
    {
        $this->tipoEducacion = $tipoEducacion;

        return $this;
    }

    /**
     * Get tipoEducacion
     *
     * @return string 
     */
    public function getTipoEducacion()
    {
        return $this->tipoEducacion;
    }

    /**
     * Set numAlumnos
     *
     * @param string $numAlumnos
     * @return CentrosMarker
     */
    public function setNumAlumnos($numAlumnos)
    {
        $this->numAlumnos = $numAlumnos;

        return $this;
    }

    /**
     * Get numAlumnos
     *
     * @return string 
     */
    public function getNumAlumnos()
    {
        return $this->numAlumnos;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return CentrosMarker
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set tipologiaMod18may
     *
     * @param string $tipologiaMod18may
     * @return CentrosMarker
     */
    public function setTipologiaMod18may($tipologiaMod18may)
    {
        $this->tipologiaMod18may = $tipologiaMod18may;

        return $this;
    }

    /**
     * Get tipologiaMod18may
     *
     * @return string 
     */
    public function getTipologiaMod18may()
    {
        return $this->tipologiaMod18may;
    }
}
