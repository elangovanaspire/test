<?php

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('gama_locality/pickuppoint'),'pickuppoint_category', 
	      Varien_Db_Ddl_Table::TYPE_TEXT, $this->_connectionConfig->dbname);

$installer->endSetup();

?>



