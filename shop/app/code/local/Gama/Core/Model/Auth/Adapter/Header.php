<?php

class Gama_Core_Model_Auth_Adapter_Header extends Mage_Api2_Model_Auth_Adapter_Abstract
{

    /**
     * Check if request contains authentication info for adapter
     *
     * @param Mage_Api2_Model_Request $request            
     * @return boolean
     */
    public function isApplicableToRequest(Mage_Api2_Model_Request $request)
    {
        return $request->getHeader('AUTHORIZATION') != NULL;
    }

    public function getUserParams(Mage_Api2_Model_Request $request)
    {
        $userParamsObj = (object) array(
            'type' => null,
            'id' => null
        );
        try {
            $authenticationString = $request->getHeader('AUTHORIZATION');
            $authenticationDetails = unserialize(Mage::helper('core')->decrypt(urldecode($authenticationString)));
            $customerDetals = Mage::getModel('customer/customer')->load($authenticationDetails['customer_id']);
            
            $userParamsObj->id = $customerDetals->getData('entity_id');
            $userParamsObj->type = 'customer';
        } catch (Exception $e) {
            throw new Mage_Api2_Exception($e->getMessage(), Mage_Api2_Model_Server::HTTP_UNAUTHORIZED);
        }
        
        return $userParamsObj;
    }
}