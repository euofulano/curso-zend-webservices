<?php

class SoapClientController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $options = array(
            'soap_version' => SOAP_1_1
        );
        
        $client = new Zend_Soap_Client("https://www3.bcb.gov.br/sgspub/JSP/sgsgeral/FachadaWSSGS.wsdl", $options);
        
        $result = $client->getUltimosValoresSerieVO(1, 1);
        
        $this->view->requestBody = $result;
        $this->view->valores = $result->valores[0];
    }

}
