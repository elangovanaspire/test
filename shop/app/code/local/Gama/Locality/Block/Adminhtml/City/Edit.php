<?php

class Gama_Locality_Block_Adminhtml_City_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct ()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'gama_locality';
        $this->_controller = 'adminhtml_city';
        
        parent::__construct();
        
        if (Mage::helper('gama_locality/Admin')->isActionAllowed('save')) {
            $this->_updateButton('save', 'label', 
                    Mage::helper('gama_locality')->__('Save City'));
        } else {
            $this->_removeButton('save');
        }
        
        $this->_removeButton('delete');
        $this->setDestElementId('edit_form');
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return string
     */
    public function getHeaderText ()
    {
        $model = Mage::helper('gama_locality')->getCityInstance();
        if ($model->getCityId()) {
            return Mage::helper('gama_locality')->__("Edit City '%s'", $this->escapeHtml($model->getName()));
        } else {
            return Mage::helper('gama_locality')->__('New City');
        }
    }
}