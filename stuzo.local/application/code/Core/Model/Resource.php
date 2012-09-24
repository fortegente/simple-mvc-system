<?php
/*
*  Class for create database connect
*/
class Core_Model_Resource
{

    /* Database connection identifier. */
    private $_connect;

    /*
    *  Create database connection.
    *  @return resource database connection identifier.
    */
    public function init()
    {
        $params = $this->_getConfig();
        $this->_connect = mysql_connect($params["host"], $params["user"], $params["pass"]) || die(mysql_error());
        mysql_select_db($params["name"]) || die(mysql_error());

        return $this->_connect;
    }

    /*
    *  Get database config.
    *  @return array parameters
    */
    protected function _getConfig()
    {
        $params = parse_ini_file(BP . DS . "etc" . DS . "config.ini", true);

        return $params['database'];
    }
}