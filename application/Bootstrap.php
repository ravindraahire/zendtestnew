<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * Initialise view
	 *
	 */
	protected function _initView()
	{
		$view = new Zend_View();
    
		return $view;    
	}

	/**
	 * Initialise translate
	 *
	 */
	protected function _initTranslate()
	{
		$english = array('test' => 'testen');
		$german = array('test' => 'testger');
	    $translate = new Zend_Translate(array(
	        'adapter' => 'array',
	        'content' =>  array('test' => 'test22'),
	        'locale'  => 'en'
	    ));
	    $translate->addTranslation(array('content' => array('test' => 'testnl'), 'locale' => 'nl'));

	    Zend_Registry::set('Zend_Translate', $translate);
	    Zend_Registry::set('translate', $translate);

		return $translate;
	}

	protected function _initRoutes()
    {
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        $route = new Zend_Controller_Router_Route(
            '/:action/:param',
            array (
                'controller' => 'route',
                'action' => 'index',
            )
        );
        $router->addRoute('pages', $route);
    }
}
