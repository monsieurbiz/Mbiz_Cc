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
 * Cc Model
 * @package Mbiz_Cc
 */
class Mbiz_Cc_Model_Cc extends Mage_Core_Model_Abstract
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Prefix of model events names
     * @var string
     */
    protected $_eventPrefix = 'cc';

    /**
     * Parameter name in event
     * In observe method you can use $observer->getEvent()->getObject() in this case
     * @var string
     */
    protected $_eventObject = 'cc';

    /**
     * Cc Constructor
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('mbiz_cc/cc');
    }

    /**
     * Explode the validity date
     */
    protected function _explodeDateVal()
    {
        if (!$this->hasData('year_val')) {
            list($month, $year) = str_split($this->getDateval(), 2);
            $this
                ->setYearVal(2000 + $year)
                ->setMonthVal($month)
            ;
        }
    }

    /**
     * Retrieve the delete url
     * @return string
     */
    public function getDeleteUrl()
    {
        return Mage::getUrl('customer/cc/delete', array('id' => $this->getId()));
    }

    /**
     * Retrieve the Year validity
     * @return int
     */
    public function getYearVal()
    {
        // Explode date val
        $this->_explodeDateVal();

        return parent::getYearVal();
    }

    /**
     * Retrieve the Month validity
     * @return int
     */
    public function getMonthVal()
    {
        // Explode date val
        $this->_explodeDateVal();

        return parent::getMonthVal();
    }

    /**
     * Retrieve the validity month in date object
     * @return Varien_Date
     */
    public function getValidityMonth()
    {
        return Mage::app()->getLocale()->date()
            ->setYear($this->getYearVal())
            ->setMonth($this->getMonthVal())
            ->setDay(1)
        ;
    }

    /**
     * Retrieve the credit card number
     * @return string
     */
    public function getNumber()
    {
        if (!$this->getId()) {
            return null;
        }
        return '**** **** **** ' . $this->getLastDigits();
    }

    /**
     * Retrieve the customer's cards
     * @param Mage_Customer_Model_Customer|null $customer The customer. Get the current customer if NULL.
     * @return Mbiz_Cc_Model_Resource_Cc_Collection
     */
    public function getCustomerCards(Mage_Customer_Model_Customer $customer = null)
    {
        // The customer
        if (null === $customer) {
            $customer = Mage::helper('customer')->getCustomer();
        }

        // The cards
        $cards = $this->getCollection();
        $cards->addCustomerFilter($customer);

        return $cards;
    }

    /**
     * Validate the object data before save (or not..)
     * @return array The errors
     */
    public function validate()
    {
        Mage::dispatchEvent($this->_eventPrefix . '_validate_before', array(
            $this->_eventObject => $this
        ));

        // The errors
        $errors = array();

        // Validators
        $notEmpty = new Zend_Validate_NotEmpty;
        $digit    = new Zend_Validate_Digits;
        $length   = new Zend_Validate_StringLength;
        $card     = new Zend_Validate_CreditCard;

        // Customer?
        if (!$id = $this->getData('customer_id')) {
            if (
                (!$customer = $this->getData('customer'))
                || !is_object($customer)
                || !$customer instanceof Mage_Customer_Model_Customer
                || !$id = $customer->getId()
            ) {
                $errors[] = Mage::helper('mbiz_cc')->__('Please specify the customer.');
            } else {
                $this->setData('customer_id', $customer->getId());
            }
        }

        // Token
        if (!$notEmpty->isValid($this->getData('token'))) {
            $errors[] = Mage::helper('mbiz_cc')->__('Please specify a token.');
        }

        // Date
        if (
            !$notEmpty->isValid($this->getData('dateval'))
            || !$digit->isvalid($this->getData('dateval'))
            || !$length->setMin(4)->setMax(4)->isValid($this->getData('dateval'))
        ) {
            $errors[] = Mage::helper('mbiz_cc')->__('Please specify a valid expiration date.');
        }

        // Cvv
        if (
            !$notEmpty->isValid($this->getData('cvv'))
            || !$digit->isValid($this->getData('cvv'))
            || !$length->setMin(3)->setMax(4)->isValid($this->getData('cvv'))
        ) {
            $errors[] = Mage::helper('mbiz_cc')->__('Please specify a valid card verification number.');
        }

        // Type
        if (!in_array($this->getData('type'), array('VI', 'AE', 'MC'))) {
            $errors[] = Mage::helper('mbiz_cc')->__('Please specify a valid card type.');
        }

        // Owner
        if (!$notEmpty->isValid($this->getData('owner'))) {
            $errors[] = Mage::helper('mbiz_cc')->__('Please specify an owner name.');
        }

        // Last digits
        if (
            !$notEmpty->isValid($this->getData('last_digits'))
            || !$digit->isValid($this->getData('last_digits'))
            || !$length->setMin(4)->setMax(4)->isValid($this->getData('last_digits'))
        ) {
            if ($this->getData('number')) {
                switch ($this->getType()) {
                    case 'VI':
                        $type = Zend_Validate_CreditCard::VISA;
                        break;
                    case 'AE':
                        $type = Zend_Validate_CreditCard::AMERICAN_EXPRESS;
                        break;
                    case 'MC':
                        $type = Zend_Validate_CreditCard::MASTERCARD;
                        break;
                    default:
                        throw new Exception('Bad card type');
                }
                if (!$card->setType($type)->isValid($this->getData('number'))) {
                    $errors[] = Mage::helper('mbiz_cc')->__('Please specify a card number or the four last digits.');
                } else {
                    $this->setLastDigits(substr((string) $this->getData('number'), -4));
                }
            } else {
                $errors[] = Mage::helper('mbiz_cc')->__('Please specify a card number or the four last digits.');
            }
        }

        return $errors;
    }

// Monsieur Biz Tag NEW_METHOD

}