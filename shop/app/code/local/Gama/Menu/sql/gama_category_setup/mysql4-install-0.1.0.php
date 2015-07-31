<?php
$installer = $this;
$connection = $installer->getConnection();
$installer->startSetup();
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
 
$setup->addAttribute('catalog_category', 'openinghour', array(
    'group'         => 'Custom Design',
    'input'         => 'select',
    'type'          => 'varchar',
    'label'         => 'Opening Hours',
    'option'        => array (
                              'value' => array(
                                  '00'=>'00',
                                  '01'=>'01',
                                  '02'=>'02',
                                  '03'=>'03',
                                  '04'=>'04',
                                  '05'=>'05',
                                  '06'=>'06',
                                  '07'=>'07',
                                  '08'=>'08',
                                  '09'=>'09',
                                  '10'=>'10',
                                  '11'=>'11',
                                  '12'=>'12',
                                  '13'=>'13',
                                  '14'=>'14',
                                  '15'=>'15',
                                  '16'=>'16',
                                  '17'=>'17',
                                  '18'=>'18',
                                  '19'=>'19',
                                  '20'=>'20',
                                  '21'=>'21',
                                  '22'=>'22',
                                  '23'=>'23',
                                  )
                       ),
 
    'backend'        => 'eav/entity_attribute_backend_array',
    'visible'       => 1,
    'required'      => 1,
    'default'       =>'00',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
));
$installer->endSetup();
