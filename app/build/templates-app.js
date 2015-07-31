angular.module('templates-app', ['customer/view/register/form.tpl.html', 'login/view/login/form.tpl.html', 'menu/view/menu/addon.tpl.html', 'menu/view/menu/address.tpl.html', 'menu/view/menu/cart.tpl.html', 'menu/view/menu/menu.tpl.html', 'menu/view/menu/ordersummary.tpl.html', 'menu/view/menu/submenu.tpl.html', 'menu/view/menu/user-account.tpl.html', 'order/view/orderconfirmation.tpl.html', 'pickup/view/index/form.tpl.html']);

angular.module("customer/view/register/form.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("customer/view/register/form.tpl.html",
    "<section class=\"accordion-top-offset\">\n" +
    "    <div class=\"gama-form\">\n" +
    "        <div ng-class=\"{'error': errors, 'success': !error}\" class=\"message\" ng-show=\"messages != null\" ng-repeat=\"message in messages\">\n" +
    "    	{{ message }}\n" +
    "        </div>\n" +
    "        <form ng-show=\"showRegisterForm\">\n" +
    "            <div>\n" +
    "                <input type=\"text\" ng-model=\"user.name\" placeholder=\"User name\">\n" +
    "            </div>\n" +
    "            <div>\n" +
    "                <input type=\"text\" ng-model=\"user.email\" placeholder=\"Email\">\n" +
    "            </div>\n" +
    "\n" +
    "            <div>\n" +
    "                <input type=\"text\" ng-model=\"user.mobile\" placeholder=\"Mobile Number\">\n" +
    "            </div>  \n" +
    "            \n" +
    "            <div>\n" +
    "                <input type=\"password\" ng-model=\"user.password\" placeholder=\"Password\">\n" +
    "            </div>\n" +
    "            <div>\n" +
    "                <input type=\"password\" ng-model=\"user.confirmation\" placeholder=\"Confirm Password\">\n" +
    "            </div>  \n" +
    "            <div>\n" +
    "                Note: User can login either with his/her registered Email Id or Mobile Number.\n" +
    "            </div>     \n" +
    "                          \n" +
    "            <div class=\"buttons\">\n" +
    "                <input type=\"submit\" value=\"Register\" ng-click=\"register()\">\n" +
    "            </div>\n" +
    "\n" +
    "        </form>\n" +
    "        <div class=\"message success\" ng-show=\"linktologin\">Registration Successfully Completed \n" +
    "            <a href=\"#/login\"> Click Here</a> to Login\n" +
    "        </div>\n" +
    "    </div>\n" +
    "</section>\n" +
    "\n" +
    "");
}]);

angular.module("login/view/login/form.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("login/view/login/form.tpl.html",
    "<section class=\"accordion-top-offset\">\n" +
    "    <div class=\"gama-form\">\n" +
    "        <div ng-class=\"{'error': errors, 'success': !error}\" class=\"message\" ng-show=\"messages != null\" \n" +
    "            ng-repeat=\"message in messages\">\n" +
    "        {{ message }}\n" +
    "    </div>\n" +
    "    <form ng-show=\"showLoginForm\">\n" +
    "        <div>\n" +
    "            <input type=\"text\" ng-model=\"username\" placeholder=\"Email Id/Phone Number\">\n" +
    "        </div>\n" +
    "        \n" +
    "        <div>\n" +
    "            <input type=\"password\" ng-model=\"password\" placeholder=\"Password\">\n" +
    "        </div>\n" +
    "\n" +
    "            <div class=\"buttons\">\n" +
    "                <input type=\"submit\" value=\"Login\" ng-click=\"login()\">\n" +
    "            </div>\n" +
    "            <div class=\"buttons\">\n" +
    "                <input type=\"submit\" value=\"Register\" ng-click=\"register()\">\n" +
    "            </div>\n" +
    "        </form>\n" +
    "    </div>\n" +
    "</section>\n" +
    "\n" +
    "\n" +
    "");
}]);

