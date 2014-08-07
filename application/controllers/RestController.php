<?php

class RestController extends Zend_Rest_Controller {

    public function init() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction() {
        $db = Zend_Registry::get('db');
        $result = $db->fetchAll('SELECT * FROM states');

        $toJson = Zend_Json::encode($result);

        $this->getResponse()->setHttpResponseCode(200);
        $this->getResponse()->setBody($toJson);
    }

    public function deleteAction() {
        $this->getResponse()->setBody(__METHOD__);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function getAction() {
        $this->getResponse()->setBody(__METHOD__);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function headAction() {
        $this->getResponse()->setBody(__METHOD__);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function postAction() {
        $this->getResponse()->setBody(__METHOD__);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function putAction() {
        $this->getResponse()->setBody(__METHOD__);
        $this->getResponse()->setHttpResponseCode(200);
    }

}
