<?php
namespace Jazzyweb\MapBundle\Command;

use Jazzyweb\Geo\AddressToLonLat;
use Jazzyweb\MapBundle\Entity\BasicMarker;
use Jazzyweb\MapBundle\Entity\CentroMarker;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class CSV2DatabaseCommand extends ContainerAwareCommand {

    protected function configure() {

        $this
            ->setName('google_map:csv2db')
            ->setDescription('Añade a la base de datos especificada por configuración un csv con datos de centro')
            ->addArgument('csvFile', InputArgument::REQUIRED)
            ->addOption('num', null, InputOption::VALUE_OPTIONAL, 'Número de lineas a procesar')
            ->addOption('from', null, InputOption::VALUE_OPTIONAL, 'Desde qué registro procesar')
            ->addOption('computeLonLat', null, InputOption::VALUE_NONE, 'Si se especiica se realiza la consulta a google para obtener la longitud y latitud')
            ->addOption('write', null, InputOption::VALUE_NONE, 'Si no se especifica no se escribe en la base de datos y se hace un volcado de los centros que se procesarán')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $inputFile = $input->getArgument('csvFile');
        $num = $input->getOption('num');
        $from = $input->getOption('from') ? $input->getOption('from') : 1;
        $write = $input->getOption('write');
        $computeLonLat = $input->getOption('computeLonLat');

        $em = $this->getContainer()->get('doctrine')->getManager();
        $logger = $this->getContainer()->get('logger');

        if(!file_exists($inputFile)){
            $output->writeln('<error>El fichero '. $inputFile . ' no se encuentra</error>');
            exit;
        }

        $fid = fopen($inputFile, "r");

        if(!$fid){
            $output->writeln('<error>No se puede leer el archivo ' . $inputFile . '</error>');
            exit;
        }

        $i = 0;
        while (($datos = fgetcsv($fid, 1000, ":")) !== FALSE) {

            if($num && ($i - $from + 1) == $num) {
                $output->writeln($num . ' centros procesados. Último centro procesado: cod = ' . $datos[0]);
                break;
            }

            if($i >= $from - 1){

                $centro = new CentroMarker();
                $centro->setCodigo($datos[0]);
                $centro->setDenoGenerica($datos[1]);
                $centro->setDenoEspecial($datos[2]);
                $centro->setDomicilio($datos[3]);
                $centro->setCpostal($datos[4]);
                $centro->setLocalidad($datos[5]);
                $centro->setProvincia($datos[6]);
                $centro->setAutonomia($datos[7]);
                $centro->setNaturaleza($datos[8]);
                $centro->setTipoEducacion($datos[9]);
                $centro->setNumAlumnos($datos[10]);
                $centro->setTelefono($datos[11]);
                $centro->setTipologiaMod18may($datos[12]);

                if($computeLonLat){
                    $address = $centro->getDomicilio() . " " . $centro->getLocalidad() . "/" . $centro->getProvincia(). " spain";
                    $a2c = new AddressToLonLat($address);
                    $centro->setLon($a2c->getLon()? $a2c->getLon() : null);
                    $centro->setLat($a2c->getLat()? $a2c->getLat() : null);

                    if($a2c->getStatus() != "OK"){
                        $txtError = 'Ha ocurrido un error en centro : ' . $centro->getCodigo() . ' : ' . $a2c->getStatus();
                        $output->writeln('<error>' . $txtError . '</error>');
                        $logger->addError('CSV2DatabaseCommand:' . $txtError);

                        if($a2c->getStatus() == "OVER_QUERY_LIMIT"){
                            $txtError = $a2c->getStatus() . ' se aborta el proceso';
                            $output-> writeln($txtError);
                            $logger->addError('CSV2DatabaseCommand:'.$txtError);
                            exit;
                        }
                    }
                }


                if($write){
                    $em->persist($centro);
                    $em->flush();
                    echo ".";

                }else{
                    print_r($datos);
                    echo "Lon: " . $centro->getLon().PHP_EOL;
                    echo "Lat: " . $centro->getLat().PHP_EOL;
                    echo "---------------------------------". PHP_EOL;
                }


            }

            $i++;
        }

        fclose($fid);

        $output->writeln('Se han procesado ' . $i +1 . ' centros');
    }
}
