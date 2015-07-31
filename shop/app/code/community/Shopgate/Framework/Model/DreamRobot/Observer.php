<?php
/**
 * Shopgate GmbH
 *
 * URHEBERRECHTSHINWEIS
 *
 * Dieses Plugin ist urheberrechtlich geschützt. Es darf ausschließlich von Kunden der Shopgate GmbH
 * zum Zwecke der eigenen Kommunikation zwischen dem IT-System des Kunden mit dem IT-System der
 * Shopgate GmbH über www.shopgate.com verwendet werden. Eine darüber hinausgehende Vervielfältigung, Verbreitung,
 * öffentliche Zugänglichmachung, Bearbeitung oder Weitergabe an Dritte ist nur mit unserer vorherigen
 * schriftlichen Zustimmung zulässig. Die Regelungen der §§ 69 d Abs. 2, 3 und 69 e UrhG bleiben hiervon unberührt.
 *
 * COPYRIGHT NOTICE
 *
 * This plugin is the subject of copyright protection. It is only for the use of Shopgate GmbH customers,
 * for the purpose of facilitating communication between the IT system of the customer and the IT system
 * of Shopgate GmbH via www.shopgate.com. Any reproduction, dissemination, public propagation, processing or
 * transfer to third parties is only permitted where we previously consented thereto in writing. The provisions
 * of paragraph 69 d, sub-paragraphs 2, 3 and paragraph 69, sub-paragraph e of the German Copyright Act shall remain unaffected.
 *
 *  @author Shopgate GmbH <interfaces@shopgate.com>
 */

/**
 * dream robot observer
 *
 * @author      Shopgate GmbH, 35510 Butzbach, DE
 * @package     Shopgate_Framework
 */
class Shopgate_Framework_Model_DreamRobot_Observer
{

    /**
     * @param Varien_Event_Observer $observer
     * @return bool
     */
    public function sendOrder(Varien_Event_Observer $observer)
    {
        /* @var ShopgateOrder $shopgateOrder */
        /* @var Mage_Sales_Model_Order $magentoOrder */
        $shopgateOrder = $observer->getShopgateOrder();
        $magentoOrder  = $observer->getOrder();

        if (class_exists("DreamRobot_Checkout_Model_Observer", false) && !$shopgateOrder->getIsShippingBlocked()) {
            $msg = "Start to send order to DreamRobot\n";
            $msg .= "\tOrderID: {$magentoOrder->getId()}\n";
            $msg .= "\tOrderNumber: {$magentoOrder->getIncrementId()}\n";
            $msg .= "\tShopgateOrderNumber: {$shopgateOrder->getOrderNumber()}\n";

            ShopgateLogger::getInstance()->log($msg, ShopgateLogger::LOGTYPE_REQUEST);

            Mage::getSingleton('checkout/type_onepage')->getCheckout()->setLastOrderId($magentoOrder->getId());
            $c = new DreamRobot_Checkout_Model_Observer();
            $c->getSaleOrder();
        }

        return true;
    }
}
