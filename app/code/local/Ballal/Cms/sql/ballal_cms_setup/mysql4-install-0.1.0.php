<?php
$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('cms_page'),'content_custom', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable'  => true,
        'length'    => 255,
        'after'     => null, // column name to insert new column after
        'comment'   => 'Extra content for CMS pages'
    ));

$installer->endSetup();