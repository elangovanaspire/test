<?php

class Gama_Locality_Block_Adminhtml_Pickuppointrequest extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct ()
    {
        $this->_blockGroup = 'gama_locality';
        $this->_controller = 'adminhtml_pickuppointrequest';
        $this->_headerText = Mage::helper('gama_locality')->__('Manage Pickup Point Request');
        
        parent::__construct();
        if (Mage::helper('gama_locality/Admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('gama_locality')->__('Add New Pickup Point Request'));
        } else {
        	$this->_removeButton('add');
        } 
    }
}