<?php

class SoapController extends Zend_Controller_Action {

    private $_WSDL_URI = "http://localhost:8501/soap";
    
    public function indexAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        
        if (isset($_GET['wsdl'])) {
            //return the WSDL
            $this->handleWSDL();
        } else {
            //handle SOAP request
            $this->handleSOAP();
        }
    }

    private function handleWSDL() {
        $autodiscover = new Zend_Soap_AutoDiscover();
        $autodiscover->setClass('Application_Model_SoapTest');
        
        // set SOAP action URI
        $autodiscover->setUri($this->_WSDL_URI);
        
        $autodiscover->handle();
    }

    private function handleSOAP() {
        $soap = new Zend_Soap_Server($this->_WSDL_URI . "?wsdl");
        $soap->setClass('Application_Model_SoapTest');
        $soap->handle();
    }

}
