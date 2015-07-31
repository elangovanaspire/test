<?php

class Gama_Core_Model_Api2_Session_Rest_Guest_V1 extends Gama_Core_Model_Api2_Session
{

    protected function _create ($filteredData)
    {
        $validator = Mage::getResourceModel('api2/validator_fields', 
                array(
                        'resource' => $this
                ));
        //print_r($validator); exit;
        if (! $validator->isValidData($filteredData)) {
            foreach ($validator->getErrors() as $error) {
                $this->_error(ucfirst($error), Mage_Api2_Model_Server::HTTP_BAD_REQUEST);
            }
            return;
        }
        if ($this->_customerLogin($filteredData)) {
            $customerDetails = $this->_getUserDetails();
            return $this->_getLocation($customerDetails);
        }
    }
    
    protected function _retrieve()
    {
        $this->getRequest()->getParam('session_id');
    }

    protected function _customerLogin ($filteredData)
    {
        $customerSession = Mage::getSingleton('customer/session');
        return $customerSession->login($filteredData['user_name'], 
                $filteredData['password']);
    }

    protected function _getUserDetails ()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
        
    }

    protected function _getLocation ($resource)
    {
        /**
         * @var $apiTypeRoute Mage_Api2_Model_Route_ApiType
         */
        $apiTypeRoute = Mage::getModel('api2/route_apiType');
        
        $chain = $apiTypeRoute->chain(
                new Zend_Controller_Router_Route(
                        $this->getConfig()
                            ->getRouteWithEntityTypeAction(
                                $this->getResourceType())));
        
        $params = array(
                'api_type' => $this->getRequest()->getApiType(),
                'session_id' => $this->_getSessionId($resource)
        );
     
        $username = ucfirst($resource->getName());
        $uri = $chain->assemble($params);
        return '/' . $uri. '/' .$username;
    }

    protected function _getSessionId ($resource)
    {
              
        return urlencode(Mage::helper('core')->encrypt(
                serialize(
                        array(
                                'user_id' => $resource->getEmail(),
                                'customer_id' => $resource->getId(),
                                'time' => time()
                        ))));
    }
}
