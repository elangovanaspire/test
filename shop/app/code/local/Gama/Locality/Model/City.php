<?php

class Gama_Locality_Model_City extends Mage_Core_Model_Abstract
{

    /**
     * Define resource model
     */
    protected function _construct ()
    {
        $this->_init('gama_locality/city');
    }
    
    public function getCityChoices()
    {
        return Mage::getModel('gama_locality/city')->getResourceCollection()
            ->toOptionArray(
                Mage::helper('gama_locality')->__('Select'));
            
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
