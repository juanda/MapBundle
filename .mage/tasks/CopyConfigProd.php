<?php
namespace Task;

use Mage\Task\AbstractTask;

class CopyConfigProd extends AbstractTask
{
    public function getName()
    {
        return 'Copy parameters.yml';
    }

    public function run()
    {
    	$command = "cp /root/red_centros/parameters.yml /nfs-netapp/mercurio/red_centros/current/app/config/parameters.yml";
    	$result = $this->runCommandRemote($command);

        return $result;        
    }
}