angular.module("menu/view/menu/addon.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("menu/view/menu/addon.tpl.html",
    "<div class=\"popularCombos\" >\n" +
    "    <div class=\"popup-body\">\n" +
    "        <form name=\"addonform\">\n" +
    "        <div class=\"popup-header\">\n" +
    "            Add-ons\n" +
    "            <span class=\"popup-exit\" ng-click=\"cancel()\">\n" +
    "                <i class=\"fa fa-times\" ></i>\n" +
    "            </span>\n" +
    "        </div>\n" +
    "        <div class=\"popup-content\">\n" +
    "            <ul class=\"add-ons-lists combo-list\">\n" +
    "                <li class=\"clearfix\" ng-if=\"addonItems\" ng-form=\"subform{{addonItemGroup.upSellProductGroupId}}\" ng-repeat=\"(addonGroupKey, addonItemGroup) in addonItems\">               \n" +
    "                  <h4>{{addonItemGroup.upSellProductGroupName}}</h4>\n" +
    "                    <div ng-if=\"addonItemGroup.upSellProductGroupItems\" ng-repeat=\"(addonKey, addonItem) in addonItemGroup.upSellProductGroupItems\">\n" +
    "                        <div class=\"left-side\">\n" +
    "                            <h3>{{addonItem.addonItemName}}</h3>\n" +
    "                        </div>\n" +
    "                        <div class=\"right-side\">                            \n" +
    "                            <input type=\"radio\"  ng-init=\"addonItemRadio[addonGroupKey][addonKey]=0\" ng-model=\"addonItemRadio[addonGroupKey][addonKey]\" ng-value=\"{{addonItem.addonItemId}}\" value=\"{{addonItem.addonItemId}}\" name=\"addonProduct{{addonItemGroup.upSellProductGroupId}}\" ng-click=\"resetAddOnCount(addonItemGroup.upSellProductGroupId, addonQuantity, addonGroupKey, addonKey)\" >\n" +
    "                            <div class=\"counter-block\">\n" +
    "                                <a class=\"minus\" ng-click=\"addOnQtyMinus(addonItemGroup.upSellProductGroupItems, addonQuantity, addonGroupKey, addonKey)\">-</a>\n" +
    "                                <span class=\"count\" >\n" +
    "                                    <input type=\"text\" ng-readonly=\"true\" ng-init=\"addonQuantity[addonGroupKey][addonKey]=0\" name=\"addonQuantity{{addonItemGroup.upSellProductGroupId}}\"  ng-model=\"addonQuantity[addonGroupKey][addonKey]\" value=\"{{addonQuantity[addonGroupKey][addonKey]}}\" />\n" +
    "                                </span>\n" +
    "                                <a class=\"plus\" ng-click=\"addOnQtyPlus(addonItemGroup.upSellProductGroupItems, addonQuantity, addonGroupKey, addonKey)\">+</a>\n" +
    "                            </div>\n" +
    "                            <span class=\"rate\" ng-init=\"addonPrice[addonGroupKey][addonKey]=addonItem.addonItemPrice\" ng-model=\"addonPrice[addonGroupKey][addonKey]\">₹ {{addonItem.addonItemPrice| number:2}}</span>\n" +
    "                        </div>\n" +
    "                    </div>                  \n" +
    "                </li>\n" +
    "            </ul>\n" +
    "        </div>\n" +
    "        <div class=\"popup-footer\">           \n" +
    "             <a ng-click=\"addToCombo()\" class=\"make-my-combo-btn add-to-combo\" href=\"javascript:void(0);\" title=\"Make My Combo\">Add to Combo</a>\n" +
    "        </div>\n" +
    "    </form>\n" +
    "    </div>\n" +
    "</div>");
}]);

angular.module("menu/view/menu/address.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("menu/view/menu/address.tpl.html",
    "<div class=\"popup-body\">\n" +
    "      <div class=\"popup-header\">Delivery Address<span class=\"popup-exit\" ng-click=\"cancel()\"><i class=\"fa fa-times\"></i></span></div>\n" +
    "      <div class=\"popup-content\" id=\"DeliveryAddres\">\n" +
    "        <ul class=\"combo-list\">\n" +
    "          <li class=\"clearfix\">\n" +
    "            <div class=\"clearfix\">\n" +
    "              <form class=\"form-combo-select\">\n" +
    "                <input type=\"text\" class=\"form-control address1\" placeholder=\"Enter Address Line 1\"ng-model=\"address1\"/>\n" +
    "                <input type=\"text\" class=\"form-control address2\" placeholder=\"Enter Address Line 2\" ng-model=\"address2\"/>\n" +
    "                <input type=\"text\" class=\"form-control phonenum\" placeholder=\"Phone Number\" ng-model=\"phone\"/>\n" +
    "                <div class=\"btn-center\">\n" +
    "                  <a class=\"btn-yellow1 bottom-offset popup-exit1 Done\" href=\"#\" ng-click=\"deliveryAddress(address1,address2,phone)\" title=\"Register\">Done</a>\n" +
    "                </div>\n" +
    "              </form>\n" +
    "            </div>\n" +
    "          </li>\n" +
    "        </ul>\n" +
    "      </div>\n" +
    "</div>\n" +
    " <div class=\"popup-overlay\"></div>\n" +
    "");
}]);

