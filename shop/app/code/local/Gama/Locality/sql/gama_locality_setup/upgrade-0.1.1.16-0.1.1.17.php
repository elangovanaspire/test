<?php

$installer = $this;

$installer->startSetup();

$installer->getConnection()->addColumn($installer->getTable('gama_locality/pickuppoint'),'category4_et', 
	      Varien_Db_Ddl_Table::TYPE_TEXT, $this->_connectionConfig->dbname);

$installer->endSetup();

?>



