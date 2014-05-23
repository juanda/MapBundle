<?php
namespace Jazzyweb\MapBundle\Command;

use Jazzyweb\MapBundle\Entity\BasicMarker;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class CSV2YamlCommand extends ContainerAwareCommand {

    protected function configure() {

        $this
            ->setName('google_map:csv2yaml')
            ->setDescription('Convierte a yaml un csv con datos de centro')
            ->addArgument('csvFile', InputArgument::REQUIRED)
            ->addArgument('outFile', InputArgument::REQUIRED)
            ->addArgument('num', InputArgument::OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $inputFile = $input->getArgument('csvFile');
        $outputFile = $input->getArgument('outFile');
        $num = $input->hasArgument('num')? $input->getArgument('num') : null;

        if(!file_exists($inputFile)){
            $output->writeln('<error>El fichero no se encuentra</error>');
            exit;
        }

        $fid = fopen($inputFile, "r");

        if(!$fid){
            $output->writeln('<error>No se puede leer el archivo</error>');
            exit;
        }

        $foutId = fopen($outputFile, 'w');
        if(!$foutId){
            $output->writeln('<error>No se puede abrir el archivo para escritura</error>');
            exit;
        }

        $i = 0;
        $centros = array();
        while (($datos = fgetcsv($fid, 1000, ":")) !== FALSE) {
            $numero = count($datos);
            if($num && $i > $num) break;
            echo ".";
            for ($c=0; $c < $numero; $c++) {
                $address = $datos[3] . "," . $datos['5'] . "/" . $datos[6];
                $content = $datos[2];
                $centro = new BasicMarker($address, $content);
                $centros[$i]['address'] = $centro->getAddress();
                $centros[$i]['content'] = $centro->getContent();
//                $centros[$i]['lon'] = $centro->getLon();
//                $centros[$i]['lat'] = $centro->getLat();
            }
            $i++;

        }
        echo PHP_EOL;
        $yaml = new Yaml();

        fwrite($foutId, $yaml->dump($centros));

        fclose($fid);
        fclose($foutId);
    }
}
