<?php
/*
* Default class
*/
class Index_Controller_Index extends Core_Controller_Abstract
{

    /* Display index page. */
    public function index()
    {
        $view = Init::app()->getView();
        $view->setData('title', 'Main page');
        $view->display('index');
    }
}