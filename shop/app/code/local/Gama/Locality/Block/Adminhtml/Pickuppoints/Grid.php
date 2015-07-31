<?php

class Gama_Locality_Block_Adminhtml_Pickuppoints_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct ()
    {
        parent::__construct();
        $this->setId('pickuppoint_list_grid');
        $this->setDefaultSort('pickuppoint_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection ()
    {
        $this->setCollection(Mage::helper('gama_locality')->getPickupPointCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns ()
    {
        $this->addColumn('pickuppoint_id', 
                array(
                        'header' => Mage::helper('gama_locality')->__('ID'),
                        'index' => 'pickuppoint_id',
                        'width' => '10px',
                ));
        
        $this->addColumn('pickuppoint_name', 
                array(
                        'header' => Mage::helper('gama_locality')->__('Name'),
                        'width' => '100px',
                        'index' => 'name'
                ));
        
        $this->addColumn('city_name', 
                array(
                        'header' => Mage::helper('gama_locality')->__('City'),
                        'width' => '100px',
                        'index' => 'city_name'
                ));
        
        $this->addColumn('country_id',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Country'),
                        'width' => '50px',
                        'index' => 'country_id'
                ));
        
        $this->addColumn('active_from', 
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Activation Date'),
                        'width' => '100px',
                        'index' => 'active_from'
                ));
        
        $this->addColumn('created_at',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Created Date'),
                        'width' => '100px',
                        'index' => 'created_at'
                ));

        $this->addColumn('category1',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category1'),
                        'width' => '50px',
                        'index' => 'category1'
                ));
                
        $this->addColumn('bf_items',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Breakfast Items'),
                        'width' => '50px',
                        'index' => 'bf_items'
                ));

        $this->addColumn('category1_st',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category1 Start Time'),
                        'width' => '50px',
                        'index' => 'category1_st'
                ));

        $this->addColumn('category1_et',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category1 End Time'),
                        'width' => '50px',
                        'index' => 'category1_et'
                ));

        $this->addColumn('category2',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category2'),
                        'width' => '50px',
                        'index' => 'category2'
                ));
                
        $this->addColumn('lunch_items',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Lunch Items'),
                        'width' => '50px',
                        'index' => 'lunch_items'
                ));

        $this->addColumn('category2_st',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category2 Start Time'),
                        'width' => '50px',
                        'index' => 'category2_st'
                ));

        $this->addColumn('category2_et',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category2 End Time'),
                        'width' => '50px',
                        'index' => 'category2_et'
                ));

        $this->addColumn('category3',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category3'),
                        'width' => '50px',
                        'index' => 'category3'
                ));
                
        $this->addColumn('dinner_items',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Dinner Items'),
                        'width' => '50px',
                        'index' => 'dinner_items'
                ));

        $this->addColumn('category3_st',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category3 Start Time'),
                        'width' => '50px',
                        'index' => 'category3_st'
                ));

        $this->addColumn('category3_et',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category3 End Time'),
                        'width' => '50px',
                        'index' => 'category2_et'
                ));

        $this->addColumn('category4',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category4'),
                        'width' => '50px',
                        'index' => 'category4'
                ));
                
				$this->addColumn('snacks_items',
				array(
								'header' => Mage::helper('gama_locality')->__(
												'Snacks Items'),
								'width' => '50px',
								'index' => 'snacks_items'
				));

        $this->addColumn('category4_st',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category4 Start Time'),
                        'width' => '50px',
                        'index' => 'category4_st'
                ));

        $this->addColumn('category4_et',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Category4 End Time'),
                        'width' => '50px',
                        'index' => 'category4_et'
                ));
    }

    public function getRowUrl ($row)
    {
        return $this->getUrl('*/*/edit', 
                array(
                        'id' => $row->getPickuppointId()
                ));
    }

    /**
     * Grid url getter
     *
     * @return string current grid url
     */
    public function getGridUrl ()
    {
        return $this->getUrl('*/*/grid', 
                array(
                        '_current' => true
                ));
    }
}
