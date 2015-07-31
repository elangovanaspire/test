<?php

class Gama_Locality_Model_Country extends Mage_Directory_Model_Country
{

    public function getCountryChoices ()
    {
        return Mage::getModel('directory/country')->getResourceCollection()
            ->loadByStore()
            ->toOptionArray(
                Mage::helper('gama_locality')->__('Select'));
    }
}