<?php

class Gama_Locality_Model_Pickuppointrequest extends Mage_Core_Model_Abstract
{

    /**
     * Define resource model
     */
    protected function _construct ()
    {
        $this->_init('gama_locality/pickuppointrequest');
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