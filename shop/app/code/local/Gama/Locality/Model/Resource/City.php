<?php

class Gama_Locality_Model_Resource_City extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Define resource model
     */
    protected function _construct ()
    {
        $this->_init('gama_locality/city', 'city_id');
    }
}