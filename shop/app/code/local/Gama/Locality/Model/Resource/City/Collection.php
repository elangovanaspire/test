<?php

class Gama_Locality_Model_Resource_City_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    /**
     * Initialize connection and define main table and primary key
     */
    protected function _construct ()
    {
        $this->_init('gama_locality/city', 'city_id');
    }
    
    public function toOptionArray($emptyLabel = ' ')
    {
        $options = $this->_toOptionArray('city_id', 'name');
    
        if (count($options) > 0 && $emptyLabel !== false) {
            array_unshift($options, array('value' => '', 'label' => $emptyLabel));
        }
    
        return $options;
    }
}