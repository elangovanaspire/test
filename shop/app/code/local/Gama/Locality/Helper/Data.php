<?php

class Gama_Locality_Helper_Data extends Mage_Admin_Helper_Data
{

    protected $_cityInstance;
    
    protected $_pickuppointInstance;
    
    protected $_pickuppointrequestInstance;

    public function getCityInstance ()
    {
        if (! $this->_cityInstance) {
            $this->_cityInstance = Mage::registry('city_item');
            if (! $this->_cityInstance) {
                Mage::throwException(
                        $this->__(
                                'City item instance does not exist in Registry'));
            }
        }
        return $this->_cityInstance;
    }
    
    public function getPickuppointInstance()
    {
        if (! $this->_pickuppointInstance) {
            $this->_pickuppointInstance = Mage::registry('pickuppoint_item');
            if (! $this->_pickuppointInstance) {
                Mage::throwException(
                $this->__(
                'Pickup Point item instance does not exist in Registry'));
            }
        }
        return $this->_pickuppointInstance;
    }
    
    public function getPickuppointrequestInstance()
    {
        if (! $this->_pickuppointrequestInstance) {
            $this->_pickuppointrequestInstance = Mage::registry('pickuppointrequest_item'); 
          
            if (! $this->_pickuppointrequestInstance) {
                Mage::throwException(
                $this->__(
                'Pickup Point item instance does not exist in Registry'));
            }
        }
        return $this->_pickuppointrequestInstance;
    }

    public function getPickupPointCollection ()
    {
        $tablePrefix = Mage::getConfig()->getTablePrefix();
        $joinTable = $tablePrefix . 'locality_city';
        $mainTable = $tablePrefix . 'locality_pickup_point';
        $pickupPointCollection = Mage::getModel('gama_locality/pickuppoint')->getCollection();
        $pickupPointCollection->getSelect()->join(
                array(
                        'city' => $tablePrefix . 'locality_city'
                ), "main_table.city_id = city.city_id", array(
                        "city.name as city_name",
                        "city.country_id as country_id"
                ));
        return $pickupPointCollection;
    }
    
    public function getPickupPointRequestCollection ()
    {
        $tablePrefix = Mage::getConfig()->getTablePrefix();
        $joinTable = $tablePrefix . 'locality_city';
        $mainTable = $tablePrefix . 'locality_pickup_point_request';
        $pickupPointRequestCollection = Mage::getModel('gama_locality/pickuppointrequest')->getCollection();
        $pickupPointRequestCollection->getSelect()->join(
                 array(
                        'city' => $tablePrefix . 'locality_city'
                ), "main_table.city_id = city.city_id", array(
                        "city.name as city_name",
                        "city.country_id as country_id"
                ));
        return $pickupPointRequestCollection;
    }
}