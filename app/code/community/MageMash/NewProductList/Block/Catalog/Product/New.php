<?php
class MageMash_NewProductList_Block_Catalog_Product_New extends Mage_Catalog_Block_Product_List
{
    /**
    * Retrieve loaded category collection
    *
    * @return Mage_Eav_Model_Entity_Collection_Abstract
    **/
    protected function _getProductCollection()
    {
        $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $collection = Mage::getResourceModel('catalog/product_collection');
        $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());

        $collection = $this->_addProductAttributesAndPrices($collection)
        ->addStoreFilter()
        ->addAttributeToFilter('news_from_date', array(
            'date' => true,
            'to' => $todayDate
        ))
        ->addAttributeToFilter('news_to_date', array(
            'or'=> array(
                0 => array(
                    'date' => true,
                    'from' => $todayDate
                ),
                1 => array('is' => new Zend_Db_Expr('null'))
            )
        ), 'left')

        ->addAttributeToSort('news_from_date', 'desc')
        ->setPageSize($this->get_prod_count())
        ->setCurPage($this->get_cur_page());

        $this->setProductCollection($collection);

        return $collection;
    }
}
?>