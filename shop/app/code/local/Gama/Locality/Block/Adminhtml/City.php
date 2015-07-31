<?php

class Gama_Locality_Block_Adminhtml_City extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct ()
    {
        $this->_blockGroup = 'gama_locality';
        $this->_controller = 'adminhtml_city';
        $this->_headerText = Mage::helper('gama_locality')->__('Manage City');
        
        parent::__construct();
        if (Mage::helper('gama_locality/Admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('gama_locality')->__('Manage City'));
        } else {
        	$this->_removeButton('add');
        } 
    }
}