<?php

class Gama_Locality_Model_Api2_Pickuppointcategory_Rest_Admin_V1 extends Gama_Locality_Model_Api2_Pickuppoint
{

		protected function _retrieve()
		{
      $pickupId = $this->getRequest()->getParam('pickuppoint_id');
			$categoryId      = $this->getRequest()->getParam('cat_id'); 
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
				if( !empty( $category ) ) {
					$sub_cats = $pickupPoint[$categories[$category]];
					$sub_cats = explode(",", $sub_cats);
				  
				  foreach( $sub_cats as $sub_cat ) {
						$subCategory = ($sub_cat) ? Mage::getModel('catalog/category')->load($sub_cat) : "";
						$products= Mage::getModel('catalog/category')->load($subCategory->getId())
                            -> getProductCollection()
                            -> addAttributeToSelect('*')
                            -> addAttributeToFilter('status', 1)
                            -> load()->toArray();
						
						$subCategories[] = array(
							 'id'         => $subCategory->getId(),
							 'name'       => $subCategory->getName(),
							 'products'   => $products
						);
					}
				}
			}

      $resSubCategories[0] = $subCategories;
      //print_r($resSubCategories); exit;
      return $resSubCategories;
		}

    protected function _retrieveCollection()
    {
        $pickupId = $this->getRequest()->getParam('pickuppoint_id');
        $dateArray  = array(); 
        for ($i = 0; $i <= 1; $i++) {
					if ($i == 0) {
							$key = 'Today';
					} else if ($i == 1) {
							$key ='Tomorrow';
					} else {
							$key = date('l',strtotime('+'.$i.' day', time()));
					}
					
					$dateArray[$key] = date('d-m-Y',strtotime('+'.$i.' day', time())); 
			 }
       
       $collection = Mage::getModel('gama_locality/pickuppoint')->getResourceCollection()
            ->addFieldToFilter('pickuppoint_id', $pickupId)
            ->load()
            ->toArray();
        $category = array();
        foreach ($collection['items'] as $pickupPoint) {					 
           $category1 = ($pickupPoint['category1']) ? Mage::getModel('catalog/category')->load($pickupPoint['category1']) : "";
           $category2 = ($pickupPoint['category2']) ? Mage::getModel('catalog/category')->load($pickupPoint['category2']) : "";
           $category3 = ($pickupPoint['category3']) ? Mage::getModel('catalog/category')->load($pickupPoint['category3']) : "";
           $category4 = ($pickupPoint['category4']) ? Mage::getModel('catalog/category')->load($pickupPoint['category4']) : "";
          
            $category[$pickupPoint['category1']]['name'] =  ($category1) ? $category1->getName() : "";
            $category[$pickupPoint['category2']]['name'] =  ($category2) ? $category2->getName() : "";
            $category[$pickupPoint['category3']]['name'] =  ($category3) ? $category3->getName() : "";
            $category[$pickupPoint['category4']]['name'] =  ($category4) ? $category4->getName() : "";
            
            /*$responseArray['menu'][]= array('id'=> $pickupPoint['category1'], 'name'=> $category1_name);
            $responseArray['menu'][]= array('id'=> $pickupPoint['category2'], 'name'=> $category2_name);
            $responseArray['menu'][]= array('id'=> $pickupPoint['category3'], 'name'=> $category3_name);
            $responseArray['menu'][]= array('id'=> $pickupPoint['category4'], 'name'=> $category4_name);
            
            $resultArr[$i++][] = $responseArray; */
        }
        $j = 0;
        $resultArr  = array();
        foreach ($dateArray as $key => $date) {
					$responseArray = array();
					$responseArray['day']= $key;
         	$responseArray['date']= date('l jS M, Y ', strtotime($date));
					foreach($category as $ckey => $cat) {
						if( $ckey != 0 ) {
							$responseArray['menu'][]= array('id'=> $ckey, 'name'=> $cat['name'] );
						}
					}
					$resultArr[$j++][] = $responseArray;
				}
        return $resultArr;
    }
}