angular.module("menu/view/menu/cart.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("menu/view/menu/cart.tpl.html",
    "<div ui-view=\"order\">\n" +
    "  <div ng-if=\"cartItems\" class=\"accordion-top-offset\">\n" +
    "    <ul class=\"combo-list mycart\">\n" +
    "      <li class=\"clearfix\" ng-repeat=\"(cartKey, cartItem) in cartItems\" \n" +
    "        ng-init=\"cpIndex = $index\">\n" +
    "        <div class=\"left-side\">\n" +
    "          <h3>{{cartItem.productName}}</h3>\n" +
    "          <p>{{cartItem.productDetails.short_description}}</p>\n" +
    "        </div>\n" +
    "        <div class=\"right-side\">\n" +
    "          <div class=\"clearfix\">\n" +
    "            <span class=\"rate\">₹ {{cartItem.productPrice| number:2}}</span>\n" +
    "            <div class=\"counter-block\">\n" +
    "              <a ng-click=\"cartQtyMinus(cpIndex, cartItem)\" class=\"minus\" >-</a>\n" +
    "                <span class=\"count\">\n" +
    "                  <input type=\"text\" ng-readonly=\"true\" ng-init=\"cartQty[cpIndex]=cartItem. productQuantity\" ng-model=\"cartQty[cpIndex]\" ng-value=\"{{cartItem.productQuantity}}\"value=\"{{cartItem.productQuantity}}\" />\n" +
    "                </span>\n" +
    "                <a ng-click=\"cartQtyPlus(cpIndex, cartItem)\" class=\"plus\" >+</a>\n" +
    "            </div>\n" +
    "          </div>\n" +
    "          <div class=\"combo-action\">\n" +
    "            <a ng-if=\"cartItem.productType=='bundle'\" class=\"editIcon\" ng-click=\"cartEdit(cartItem, qty, cartQty, cpIndex)\" title=\"Edit\" href=\"javascript:void(0);\"><i class=\"fa fa-pencil\"></i></a>\n" +
    "            <a href=\"javascript:void(0);\" ng-click=\"removeFromCart(cpIndex)\" title=\"Delete\" class=\"deleteIcon\"><i class=\"fa fa-trash-o\"></i></a>\n" +
    "          </div>\n" +
    "        </div>\n" +
    "      </li>\n" +
    "<!-- <li class=\"clearfix\">\n" +
    "  <div class=\"left-side\">\n" +
    "    <h3>Plain Dosa</h3>\n" +
    "    <p>Lorem Ipsum is simply dummy text of the...</p>\n" +
    "  </div>\n" +
    "  <div class=\"right-side\">\n" +
    "    <div class=\"clearfix\">\n" +
    "      <span class=\"rate\">₹ 70.00</span>\n" +
    "      <div class=\"counter-block\">\n" +
    "        <a class=\"minus\" href=\"#\">-</a><span class=\"count\"><input type=\"text\" value=\"1\" /></span><a class=\"plus\" href=\"#\">+</a>\n" +
    "      </div>\n" +
    "    </div>\n" +
    "    <div class=\"combo-action\">\n" +
    "      <a href=\"#\" title=\"Delete\" class=\"deleteIcon\"><i class=\"fa fa-trash-o\"></i></a>\n" +
    "    </div>\n" +
    "  </div>\n" +
    "</li> -->\n" +
    "    </ul>\n" +
    "    <div class=\"stickyBtn\">\n" +
    "      <!-- <a href=\"javascript:void(0);\"  ng-click=\"orderSummary()\">PLACE ORDER</a> -->\n" +
    "      <a class=\"btn-yellow\" ui-sref=\"menu.ordersummary\">PLACE ORDER</a>\n" +
    "    </div>\n" +
    "  </div>\n" +
    "</div>\n" +
    "");
}]);

angular.module("menu/view/menu/menu.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("menu/view/menu/menu.tpl.html",
    "<div ui-view=\"content\">\n" +
    "  <form>     \n" +
    "    <div class=\"menu-home\" ng-if=\"dayWiseMenus\"  ng-repeat=\"(day, dayList) in dayWiseMenus\">\n" +
    "        <h3 ng-if=\"dayList\" ng-repeat=\"(key, dayMenu) in dayList\" ng-model=\"day\" >{{dayMenu.day}}</h3>\n" +
    "        <p class=\"date\" ng-if=\"dayList\" ng-repeat=\"(key, dayMenu) in dayList\" >{{dayMenu.date}}</p>\n" +
    "        <ul ng-if=\"dayList\" ng-repeat=\"(key, dayMenu) in dayList\" > \n" +
    "            <li  ng-if=\"dayMenu\" ng-repeat=\"(catkey, category) in dayMenu.menu\" class=\"{{category.name | lowercase}}\" >\n" +
    "               <a href=\"javascript:void(0);\" ng-model=\"category\" ng-class=\"isTimesUp(dayMenu.day, category.end)\" ng-click=\"getSubCategory(day, category.id, category.name)\">{{category.name}}</a>               \n" +
    "               <!-- <a href=\"#/submenu/{{category.id}}\" ng-model=\"category\" >{{category.name}}</a>                   \n" +
    "              <a ui-sref=\"menu.submenu({ pickuppoint_id:dayMenu.pickuppointId, cat_id: category.id})\" ng-model=\"category\" >{{category.name}}</a>-->                         \n" +
    "            </li>\n" +
    "        </ul>\n" +
    "    </div>\n" +
    "</form> \n" +
    "<div class=\"pick-up-point-timing\">\n" +
    "   <a href=\"#/pickup\" title=\"Pick-up Points and Timings\">Pick-up Points and Timings</a>\n" +
    " </div>\n" +
    "</div>");
}]);

