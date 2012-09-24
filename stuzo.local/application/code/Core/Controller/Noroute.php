<?php

class Core_Controller_Noroute extends Core_Controller_Abstract
{

    /* Display noroute page. */
    public function index()
    {
        $view = Init::app()->getView();
        $view->display('noroute');
    }
}