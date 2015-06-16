<?php

class MageMash_NewProductList_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index index action
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
