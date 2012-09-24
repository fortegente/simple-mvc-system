<?php
/*
*  Display collection of items
*/
class Tree_Controller_Index extends Core_Controller_Abstract
{
    /* @var string tree hierarchy*/
    public $tree = '';

    /* Get all records from database and output them to frontend. */
    public function index()
    {
        $this->getTreeHtml(0, 0);
        $view = Init::app()->getView();
        $view->setData('title', 'Tree');
        $view->setData('tree', $this->tree);
        $view->display('tree');
    }

    /*
     * Create tree hierarchy.
     * @param int
     * */
    function getTreeHtml($parentID, $level)
    {
        $level++;
        $model = Init::getModel("tree" . DS . "tree");
        $result = $model->getCollection()
                        ->setWhere(array("parent_id" => $parentID))
                        ->makeQuery();
        $this->tree .= "<ul>";
        while ($row = $model->fetch($result)) {
            $id = $row["id"];
            $this->tree .= "<li>";
            $this->tree .= $row["name"] . "\n";
            $this->getTreeHtml($id, $level);
            $level--;
        }
        $this->tree .= "</ul>\n";
    }

}