<?php
namespace Task;

use Mage\Task\AbstractTask;

class Permissions extends AbstractTask
{
    public function getName()
    {
        return 'Fixing file permissions';
    }

    public function run()
    {
        $command = 'chmod -R 755 .;chown -R root:root .';
                
        $result = $this->runCommandRemote($command);

        return $result;
    }
}