angular.module("menu/view/menu/ordersummary.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("menu/view/menu/ordersummary.tpl.html",
    "<div ui-view=\"content\">\n" +
    "<section class=\"content\">\n" +
    "    <div class=\"ordersummary\">\n" +
    "      <ul class=\"combo-list order-final\">\n" +
    "\n" +
    "        <li class=\"clearfix\" ng-repeat=\"cartItem in cartItems\" \n" +
    "        ng-init=\"cpIndex = $index\">\n" +
    "        <div class=\"left-side\" ng-if=\"cartItem.productType == 'bundle'\">\n" +
    "          <h3>{{cartItem.productName}}</h3>\n" +
    "          <ul class=\"combo-selected-list\">\n" +
    "            <li ng-if=\"comboGroup\" ng-repeat=\"(gkey, groupItems) in cartItem.productComboGroupItems\">\n" +
    "              <div class=\"clearfix combo-wrap\">\n" +
    "                <div class=\"combo-no\" >\n" +
    "                  <span>{{ gkey + 1 }}</span>\n" +
    "                </div>\n" +
    "                <div class=\"combo-content clearfix\">\n" +
    "                  <div class=\"combo-content-list\">\n" +
    "                    <p ng-repeat=\"comboItem in groupItems\">{{comboItem |split:'~':0}}</p>  \n" +
    "                    <p ng-if=\"cartItem.productAddonDetails\" ng-repeat=\"addon in cartItem.productAddonDetails\">\n" +
    "                    {{addon.addonProductId}} (Add-on)</p>\n" +
    "                  </div>\n" +
    "                </div>\n" +
    "              </div>\n" +
    "            </li> \n" +
    "          </ul>\n" +
    "        </div>\n" +
    "        <div class=\"left-side\" ng-if=\"cartItem.productType !== 'bundle'\">\n" +
    "          <h3>{{cartItem.productName}}</h3>\n" +
    "          <p>{{cartItem.productDetails.short_description}}</p>\n" +
    "        </div>\n" +
    "        <div class=\"right-side\">\n" +
    "          <div class=\"clearfix\">\n" +
    "            <span class=\"rate\">₹ {{cartItem.productPrice| number:2}}</span>\n" +
    "            <div class=\"counter-block\">\n" +
    "              <a ng-if=\"cartItem.productType !== 'bundle'\" ng-click=\"cartQtyMinus(cpIndex, cartItem)\" class=\"minus\" >-</a>\n" +
    "                <span class=\"count\">\n" +
    "                  <input type=\"text\" ng-readonly=\"true\" ng-init=\"cartQty[cpIndex]=cartItem. productQuantity\" ng-model=\"cartQty[cpIndex]\" ng-value=\"{{cartItem.productQuantity}}\"value=\"{{cartItem.productQuantity}}\" />\n" +
    "                </span>\n" +
    "                <a ng-if=\"cartItem.productType !== 'bundle'\" ng-click=\"cartQtyPlus(cpIndex, cartItem)\" class=\"plus\" >+</a>\n" +
    "            </div>\n" +
    "          </div>\n" +
    "          <div class=\"combo-action\">\n" +
    "            <a href=\"javascript:void(0);\" ng-click=\"removeFromCart(cpIndex)\" title=\"Delete\" class=\"deleteIcon\"><i class=\"fa fa-trash-o\"></i></a>\n" +
    "          </div>\n" +
    "        </div>\n" +
    "      </li>\n" +
    "          <div class=\"clearfix clear\">\n" +
    "            <a title=\"Make My Combo\" class=\"make-my-combo-btn\" href=\"javascript:void(0);\" ng-click=\"addMore()\">+ Add More</a>\n" +
    "          </div>\n" +
    "\n" +
    "        </li>\n" +
    "      </ul>\n" +
    "      <div class=\"order-pick-up\">\n" +
    "        <ul>\n" +
    "          <li>\n" +
    "            <div class=\"order-align\">\n" +
    "              <span class=\"PickupLabel\">Pick-up Point</span>\n" +
    "            </div>\n" +
    "            <div class=\"AddressChange order-align-right\">\n" +
    "              <span class=\"AddressTo\">{{pickupPointSelected}}</span> \n" +
    "              <span>-</span> \n" +
    "              <span class=\"Offset-10\">07:00 AM</span>\n" +
    "              <!-- <div>\n" +
    "                <i ng-if=\"pickupPointSelected\" class=\"fa fa-pencil edit-sm\" ng-click=\"editPickupoint()\"></i>\n" +
    "              </div> -->\n" +
    "              <div>\n" +
    "                <select ng-if=\"showPickuppoint\" ng-model=\"pickup\" ng-change=\"changePickuppoint(pickup)\">\n" +
    "                  <option ng-repeat=\"pickuppoints in pickUpList\" value=\"{{pickuppoints.name}}\">{{pickuppoints.name}}\n" +
    "                  </option>\n" +
    "                </select>\n" +
    "              </div>\n" +
    "            </div>\n" +
    "          </li>\n" +
    "          <li>\n" +
    "            <div class=\"order-align\">\n" +
    "              <span>Date</span>\n" +
    "            </div>\n" +
    "              <p>{{showDate()}}</p>\n" +
    "          </li>\n" +
    "          <li ng-repeat=\"address in deliveryAddressData\">\n" +
    "            <div class=\"order-align\">\n" +
    "              <span>Address</span>\n" +
    "            </div>\n" +
    "            <div class=\"order-align-right\">\n" +
    "              <span>\n" +
    "                {{address.address1}}\n" +
    "              </span>\n" +
    "              <span>\n" +
    "                {{address.address2}}\n" +
    "              </span>\n" +
    "            </div>\n" +
    "            <div class=\"order-align\">\n" +
    "              <span>Phone</span>\n" +
    "            </div>\n" +
    "            <div class=\"order-align-right\">\n" +
    "              <span>\n" +
    "                <input type=\"text\" value=\"+91\" />\n" +
    "                <input type=\"text\" value=\"{{address.phone}}\" class=\"PhoneNumberField\"/>\n" +
    "              </span>\n" +
    "            </div>\n" +
    "          </li>\n" +
    "        </ul>\n" +
    "\n" +
    "        <div class=\"clearfix\">\n" +
    "          <div class=\"check-wrap\">\n" +
    "            <input type=\"checkbox\" ng-init=\"showBYOVOffer=true\" ng-model=\"showBYOVOffer\" ng-change=\"byovCalculate(showBYOVOffer)\"/>\n" +
    "          </div>\n" +
    "          <label class=\"pink\"><span>Get 5% off by Bringing Your Own Vessel (BYOV)</span><i class=\"question\" title=\"Lorem ipsum dolor sit amet, consec\"></i></label>\n" +
    "        </div>\n" +
    "        <div class=\"door-step clearfix\">\n" +
    "          <span>Would you like to get it delivered to your door step at an extra charge of ₹ 20?<i class=\"question\" title=\"Lorem ipsum dolor sit amet, consec\"></i></span>\n" +
    "          <span>\n" +
    "            <input id=\"toggle-yes\" class=\"toggle toggle-left\" name=\"toggle\" value=\"true\" type=\"radio\" />\n" +
    "            <label for=\"toggle-yes\"  ng-click=\"deliveryAddressPopUp()\">Yes</label>\n" +
    "            <input id=\"toggle-no\" class=\"toggle toggle-right\" name=\"toggle\" value=\"false\" type=\"radio\" checked />\n" +
    "            <label for=\"toggle-no\" ng-click=\"doorDelivery()\">No</label>\n" +
    "          </span>\n" +
    "        </div>\n" +
    "      </div>\n" +
    "\n" +
    "      <ul class=\"total-amount\">\n" +
    "        <li><span>Sub Total</span><span>{{getSubTotal() | currency: \"₹\"}}</span></li>\n" +
    "        <li><span>Taxes</span><span>₹ 20.00</span></li>\n" +
    "        <li ng-if=\"showBYOVOffer\"><span>BYOV Offer</span><span>{{byov() | currency: \"₹\"}} </span></li>\n" +
    "        <li ng-if=\"addExtraCharge\"><span>Extra Charge</span><span>₹ 20.00</span></li>\n" +
    "        <li><span>Total</span><span>{{getTotal() | currency: \"₹\"}} </span></li>\n" +
    "      </ul>\n" +
    "\n" +
    "      <div class=\"stickyBtn\">\n" +
    "        <!--<a href=\"javascript:void(0);\" class=\"btn-yellow\">PLACE ORDER</a>-->\n" +
    "         <a class=\"btn-yellow\" ui-sref=\"order\">PLACE ORDER</a>\n" +
    "      </div>\n" +
    "</section>\n" +
    "</div>\n" +
    "");
}]);

