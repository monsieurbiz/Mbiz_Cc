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
 * Cc Controller
 * @package Mbiz_Cc
 */
class Mbiz_Cc_CcController extends Mage_Core_Controller_Front_Action
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Retrieve customer session model object
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getCustomerSession()
    {
        return Mage::getSingleton('customer/session');
    }

    /**
     * Retrieve the module session
     * @return Mbiz_Cc_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('mbiz_cc/session');
    }

    /**
     * Predispatch
     * @return Mbiz_Cc_CcController
     */
    public function preDispatch()
    {
        parent::preDispatch();

        // Not dispatched
        if (!$this->getRequest()->isDispatched()) {
            return;
        }

        // Not logged in?
        if (!$this->_getCustomerSession()->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }

        // Title
        $this->_title($this->__('My credit cards'));

        return $this;
    }

    /**
     * Action postdispatch
     *
     * Remove No-referer flag from customer session after each action
     */
    public function postDispatch()
    {
        parent::postDispatch();
        $this->_getSession()->unsNoReferer(false);
    }

    /**
     * All my credit cards
     */
    public function indexAction()
    {
        $this->loadLayout();

        // Init messages
        $this->_initLayoutMessages('mbiz_cc/session');

        $this->renderLayout();
    }

    /**
     * Delete a card
     */
    public function deleteAction()
    {
        // The card to delete
        $card = Mage::getModel('mbiz_cc/cc')->load($this->getRequest()->getParam('id'));

        // Is card ok?
        if (!$card->getId() || $this->_getCustomerSession()->getCustomer()->getId() !== $card->getCustomerId()) {
            $this->_getSession()->addError($this->__('Card not found.'));
            $this->_redirect('customer/cc/index');
            return;
        }

        // Delete the card
        try {
            $card->delete();
            $this->_getSession()->addSuccess($this->__('Card removed successfully.'));
        } catch (Mbiz_Cc_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($this->__('An error occurred.'));
        }

        $this->_redirect('customer/cc/index');
    }

    /**
     * New credit card form
     */
    public function newAction()
    {
        // Layout
        $this->loadLayout();

        // Title
        $this->_title($this->__('Add a credit card'));

        // Init messages
        $this->_initLayoutMessages('mbiz_cc/session');

        // Active menu
        $navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('customer/cc');
        }

        // Render
        $this->renderLayout();
    }

    /**
     * Valid a new card
     */
    public function newPostAction()
    {
        // The card
        $card = Mage::getModel('mbiz_cc/cc');

        try {
            $post = $this->getRequest()->getPost();

            $card->setData(array(
                'customer' => $this->_getCustomerSession()->getCustomer(),
                'dateval'  => isset($post['dateval-month'], $post['dateval-year']) ? sprintf('%02d%02d', (int) $post['dateval-month'], $post['dateval-year'] - 2000) : null,
                'cvv'      => isset($post['cvv']) ? $post['cvv'] : null,
                'type'     => isset($post['type']) ? $post['type'] : null,
                'owner'    => isset($post['owner']) ? $post['owner'] : null,
                'number'   => isset($post['number']) ? $post['number'] : null,
            ));

            /* INFO:
             * To specify the token you can use the event "cc_validate_before"
             */

            $errors = $card->validate();

            if ($errors) {
                foreach ($errors as $error) {
                    $this->_getSession()->addError($error);
                }
            } else {
                $card->save();
                $this->_getSession()->addSuccess($this->__('Credit card saved successfully.'));
            }

        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
            Mage::logException($e);
        }

        $this->_redirect('customer/cc/index');
    }

// Monsieur Biz Tag NEW_METHOD

}