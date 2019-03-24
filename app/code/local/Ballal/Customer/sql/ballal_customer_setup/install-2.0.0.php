<?php
//$this->addAttribute('customer', 'company_name', array(
//    'type'      => 'varchar',
//    'label'     => 'Company Name',
//    'input'     => 'text',
//    'position'  => 120,
//    'required'  => false,//or true
//    'is_system' => 0,
//));
//$attribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'company_name');
//$attribute->setData('used_in_forms', array(
//    'adminhtml_customer',
//    'checkout_register',
//    'customer_account_create',
//    'customer_account_edit',
//));
//$attribute->setData('is_user_defined', 0);
//$attribute->save();


$installer = $this;
$installer->startSetup();


$installer->addAttribute("customer", "customer_hear",  array(
    "type"     => "int",
    "backend"  => "",
    "label"    => "Where did you here about us?",
    "input"    => "select",
    "source"   => "ballal_customer/eav_entity_attribute_source_customeroptions",
    "visible"  => true,
    "required" => false,
    "default" => "Select one",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

));

$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "customer_hear");


$used_in_forms=array();

$used_in_forms[]="adminhtml_customer";
$used_in_forms[]="checkout_register";
$used_in_forms[]="customer_account_create";
$used_in_forms[]="customer_account_edit";
$attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 1000)
;
$attribute->save();



$installer->endSetup();