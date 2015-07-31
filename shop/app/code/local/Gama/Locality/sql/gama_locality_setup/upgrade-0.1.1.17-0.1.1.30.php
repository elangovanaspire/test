<?php

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('gama_locality/pickuppoint'),'active', 
	      Varien_Db_Ddl_Table::TYPE_CHAR, $this->_connectionConfig->dbname);
	      
	     
$installer->endSetup();

?>
