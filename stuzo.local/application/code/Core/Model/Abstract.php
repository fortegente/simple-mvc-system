<?php
/*
*  Class to work with database
*/
class Core_Model_Abstract extends Registry
{

    /* Table's name. */
    protected $_table;

    /* Table field's name. */
    protected $_fields = array();

    /* Table's primary key. */
    protected $_primaryKey = 'id';

    protected $_query = '';

    /* Declare the required method which create ArrayIterator instance. */
    public function getIterator()
    {
        return new ArrayIterator($this);
    }

    /*
    *  Get all records from table.
    *  @return model object
    */
    public function getCollection()
    {
        $this->_query = "SELECT *  FROM " . $this->_getTable();
        return $this;
    }

    /*
    *  quoted string
    *  @param string for quoted
    *  @return string
    */
    protected function _quote($str)
    {
        return '`' . $str . '`';
    }

    /*
    *  Get table which contains information.
    *  @return str quoted table
    */
    protected function _getTable()
    {
        return $this->_quote($this->_table);
    }

    /*
    *  Get quoted fields that contains table.
    *  @return str fields
    */
    protected function _getFields()
    {
        foreach ($this->_fields as $value) {
            $fields[] = $this->_quote($value);
        }
        return implode(',', $fields);
    }

    /*
    *  Makes request to the database.
    *  @param query string
    *  @return resource of result
    */
    public function makeQuery()
    {
        $result = mysql_query($this->_query);
        if (!$result) {
            $message = 'Invalid query: ' . mysql_error() . '<br />';
            $message .= 'Whole query: ' . $this->_query;
            die($message);
        }
        return $result;
    }

    public function setWhere($array, $pred = "") {
        $this->_query .= " WHERE ";
        foreach ($array as $key => $value) {
            $this->_query .= $key . " = '$value' ". " " . $pred . " ";
        }
        if ($pred) $this->_query = substr($this->_query, 0, -4);

        return $this;
    }

    public function fetch($res) {
        return mysql_fetch_assoc($res);
    }
}