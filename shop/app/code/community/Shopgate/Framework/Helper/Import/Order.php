<?php
/**
 * User: pliebig
 * Date: 17.09.14
 * Time: 17:39
 * E-Mail: p.liebig@me.com, peter.liebig@magcorp.de
 */
 
 /**
 * 
 *
 * @package     Shopgate_Framework_Helper_Import_Order
 * @author      Peter Liebig <p.liebig@me.com, peter.liebig@magcorp.de>
 */ 

class Shopgate_Framework_Helper_Import_Order extends Mage_Core_Helper_Abstract
{
    /**
     * @param string $paymentType
     *
     * @return Mage_Payment_Model_Method_Abstract
     */
    public function getMagentoPaymentMethod($paymentType)
    {
        $payment = null;

        switch ($paymentType) {
            case ShopgateOrder::SHOPGATE:
                $payment = Mage::getModel("shopgate/payment_shopgate");
                break;
            case ShopgateOrder::PAYPAL:
                $payment = Mage::getModel("paypal/standard");
                if (!$payment->isAvailable()) {
                    $payment = Mage::getModel("paypal/express");
                    if (!$payment->isAvailable()){
                        $payment = Mage::getModel("shopgate/payment_mobilePayment");    
                    }
                }
                break;
            case ShopgateOrder::COD:
                $payment = $this->_getCodPayment();
                break;
            case ShopgateOrder::PREPAY:
                $classExists = mageFindClassFile("Mage_Payment_Model_Method_Banktransfer");
                if ($classExists !== false && Mage::getStoreConfigFlag("payment/banktransfer/active")) {
                    $payment = Mage::getModel('payment/method_banktransfer');
                    break;
                }
                
                if (Mage::getConfig()->getModuleConfig('Phoenix_BankPayment')->is('active', 'true')) {
                    $payment = Mage::getModel("bankpayment/bankPayment");
                    break;
                }
                break;
            case ShopgateOrder::INVOICE:
                $payment = Mage::getModel("payment/method_purchaseorder");
                break;
            case ShopgateOrder::AMAZON_PAYMENT:
                if (Mage::getConfig()->getModuleConfig("Creativestyle_AmazonPayments")->is('active', 'true')) {
                    $payment = Mage::getModel('amazonpayments/payment_advanced');
                    break;
                }
                break;
            case ShopgateOrder::PP_WSPP_CC:
                if (Mage::getConfig()->getModuleConfig("Mage_Paypal")->is('active', 'true')) {
                    $payment = Mage::getModel('paypal/direct');
                    break;
                }
                break;
            case ShopgateOrder::SUE:
                if (Mage::getConfig()->getModuleConfig("Paymentnetwork_Pnsofortueberweisung")->is('active', 'true')) {
                    // no model shortener specified in config of sofort, so dirty model call needed
                    $payment = Mage::getModel('Paymentnetwork_Pnsofortueberweisung_Model_Method_Sofort');
                    break;
                }
                break;
            default:
                $payment = Mage::getModel("shopgate/payment_mobilePayment");
                break;
        }

        if (!$payment) {
            $payment = Mage::getModel("shopgate/payment_mobilePayment");
        }
        return $payment;
    }

    /**
     * @return MSP_CashOnDelivery_Model_Cashondelivery|null|Phoenix_CashOnDelivery_Model_CashOnDelivery
     */
    protected function _getCodPayment()
    {
        $payment = null;
        if (Mage::getConfig()->getModuleConfig("Phoenix_CashOnDelivery")->is('active', 'true')) {
            $version = Mage::getConfig()->getModuleConfig("Phoenix_CashOnDelivery")->version;
            if (version_compare($version, '1.0.8', '<')) {
                $payment = Mage::getModel("cashondelivery/cashOnDelivery");
            } else {
                $payment = Mage::getModel("phoenix_cashondelivery/cashOnDelivery");
            }
        }

        if (Mage::getConfig()->getModuleConfig("MSP_CashOnDelivery")->is('active', 'true')) {
            $payment = Mage::getModel('msp_cashondelivery/cashondelivery');
        }
        return $payment;
    }
}