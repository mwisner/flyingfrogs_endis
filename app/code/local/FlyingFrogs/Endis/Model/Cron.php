<?php

class FlyingFrogs_Endis_Model_Cron {
  public function getStoreIds() {
    $stores = array();
    $allStores = Mage::app()->getStores();
    foreach ($allStores as $_eachStoreId => $val) {
      $stores[] = Mage::app()->getStore($_eachStoreId)->getId();
    }
    return $stores;
  }

  public function dailyProductEnDis($observer) {

    //disable products
    $this->dailyProductToggleStatus(array(
      'filter_status' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED,
      'set_status' =>Mage_Catalog_Model_Product_Status::STATUS_DISABLED,
      'schedule_attribute' => "endis_schedule_disable"
     ));

    //enable products
    $this->dailyProductToggleStatus(array(
      'filter_status' =>Mage_Catalog_Model_Product_Status::STATUS_DISABLED,
      'set_status' => Mage_Catalog_Model_Product_Status::STATUS_ENABLED,
      'schedule_attribute' => "endis_schedule_enable"
     ));

  }

  public function dailyProductToggleStatus($options) {
    foreach ($this->getStoreIds() as $storeId) {
      $products = Mage::getResourceModel('catalog/product_collection');
      $products	->setStoreId($storeId)
	->addStoreFilter()
	->addAttributeToFilter("status", $options['filter_status'])
	->addAttributeToFilter($options['schedule_attribute'], array('to' => date('Y-m-d')))
	->addAttributeToFilter($options['schedule_attribute'], array('notnull' => true))
	->addAttributeToSelect('sku')
	->addAttributeToSelect('status')
	->addAttributeToSelect($options['schedule_attribute']);
      foreach($products as $product) {
	$product->setStoreId($storeId);
	$product->setStatus($options['set_status']);
	$product->save();
      }
    }
  }


}  
?>