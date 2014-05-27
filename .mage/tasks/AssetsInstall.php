<?php
namespace Task;

use Mage\Task\AbstractTask;

class AssetsInstall extends AbstractTask
{
    public function getName()
    {
        return 'Install assets';
    }

    public function run()
    {
    	$command = "php app/console assets:install web --symlink";
    	$result = $this->runCommandRemote($command);

        return $result;        
    }
}