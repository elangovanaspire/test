<?php

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;

$installer->startSetup();

$adapter = $installer->getConnection();

$cityTable = $adapter->newTable($installer->getTable('gama_locality/city'))
    ->addColumn('city_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, 
        array(
                'unsigned' => true,
                'nullable' => false,
                'identity' => true,
                'primary' => true,
                'auto_increment' => true
        ), 'City Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, 
        array(
                'nullable' => false
        ), 'City Name')
    ->addColumn('country_id', Varien_Db_Ddl_Table::TYPE_TEXT, 2, 
        array(
                'nullable' => false,
                'default' => ''
        ), 'Country Id in ISO-2')
    ->addColumn('active_from', Varien_Db_Ddl_Table::TYPE_DATE, null, 
        array(
                'nullable' => true,
                'default' => null
        ), 'City Active From date')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATE, null, 
        array(
                'nullable' => true,
                'default' => null
        ), 'City Created date')
    ->addForeignKey(
        $installer->getFkName('gama_locality/city', 'country_id', 
                'directory/country', 'country_id'), 'country_id', 
        $installer->getTable('directory/country'), 'country_id', 
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('City Table');

$installer->getConnection()->createTable($cityTable);

$pickupPointTable = $adapter->newTable(
        $installer->getTable('gama_locality/pickuppoint'))
    ->addColumn('pickuppoint_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, 
        array(
                'unsigned' => true,
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'auto_increment' => true
        ), 'Pickuppoint Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, 
        array(
                'nullable' => false
        ), 'Pickuppoint Name')
    ->addColumn('city_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, 
        array(
                'nullable' => false,
                'unsigned' => true
        ), 'City ID')
    ->addColumn('active_from', Varien_Db_Ddl_Table::TYPE_DATE, null, 
        array(
                'nullable' => true,
                'default' => null
        ), 'Pickup Point Active From date')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATE, null, 
        array(
                'nullable' => true,
                'default' => null
        ), 'Pickup Point Created date')
    ->addForeignKey(
        $installer->getFkName('gama_locality/pickuppoint', 'city_id', 
                'gama_locality/city', 'city_id'), 'city_id', 
        $installer->getTable('gama_locality/city'), 'city_id', 
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Pickuppoint Table');
$adapter->createTable($pickupPointTable);
