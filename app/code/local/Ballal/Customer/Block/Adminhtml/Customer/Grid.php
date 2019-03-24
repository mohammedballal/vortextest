<?php

class Ballal_Customer_Block_Adminhtml_Customer_Grid extends Mage_Adminhtml_Block_Customer_Grid
{
    public function setCollection($collection)
    {
        $collection
            ->addAttributeToSelect('customer_hear');
        $this->_collection = $collection;
    }

    protected function _prepareColumns()
    {
        $this->addColumnAfter('customer_hear', array(
            'header' => Mage::helper('customer')->__('Hear about us'),
            'type' => 'options',
            'index' => 'customer_hear',
            'options' => Mage::getModel('ballal_customer/eav_entity_attribute_source_customeroptions')->getOptionArray()
        ), 'billing_region');

        return parent::_prepareColumns();
    }
}