<?php

class Gama_Locality_Model_Resource_Pickuppointrequest extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Define resource model
     */
    protected function _construct ()
    {
        $this->_init('gama_locality/pickuppointrequest', 'pickuppoint_request_id');
    }
}