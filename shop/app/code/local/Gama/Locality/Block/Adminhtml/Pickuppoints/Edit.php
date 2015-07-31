<?php

class Gama_Locality_Block_Adminhtml_Pickuppoints_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct ()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'gama_locality';
        $this->_controller = 'adminhtml_pickuppoints';
        
        parent::__construct();
        
        if (Mage::helper('gama_locality/Admin')->isActionAllowed('save')) {
            $this->_updateButton('save', 'label', 
                    Mage::helper('gama_locality')->__('Save Pickup Point'));
        } else {
            $this->_removeButton('save');
        }
        
        //$this->_removeButton('delete');
        
        $this->_updateButton('delete', 'label', Mage::helper('gama_locality')->__('Delete PickupPoint Request'));
        $this->_updateButton('delete', 'onclick', "deleteConfirm(
                    '".Mage::helper('adminhtml')->__('Are you sure you want to do this?')."',
                    '".$this->getUrl('*/*/delete/type/gama_locality/id/'.$this->getRequest()->getParam('id')
                    )."')");
        
        
        $this->setDestElementId('edit_form');
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return string
     */
    public function getHeaderText ()
    {
        $model = Mage::helper('gama_locality')->getPickuppointInstance();
        if ($model->getPickuppointId()) {
            return Mage::helper('gama_locality')->__("Edit Pickup Point '%s'", $this->escapeHtml($model->getName()));
        } else {
            return Mage::helper('gama_locality')->__('New Pickup Point');
        }
    }
}
