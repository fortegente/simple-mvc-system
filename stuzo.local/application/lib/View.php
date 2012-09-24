<?php
class View extends Registry
{
    /* @var array */
    private $_content = array();

    /*
     * Push file's content into array.
     * @param string template, boolean
     * */
    public function display($template, $writeToBody = true)
    {
        ob_start();
        include Init::getBaseDir('templates') . DS . $template . '.phtml';
        $content = ob_get_contents();
        ob_end_clean();
        if (!$writeToBody) {
            return $content;
        }
        $this->_content = $content;
    }

    /*
     *  Add file's content to response object.
     */
    public function renderOutput()
    {
        $page = $this->display('1column', false); //file_get_contents(Init::getBaseDir('templates'). '');
        $content = str_replace(array('{$title}', '{$content}'), array($this->getData('title'), $this->_content), $page);
        Init::app()->getResponse()->addBody($content);
    }

}