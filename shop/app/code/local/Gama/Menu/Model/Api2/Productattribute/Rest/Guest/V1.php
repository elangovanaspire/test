<?php

/**
 * Override for Magento's Catalog REST API
 */
class Gama_Menu_Model_Api2_Productattribute_Rest_Guest_V1 extends Mage_Api2_Model_Resource {

    /**
     * Retrieve the attribute options
     * @return attribute options
     */
    protected function _retrieve() {
        $bundleItems        = array();
        $productId          = $this->getRequest()->getParam('id');
        $bundleProduct      = Mage::getModel('catalog/product')->load($productId);	

        /* custom options */
       // $attVal = $bundleProduct->getOptions();
        $optionCollection       = $bundleProduct->getTypeInstance()->getOptionsCollection();
        $selectionCollection    = $bundleProduct->getTypeInstance()->getSelectionsCollection($bundleProduct->getTypeInstance()->getOptionsIds());
        $options                = $optionCollection->appendSelections($selectionCollection);
         
	
	foreach($options as $option) {
            
            $itemsArray = array();   

            $selections = $option->getSelections();
           
            foreach ($selections as $selection) {                 
                $itemsArray[] = array(
                        'itemId'=> $selection->getId(),
                        'itemName'=> $selection->getName(),
                        'itemQuantity'=>$selection->getSelectionQty()
                    );
            }
            $bundleItems['bundleItems'][]=$itemsArray;
	}
      
        $bundleItems[0] = $bundleItems;          
              
        $upsellProducts = $bundleProduct->getUpSellProductCollection()->addAttributeToSort('position', Varien_Db_Select::SQL_ASC)->addStoreFilter(); 

        //check if record is empty or not
        $count = count($upsellProducts); 
        
        $upSellArr = array();
        
        //if result is not empty then get  upsell product detail using foreach loop
        foreach($upsellProducts as $upsell) {
            
            $addOnBundleItems            = array();

            //get detail of single upsell prdocut using upsell product id
            $upSellProduct               = $bundleProduct->load($upsell->getId());

            $addOnBundleProduct          = Mage::getModel('catalog/product')->load($upSellProduct->getId());
            $selectionAddOnCollection    = $addOnBundleProduct->getTypeInstance(true)->getSelectionsCollection(
            $addOnBundleProduct->getTypeInstance(true)->getOptionsIds($addOnBundleProduct), $addOnBundleProduct);
         
            foreach($selectionAddOnCollection as $option) {
           
                $addOnBundleItems[]      = array(
                                            'addonItemId' => $option->entity_id, 
                                            'addonItemName' => $option->name,
                                            'addonItemPrice' => $option->price
                                        );
            }
            
            $upSellArr[] = array(
                'upSellProductGroupId'=>$upSellProduct->getId(),
                'upSellProductGroupName'=>$upSellProduct->getName(),
                'upSellProductGroupItems'=>$addOnBundleItems
            ); 
        }
        
        $bundleItems[0]['addonGroupItems'] = $upSellArr;
        
            
    	return $bundleItems;
    }

    /**
     * TODO
     *
     * @return int
     */
    protected function _retrieveCollection() {
        
    }
}

