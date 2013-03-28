<?php

namespace KapDev;

use Zend\EventManager\EventInterface,
    Zend\ModuleManager\Feature\ControllerProviderInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface,
    Zend\ModuleManager\Feature\ViewHelperProviderInterface,
	KapitchiBase\ModuleManager\AbstractModule;

class Module extends AbstractModule
    implements ServiceProviderInterface, ControllerProviderInterface, ViewHelperProviderInterface
{

	public function onBootstrap(EventInterface $e) {
		parent::onBootstrap($e);
		
        $em = $e->getApplication()->getEventManager();
        $sm = $e->getApplication()->getServiceManager();
        
        $em->getSharedManager()->attach('KapitchiEntity\Controller\EntityRestfulController', 'error', function($e) use ($sm) {
            $exc = $e->getParam('exception');
            $model = $e->getParam('jsonViewModel');
            $exceptions = array();
            
            while($exc) {
                $exceptions[] = array(
                    'class' => get_class($exc),
                    'message' => $exc->getMessage(),
                    'code' => $exc->getCode(),
                    'file' => $exc->getFile(),
                    'line' => $exc->getLine(),
                    'trace' => $exc->getTrace(),
                );
                $exc = $exc->getPrevious();
            }
            
            $model->setVariable('exceptions', $exceptions);
        });
	}
    
    public function getControllerConfig()
    {
        return array(
            'factories' => array(
            )
        );
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'testfsdfdsfsf' => function($sm) {
                    $ins = new View\Helper\Test();
                    return $ins;
                },
            )
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                //'KapitchiAuction\Entity\Auction' => 'KapitchiAuction\Entity\Auction',
            ),
            'factories' => array(
//                'KapitchiAuction\Form\Auction' => function ($sm) {
//                    $ins = new Form\Auction();
//                    return $ins;
//                },
            )
        );
    }
    
    public function getDir() {
        return __DIR__;
    }

    public function getNamespace() {
        return __NAMESPACE__;
    }

}