angular.module("menu/view/menu/submenu.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("menu/view/menu/submenu.tpl.html",
    "<div ui-view=\"content\" >{{selectedDay}}\n" +
    "    <div ng-if=\"subMenuItems\" ng-repeat=\"(mkey, menuItems) in subMenuItems\"  class=\"accordion-top-offset\">    \n" +
    "        <accordion close-others=\"true\" id=\"accordion-panel\">\n" +
    "            <accordion-group  is-open=\"isopen\" ng-repeat=\"(titleKey, itemTitle) in menuItems\" ng-init=\"cIndex = $index\" >\n" +
    "                <accordion-heading > {{itemTitle.name}}\n" +
    "                    <i class=\"pull-right glyphicon\"  ng-class=\"{'glyphicon-chevron-up': isopen, 'glyphicon-chevron-down': !isopen}\"></i>\n" +
    "                </accordion-heading>\n" +
    "                <div class=\"container\" >                \n" +
    "                    <div class=\"content\"  >\n" +
    "                        <ul class=\"combo-list\">\n" +
    "                            <li class=\"clearfix\" ng-if=\"itemTitle.products\" ng-repeat=\"(itemKey, items) in itemTitle.products\" ng-init=\"productId = items.entity_id\">\n" +
    "                                <form name=\"productform\" class=\"form-combo-select\"  >\n" +
    "                                    <div ng-init=\"pIndex = $index\">\n" +
    "                                        <div class=\"left-side\">\n" +
    "                                            <h3>{{items.name}} </h3>\n" +
    "                                            <p>{{items.description}}</p>\n" +
    "                                        </div>\n" +
    "                                        <div class=\"right-side\"  >\n" +
    "                                            <div class=\"clearfix\">\n" +
    "                                                <span class=\"rate\">₹ {{items.price|number:2}}</span>\n" +
    "                                                <div class=\"counter-block\" >\n" +
    "                                                    <!--  <a ng-if=\"qty.count> 0\" ng-click=\"qty.count=qty.count-1\" class=\"minus\">-</a>\n" +
    "                                                           <span class=\"count\">\n" +
    "                                                                   <input ng-init=\"qty.count=0\" type=\"text\" ng-model=\"qty.count\" value=\"{{qty.count}}\" />\n" +
    "                                                           </span>\n" +
    "                                                           <a class=\"plus\" ng-click=\"qty.count=qty.count+1\">+</a>-->\n" +
    "                                                    <a  ng-click=\"productQtyMinus(qty, cIndex, pIndex)\" class=\"minus\">-</a>\n" +
    "                                                    <span class=\"count\">\n" +
    "                                                        <input type=\"text\" ng-readonly=\"true\" ng-init=\"qty[cIndex][pIndex]= (qty[cIndex][pIndex] > 0 ) ? qty[cIndex][pIndex] :0\" ng-model=\"qty[cIndex][pIndex]\" value=\"{{qty[cIndex][pIndex]}}\" />\n" +
    "                                                    </span>\n" +
    "\n" +
    "                                                    <a class=\"plus\" ng-click=\"productQtyPlus(qty, cIndex, pIndex)\" >+</a> \n" +
    "                                                </div>\n" +
    "                                            </div>                                \n" +
    "                                            <a ng-if=\"items.type_id != 'bundle'\" href=\"javascript:void(0);\" ng-click=\"addToCart('others', productId, qty[cIndex][pIndex], items, 0, 0, cIndex, pIndex)\" class=\"make-my-combo-btn\" title=\"Add to Cart\">Add to Cart</a>\n" +
    "                                            <a ng-if=\"items.type_id == 'bundle'\" class=\"make-my-combo-btn\" ng-hide=\"showme == productId\" ng-click=\"getComboList(productId, qty, cIndex, pIndex)\" title=\"Make My Combo\" href=\"javascript:void(0);\" >Make My Combo</a>\n" +
    "                                        </div>\n" +
    "                                        <div ng-show=\"showLoader{{pIndex}}\"> <i class=\"fa fa-refresh fa-spin\"></i></div>\n" +
    "                                        <div class=\"clearfix clear combo-items\" ng-if=\"items.type_id == 'bundle'\" ng-show=\"showme == productId\" >   <!-- combo products start -->\n" +
    "\n" +
    "                                            <img class=\"ComboImg\" src=\"assets/images/combo-item.jpg\">\n" +
    "                                            <!-- <div class=\"most-popular-combos clearfix\">\n" +
    "                                                <a href=\"javascript:void(0);\" title=\"Most Popular Combos\" data-popup-target=\"#mostpopular-popup\">Most Popular Combos</a>\n" +
    "                                            </div> -->\n" +
    "                                            <ul class=\"combo-selected-list\"> \n" +
    "                                                <li ng-if=\"comboGroup\" ng-repeat=\"(gkey, groupItems) in comboGroup\" ng-init=\"cgIndex = $index\">\n" +
    "                                                    <div class=\"clearfix combo-wrap\">\n" +
    "                                                        <div class=\"combo-no\" >														\n" +
    "                                                            <span>{{ gkey + 1}}</span>\n" +
    "                                                        </div>\n" +
    "                                                        <div class=\"combo-content clearfix\">\n" +
    "                                                            <div class=\"combo-content-list\">\n" +
    "                                                                <p ng-repeat=\"groupItem in groupItems\">{{groupItem|split:'~':0}} </p> \n" +
    "                                                            </div>\n" +
    "                                                            <div class=\"combo-action\"> <a ng-if=\"alcartaEditFlag\" class=\"editIcon\" ng-click=\"comboEdit(groupItems, gkey)\" title=\"Edit\" href=\"javascript:void(0);\"><i class=\"fa fa-pencil\"></i></a>                                \n" +
    "                                                                <a class=\"deleteIcon\" title=\"Delete\" href=\"\" ng-click=\"arrangeCombo($index, pIndex, cIndex, comboCount)\">\n" +
    "                                                                    <i class=\"fa fa-trash-o\"></i>\n" +
    "                                                                </a>\n" +
    "                                                            </div>\n" +
    "                                                        </div>\n" +
    "                                                    </div>\n" +
    "                                                </li>\n" +
    "                                            </ul> \n" +
    "\n" +
    "\n" +
    "                                            <div ng-if=\"comboalert\"  class=\"message error\" >{{comboalert}}</div>                                \n" +
    "                                            <p class=\"ComboNumber\"></p>\n" +
    "                                            <label>Pick {{comboSize}} delicacies to make your Combo</label>\n" +
    "                                            <div ng-if=\"comboItems.bundleItems\" ng-repeat=\"(comboKey, comboOptions) in comboItems.bundleItems\">\n" +
    "                                                <select ng-disabled=\"isDisabled\" ng-model=\"combos\" ng-change=\"comboItemsSelected(combos, comboOptions, productId, cIndex, pIndex, comboKey)\">\n" +
    "                                                    <option value=\"\">Pick any one item from the list</option>\n" +
    "                                                    <option ng-if=\"comboOptions\" ng-repeat=\"(ckey, cvalue) in comboOptions\" value=\"{{cvalue.itemId}}\" ng-selected='isSelected(ckey, cvalue.itemName)' >{{cvalue.itemQuantity| number:0}} {{cvalue.itemName}}</option>\n" +
    "                                                </select>\n" +
    "\n" +
    "                                            </div>	\n" +
    "\n" +
    "                                            <div class=\"endureCombos\">\n" +
    "                                                <span><input type=\"checkbox\" ng-model=\"applyRemainingCombo[cIndex][pIndex]\" name=\"applyRemainingCombo\" value=\"1\">\n" +
    "                                                    Apply same combination   \n" +
    "                                                    <select ng-if=\"comboGroup.length > 1\" id=\"remainingCombo\"  ng-model=\"remainingComboItem[cIndex][pIndex]\" >\n" +
    "                                                        <option value=\"\">Combo</option>\n" +
    "                                                        <option ng-if=\"comboGroup\" ng-repeat=\"(gkey, groupItems) in comboGroup\"  value=\"{{gkey}}\">{{gkey + 1}}</option>\n" +
    "                                                    </select> to the remaining quantities</span>\n" +
    "                                            </div>\n" +
    "                                            <div class=\"combo-submit\">\n" +
    "                                                <span><a class=\"add-ons\" ng-if=\"comboItems.addonGroupItems.length > 0\" ng-click=\"open()\" href=\"javascript:void(0);\" title=\"Add-ons\">Add-ons <i ng-if=\"addonCount > 0\" >({{addonCount}})</i></a></span>\n" +
    "                                                <span> <!--<button type=\"submit\" class=\"add-to-cart\" ng-disabled=\"productform.$invalid\">Add to Cart</button>-->\n" +
    "                                                    <a class=\"add-to-cart\" href=\"javascript:void(0);\" ng-click=\"addToCart('bundle', productId, qty[cIndex][pIndex], items, applyRemainingCombo[cIndex][pIndex], remainingComboItem[cIndex][pIndex], cIndex, pIndex)\" title=\"Add to Cart\" data-popup-target=\"#alert-popup\">Add to Cart</a>                                                \n" +
    "                                                    <!--<input class=\"add-to-cart\"  title=\"Add to Cart\" type=\"submit\" ng-click=\"productValidate()\" value=\"Add to Cart\" />-->\n" +
    "                                                    <a ng-click=\"hideComboList(qty, cIndex, pIndex);\" class=\"cancel \" href=\"javascript:void(0);\" title=\"Cancel\">Cancel</a></span>\n" +
    "                                            </div>                               \n" +
    "                                        </div><!-- combo products end -->  \n" +
    "                                    </div>\n" +
    "                                </form>\n" +
    "                            </li>        \n" +
    "                        </ul>\n" +
    "                    </div>\n" +
    "                </div>        \n" +
    "            </accordion-group>\n" +
    "        </accordion>\n" +
    "    </div>\n" +
    "    <div class=\"stickyBtn\">\n" +
    "        <a class=\"btn-yellow\" ng-click=\"userAccountPopup()\" href=\"javascript:void(0);\">PLACE ORDER</a>\n" +
    "    </div>\n" +
    "</div>");
}]);

