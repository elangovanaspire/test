<?php

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;

$installer->startSetup();

$adapter = $installer->getConnection();

$pickuppointRequest = $adapter->newTable($installer->getTable('gama_locality/pickuppointrequest'))
    ->addColumn('pickuppoint_request_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, 
        array(
                'unsigned' => true,
                'nullable' => false,
                'identity' => true,
                'primary' => true,
                'auto_increment' => true
        ), 'Pickuppoint Request Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, 
        array(
                'nullable' => false
        ), 'Pickuppoint Name')
    ->addColumn('city_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'unsigned' => true,
            'nullable' => false,
        ), 'City ID')        
    ->addColumn('mobile_no', Varien_Db_Ddl_Table::TYPE_INTEGER, null, 
        array(
                'nullable' => false,
        ), 'Mobile No')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATE, null, 
        array(
                'nullable' => true,
                'default' => null
        ), 'City Created date')
    ->addForeignKey(
        $installer->getFkName('gama_locality/pickuppointrequest', 'city_id', 
                'gama_locality/city', 'city_id'), 'city_id', 
        $installer->getTable('gama_locality/city'), 'city_id', 
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Pickuppoint Request Table');

$installer->getConnection()->createTable($pickuppointRequest);
