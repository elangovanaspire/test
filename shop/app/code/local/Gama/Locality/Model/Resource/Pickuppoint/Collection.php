<?php

class Gama_Locality_Model_Resource_Pickuppoint_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * Initialize connection and define main table and primary key
     */
    protected function _construct ()
    {
        $this->_init('gama_locality/pickuppoint', 'pickuppoint_id');
    }
}