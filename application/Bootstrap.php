<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initPropel()
    {
        // Initialize Propel with the runtime configuration
        Propel::init(realpath(APPLICATION_PATH . "/models/conf/vote-app-conf.php"));
        set_include_path(realpath(APPLICATION_PATH . "/models/classes/") . PATH_SEPARATOR . get_include_path());
    }

}

