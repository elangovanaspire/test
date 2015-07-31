<?php
/**
 * Categories and Sub Categories Rest API for Guest
 */
class Gama_Menu_Model_Api2_Subcategory_Rest_Guest_V1 extends Mage_Api2_Model_Resource {

	/**
	 * Retrieve the category
	 * @return category entity
	 */
    protected function _retrieve() {
        $categoryId      = $this->getRequest()->getParam('id'); 
//        echo "subcategory: " . $categoryId; exit;
        $category        = Mage::getModel('catalog/category')
                         //   -> addAttributeToFilter('custom_design_from', array('to' => date('Y-m-d'),'date' => true))
                         //   -> addAttributeToFilter('custom_design_to', array('from' => date('Y-m-d'),'date' => true))
                            -> load($categoryId);
        $categoryCollection = $category->getChildrenCategories()->addIsActiveFilter();
        
        $subCategories = array();
        $i=0;
        foreach($categoryCollection as $subCategory) {
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
        $resSubCategories[0] = $subCategories;
        //print_r($resSubCategories); exit;
        return $resSubCategories;
    }

    /**
     * Retrieves the category collection and returns
     *
     * @return int
     */
     protected function _retrieveCollection() {
         echo "asd";
         exit;
        $model      = Mage::getSingleton('catalog/category');
        $parent_id  = Mage::app()->getStore("default")->getRootCategoryId();
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
       
        $resultArr  = array();
        $j=0;
        foreach ($dateArray as $key => $date) { 
            $collection = $model->getCollection()
                        -> addAttributeToSelect(
                                array_keys(
                                   $this-> getAvailableAttributes($this->getUserType(), Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ)
                                ))                
                        -> addAttributeToFilter('is_active', array('eq' => 1))
                        -> addAttributeToFilter('parent_id', array('eq' => $parent_id)) 
                        -> addAttributeToFilter('custom_design_from', array('to' => $date,'date' => true))
                        -> addAttributeToFilter('custom_design_to', array('from' => $date,'date' => true))
                        -> load()->toArray();
                     
            $responseArray = array();
            $responseArray['day']= $key;
            $responseArray['date']= date('l jS M, Y ', strtotime($date));
            
            foreach($collection as $categories) {
                
                
                $responseArray['menu'][]= array('id'=> $categories['entity_id'], 'name'=> $categories['name']);
            }
            $resultArr[$j++][] = $responseArray; 
        }
               
        // print_r($resultArr); exit;
     
        return $resultArr;
    }
}

