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
 * Resource Model of Cc
 * @package Mbiz_Cc
 */
class Mbiz_Cc_Model_Resource_Cc extends Mage_Core_Model_Resource_Db_Abstract
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Cc Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mbiz_cc/cc', 'cc_id');
    }

// Monsieur Biz Tag NEW_METHOD

}