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
 * Session Model
 * @package Mbiz_Cc
 */
class Mbiz_Cc_Model_Session extends Mage_Core_Model_Session_Abstract
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Secondary constructor
     * @return Mbiz_Cc_Model_Session
     */
    protected function _construct()
    {
        // Init
        $this->init('mbiz_cc');

        return parent::_construct();
    }

// Monsieur Biz Tag NEW_METHOD

}