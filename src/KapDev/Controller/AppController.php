<?php

/**
 * Kapitchi Zend Framework 2 Modules (http://kapitchi.com/)
 *
 * @copyright Copyright (c) 2012-2013 Kapitchi Open Source Team (http://kapitchi.com/open-source-team)
 * @license   http://opensource.org/licenses/LGPL-3.0 LGPL 3.0
 */

namespace KapDev\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AppController extends AbstractActionController{
    protected $appService;
   
    public function __construct($appService)
    {
            $this->setAppService($appService);
    }
    
    public function enableAllPluginsAction()
    {
         $sm = $this->getServiceLocator();
        $serv = $sm->get('KapitchiApp\Service\Plugin');
        $serv->syncWithPluginManager();
        $pag = $serv->getMapper()->getPaginatorAdapter();
        foreach($pag->getItems(0, 9999) as $i) {
            $i->setEnabled(true);
            $serv->getMapper()->persist($i);
            echo $i->getName() . ' enabled<br>';
        }
        exit;
        
    }
    
    public function getAppService() {
        return $this->appService;
    }

    public function setAppService($appService) {
        $this->appService = $appService;
    }


}
