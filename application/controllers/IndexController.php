<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $userAuth = new Zend_Session_Namespace('userAuth');
        $userAuth->name = 'testUser';
        $userAuth->age = 30;
        var_dump($_SESSION);
    	echo 'in index';
        // action body
    }

    public function testAction()
    {
    		//echo 'in test action';
    		$this->view->test = 'test';
    	
    }

}

