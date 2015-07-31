<?php

class Gama_Locality_Model_Api2_Pickuppointrequest_Rest_Guest_V1 extends Gama_Locality_Model_Api2_Pickuppoint
{

    protected function _create($filteredData)
    {
        $validator = Mage::getResourceModel('api2/validator_fields', array(
            'resource' => $this
        ));
        
        if (! $validator->isValidData($filteredData)) {
            foreach ($validator->getErrors() as $error) {
                $this->_error($error, Mage_Api2_Model_Server::HTTP_BAD_REQUEST);
            }
            $this->_critical(self::RESOURCE_DATA_PRE_VALIDATION_ERROR);
            return;
        }
        try {
            $requestDetails = Mage::getModel('gama_locality/pickuppointrequest')
                                    ->setData($filteredData)
                                    ->save();
            return $this->_getLocation($requestDetails);
        } 

        catch (Mage_Core_Exception $e) {
            $this->_error(Mage::helper('gama_locality')
                        ->__('Unable to register your request. Please try again later'), 
                          Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);
        }
    }
}