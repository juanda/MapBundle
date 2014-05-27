<?php
namespace Task;

use Mage\Task\AbstractTask;

class ClearCache extends AbstractTask
{
    public function getName()
    {
        return 'Clear cache';
    }

    public function run()
    {
    	$command = "php app/console cache:clear; chown -R apache:users ./app/cache ./app/logs";
    	$result = $this->runCommandRemote($command);

        return $result;        
    }
}
