<?php

/* Global transfer of values ​​between the individual objects. */
class Registry implements ArrayAccess
{

    protected $_data = array();

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->_data[] = $value;
        } else {
            $this->_data[$offset] = $value;
        }
    }

    public function offsetGet($offset)
    {
        return (isset($this->_data[$offset])) ? $this->_data[$offset] : null;
    }

    public function offsetExists($offset)
    {
        return $this->_data[$offset];
    }

    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }

    public function getData($key = '')
    {
        if (array_key_exists($key, $this->_data)) {
            return $this->_data[$key];
        } elseif (empty($key)) {
            return $this->_data;
        }

        return false;
    }

    public function setData($key, $value)
    {
        if ($key) {
            $this->_data[$key] = $value;
        } else {
            $this->_data[] = $value;
        }

        return $this;
    }

    public function unsData($key)
    {
        if (array_key_exists($key, $this->_data)) {
            unset($this->_data[$key]);
        }
        return false;
    }

    public function addData(array $arr)
    {
        foreach ($arr as $key => $value) {
            $this->setData($key, $value);
        }
        return $this;
    }

    public function hasData($key)
    {
        return array_key_exists($key, $this->_data);
    }
}