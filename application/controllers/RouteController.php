<?php
class RouteController extends Zend_Controller_Action
{
    public function indexAction()
    {
        echo 'hi';
    }

    public function contactAction()
    {
        //echo $_SERVER['HTTP_HOST'];
        //echo $httpHost = (isset ($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost');exit;
        $httpHost = 'https://www.bastrucks.com';
        $httpHost = 'https://www.bts-daf.de';
        $currentHost = explode('.', $httpHost);
        $currentHost = array_slice($currentHost, -2, 2);
        $hostName = implode('.', $currentHost);
echo $hostName . '<br>';
        echo substr($hostName, 0, -4);
        $param1 = $this->getRequest()->getParam('param');
        //echo $param1;
        exit;

    }
}