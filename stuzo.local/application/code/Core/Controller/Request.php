<?php
/**
 *  Handler address string.
 */
class Core_Controller_Request extends Registry
{
    /* Init appropriate method. */
    public function init()
    {
        $this->_preDispatch();
        $this->_dispatchController();
    }

    /* Handler requested address. */
    protected function _preDispatch()
    {
        $path = explode("/", rtrim($_SERVER['REQUEST_URI'], "/"));
        array_shift($path);
        $path = (isset($path[0])) ? $path : '';
        $this->setData('request_path', $path);
        $this->_initRequest();
    }

    /* Call appropriate method in controller. */
    protected function _dispatchController()
    {
        $controller = $this->_getInstanceController();
        $controller->dispatch($this);
    }

    /*
    * Create controller instance.
    * @return controller instance
    */
    protected function _getInstanceController()
    {
        $module = ucfirst($this->getData('module'));
        $class = ucfirst($this->getData('class'));
        $className = $module . "_Controller_" . $class;
        $file = BP . DS . "code" . DS . $module . DS . "Controller" . DS . $class . ".php";
        if (!file_exists($file)) {
            throw new Core_Model_Exception();
        }

        return new $className();
    }

    /**
     * Set request parameters.
     * @return Core_Controller_Request
     */
    public function _initRequest()
    {
        $requestPath = $this->getData('request_path');

        $this->setData('module', (isset($requestPath[0])) ? $requestPath[0] : "index");
        $this->setData('class', (isset($requestPath[1])) ? $requestPath[1] : "index");
        $this->setData('action', (isset($requestPath[2])) ? $requestPath[2] : "index");

        return $this;
    }

    /* Set noroute parameters. */
    public function forwardNoRoute()
    {
        $this->setData('module', 'core');
        $this->setData('class', 'noroute');
        $this->setData('action', 'index');

        $this->_dispatchController();
    }


}