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
 * List Block
 * @package Mbiz_Cc
 */
class Mbiz_Cc_Block_List extends Mage_Core_Block_Template
{

    /**
     * Template filename for this block
     * @const TEMPLATE string
     */
    const TEMPLATE = 'mbiz_cc/list.phtml';

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Secondary constructor
     */
    protected function _construct()
    {
        // Default template
        $this->setTemplate(self::TEMPLATE);

        return parent::_construct();
    }

    /**
     * Retrieve the customer cards
     * @return Mbiz_Cc_Model_Resource_Cc_Collection
     */
    public function getCustomerCards()
    {
        return Mage::getModel('mbiz_cc/cc')->getCustomerCards(null);
    }

// Monsieur Biz Tag NEW_METHOD

}