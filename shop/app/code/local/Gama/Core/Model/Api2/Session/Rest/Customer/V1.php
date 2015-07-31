<?php

class Gama_Core_Model_Api2_Session_Rest_Customer_V1 extends Gama_Core_Model_Api2_Session
{
    
    protected function _retrieve()
    {
        //$this->getRequest()->getParam('session_id');
        $this->_customerLogout();
        if($this->_customerLogout()) {
            return "Logged out successfully";
        } else {
            return "Logout error";
        }
    }

    protected function _customerLogout() {
        $customerSession = Mage::getSingleton('customer/session');
        return $customerSession->logout();
    }

}
