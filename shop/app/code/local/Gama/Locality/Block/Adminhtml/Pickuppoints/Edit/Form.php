<?php

class Gama_Locality_Block_Adminhtml_Pickuppoints_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form(
                array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save'),
            'method' => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('tag')->__('Pickup Point Information')
        ));

        $model = Mage::helper('gama_locality')->getPickuppointInstance();

        if (Mage::helper('gama_locality/Admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }
        $data = $model->getData();

        $start = "00:00";
        $end = "23:00";

        $tStart = strtotime($start);
        $tEnd = strtotime($end);
        $tNow = $tStart;

        $avail_times = array();
        while ($tNow <= $tEnd) {
            $interval = date("H:i", $tNow);
            $avail_times[$interval] = $interval;
            $tNow = strtotime('+60 minutes', $tNow);
        }


        if ($model->getPickuppointId()) {
            $fieldset->addField('pickuppoint_id', 'hidden', array(
                'name' => 'pickuppoint_id'
            ));
        }
        $fieldset->addField('name', 'text', array(
            'name' => 'name',
            'label' => Mage::helper('gama_locality')->__(
                    'Pickup Point Name'),
            'required' => true,
            'disabled' => $isElementDisabled
        ));

        $fieldset->addField('city_id', 'select', array(
            'name' => 'city_id',
            'label' => Mage::helper('gama_locality')->__('City'),
            'required' => true,
            'disabled' => $isElementDisabled,
            'values' => Mage::getModel('gama_locality/city')->getCityChoices(),
        ));

        $fieldset->addField('active_from', 'date', array(
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

        $fieldset->addField('active', 'checkbox', array(
            'name' => 'active',
            'label' => Mage::helper('gama_locality')->__('Is Active'),
            'required' => false,
            'onclick' => 'this.value = this.checked ? 1 : 0;',
            'checked' => isset($data['active']) ? $data['active'] : 0
        ));

        $fieldset->addField('cat_avail_from', 'date', array(
            'name' => 'cat_avail_from',
            'label' => Mage::helper('gama_locality')->__(
                    'Categories Available From'),
            'format' => Mage::app()->getLocale()
                    ->getDateFormat(
                            Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'required' => true,
            'disabled' => $isElementDisabled,
            'readonly' => true,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'class' => 'validate-date validate-date-range date-range-custom_theme-from'
        ));


        $fieldset->addField('cat_avail_to', 'date', array(
            'name' => 'cat_avail_to',
            'label' => Mage::helper('gama_locality')->__(
                    'Categories Available To'),
            'format' => Mage::app()->getLocale()
                    ->getDateFormat(
                            Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'required' => true,
            'disabled' => $isElementDisabled,
            'readonly' => true,
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'class' => 'validate-date validate-date-range date-range-custom_theme-to'
        ));

        $fieldset->addField('category1', 'checkbox', array(
            'name' => 'category1',
            'label' => Mage::helper('gama_locality')->__('Breakfast'),
            'required' => false,
            'onclick' => 'this.value = this.checked ? 3 : 0;',
            'checked' => isset($data['category1']) ? $data['category1'] : 0,
            'onchange' => "return this.value = this.checked ? 3 : uncheckall_pickupcats('category1', 'bf_items[]');"
        ));

        $categories = array();
        $subcats = Mage::getModel('catalog/category')->getCategories(3);
        foreach ($subcats as $sub) {
            $sub_cat_id = $sub->getId();
            $sub_cat_label = $sub->getName();
            $categories[] = array(
                'label' => $sub_cat_label,
                'value' => $sub_cat_id
            );
        }

        $fieldset->addField('bf_items', 'checkboxes', array(
            'name' => 'bf_items[]',
            'label' => Mage::helper('gama_locality')->__('Breakfast Items'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $categories,
            'onclick' => "return edit_form.category1.value = edit_form.category1.checked ? 3 : false;",
        ));

        $fieldset->addField('category1_st', 'select', array(
            'name' => 'category1_st',
            'label' => Mage::helper('gama_locality')->__(
                    'Start Time'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $avail_times,
        ));

        $fieldset->addField('category1_et', 'select', array(
            'name' => 'category1_et',
            'label' => Mage::helper('gama_locality')->__(
                    'End Time'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $avail_times,
        ));

        $fieldset->addField('category2', 'checkbox', array(
            'name' => 'category2',
            'label' => Mage::helper('gama_locality')->__('Lunch'),
            'required' => false,
            'checked' => isset($data['category2']) ? $data['category2'] : 0,
            'onclick' => 'this.value = this.checked ? 7 : 0;',
            'onchange' => "return this.value = this.checked ? 7 : uncheckall_pickupcats('category2', 'lunch_items[]');"
        ));

        $categories = array();
        $subcats = Mage::getModel('catalog/category')->getCategories(7);
        foreach ($subcats as $sub) {
            $sub_cat_id = $sub->getId();
            $sub_cat_label = $sub->getName();
            $categories[] = array(
                'label' => $sub_cat_label,
                'value' => $sub_cat_id
            );
        }

        $fieldset->addField('lunch_items', 'checkboxes', array(
            'name' => 'lunch_items[]',
            'label' => Mage::helper('gama_locality')->__('Lunch Items'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $categories,
            'onclick' => "return edit_form.category2.value = edit_form.category2.checked ? 7 : false;",
        ));

        $fieldset->addField('category2_st', 'select', array(
            'name' => 'category2_st',
            'label' => Mage::helper('gama_locality')->__(
                    'Start Time'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $avail_times,
        ));

        $fieldset->addField('category2_et', 'select', array(
            'name' => 'category2_et',
            'label' => Mage::helper('gama_locality')->__(
                    'End Time'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $avail_times,
        ));

        $fieldset->addField('category3', 'checkbox', array(
            'name' => 'category3',
            'label' => Mage::helper('gama_locality')->__('Dinner'),
            'required' => false,
            'onclick' => 'this.value = this.checked ? 9 : 0;',
            'checked' => isset($data['category3']) ? $data['category3'] : 0,
            'onchange' => "return this.value = this.checked ? 9 : uncheckall_pickupcats('category3', 'dinner_items[]');"
        ));

        $categories = array();
        $subcats = Mage::getModel('catalog/category')->getCategories(9);
        foreach ($subcats as $sub) {
            $sub_cat_id = $sub->getId();
            $sub_cat_label = $sub->getName();
            $categories[] = array(
                'label' => $sub_cat_label,
                'value' => $sub_cat_id
            );
        }

        $fieldset->addField('dinner_items', 'checkboxes', array(
            'name' => 'dinner_items[]',
            'label' => Mage::helper('gama_locality')->__('Dinner Items'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $categories,
            'onclick' => "return edit_form.category3.value = edit_form.category3.checked ? 9 : false;",
        ));

        $fieldset->addField('category3_st', 'select', array(
            'name' => 'category3_st',
            'label' => Mage::helper('gama_locality')->__(
                    'Start Time'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $avail_times,
        ));

        $fieldset->addField('category3_et', 'select', array(
            'name' => 'category3_et',
            'label' => Mage::helper('gama_locality')->__(
                    'End Time'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $avail_times,
        ));

        $fieldset->addField('category4', 'checkbox', array(
            'name' => 'category4',
            'label' => Mage::helper('gama_locality')->__('Snacks'),
            'required' => false,
            'onclick' => 'this.value = this.checked ? 8 : 0;',
            'checked' => isset($data['category4']) ? $data['category4'] : 0,
            'onchange' => "return this.value = this.checked ? 8 : uncheckall_pickupcats('category4', 'snacks_items[]');"
        ));

        $categories = array();
        $subcats = Mage::getModel('catalog/category')->getCategories(8);
        foreach ($subcats as $sub) {
            $sub_cat_id = $sub->getId();
            $sub_cat_label = $sub->getName();
            $categories[] = array(
                'label' => $sub_cat_label,
                'value' => $sub_cat_id
            );
        }

        $fieldset->addField('snacks_items', 'checkboxes', array(
            'name' => 'snacks_items[]',
            'label' => Mage::helper('gama_locality')->__('Snacks Items'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $categories,
            'onclick' => "return edit_form.category4.value = edit_form.category4.checked ? 8 : false;",
        ));

        $fieldset->addField('category4_st', 'select', array(
            'name' => 'category4_st',
            'label' => Mage::helper('gama_locality')->__(
                    'Start Time'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $avail_times,
        ));

        $fieldset->addField('category4_et', 'select', array(
            'name' => 'category4_et',
            'label' => Mage::helper('gama_locality')->__(
                    'End Time'),
            'required' => false,
            'disabled' => $isElementDisabled,
            'values' => $avail_times,
        ));

        //$data = $model->getData();
        //echo "<pre>";
        //print_r($data);
        foreach ($data as $key => $value) {
            if ($key == 'bf_items' || $key == 'lunch_items' || $key == 'dinner_items' || $key == 'snacks_items') {
                $data[$key] = explode(",", $value);
            }
        }

        $form->setValues($data);
        $this->setForm($form);
        $form->setUseContainer(true);

        return parent::_prepareForm();
    }

}
