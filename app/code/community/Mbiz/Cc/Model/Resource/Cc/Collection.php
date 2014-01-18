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

/**
 * Collection of Cc
 * @package Mbiz_Cc
 */
class Mbiz_Cc_Model_Resource_Cc_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Cc Collection Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('mbiz_cc/cc');
    }

    /**
     * Add customer filter
     * @param int|Mage_Customer_Model_Customer $customer The customer to filter (object or ID)
     * @return Mbiz_Cc_Model_Resource_Cc_Collection
     */
    public function addCustomerFilter($customer)
    {
        // No customer?
        if (!$customer) {
            Mage::throwException('Please specify the customer to filter.');
        }

        // Is object?
        if ($customer instanceof Mage_Customer_Model_Customer) {
            $customer = $customer->getId();
        }

        // Filter
        $this->addFieldToFilter('customer_id', $customer);

        return $this;
    }

// Monsieur Biz Tag NEW_METHOD

}