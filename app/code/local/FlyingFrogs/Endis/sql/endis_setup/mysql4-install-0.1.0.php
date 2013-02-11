<?php

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

// Add new attributes
$setup->addAttribute('catalog_product', 'endis_schedule_enable', array(
		'label' => 'Enable On',
		'group' => 'Scheduling',
		'type' => 'datetime',
		'input' => 'date',
		//		'source' => '',
		'backend' => 'eav/entity_attribute_backend_datetime',
		//		'frontend' => '',
		//		'input_renderer' => '',
		'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
		'required' => 0,
		'default' => '',
		'user_defined' => 0,
		'filterable_in_search' => 0,
		'is_configurable' => 0,
		'used_in_product_listing' => 0,
));

$setup->addAttribute('catalog_product', 'endis_schedule_disable', array(
		'label' => 'Disable On',
		'group' => 'Scheduling',
		'type' => 'datetime',
		'input' => 'date',
		//		'source' => '',
		'backend' => 'eav/entity_attribute_backend_datetime',
		//		'frontend' => '',
		//		'input_renderer' => '',
		'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
		'required' => 0,
		'default' => '',
		'user_defined' => 0,
		'filterable_in_search' => 0,
		'is_configurable' => 0,
		'used_in_product_listing' => 0,
));

$installer->endSetup(); 