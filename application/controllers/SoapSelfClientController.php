<?php

class SoapSelfClientController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $client = new Zend_Soap_Client("http://localhost:8501/soap?wsdl");

        $this->view->add_result = $client->mathAdd(11, 55);
        $this->view->not_result = $client->logicalNot(true);
        $this->view->sort_result = $client->simpleSort(
                array("d" => "lemon", "a" => "orange",
                    "b" => "banana", "c" => "apple"));
    }

}
