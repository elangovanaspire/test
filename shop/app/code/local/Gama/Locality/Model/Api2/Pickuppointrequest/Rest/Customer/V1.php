<?php

class Gama_Locality_Model_Api2_Pickuppointrequest_Customer_Guest_V1 extends Gama_Locality_Model_Api2_Pickuppoint
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
        if ($this->_customerLogin($filteredData)) {
            $customerDetails = $this->_getUserDetails();
            return $this->_getLocation($customerDetails);
        }
    }
}