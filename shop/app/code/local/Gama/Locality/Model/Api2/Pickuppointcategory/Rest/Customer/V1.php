<?php

class Gama_Locality_Model_Api2_Pickuppointcategory_Rest_Customer_V1 extends Gama_Locality_Model_Api2_Pickuppoint 
{

    protected function _retrieve() {
        $pickupId = $this->getRequest()->getParam('pickuppoint_id');
        $categoryId = $this->getRequest()->getParam('cat_id');
        //echo "subcategory: " . $categoryId; exit;

        $category = ($categoryId) ? Mage::getModel('catalog/category')->load($categoryId) : "";
        $category = $category->getName();

        $categories = array("BreakFast" => "bf_items",
            "Lunch" => "lunch_items",
            "Dinner" => "dinner_items",
            "Snacks" => "snacks_items"
        );

        $collection = Mage::getModel('gama_locality/pickuppoint')->getResourceCollection()
                ->addFieldToFilter('pickuppoint_id', $pickupId)
                //->addFieldToFilter($categories[$category], $categoryId)
                ->load()
                ->toArray();

        $subCategories = array();
        foreach ($collection['items'] as $pickupPoint) {
            if (!empty($category)) {
                $sub_cats = $pickupPoint[$categories[$category]];
                $sub_cats = explode(",", $sub_cats);

                foreach ($sub_cats as $sub_cat) {
                    $subCategory = ($sub_cat) ? Mage::getModel('catalog/category')->load($sub_cat) : "";
                    $products = Mage::getModel('catalog/category')->load($subCategory->getId())
                                    ->getProductCollection()
                                    ->addAttributeToSelect('*')
                                    ->addAttributeToFilter('status', 1)
                                    ->load()->toArray();

                    $subCategories[] = array(
                        'id' => $subCategory->getId(),
                        'name' => $subCategory->getName(),
                        'products' => $products
                    );
                }
            }
        }

        $resSubCategories[0] = $subCategories;
        //print_r($resSubCategories); exit;
        return $resSubCategories;
    }

    protected function _retrieveCollection() {
        $pickupId = $this->getRequest()->getParam('pickuppoint_id');
        $dateArray = array();
        for ($i = 0; $i <= 1; $i++) {
            if ($i == 0) {
                $key = 'Today';
            } else if ($i == 1) {
                $key = 'Tomorrow';
            } else {
                $key = date('l', strtotime('+' . $i . ' day', time()));
            }

            $dateArray[$key] = date('d-m-Y', strtotime('+' . $i . ' day', time()));
        }

        $pickupPointDet = Mage::getModel('gama_locality/pickuppoint')->getResourceCollection()
                ->addFieldToFilter('pickuppoint_id', $pickupId)
                ->getFirstItem()
                ->getData();

        $category = array();
        for ($i = 1; $i <= 4; $i++) {
            if ($pickupPointDet['category' . $i] > 0) {
                $category[$pickupPointDet['category' . $i]]['name'] = Mage::getModel('catalog/category')->load($pickupPointDet['category' . $i])->getName();
                $category[$pickupPointDet['category' . $i]]['start'] = $pickupPointDet['category' . $i . '_st'];
                $category[$pickupPointDet['category' . $i]]['end'] = $pickupPointDet['category' . $i . '_et'];
            }
        }

        $j = 0;
        $resultArr = array();
        foreach ($dateArray as $key => $date) {
            $responseArray = array();
            $responseArray['day'] = $key;
            $responseArray['date'] = date('l jS M, Y ', strtotime($date));
            $responseArray['pickuppointId'] = $pickupPointDet['pickuppoint_id'];
            $responseArray['pickuppoint'] = $pickupPointDet['name'];
            foreach ($category as $ckey => $cat) {
                if ($ckey != 0) {
                    $responseArray['menu'][] = array('id' => $ckey, 'name' => $cat['name'], 'start' => $cat['start'], 'end' => $cat['end']);
                }
            }
            $resultArr[$j++][] = $responseArray;
        }
        //  print_r($resultArr);
        return $resultArr;
    }

}
