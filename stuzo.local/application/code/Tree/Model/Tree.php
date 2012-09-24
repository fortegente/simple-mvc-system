<?php
/*
*  Used to retrieve tree of items.
*/
class Tree_Model_Tree extends Core_Model_Abstract
{
    protected $_table = 'items';
    protected $_fields = array('id', 'parent_id', 'name');
}