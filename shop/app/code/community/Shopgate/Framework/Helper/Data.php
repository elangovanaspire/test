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
 * @author Shopgate GmbH <interfaces@shopgate.com>
 */

/**
 * User: Peter Liebig
 * Date: 27.01.14
 * Time: 12:06
 * E-Mail: p.liebig@me.com
 */

/**
 * data helper shopgate
 *
 * @author      Shopgate GmbH, 35510 Butzbach, DE
 * @package     Shopgate_Framework
 */
include_once Mage::getBaseDir("lib") . '/Shopgate/shopgate.php';

class Shopgate_Framework_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @var Shopgate_Framework_Model_Config
     */
    protected $_config;

    /**
     * get QR Code directory
     *
     * @return string
     */
    public function getRelativeQrCodeDir()
    {
        return "/media/shopgate/qrcodes/" . $this->getConfig()->getShopNumber();
    }

    /**
     * Return ISO-Code for Magento address
     *
     * @param Varien_Object $address
     *
     * @return null|string
     */
    public function getIsoStateByMagentoRegion(Varien_Object $address)
    {
        $map      = $this->_getIsoToMagentoMapping();
        $sIsoCode = null;

        if ($address->getCountryId() && $address->getRegionCode()) {
            $sIsoCode = $address->getCountryId() . "-" . $address->getRegionCode();
        }

        if (isset($map[$address->getCountryId()])) {
            foreach ($map[$address->getCountryId()] as $isoCode => $mageCode) {
                if ($mageCode === $address->getRegionCode()) {
                    $sIsoCode = $address->getCountryId() . "-" . $isoCode;
                    break;
                }
            }
        }

        return $sIsoCode;
    }

    /**
     * Magento default supported countries:
     * DE, AT, CH, CA, EE, ES, FI, FR, LT, LV, RO, US
     * Countries with correct iso-codes for region:
     * US, CA, CH, EE, FR, RO
     * Countries with incorrect iso-codes for region:
     * DE, AT, ES, FI, LT, LV
     * http://de.wikipedia.org/wiki/ISO_3166-2:DE
     * http://de.wikipedia.org/wiki/ISO_3166-2:AT
     * http://de.wikipedia.org/wiki/ISO_3166-2:ES
     * http://de.wikipedia.org/wiki/ISO_3166-2:FI
     * http://de.wikipedia.org/wiki/ISO_3166-2:LT
     * http://de.wikipedia.org/wiki/ISO_3166-2:LV
     *
     * @return array
     */
    protected function _getIsoToMagentoMapping()
    {
        $map = array(
            'DE' => array(
                /* @see http://de.wikipedia.org/wiki/ISO_3166-2:DE */
                'BW' => 'BAW',
                'BY' => 'BAY',
                'BE' => 'BER',
                'BB' => 'BRG',
                'HB' => 'BRE',
                'HH' => 'HAM',
                'HE' => 'HES',
                'MV' => 'MEC',
                'NI' => 'NDS',
                'NW' => 'NRW',
                'RP' => 'RHE',
                'SL' => 'SAR',
                'SN' => 'SAS',
                'ST' => 'SAC',
                'SH' => 'SCN',
                'TH' => 'THE'
            ),
            'AT' => array(
                /* @see http://de.wikipedia.org/wiki/ISO_3166-2:AT */
                '1' => 'BL',
                '2' => 'KN',
                '3' => 'NO',
                '4' => 'OO',
                '5' => 'SB',
                '6' => 'ST',
                '7' => 'TI',
                '8' => 'VB',
                '9' => 'WI',
            ),
            'ES' => array(
                /* @see http://de.wikipedia.org/wiki/ISO_3166-2:ES */
                'C'  => 'A Coruсa',
                'VI' => 'Alava',
                'AB' => 'Albacete',
                'A'  => 'Alicante',
                'AL' => 'Almeria',
                'O'  => 'Asturias',
                'AV' => 'Avila',
                'BA' => 'Badajoz',
                'PM' => 'Baleares',
                'B'  => 'Barcelona',
                'BU' => 'Burgos',
                'CC' => 'Caceres',
                'CA' => 'Cadiz',
                'CS' => 'Castellon',
                'GI' => 'Girona',
                'CO' => 'Cordoba',
                'CU' => 'Cuenca',
                'GR' => 'Granada',
                'GU' => 'Guadalajara',
                'SS' => 'Guipuzcoa',
                'H'  => 'Huelva',
                'HU' => 'Huesca',
                'J'  => 'Jaen',
                'CR' => 'Ciudad Real',
                'S'  => 'Cantabria',
                'LO' => 'La Rioja',
                'GC' => 'Las Palmas',
                'LE' => 'Leon',
                'L'  => 'Lleida',
                'LU' => 'Lugo',
                'M'  => 'Madrid',
                'MA' => 'Malaga',
                'MU' => 'Murcia',
                'NA' => 'Navarra',
                'OR' => 'Ourense',
                'P'  => 'Palencia',
                'PO' => 'Pontevedra',
                'SA' => 'Salamanca',
                'TF' => 'Santa Cruz de Tenerife',
                'Z'  => 'Zaragoza',
                'SG' => 'Segovia',
                'SE' => 'Sevilla',
                'SO' => 'Soria',
                'T'  => 'Tarragona',
                'TE' => 'Teruel',
                'TO' => 'Toledo',
                'V'  => 'Valencia',
                'VA' => 'Valladolid',
                'BI' => 'Vizcaya',
                'ZA' => 'Zamora',
                'CE' => 'Ceuta',
                'ML' => 'Melilla',
            ),
            'LT' => array(
                /* @see http://de.wikipedia.org/wiki/ISO_3166-2:LT */
                'AL' => 'LT-AL',
                'KU' => 'LT-KU',
                'KL' => 'LT-KL',
                'MR' => 'LT-MR',
                'PN' => 'LT-PN',
                'SA' => 'LT-SA',
                'TA' => 'LT-TA',
                'TE' => 'LT-TE',
                'UT' => 'LT-UT',
                'VL' => 'LT-VL',
            ),
            'FI' => array(
                /* @see http://de.wikipedia.org/wiki/ISO_3166-2:FI */
                "01" => "Ahvenanmaa",
                "02" => "Etelä-Karjala",
                "03" => "Etelä-Pohjanmaa",
                "04" => "Etelä-Savo",
                "05" => "Kainuu",
                "06" => "Kanta-Häme",
                "07" => "Keski-Pohjanmaa",
                "08" => "Keski-Suomi",
                "09" => "Kymenlaakso",
                "10" => "Lappi",
                "11" => "Pirkanmaa",
                "12" => "Pohjanmaa",
                "13" => "Pohjois-Karjala",
                "14" => "Pohjois-Pohjanmaa",
                "15" => "Pohjois-Savo",
                "16" => "Päijät-Häme",
                "17" => "Satakunta",
                "18" => "Uusimaa",
                "19" => "Varsinais-Suomi",
                "00" => "Itä-Uusimaa", // !!not listet in wiki
            ),
            'LV' => array(
                /* @see http://de.wikipedia.org/wiki/ISO_3166-2:LV */
                /* NOTE: 045 and 063 does not exist in magento */
                "001" => "Aglonas novads",
                "002" => "AI",
                "003" => "Aizputes novads",
                "004" => "Aknīstes novads",
                "005" => "Alojas novads",
                "006" => "Alsungas novads",
                "007" => "AL",
                "008" => "Amatas novads",
                "009" => "Apes novads",
                "010" => "Auces novads",
                "011" => "Ādažu novads",
                "012" => "Babītes novads",
                "013" => "Baldones novads",
                "014" => "Baltinavas novads",
                "015" => "BL",
                "016" => "BU",
                "017" => "Beverīnas novads",
                "018" => "Brocēnu novads",
                "019" => "Burtnieku novads",
                "020" => "Carnikavas novads",
                "021" => "Cesvaines novads",
                "022" => "CE",
                "023" => "Ciblas novads",
                "024" => "Dagdas novads",
                "025" => "DA",
                "026" => "DO",
                "027" => "Dundagas novads",
                "028" => "Durbes novads",
                "029" => "Engures novads",
                "030" => "Ērgļu novads",
                "031" => "Garkalnes novads",
                "032" => "Grobiņas novads",
                "033" => "GU",
                "034" => "Iecavas novads",
                "035" => "Ikšķiles novads",
                "036" => "Ilūkstes novads",
                "037" => "Inčukalna novads",
                "038" => "Jaunjelgavas novads",
                "039" => "Jaunpiebalgas novads",
                "040" => "Jaunpils novads",
                "041" => "JL",
                "042" => "JK",
                "043" => "Kandavas novads",
                "044" => "Kārsavas novads",
                /*"045" => "",*/
                "046" => "Kokneses novads",
                "047" => "KR",
                "048" => "Krimuldas novads",
                "049" => "Krustpils novads",
                "050" => "KU",
                "051" => "Ķeguma novads",
                "052" => "Ķekavas novads",
                "053" => "Lielvārdes novads",
                "054" => "LM",
                "055" => "Līgatnes novads",
                "056" => "Līvānu novads",
                "057" => "Lubānas novads",
                "058" => "LU",
                "059" => "MA",
                "060" => "Mazsalacas novads",
                "061" => "Mālpils novads",
                "062" => "Mārupes novads",
                /*"063" => "",*/
                "064" => "Naukšēnu novads",
                "065" => "Neretas novads",
                "066" => "Nīcas novads",
                "067" => "OG",
                "068" => "Olaines novads",
                "069" => "Ozolnieku novads",
                "070" => "Pārgaujas novads",
                "071" => "Pāvilostas novads",
                "072" => "Pļaviņu novads",
                "073" => "PR",
                "074" => "Priekules novads",
                "075" => "Priekuļu novads",
                "076" => "Raunas novads",
                "077" => "RE",
                "078" => "Riebiņu novads",
                "079" => "Rojas novads",
                "080" => "Ropažu novads",
                "081" => "Rucavas novads",
                "082" => "Rugāju novads",
                "083" => "Rundāles novads",
                "084" => "Rūjienas novads",
                "085" => "Salas novads",
                "086" => "Salacgrīvas novads",
                "087" => "Salaspils novads",
                "088" => "SA",
                "089" => "Saulkrastu novads",
                "090" => "Sējas novads",
                "091" => "Siguldas novads",
                "092" => "Skrīveru novads",
                "093" => "Skrundas novads",
                "094" => "Smiltenes novads",
                "095" => "Stopiņu novads",
                "096" => "Strenču novads",
                "097" => "TA",
                "098" => "Tērvetes novads",
                "099" => "TU",
                "100" => "Vaiņodes novads",
                "101" => "VK",
                "102" => "Varakļānu novads",
                "103" => "Vārkavas novads",
                "104" => "Vecpiebalgas novads",
                "105" => "Vecumnieku novads",
                "106" => "VE",
                "107" => "Viesītes novads",
                "108" => "Viļakas novads",
                "109" => "Viļānu novads",
                "110" => "Zilupes novads",
                // cities
                "DGV" => "LV-DGV",
                "JKB" => "Jēkabpils",
                "JEL" => "LV-JEL",
                "JUR" => "LV-JUR",
                "LPX" => "LV-LPX",
                "REZ" => "LV-REZ",
                "RIX" => "LV-RIX",
                "VMR" => "Valmiera",
                "VEN" => "LV-VEN",
                // Unknown
                // 						"" => "LV-LE", "" => "LV-RI", "" => "LV-VM",
            ),
        );

        return $map;
    }

    /**
     * show module version
     *
     * @return string
     */
    public function getModuleVersion()
    {
        return Mage::getConfig()->getModuleConfig("Shopgate_Framework")->version;
    }

    /**
     * Returns the state depends on given status
     *
     * @param string $status
     *
     * @return string
     */
    public function getStateForStatus($status)
    {
        if (Mage::helper("shopgate/config")->getIsMagentoVersionLower15() ||
            (Mage::helper("shopgate/config")->getEdition() == 'Enterprise' && 
             version_compare(Mage::getVersion(),'1.9.1.2','<'))) {
            return $this->_getStateForStatusMagento14x($status);
        }

        $resource = Mage::getSingleton('core/resource');
        $db       = $resource->getConnection('core_read');
        $table    = $resource->getTableName('sales/order_status_state');
        $result   = $db->fetchOne("SELECT state FROM {$table} WHERE status = '{$status}' AND is_default = 1");
        if (!$result) {
            $result = $db->fetchOne("SELECT state FROM {$table} WHERE status = '{$status}'");
        }
        return $result;
    }

    /**
     * return the sate of status for magento 1.4
     * if status not in mapping-array state will set to status!
     *
     * @param $status string
     *
     * @return string
     */
    protected function _getStateForStatusMagento14x($status)
    {
        $map = array(
            "pending" => "new",
            "fraud"   => "payment_review"
        );

        return in_array($status, $map) ? $map[$status] : $status;
    }

    /**
     * returns true if the current request is from shopgate
     * if action is set it will also checked
     *
     * @param string|null $action
     *
     * @return boolean
     */
    public function isShopgateApiRequest($action = null)
    {
        $isShopgateRequest = defined("_SHOPGATE_API") && _SHOPGATE_API;
        if ($isShopgateRequest && defined("_SHOPGATE_ACTION") && $action) {
            $isShopgateRequest = $isShopgateRequest && ($action == _SHOPGATE_ACTION);
        }

        return $isShopgateRequest;
    }

    /**
     * check if order total is correct
     *
     * @param ShopgateOrder          $order
     * @param Mage_Sales_Model_Order $oMageOrder
     * @param string                 $message
     *
     * @return bool
     */
    public function isOrderTotalCorrect(ShopgateOrder $order, Mage_Sales_Model_Order $oMageOrder, &$message = "")
    {
        $totalShopgate = $order->getAmountComplete();
        $totalMagento  = $oMageOrder->getTotalDue() + $oMageOrder->getTotalPaid();

        ShopgateLogger::getInstance()->log(
                      "Total Shopgate: {$totalShopgate} {$order->getCurrency()} 
            Total Magento: {$totalMagento} {$order->getCurrency()}",
                      ShopgateLogger::LOGTYPE_DEBUG
        );

        if (abs($totalShopgate - $totalMagento) > 0.02) {
            $msg = "differing total order amounts:\n";
            $msg .= "\tShopgate:\t{$totalShopgate} {$order->getCurrency()} \n";
            $msg .= "\tMagento:\t{$totalMagento} {$oMageOrder->getOrderCurrencyCode()}\n";
            $message = $msg;
            return false;
        }

        return true;
    }

    /**
     * Sets the correct Shipping Carrier and Method
     * in relation to
     *        ShopgateOrder->{shipping_group} [carrier]
     *        ShopgateOrder->{shipping_info}    [method]
     *
     * @param Mage_Sales_Model_Quote_Address $shippingAddress
     * @param ShopgateCartBase               $order
     */
    public function setShippingMethod(Mage_Sales_Model_Quote_Address $shippingAddress, ShopgateCartBase $order)
    {
        /* dont set shipping method when the order does not contain any shipping information (e.g. checkCart) */
        if (!$order->getShippingGroup()) {
            ShopgateLogger::getInstance()
                          ->log(
                          "# setShippingMethod skipped, no Shipping information in " . get_class($order) . " available",
                          ShopgateLogger::LOGTYPE_DEBUG
                );
            return;
        }

        ShopgateLogger::getInstance()->log("# Start of setShippingMethod process", ShopgateLogger::LOGTYPE_DEBUG);
        $mapper = Mage::getModel('shopgate/shopgate_shipping_mapper')->init($shippingAddress, $order);
        $shippingAddress->setShippingMethod($mapper->getCarrier() . '_' . $mapper->getMethod());

        ShopgateLogger::getInstance()->log(
                      "  Shipping method set: '" . $shippingAddress->getShippingMethod() . "'",
                      ShopgateLogger::LOGTYPE_DEBUG
        );
        ShopgateLogger::getInstance()->log("# End of setShippingMethod process", ShopgateLogger::LOGTYPE_DEBUG);
    }

    /**
     * return the right store id by shop number
     *
     * @param $shopNumber
     *
     * @return array
     */
    public function getStoreIdByShopNumber($shopNumber)
    {
        /** @var Shopgate_Framework_Model_Resource_Core_Config $configModel */
        $configModel = Mage::getResourceSingleton('shopgate/core_config');
        $config      = $configModel->getConfigDataByWebsite('shopgate/option/shop_number', array($shopNumber));
        if (!empty($config)) {
            $configKeys      = array_keys($config);
            $scopeShopNumber = array_shift($configKeys);
            $defaultStore    = $configModel->getConfigDataByWebsite('shopgate/option/default_store');
            if (!empty($defaultStore)) {
                $defaultStoreKeys = array_keys($defaultStore);
                if (array_search($scopeShopNumber, $defaultStoreKeys) !== false
                    && isset($defaultStore[$scopeShopNumber])
                ) {
                    return $defaultStore[$scopeShopNumber];
                }
            }
        }
        return null;
    }

    /**
     * get library version
     *
     * @return string
     */
    public function getLibraryVersion()
    {
        if (!defined(SHOPGATE_LIBRARY_VERSION)) {
            Mage::helper('shopgate/config')->getConfig();
        }
        return SHOPGATE_LIBRARY_VERSION;
    }

    /**
     * @param int $storeViewId
     *
     * @return Shopgate_Framework_Model_Config
     */
    public function getConfig($storeViewId = null)
    {
        if (!$this->_config) {
            $this->_config = Mage::helper('shopgate/config')->getConfig($storeViewId);
        }
        return $this->_config;
    }


    /**
     * retrieves the maximal count of options for all bundles
     *
     * @return integer
     */
    protected function _getMaxBundleOptionCount()
    {
        $mainTable = $resource = Mage::getModel('bundle/option')
                                     ->getResource()
                                     ->getMainTable();

        $connection = Mage::getModel('bundle/option')
                          ->getResource()
                          ->getReadConnection();

        $entries = $connection->select()
                              ->from("$mainTable", array("count" => "count(*)"))
                              ->group(array("parent_id"))
                              ->query()
                              ->fetchAll();

        $entries[] = array('count' => 0);
        $result    = max($entries);
        return count($entries) ? array_shift($result) : 0;
    }

    /**
     * retrieves the maximal count of custom options for all products
     *
     * @return integer
     */
    protected function _getMaxCustomOptionCount()
    {
        $mainTable = $resource = Mage::getModel('catalog/product_option')
                                     ->getResource()
                                     ->getMainTable();

        $connection = Mage::getModel('catalog/product_option')
                          ->getResource()
                          ->getReadConnection();

        $entries = $connection->select()
                              ->from("$mainTable", array("count" => "count(*)"))
                              ->group(array("product_id"))
                              ->query()
                              ->fetchAll();

        $entries[] = array('count' => 0);
        $result    = max($entries);
        return count($entries) ? array_shift($result) : 0;
    }

    /**
     * retrieves the maximal count of options for all products
     *
     * @return integer
     */
    public function getMaxOptionCount()
    {
        return max(array($this->_getMaxBundleOptionCount(), $this->_getMaxCustomOptionCount()));
    }

    /**
     * Validates missing Quote_Items which got removed because of insufficient qty available
     *
     * @param ShopgateCart           $cart
     * @param Mage_Sales_Model_Quote $quote
     *
     * @return array $result
     */
    public function fetchMissingQuoteItems($cart, $quote)
    {
        $result = array();

        foreach ($cart->getItems() as $_item) {
            $itemNumbers = explode("-", $_item->getItemNumber());
            $item        = $quote->getItemsCollection()->getItemsByColumnValue('product_id', $itemNumbers[0]);
            if (empty($item) && !empty($itemNumbers[1])) {
                // grouped child
                $item = $quote->getItemsCollection()->getItemsByColumnValue('product_id', $itemNumbers[1]);
            }

            if (!count($item)) {
                $product = Mage::getModel('catalog/product')
                               ->setStoreId(Mage::helper('shopgate')->getConfig()->getStoreViewId())
                               ->load($_item->getItemNumber())
                               ->setShopgateItemNumber($_item->getItemNumber())
                               ->setShopgateOptions($_item->getOptions())
                               ->setShopgateInputs($_item->getInputs())
                               ->setShopgateAttributes($_item->getAttributes());

                $model = Mage::getModel('sales/quote_item');
                $model->setProduct($product);
                $result[] = $model;
            }
        }

        return $result;
    }

    /**
     * Generates a ShopgateCartItem for the checkCart Response
     *
     * @param Mage_Catalog_Model_Product $product
     * @param boolean                    $isBuyable
     * @param int                        $qtyBuyable
     * @param int|float                  $priceExclTax
     * @param int|float                  $priceInclTax
     * @param array                      $errors
     * @param bool                       $stockQuantity
     *
     * @return ShopgateCartItem
     */
    public function generateShopgateCartItem(
        $product,
        $isBuyable = false,
        $qtyBuyable = 0,
        $priceInclTax = 0,
        $priceExclTax = 0,
        $errors = array(),
        $stockQuantity = false
    ) {

        $item = new ShopgateCartItem();
        $item->setItemNumber($product->getShopgateItemNumber());
        $item->setOptions($product->getShopgateOptions());
        $item->setInputs($product->getShopgateInputs());
        $item->setAttributes($product->getShhopgateAttributes());
        $item->setIsBuyable((int)$isBuyable);
        $item->setQtyBuyable($isBuyable ? $qtyBuyable : 0);
        $item->setStockQuantity($stockQuantity);
        $item->setUnitAmount($priceExclTax);
        $item->setUnitAmountWithTax($priceInclTax);

        foreach ($errors as $error) {
            $item->setError($error['type']);
            $item->setErrorText($error['message']);
        }

        return $item;
    }

    /**
     * Fetches the count of all entities
     *
     * @param $storeViewId
     *
     * @return array
     */
    public function getEntitiesCount($storeViewId)
    {
        $store             = Mage::getModel('core/store')->load($storeViewId);
        $productNotVisible = Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE;

        $categoryCount = (int)Mage::getResourceModel('catalog/category')
                                  ->getChildrenCount($store->getRootCategoryId());
        $productCount  = (int)Mage::getModel('catalog/product')
                                  ->getCollection()
                                  ->addStoreFilter($storeViewId)
                                  ->addAttributeToSelect('id')
                                  ->addAttributeToFilter('visibility', array('nin' => $productNotVisible))
                                  ->addAttributeToFilter('status', Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
                                  ->getSize();
        $reviewCount = 0;
        if (Mage::getConfig()->getModuleConfig("Mage_Review")->is('active', 'true')) {
            $reviewCount = (int)Mage::getModel('review/review')
                                    ->getCollection()
                                    ->addStoreFilter($storeViewId)
                                    ->addStatusFilter(Mage_Review_Model_Review::STATUS_APPROVED)
                                    ->getSize();
        }

        return array(
            'category_count' => $categoryCount,
            'item_count'     => $productCount,
            'review_count'   => $reviewCount
        );
    }

    /**
     * Retrieve a collection of third party modules installed and active
     *
     * @return Varien_Data_Collection Collection
     */
    public function getThirdPartyModules()
    {
        $modules = Mage::getConfig()->getNode('modules')->children();

        $pluginsInstalled = array();
        foreach ($modules as $moduleName => $obj) {
            if (preg_match('/^(Mage_|Shopgate_Framework)/', $moduleName)) {
                continue;
            }

            $pluginsInstalled[] = $this->_createModuleInfo($moduleName);
        }

        return $pluginsInstalled;
    }

    /**
     * creates module info array from module config
     *
     * @param string $moduleName
     *
     * @return array
     */
    protected function _createModuleInfo($moduleName)
    {
        $moduleConfig = Mage::getConfig()->getModuleConfig($moduleName);
        return array(
            'name'      => $moduleName,
            'id'        => $moduleName,
            'version'   => (string)$moduleConfig->{'version'},
            'is_active' => (string)$moduleConfig->{'active'}
        );
    }

    /**
     * Check qty increments
     *
     * @param int|float                              $qty
     * @param Mage_CatalogInventory_Model_Stock_Item $stockItem
     *
     * @return Varien_Object
     */
    public function checkQtyIncrements($stockItem, $qty)
    {
        $result = new Varien_Object();

        $qtyIncrements = $stockItem->getQtyIncrements();
        if ($qtyIncrements && (Mage::helper('core')->getExactDivision($qty, $qtyIncrements) != 0)) {
            $result->setHasError(true)
                   ->setQuoteMessage(
                   Mage::helper('cataloginventory')->__(
                       'Some of the products cannot be ordered in the requested quantity.'
                   )
                )
                   ->setErrorCode('qty_increments')
                   ->setQuoteMessageIndex('qty');
            $result->setMessage(
                   Mage::helper('cataloginventory')->__(
                       'This product is available for purchase in increments of %s only.',
                       $qtyIncrements * 1
                   )
            );
        }

        return $result;
    }

    /**
     * Generates the uri to direct back after oauth authorization
     * and makes the uri unique via storeviewid
     *
     * @param int $storeViewId
     *
     * @return string
     */
    public function getOAuthRedirectUri($storeViewId)
    {
        /* temporary changing the current store to prevent the generation of get_params on getUrl */
        $oldStoreViewId = Mage::app()->getStore()->getId();
        Mage::app()->setCurrentStore($storeViewId);
        $url = Mage::app()->getStore($storeViewId)
                   ->getUrl('shopgate/framework/receive_authorization/storeviewid/' . $storeViewId);
        Mage::app()->setCurrentStore($oldStoreViewId);

        return $url;
    }

    /**
     * Check for enterprise edition
     *
     * @return int
     */
    public function isEnterPrise()
    {
        return (int)is_object(Mage::getConfig()->getNode('global/models/enterprise_enterprise'));
    }

    /**
     * Helper method to fetch already for connections used store view id's
     *
     * @return array<int>
     */
    public function getConnectionDefaultStoreViewCollection()
    {
        $connections = Mage::helper('shopgate/config')->getShopgateConnections();

        $result = array();
        foreach ($connections as $connection) {
            if ($connection->getScope() == 'websites') {
                $collection = Mage::getModel('core/config_data')->getCollection()
                                  ->addFieldToFilter(
                                  'path', Shopgate_Framework_Model_Config::XML_PATH_SHOPGATE_SHOP_DEFAULT_STORE
                    )
                                  ->addFieldToFilter('scope', $connection->getScope())
                                  ->addFieldToFilter('scope_id', $connection->getScopeId());

                if ($collection->getSize()) {
                    $storeViewId = $collection->getFirstItem()->getValue();
                }
            } else {
                if ($connection->getScope() == 'stores') {
                    $storeViewId = $connection->getScopeId();
                }
            }

            $result[] = $storeViewId;
        }

        return $result;
    }
}
