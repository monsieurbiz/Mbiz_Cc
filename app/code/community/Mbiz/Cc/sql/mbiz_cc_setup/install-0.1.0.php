<?php
/**
 * This file is part of Mbiz_Cc for Magento.
 *
 * @license All rights reserved
 * @author Jacques Bodin-Hullin <@jacquesbh> <j.bodinhullin@monsieurbiz.com>
 * @category Mbiz
 * @package Mbiz_Cc
 * @copyright Copyright (c) 2014 Monsieur Biz (http://monsieurbiz.com/)
 */

try {

    /* @var $installer Mage_Core_Model_Resource_Setup */
    $installer = $this;
    $installer->startSetup();

    // Create cards table
    $tableName = $installer->getTable('mbiz_cc/cc');
    if (!$installer->tableExists($tableName)) {
        $table = $installer->getConnection()->newTable($tableName);
        $table
            ->addColumn('cc_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary'  => true,
            ), 'Credit Card ID')
            ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'nullable' => false,
                'unsigned' => true,
            ), 'Customer ID')
            ->addColumn('token', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
                'nullable' => false,
            ), 'Token')
            ->addColumn('dateval', Varien_Db_Ddl_Table::TYPE_VARCHAR, 4, array(
                'nullable' => false,
            ), 'Validity date')
            ->addColumn('cvv', Varien_Db_Ddl_Table::TYPE_VARCHAR, 4, array(
                'nullable' => false,
            ), 'Card Verification Value')
            ->addColumn('type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 4, array(
                'nullable' => false,
            ), 'Card Type')
            ->addColumn('owner', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
                'nullable' => true,
                'default' => null,
            ), 'Card Owner name')
            ->addColumn('last_digits', Varien_Db_Ddl_Table::TYPE_VARCHAR, 4, array(
                'nullable' => false,
            ), 'Last four digits')
            ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
                'nullable' => false,
            ), 'Creation date')
            ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
                'nullable' => false,
            ), 'Update date')
        ;
        $installer->getConnection()->createTable($table);
    }

    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
}