angular.module("menu/view/menu/user-account.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("menu/view/menu/user-account.tpl.html",
    "<div id=\"login-popup\" class=\"popularCombos\">\n" +
    "\n" +
    "<div class=\"popup-body\">\n" +
    "    <div class=\"popup-header\">Login<span class=\"popup-exit\" ng-click=\"cancel()\"><i class=\"fa fa-times\"></i></span></div>\n" +
    "    <div class=\"popup-content\">\n" +
    "\n" +
    "      <div class=\"GuestLogin\"><a href=\"javascript:void(0);\" ng-click=\"guestUser()\" class=\"btn-yellow1\">Continue as Guest</a></div>\n" +
    "\n" +
    "        <accordion close-others=\"true\" id=\"accordion-panel\">\n" +
    "          <accordion-group  is-open=\"isopen\">\n" +
    "            <accordion-heading> Using GamaGamaa Account\n" +
    "              <i class=\"pull-right glyphicon\"  ng-class=\"{'glyphicon-chevron-up': isopen, 'glyphicon-chevron-down': !isopen}\"></i>\n" +
    "            </accordion-heading>\n" +
    "\n" +
    "            <div class=\"container\">                \n" +
    "              <div class=\"content\">\n" +
    "                <ul class=\"combo-list\">\n" +
    "                  <li class=\"clearfix\">\n" +
    "                    <div class=\"clearfix\">\n" +
    "                      <div ng-class=\"{'error': errors, 'success': !error}\" class=\"message\" ng-show=\"errorMessages != null\" ng-repeat=\"message in errorMessages\">\n" +
    "                      {{ message }}\n" +
    "                      </div>\n" +
    "                      <form class=\"form-combo-select\">\n" +
    "                        <input type=\"text\" class=\"form-control\" ng-model=\"username\" placeholder=\"Email ID/Mobile Number\" />\n" +
    "                        <input type=\"password\" class=\"form-control\" ng-model=\"password\" placeholder=\"Password\" />\n" +
    "                        <label><input type=\"checkbox\" />Remember me</label>\n" +
    "                        <div class=\"btn-center\">\n" +
    "                          <a class=\"btn-yellow1\" href=\"javascript:void(0);\" ng-click=\"login(username,password)\" title=\"Login\">LOGIN</a>\n" +
    "                        </div>\n" +
    "                      </form>\n" +
    "                    </div>\n" +
    "                  </li>\n" +
    "                </ul>\n" +
    "              </div>\n" +
    "            </div>  \n" +
    "          </accordion-group> \n" +
    "          <accordion-group>\n" +
    "            <accordion-heading> Register with GamaGamaa\n" +
    "               <i class=\"pull-right glyphicon\"  ng-class=\"{'glyphicon-chevron-up': isopen, 'glyphicon-chevron-down': !isopen}\"></i>\n" +
    "            </accordion-heading>\n" +
    "            <div class=\"container\">                \n" +
    "              <div class=\"content\">\n" +
    "                <ul class=\"combo-list\">\n" +
    "                  <li class=\"clearfix\">\n" +
    "                    <div class=\"clearfix\">\n" +
    "                      <div ng-class=\"{'error': errors, 'success': !error}\" class=\"message\" ng-show=\"errorMessages != null\" ng-repeat=\"message in errorMessages\">\n" +
    "                      {{ message }}\n" +
    "                      </div>\n" +
    "                      <form class=\"form-combo-select\" ng-show=\"showRegisterForm\">\n" +
    "                        <input type=\"text\" class=\"form-control\" ng-model=\"user.name\" placeholder=\"Username\" />\n" +
    "                        <input type=\"text\" class=\"form-control\" ng-model=\"user.email\" placeholder=\"Email\" />\n" +
    "                        <input type=\"text\" class=\"form-control\" ng-model=\"user.mobile\" placeholder=\"Mobile Number\" />\n" +
    "                        <input type=\"password\" class=\"form-control\" ng-model=\"user.password\" placeholder=\"Password\" />\n" +
    "                        <input type=\"password\" class=\"form-control\" ng-model=\"user.confirmation\" placeholder=\"Confirm Password\" />\n" +
    "                        <div>\n" +
    "                          Note: User can login either with his/her registered Email Id or Mobile Number.\n" +
    "                        </div> \n" +
    "                        <div class=\"btn-center\">\n" +
    "                          <a class=\"btn-yellow1 top-offset\" href=\"javascript:void(0);\" ng-click=\"register(user)\" title=\"Register\">REGISTER</a>\n" +
    "                        </div>\n" +
    "                      </form>\n" +
    "                      <div class=\"message success\" ng-show=\"successMessage\">Registration Successfully Completed</div>\n" +
    "                    </div>\n" +
    "                  </li>\n" +
    "                </ul>\n" +
    "              </div>  \n" +
    "            </div>\n" +
    "          </accordion-group>\n" +
    "        </accordion>\n" +
    "      </div>\n" +
    "</div>  \n" +
    "</div> ");
}]);

