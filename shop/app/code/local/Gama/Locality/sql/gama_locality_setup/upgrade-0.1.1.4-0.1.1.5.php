<?php

$installer = $this;

$installer->startSetup();

$installer->getConnection()->dropColumn($installer->getTable('gama_locality/pickuppoint'), 
	'pickuppoint_category');

$installer->endSetup();

?>