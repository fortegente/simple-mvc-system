<?php
/*
*   Abstract controller class
*/
class Core_Controller_Abstract
{
    /*
    * Call requested controller method.
    * @param request object
    */
    public function dispatch($request)
    {
        if (!$this->_canDispatch($request)) {

            throw new Core_Model_Exception();
        }

        call_user_func(array($this, $request->getData('action')));
    }

    /*
    * Check existence method.
    * @param request object
    * @return boolean
    */
    protected function _canDispatch($request)
    {
        return method_exists($this, $request->getData('action'));
    }

}