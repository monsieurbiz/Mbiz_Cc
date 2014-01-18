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
 * Form Block
 * @package Mbiz_Cc
 */
class Mbiz_Cc_Block_Form extends Mage_Core_Block_Template
{

    /**
     * Template filename for this block
     * @const TEMPLATE string
     */
    const TEMPLATE = 'mbiz_cc/form.phtml';

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
     * Retrieve the form action
     * @return string
     */
    public function getPostAction()
    {
        return $this->helper('mbiz_cc')->getNewPostUrl();
    }

    /**
     * Retrieve the list url
     * @return string
     */
    public function getListUrl()
    {
        return $this->helper('mbiz_cc')->getListUrl();
    }

    /**
     * Retrieve the card types
     * @return array
     */
    public function getCardTypes()
    {
        return array(
            new Varien_Object(array(
                'value' => 'VI',
                'label' => 'Visa',
            )),
            new Varien_Object(array(
                'value' => 'AE',
                'label' => 'American Express',
            )),
            new Varien_Object(array(
                'value' => 'MC',
                'label' => 'MasterCard',
            ))
        );
    }

    /**
     * Retrieve the months
     * @return array
     */
    public function getCcMonths()
    {
        return $this->helper('mbiz_cc')->getConfig()->getMonths();
    }

    /**
     * Retrieve the years
     * @return array
     */
    public function getCcYears()
    {
        return $this->helper('mbiz_cc')->getConfig()->getYears();
    }

// Monsieur Biz Tag NEW_METHOD

}