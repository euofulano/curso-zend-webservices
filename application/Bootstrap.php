<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    /**
     * Inicializa o banco de dados. Somente necessário se desejado
      salvar a conexão no Registry
     *
     */
    public function _initDb() {
        $db = $this->getPluginResource('db')->getDbAdapter();
        Zend_Db_Table::setDefaultAdapter($db);
        Zend_Registry::set('db', $db);
    }
    
    public function _initRestRoute() {
        $front     = Zend_Controller_Front::getInstance();
        $restRoute = new Zend_Rest_Route($front, array(), array('default' => array('rest')));
        
        $front->getRouter()->addRoute('rest', $restRoute);
    }

}
