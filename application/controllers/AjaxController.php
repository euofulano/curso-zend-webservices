<?php

class AjaxController extends Zend_Controller_Action {

    public function init() {
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('index', 'html')
                    ->addActionContext('estados', 'json')
                    ->addActionContext('cidades', 'json')
                    ->setAutoJsonSerialization(true)
                    ->initContext();
    }

    public function indexAction() {
        // action body
    }

    public function estadosAction() {
//        $this->_helper->layout()->disableLayout();
//        $this->_helper->viewRenderer->setNoRender(true);

        $db = Zend_Registry::get('db');
        $result = $db->fetchAll('SELECT * FROM states');

        $this->view->data = $result;
    }

    public function cidadesAction() {
        $uf = $this->_request->getParam('uf', 'SP');

        $db = Zend_Registry::get('db');
        $result = $db->fetchAll(
                'SELECT c.*, s.uf FROM cities AS c INNER JOIN states AS s ON s.id = c.fk_state WHERE s.uf = ?', $uf);

        $this->view->data = $result;
    }

}