angular.module("order/view/orderconfirmation.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("order/view/orderconfirmation.tpl.html",
    "<div class=\"order-confirmation\">\n" +
    "    <ul>\n" +
    "        <li>\n" +
    "            <span>You have placed the order successfully. </span>\n" +
    "            <span>\n" +
    "                Your order ID:\n" +
    "                <strong>GAMA{{orderDetails.entity_id}}</strong>\n" +
    "            </span>\n" +
    "        </li>\n" +
    "        <li>We will call to your registered mobile number in 30 min to confirm. </li>\n" +
    "        <li>\n" +
    "            <span>\n" +
    "                <strong>Delivery Address </strong>\n" +
    "            </span>\n" +
    "            <span>{{orderDetails.addresses.street}}</span>\n" +
    "            <span>{{orderDetails.addresses.city}} - {{orderDetails.addresses.pincode}}</span>\n" +
    "            <span>Phone: +91 {{orderDetails.addresses.telephone}}</span>\n" +
    "        </li>\n" +
    "        <li>\n" +
    "            <span>\n" +
    "                <strong>Delivery Time </strong>\n" +
    "            </span>\n" +
    "            <span>Wednesday, 12th Nov, 2014 at 7:00 AM </span>\n" +
    "        </li>\n" +
    "        <li>\n" +
    "            <span>\n" +
    "                <strong>Thank You</strong>\n" +
    "            </span>\n" +
    "            <span>GamaGamaa</span>\n" +
    "        </li>\n" +
    "    </ul>\n" +
    "</div>\n" +
    "<div class=\"stickyBtn\">\n" +
    "    <!--<a class=\"btn-yellow\" href=\"menu\"> Place Another Order</a>-->\n" +
    "    <a class=\"btn-yellow\" ui-sref=\"menu\"> Place Another Order </a>\n" +
    "</div>\n" +
    "");
}]);

