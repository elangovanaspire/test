<?php

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('gama_locality/pickuppoint'),'category2_st', 
	      Varien_Db_Ddl_Table::TYPE_TEXT, $this->_connectionConfig->dbname);

$installer->endSetup();

?>



