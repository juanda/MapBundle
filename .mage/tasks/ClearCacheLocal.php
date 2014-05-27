<?php
namespace Task;

use Mage\Task\AbstractTask;

class ClearCacheLocal extends AbstractTask
{
    public function getName()
    {
        return 'Clear cache local';
    }

    public function run()
    {
    	$command = "./bin/cc.sh";
    	$result = $this->runCommandLocal($command);

        return $result;        
    }
}
