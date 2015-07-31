<?php

class Gama_Locality_Model_Pickuppoint extends Mage_Core_Model_Abstract
{

    /**
     * Define resource model
     */
    protected function _construct ()
    {
        $this->_init('gama_locality/pickuppoint');
    }

    public function getCategoryChoices()
    {
        $parentCategoryId = Mage::app()->getStore("default")->getRootCategoryId();

        $category = Mage::getModel('catalog/category')->load($parentCategoryId);
        $subcats = $category->getChildren();
        foreach(explode(',',$subcats) as $subCatid)
              {
                $_category = Mage::getModel('catalog/category')->load($subCatid);
                $catid = $_category->getId();
                $catname[$catid] = $_category->getName();
                
            }
            return $catname;
    }

    protected function _beforeSave ()
    {
        parent::_beforeSave();
        if ($this->isObjectNew()) {
            $this->setData('created_at', Varien_Date::now());
        }
        return $this;
    }
}