angular.module("pickup/view/index/form.tpl.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("pickup/view/index/form.tpl.html",
    "<section  class=\"accordion-top-offset\">\n" +
    "    <div class=\"pick-up\">\n" +
    "        <p>Enjoy 5% discount on the bill amount by Bring Your Own Vessel (BYOV). <a href=\"#\">Know More</a>\n" +
    "        </p>\n" +
    "        <form class=\"search-form\">\n" +
    "            <input type=\"text\" ng-model=\"pickupPoint\" ng-keypress=\"setPickupListDisplay(true)\"\n" +
    "                   placeholder=\"Search\"/>\n" +
    "            <input type=\"submit\" value=\"&#xf002;\" />\n" +
    "            <table class=\"pickup-table\">\n" +
    "                <thead>\n" +
    "                    <tr>\n" +
    "                        <th>Pick-up Points</th>\n" +
    "                        <th>Break Fast</th>\n" +
    "                        <th>Lunch</th>\n" +
    "                        <th>Dinner</th>\n" +
    "                        <th>Snacks</th>\n" +
    "                    </tr>\n" +
    "                </thead>\n" +
    "                <tbody>\n" +
    "                    <tr ng-repeat=\"point in filtered = (pickUpList| filter:pickupPoint | 		    orderBy:is_favourite:reverse)\">\n" +
    "                        <td ng-click=\"selectFavouriteLocation($event)\">{{point.name}}</td>\n" +
    "                        <td> {{point.category1_st}} - {{point.category1_et}} </td>\n" +
    "                        <td> {{point.category2_st}} - {{point.category2_et}} </td>\n" +
    "                        <td> {{point.category3_st}} - {{point.category3_et}} </td>\n" +
    "                        <td> {{point.category4_st}} - {{point.category4_et}} </td>\n" +
    "                    </tr>\n" +
    "                </tbody> \n" +
    "            </table>\n" +
    "            <div class=\"ad-footer\">\n" +
    "                <img src=\"assets/images/ad-footer.jpg\" alt=\"Footer Ad\" />\n" +
    "            </div> \n" +
    "        </form>\n" +
    "    </div>\n" +
    "\n" +
    "    <!--<p>If your pick-up Point is not listed, please allow us to notify as\n" +
    "      soon as we cover.</p>\n" +
    "    <form class=\"notify-form\">\n" +
    "            <div ng-class=\"{'error': error, 'success': !error, 'info':'info'}\" class=\"message\" ng-show=\"message != null\">{{message}}</div>\n" +
    "      <div>\n" +
    "        <input type=\"text\" placeholder=\"Location - Pick–up Point\" ng-model=\"newPickupPointRequest.name\"/> <input\n" +
    "          type=\"text\" placeholder=\"Mobile Number\" ng-model=\"newPickupPointRequest.mobile_no\" />\n" +
    "      </div>\n" +
    "    \n" +
    "      <div class=\"buttons\">\n" +
    "        <input type=\"submit\" value=\"Notify Me\" ng-click=\"requestNewPickupPoint();\" /> \n" +
    "        <input type=\"submit\" value=\"Skip\" />\n" +
    "      </div>\n" +
    "    </form> -->");
}]);
