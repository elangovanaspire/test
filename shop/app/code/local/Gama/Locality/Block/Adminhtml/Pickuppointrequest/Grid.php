<?php

class Gama_Locality_Block_Adminhtml_Pickuppointrequest_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct ()
    {
        parent::__construct();
        $this->setId('pickuppointrequest_list_grid');
        $this->setDefaultSort('pickuppoint_request_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection ()
    {
        $this->setCollection(Mage::helper('gama_locality')->getPickupPointRequestCollection());
        
        return parent::_prepareCollection();
    }

    protected function _prepareColumns ()
    {
        $this->addColumn('pickuppoint_request_id', 
                array(
                        'header' => Mage::helper('gama_locality')->__('ID'),
                        'index' => 'pickuppoint_request_id',
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
        
        $this->addColumn('mobile_no',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Mobile Number'),
                        'width' => '50px',
                        'index' => 'mobile_no'
                ));
               
        $this->addColumn('created_at',
                array(
                        'header' => Mage::helper('gama_locality')->__(
                                'Requested Date'),
                        'width' => '100px',
                        'index' => 'created_at'
                ));
    }

    public function getRowUrl ($row)
    {
        return $this->getUrl('*/*/edit', 
                array(
                        'id' => $row->getPickuppointRequestId()
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