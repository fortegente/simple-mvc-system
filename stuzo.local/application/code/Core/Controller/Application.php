<?php
/*
* Application class
*/
class Core_Controller_Application
{

    /* @var Core_Model_Resource object. */
    private $_resource;

    /* @var Core_Controller_Request object. */
    private $_request;

    /* @var Core_Controller_Response object. */
    private $_response;

    /* @var View object. */
    protected $_view;

    /*
    * Connection to the database, call appropriate controller.
    * @var Core_Model_Resource
    * @var Core_Controller_Request
    */
    public function run()
    {
        $this->_initResource();
        try {
            $this->getRequest()->init();
        } catch (Core_Model_Exception $e) {
            $this->getRequest()->forwardNoRoute();
        }

        $this->getView()->renderOutput();
        $this->getResponse()->send();
    }

    /* Initialize request object. */
    public function getRequest()
    {
        if (empty($this->_request))
            $this->_request = new Core_Controller_Request();
        return $this->_request;
    }

    /* Initialize response object. */
    public function getResponse()
    {
        if (empty($this->_response))
            $this->_response = new Core_Controller_Response();
        return $this->_response;
    }

    /* Initialize resource object. */
    protected function _initResource()
    {
        if (empty($this->_resource))
            $resourse = new Core_Model_Resource();
        $resourse->init();
    }

    /* Initialize view object. */
    public function getView()
    {
        if (empty($this->_view))
            $this->_view = new View();
        return $this->_view;
    }
}