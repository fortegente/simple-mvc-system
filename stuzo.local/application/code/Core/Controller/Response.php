<?php

class Core_Controller_Response
{
    /* @var Include page's content. */
    private $_body = '';

    /* @var Array of headers. */
    private $_header = array();

    /*
     *  Send headers.
     *  @param string, string
     */
    public function setHeader($key, $value)
    {
        if (isset($key)) {
            $this->_header[$key] = $value;
        } else {
            $this->_header[] = $value;
        }
        return $this;
    }

    /*
     *  Get necessary header.
     *  @param string
     */
    public function getHeader($key)
    {
        if (isset($this->_header[$key]))
            return $this->_header[$key];

        return $this->_header;
    }

    /* Send all setted headers. */
    public function sendHeaders()
    {
        if (isset($this->_header)) {
            foreach ($this->_header as $key => $value) {
                if (strlen($key) > 1) {
                    header($key . ':' . $value);
                } else {
                    header($value);
                }
            }
        }
    }

    /* Output page's body. */
    public function send()
    {
        $this->sendHeaders();
        echo $this->_body;
    }

    /* Get pages' body.
     * @return string
     */
    public function getBody()
    {
        return $this->_body;
    }

    /* Set pages' body.
     * @return object
     */
    public function setBody($body)
    {
        $this->_body = $body;
        return $this;
    }

    /* Add pages' body as element of array.
     * @return object
     */
    public function addBody($body)
    {
        $this->_body .= $body;
        return $this;
    }
}