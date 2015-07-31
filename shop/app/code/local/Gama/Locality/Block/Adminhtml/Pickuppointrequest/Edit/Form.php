<?php

class Gama_Locality_Block_Adminhtml_Pickuppointrequest_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm ()
    {
        $form = new Varien_Data_Form(
                array(
                        'id' => 'edit_form',
                        'action' => $this->getUrl('*/*/save'),
                        'method' => 'post'
                ));
        
        $fieldset = $form->addFieldset('base_fieldset', 
                array(
                        'legend' => Mage::helper('tag')->__('Pickup Point Request Information')
                ));
        
        $model = Mage::helper('gama_locality')->getPickuppointrequestInstance();
        if (Mage::helper('gama_locality/Admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }
        
        if ($model->getPickuppointRequestId()) {
            $fieldset->addField('pickuppoint_request_id', 'hidden', 
                    array(
                            'name' => 'pickuppoint_request_id'
                    ));
        }
        $fieldset->addField('name', 'text', 
                array(
                        'name' => 'name',
                        'label' => Mage::helper('gama_locality')->__(
                                'Pickup Point Name'),
                        'required' => true,
                        'disabled' => $isElementDisabled
                ));
        
        $fieldset->addField('city_id', 'select', 
                array(
                        'name' => 'city_id',
                        'label' => Mage::helper('gama_locality')->__('City'),
                        'required' => true,
                        'disabled' => $isElementDisabled,
                        'values' => Mage::getModel('gama_locality/city')->getCityChoices(),
                ));
        
        $fieldset->addField('mobile_no', 'text', 
                array(
                        'name' => 'mobile_no',
                        'label' => Mage::helper('gama_locality')->__('Mobile Number'),
                        'required' => true,
                        'disabled' => $isElementDisabled
                ));
        
        $fieldset->addField('created_at', 'date', 
                array(
                        'name' => 'created_at',
                        'label' => Mage::helper('gama_locality')->__(
                                'Requested On'),
                        'format' => Mage::app()->getLocale()
                            ->getDateFormat(
                                Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
                        'required' => true,
                        'disabled' => $isElementDisabled,
                        'readonly' => true,
                        'image' => $this->getSkinUrl('images/grid-cal.gif')
                ));
        
        $form->setValues($model->getData());
        $this->setForm($form);
        $form->setUseContainer(true);
        
        return parent::_prepareForm();
    }
}