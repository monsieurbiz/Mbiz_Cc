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
 * Data Helper
 * @package Mbiz_Cc
 */
class Mbiz_Cc_Helper_Data extends Mage_Core_Helper_Abstract
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Retrieve the url to add card
     * @return string
     */
    public function getNewUrl()
    {
        return $this->_getUrl('customer/cc/new');
    }

    /**
     * Retrieve the url to add card (post action)
     * @return string
     */
    public function getNewPostUrl()
    {
        return $this->_getUrl('customer/cc/newPost');
    }

    /**
     * Retrieve the url to the list
     * @return string
     */
    public function getListUrl()
    {
        return $this->_getUrl('customer/cc/index');
    }

    /**
     * Retrieve the configuration
     * @return Mbiz_Cc_Model_Config
     */
    public function getConfig()
    {
        return Mage::getSingleton('mbiz_cc/config');
    }

// Monsieur Biz Tag NEW_METHOD

}