<?php
set_include_path(implode(PATH_SEPARATOR, array(
    realpath('/usr/share/php'),
    get_include_path(),
)));
require_once 'propel/Propel.php';

require_once 'Zend/Tool/Project/Provider/Abstract.php';
require_once 'Zend/Tool/Project/Provider/Exception.php';

class ImportProvider extends Zend_Tool_Project_Provider_Abstract
{

    protected function initializePropel()
    {
        Propel::init(realpath(__DIR__ . "/../application/models/conf/vote-app-conf.php"));
        set_include_path(realpath(__DIR__ . "/../application/models/classes/") . PATH_SEPARATOR . get_include_path());
    }

    public function constituency()
    {
        $this->initializePropel();
        echo 'Importing ...';

        $constituencies = file(__DIR__ . '/constituency.txt');

        foreach ($constituencies as $constituency) {
            $constituencyModel = new \Model\Constituency();
            $constituencyModel->setName($constituency)
                ->save();
        }

    }

}

