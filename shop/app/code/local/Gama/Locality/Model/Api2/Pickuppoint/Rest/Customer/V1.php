<?php

class Gama_Locality_Model_Api2_Pickuppoint_Rest_Customer_V1 extends Gama_Locality_Model_Api2_Pickuppoint
{

    protected function _retrieveCollection()
    {
        $cityId = $this->getRequest()->getParam('city_id');
        $response = array();
        $i = 0;
        $collection = Mage::getModel('gama_locality/pickuppoint')->getResourceCollection()
            ->addFieldToFilter('city_id', $cityId)
            ->addFieldToFilter('active', 1)
            ->addFieldToFilter('active_from', array(
            'lteq' => date("Y-m-d")
        ))
            ->load()
            ->toArray();

       
         foreach ($collection['items'] as $pickupPoint) {
            $response[$i++] = array (
                'id'            => $pickupPoint['pickuppoint_id'],
                'name'          => $pickupPoint['name'],
                'is_favourite' => true,
                'category1_st'  => date('h A', strtotime($pickupPoint['category1_st'])),
                'category1_et'  => date('h A', strtotime($pickupPoint['category1_et'])),
                'category2_st'  => date('h A', strtotime($pickupPoint['category2_st'])),
                'category2_et'  => date('h A', strtotime($pickupPoint['category2_et'])),
                'category3_et'  => date('h A', strtotime($pickupPoint['category3_et'])),
                'category3_st'  => date('h A', strtotime($pickupPoint['category3_st'])),
                'category4_st'  => date('h A', strtotime($pickupPoint['category4_st'])),
                'category4_et'  => date('h A', strtotime($pickupPoint['category4_et'])),
            );
        }    
        return $response;
    }
}