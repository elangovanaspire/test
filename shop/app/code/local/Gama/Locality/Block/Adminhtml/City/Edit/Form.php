<?php

class Gama_Locality_Block_Adminhtml_City_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
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
                        'legend' => Mage::helper('tag')->__('City Information')
                ));
        
        $model = Mage::helper('gama_locality')->getCityInstance();
        
        if (Mage::helper('gama_locality/Admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }
        
        if ($model->getCityId()) {
            $fieldset->addField('city_id', 'hidden', 
                    array(
                            'name' => 'city_id'
                    ));
        }
        $fieldset->addField('name', 'text', 
                array(
                        'name' => 'name',
                        'label' => Mage::helper('gama_locality')->__(
                                'City Name'),
                        'required' => true,
                        'disabled' => $isElementDisabled
                ));
        
        $fieldset->addField('country_id', 'select', 
                array(
                        'name' => 'country_id',
                        'label' => Mage::helper('gama_locality')->__('Country'),
                        'required' => true,
                        'disabled' => $isElementDisabled,
                        'values' => Mage::getModel('directory/country')->getCountryChoices(),
                ));
        
        $fieldset->addField('active_from', 'date', 
                array(
                        'name' => 'active_from',
                        'label' => Mage::helper('gama_locality')->__(
                                'Active From'),
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