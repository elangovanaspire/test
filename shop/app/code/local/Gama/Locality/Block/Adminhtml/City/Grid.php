<?php

class Gama_Locality_Block_Adminhtml_City_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct ()
    {
        parent::__construct();
        $this->setId('city_list_grid');
        $this->setDefaultSort('city_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection ()
    {
        $this->setCollection(
                Mage::getModel('gama_locality/city')->getResourceCollection());

        return parent::_prepareCollection();
    }

    protected function _prepareColumns ()
    {
        $this->addColumn('city_id', 
                array(
                        'header' => Mage::helper('gama_locality')->__('ID'),
                        'width' => '10px',
                        'index' => 'city_id'
                ));
        
        $this->addColumn('city_name', 
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Name'),
                        'width' => '100px',
                        'index' => 'name'
                ));
        
        $this->addColumn('county_id', 
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Country ID'),
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
    }

    public function getRowUrl ($row)
    {
        return $this->getUrl('*/*/edit', array(
                'id' => $row->getCityId()
        ));
    }

    /**
     * Grid url getter
     *
     * @return string current grid url
     */
    public function getGridUrl ()
    {
        return $this->getUrl('*/*/grid', array(
                '_current' => true
        ));
    }
}