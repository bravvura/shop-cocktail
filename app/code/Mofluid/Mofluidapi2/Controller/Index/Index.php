<?php


namespace Mofluid\Mofluidapi2\Controller\Index;
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
use \Mofluid\Mofluidapi2\Helper\Data;
use \Mofluid\Mofluidapi2\Helper\CommonHelper;

class Index extends \Magento\Framework\App\Action\Action {

    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;

    /** @var  \Mofluid\Mofluidapi2\Model\Catalog\Product */
    protected $Mproduct;

    protected $common_helper;


    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Mofluid\Mofluidapi2\Model\Catalog\Product $Mproduct
     */
    /*public function __construct(
    \Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Mofluid\Mofluidapi2\Model\Catalog\Product $Mproduct, \Mofluid\Mofluidapi2\Model\Index $Mauthentication, Data $helper
    ) {
        //date_default_timezone_set('UTC');
        date_default_timezone_set('America/New_York');
        $this->resultPageFactory = $resultPageFactory;
        $this->mproduct = $Mproduct;
        $this->helper = $helper;
        $this->_mauthentication = $Mauthentication;
        parent::__construct($context);
    }*/
    public function  __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Mofluid\Mofluidapi2\Model\Catalog\Product $Mproduct,
        \Mofluid\Mofluidapi2\Model\Index $Mauthentication, Data $helper
    ) {
        date_default_timezone_set('America/New_York');
        $this->resultPageFactory = $resultPageFactory;
        $this->helper = $helper;
        $this->_mauthentication = $Mauthentication;
        $this->common_helper=new CommonHelper();
        parent::__construct($context);
    }

    public function ws_validateAuthenticate() {
         //print_r()
        $request = $this->_objectManager->get('Magento\Framework\App\RequestInterface');
        $authappid = $request->getHeader('authappid');
        $token = $request->getHeader('token');
        $secretkey = $request->getHeader('secretkey');
        if (empty($authappid) || $authappid == null)
            return false;
        if (empty($token) || $token == null)
            return false;

        if (empty($secretkey) || $secretkey == null)
            return false;

        $mofluid_authentication = $this->_mauthentication->getCollection()->addFieldToFilter('appid', $authappid)->addFieldToFilter('token', $token)->addFieldToFilter('secretkey', $secretkey)->getData();
        if (count($mofluid_authentication) > 0) {
            return true;
        } else {
            return false;
        }
        return false;
    }

    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute() {

        header('Content-Type: application/json');
        $request = $this->_objectManager->get('Magento\Framework\App\RequestInterface');
        $service = $request->getParam("service");

        // get authenticate token and secret key
        if ($service == 'gettoken') {
            $mofluidAuthResponse = array();
            $authappid = $request->getParam("authappid");
            if (empty($authappid) || $authappid == null) {
                $mesg = "Invalid App id";
                echo $this->formatOutput(null, null, null, false, $mesg);
                return;
                //echo json_encode(array("Invalid App id"));
                //return;
            }
            $mofluid_authentication = $this->_mauthentication->getCollection()->addFieldToFilter('appid', $authappid)->getData();
            if (count($mofluid_authentication) > 0) {
                $data = ['appid' => $mofluid_authentication[0]['appid'], 'token' => $mofluid_authentication[0]['token'], 'secretkey' => $mofluid_authentication[0]['secretkey']];
                //echo json_encode($data);
                //return;
                $mesg = "success";
                echo $this->formatOutput(null, $data, null, true, $mesg);
                return;
            } else {
                $token = openssl_random_pseudo_bytes(16);
                $token = bin2hex($token);
                $secretKey = md5(uniqid($authappid, TRUE));
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $model = $objectManager->create('Mofluid\Mofluidapi2\Model\Index');
                $data = ['appid' => $authappid, 'token' => $token, 'secretkey' => $secretKey];
                $model->setData($data);
                $model->save();
                //echo json_encode($data);
                //return;
                $mesg = "success";
                echo $this->formatOutput(null, $data, null, true, $mesg);
                return;
            }
        }
        if ($service == 'driver_update_status') {
            if($request->getContent()){
                $request=json_decode($request->getContent(),true);

                $res = $this->helper->updateOrderStatusDirect($request);
                if($res){
                    $mesg = "success";
                    echo $this->formatOutput(null, $request, null, true, $mesg);
                }else{
                    $mesg = "failed";
                    echo $this->formatOutput(null, $request, null, false, $mesg);
                }
                return;
            }

        }
        // get authenticate token and secret key end here

        if (!$this->ws_validateAuthenticate()) {
            //echo json_encode(array('unauthorized'));
            $mesg = "unauthorized";
            echo $this->formatOutput(null, null, null, false, $mesg);
            return;
        }

        $store = $request->getParam("store");
        if ($store == null || $store == '') {
            $store = 1;
        }

        $categoryid = $request->getParam("categoryid");
        $filterdataencode = $request->getParam("filterdata");
        $filterdata = base64_decode($filterdataencode);
        $pageId = $request->getParam("pageId");
        $service = $request->getParam("service");
        //$categoryid = $request->getParam("categoryid");
        $firstname = $request->getParam("firstname");
        $lastname = $request->getParam("lastname");
        $email = $request->getParam("email");
        $password = $request->getParam("password");
        $oldpassword = $request->getParam("oldpassword");
        $newpassword = $request->getParam("newpassword");
        $productid = $request->getParam("productid");
        $custid = $request->getParam("customerid");
        $billAdd = $request->getParam("billaddress");
        $shippAdd = $request->getParam("shippaddress");
        $pmethod = $request->getParam("paymentmethod");
        $smethod = $request->getParam("shipmethod");
        $transid = $request->getParam("transactionid");
        $product = $request->getParam("product");
        $shippCharge = $request->getParam("shippcharge");
        $search_data = $request->getParam("search_data");
        $username = $request->getParam("username");
        // Get Requested Data for Push Notification Request
        $deviceid = $request->getParam("deviceid");
        $pushtoken = $request->getParam("pushtoken");
        $platform = $request->getParam("platform");
        $appname = $request->getParam("appname");
        $description = $request->getParam("description");
        $profile = $request->getParam("profile");
        $paymentgateway = $request->getParam("paymentgateway");
        $couponCode = $request->getParam("couponCode");
        $orderid = $request->getParam("orderid");
        $pid = $request->getParam("pid");
        $products = $request->getParam("products");
        $address = $request->getParam("address");
        $country = $request->getParam("country");
        $grand_amount = $request->getParam("grandamount");
        $order_sub_amount = $request->getParam("subtotal_amount");
        $discount_amount = $request->getParam("discountamount");
        $mofluidpayaction = $request->getParam("mofluidpayaction");
        $postdata = $_POST;
        $mofluid_payment_mode = $request->getParam("mofluid_payment_mode");
        $product_id = $request->getParam("product_id");
        $gift_message = $request->getParam("message");
        $mofluid_paymentdata = $request->getParam("mofluid_paymentdata");
        $mofluid_ebs_pgdata = $request->getParam("DR");
        $curr_page = $request->getParam("currentpage");
        $page_size = $request->getParam("pagesize");
        $sortType = $request->getParam("sorttype");
        $sortOrder = $request->getParam("sortorder");
        $saveaction = $request->getParam("saveaction");
        $mofluid_orderid_unsecure = $request->getParam("mofluid_order_id");
        $currency = $request->getParam("currency");
        $price = $request->getParam("price");
        $from = $request->getParam("from");
        $to = $request->getParam("to");
        $is_create_quote = $request->getParam("is_create_quote");
        $find_shipping = $request->getParam("find_shipping");
        $messages = $request->getParam("messages");
        $theme = $request->getParam("theme");
        $timeslot = $request->getParam("timeslot");
        $billshipflag = $request->getParam("shipbillchoice");
        $customer_id = $request->getParam("customer_id");
        $apiKey = $request->getParam("apiKey");
        $token_id = $request->getParam("token_id");
        $card_id = $request->getParam("card_id");
        $mofluid_Custid = $request->getParam("mofluid_Custid");
        $discription = $request->getParam("discription");
        $name1 = $request->getParam("name");
        $shipping_id = $request->getParam("shipping_id");
        $qty = $request->getParam("qty");
        $cityid = $request->getParam("cityid");
        $inv_store = $request->getParam("inv_store");
        $instock = $request->getParam("instock");
        $currency = $request->getParam("currency");
        $payment_data = $request->getParam("payment_data");
        $q = $request->getParam("q");
        $search_type = $request->getParam("search_type");
        $cartproducts = $request->getParam("cartproducts");
        $cartaddress = $request->getParam("cartaddress");
        $city_id = $request->getParam("city_id");
        $payment_method = $request->getParam("payment_method");
        $shipping_date = $request->getParam("shipping_date");
        $shipping_carrier_code = $request->getParam("shipping_carrier_code");
        $shipping_method_code = $request->getParam("shipping_method_code");
        $cartsession_id = $request->getParam("cartsession_id");
        $cartregion_id = $request->getParam("cartregion_id");
        $order_payload = $request->getParam("orderpayload");
        $tip_option_id = $request->getParam("option_id");
        $tip_fee_id = $request->getParam("fee_id");
        $tip_amount_value = $request->getParam("amount_value");
        
        $store_credit = $request->getParam("store_credit");
        $couponCode = $request->getParam("coupon_code");
        $cartId = $request->getParam("quote_id");
        $isSubscribe = $request->getParam("issubscribe");
        $shippingDate = $request->getParam("shipping_date");
        $comment = addslashes($request->getParam("comment"));

        $delivery_type = $request->getParam("delivery_type");
        $delivery_date = $request->getParam("shipping_date");
        $slot_time = $request->getParam("slot_time");
        $slot_id = $request->getParam("slot_id");
        $slot_group = $request->getParam("slot_group");
        $name = base64_decode($name1);
        $zipcode = $request->getParam("zipcode");
        $stripe_token = $request->getParam("stripe_token");
        $slot_total = $request->getParam("slot_total");
        $isloggedIn = $request->getParam("is_logged_in");
        $save_card = $request->getParam("save_card");
        $isNew_card = $request->getParam("isNew_card");
        $srcID = $request->getParam("srcID");
        $action = $request->getParam("action");
        $order_type = $request->getParam("order_type");
        $is_pickup = $request->getParam("is_pickup");
        $store_id = $request->getParam("store_id");

        /**********************************************************/
              //API FOR STORE OWNER AND PICKER

        $orderState = $request->getParam("orderState");
        $orderStatus = $request->getParam("orderStatus");
        $picker_id = $request->getParam("picker_id");
        $itemstatus = $request->getParam("itemstatus");
        $product_sku = $request->getParam("product_sku");
        $order_quantity = $request->getParam("order_quantity");
        $quantity = $request->getParam("quantity");
        $taskfilter=$request->getParam("taskfilter");
        $update_msg=$request->getParam("update_msg");
        $old_product_id=$request->getParam("old_product_id");
        $old_product_sku=$request->getParam("old_product_sku");
        $reason = addslashes($request->getParam("reason"));
        $job_ids=$request->getParam("job_ids");
        $notification_ids=$request->getParam("notification_ids");
        $status=$request->getParam("status");
        $active=$request->getParam("active");
        $user_id=$request->getParam("user_id");
        $role=$request->getParam("role");
        $old_order_item_id=$request->getParam("old_order_item_id");
        $order_item_id=$request->getParam("order_item_id");
        $review_action=$request->getParam("review_action");
        $earning_type=$request->getParam("earning_type");
        $otp=$request->getParam("otp");
        $confirmpassword=$request->getParam("confirmpassword");
        $filterval=$request->getParam("filterval");
        $qr_codes=$request->getParam("qr_codes");
        $locker_no=$request->getParam("locker_no");
        $is_weighted=$request->getParam("is_weighted");
        $lat=$request->getParam("lat");
        $lng=$request->getParam("lng");
        $customerId=$request->getParam("customerId");
        $picker_extra_tip_percent=$request->getParam("picker_extra_tip_percent");
        $picker_extra_tip_amount=$request->getParam("picker_extra_tip_amount");

        $driver_extra_tip_percent=$request->getParam("driver_extra_tip_percent");
        $driver_extra_tip_amount=$request->getParam("driver_extra_tip_amount");
        $stripe_token=$request->getParam("stripe_token");
        $total_earning=$request->getParam("total_earning");
        $tip_amount=$request->getParam("tip_amount");
        $is_schedule=$request->getParam("is_schedule");
        $maxId = $request->getParam("max_id");

        $allparams = $request->getParams();
        $validate_routes=[
            'new_orders',
            'tasks',
            'order_details',
            'update_order_status',
            'update_order_product',
            'picker_order_packing',
            'search_data',
            'notifications',
            'notification_read',
            'logout',
            'get_drivers',
            'refresh_token',
            'assign_task',
            'get_pickers',
            'reassign_picker',
            'get_picker_checkin',
            'running_orders',
            'completed_orders',
            'all_orders',
            'delete_picker',
            'add_picker',
            'update_picker',
            'add_driver','update_driver',
            'user_detail',
            'get_pickers_list',
            'get_pickers_update_by_shopper_app',
            'timeslots',
            'picker_slots',
            'refund_review_items',
            'myearnings',
            'myearnings_orderdetails',
            'myearnings_taskdetails',
            'checkinUser',
            'updateLocation',
            'picker_detail',
            'picker_update_detail',
            'schedule_order_test',
            'asign_order_picker',
            'picker_order_status',
            'picker_first_slot',
            'assign_picker',
            'stores',
            'notification',
        ];

        /**********************************************************/

        //$currency='USD';
        $res = null;
        $mesg = "success";
        try {
            if ($service == "customerlist") {
                $res = $this->helper->ws_customerList($customerId);
                //echo $_GET["callback"].json_encode($res);
            }elseif($service == "stores"){
                $res = $this->common_helper->getAllStores();
            }elseif ($service == "sidecategory") {
                $res = $this->helper->ws_sidecategory($store, $service);
                //echo $_GET["callback"].json_encode($res);
            }elseif ($service == "getuseraddress") {
                $customerID = $request->getParam("customerID");
                $res = $this->helper->getCustomerAddressByID($customerID);
            } elseif ($service == "setnewaddress") {
                $customerID = $request->getParam("customerID");
                $new_address = $request->getParam("newaddress");
                $res = $this->helper->setNewAddressByCustomerID($customerID,$new_address);
            } elseif ($service == "deleteaddress") {
                $addressID = $request->getParam("addressID");
                $res = $this->helper->deleteAddressByID($addressID);
            } elseif ($service == "shippingslot") {
                $res = $this->helper->getShippingSlot($zipcode,$slot_total,$order_type);
            }elseif ($service == "preparecart") {
                $res = $this->helper->ws_PrepareCart($cartproducts, $cartaddress, $city_id, $inv_store, $payment_method, $shipping_date, $shipping_carrier_code, $shipping_method_code, $cartregion_id, $customer_id, $email, $cartsession_id, $store_credit, $delivery_date, $slot_time, $slot_id, $slot_group,$is_pickup,$store_id);
            } elseif ($service == "createorderfromcart") {
                $res = $this->helper->ws_createOrderFromCart($order_payload, $cartregion_id, $store, $currency, $customer_id, $cartsession_id, $comment, $shippingDate, $isSubscribe, $delivery_type, $delivery_date, $stripe_token, $email, $save_card, $isNew_card,$tip_fee_id,$tip_option_id,$tip_amount_value,$shipping_carrier_code, $shipping_method_code);
                //$region_id, $sessionId,$couponCode
            } elseif ($service == "region") {
                $res = $this->helper->getallRegion($store, $service, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "applycoupon") {
                $res = $this->helper->applyCouponOnCart($cartregion_id, $cartsession_id, $couponCode, $customer_id, $cartId);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "removecoupon") {
                $res = $this->helper->removeCouponFromCart($cartregion_id, $cartsession_id, $customer_id, $cartId);
            } elseif ($service == "cmspage") {
                $res = $this->helper->getallcmspage($store, $service, $currency, $q);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "initial") {
                $res = $this->helper->fetchInitialData($store, $service, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "initialnew") {
                $res = $this->helper->fetchNewInitialData($store, $service, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "getallCMSPages") {
                $res = $this->helper->getallCMSPages($store, $pageId);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "category") {
                $res = $this->helper->ws_category($store, $service);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "subcategory") {
                $res = $this->helper->ws_subcategory($store, $service, $categoryid);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "products") {
                $res = $this->helper->ws_products($store, $service, $categoryid, $curr_page, $page_size, $sortType, $sortOrder, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "newsearch") {
                if ($search_type == 'category') {
                    $res = $this->helper->ws_newcategroysearch($store, $service, $q, $curr_page, $page_size, $sortType, $sortOrder, $currency, $customer_id, $filterdata, $instock);
                }
                if ($search_type == 'freetxt') {
                    $res = $this->helper->ws_newsearchQuick($store, $service, $q, $curr_page, $page_size, $sortType, $sortOrder, $currency, $customer_id, $filterdata, $search_type, $instock);
                }
            } elseif ($service == "sudsearch") {

                if ($search_type == 'category') {
                    $res = $this->helper->ws_sud_newcategroysearch($store, $service, $q, $curr_page, $page_size, $sortType, $sortOrder, $currency, $filterdata, $instock);
                }
                if ($search_type == 'freetxt') {
                    $res = $this->helper->ws_newsearchQuick($store, $service, $q, $curr_page, $page_size, $sortType, $sortOrder, $currency, $filterdata, $search_type, $instock);
                }
            }elseif ($service == 'autosuggest') {
                $res = $this->helper->getAutoSuggest($q);
            } elseif ($service == "productdetaildescription") {
                $res = $this->helper->ws_productdetailDescription($store, $service, $productid, $currency, $customer_id);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "crossupsellrelated") {
                $res = $this->helper->getCrossUpSellRelatedProductsByProductId($store, $service, $productid, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "productdetaildescriptionrecipe") {
                $res = $this->helper->ws_productdetailDescriptionRecipe($store, $service, $productid, $currency);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "get_configurable_product_details_description") {
                $res = $this->helper->get_configurable_products_description($productid, $currency, $store);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "getFeaturedProducts") {
                $res = $this->helper->ws_getFeaturedProducts($currency, $service, $store);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "get_configurable_product_details_image") {
                $res = $this->helper->get_configurable_products_image($productid, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "getNewProducts") {
                $res = $this->helper->ws_getNewProducts($currency, $service, $store, $curr_page, $page_size, $sortType, $sortOrder);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "convert_currency") {
                $res = $this->helper->convert_currency($price, $from, $to);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "rootcategory") {
                $res = $this->helper->rootCategoryData($store, $service);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "createuser") {
                $res = $this->helper->ws_createuser($store, $service, $firstname, $lastname, $email, $password);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "customerinfo") {
                $res = $this->helper->ws_getCustomerInfo($custid, $store);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "myprofile") {
                $res = $this->helper->ws_myProfile($custid, $store);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "mofluidUpdateProfile") {
                $res = $this->helper->mofluidUpdateProfile($store, $service, $custid, $billAdd, $shippAdd, $profile, $billshipflag);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "changeprofilepassword") {
                $res = $this->helper->ws_changeProfilePassword($custid, $username, $oldpassword, $newpassword, $store);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "mofluidappcountry") {
                $res = $this->helper->ws_mofluidappcountry($store);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "mofluidappstates") {
                $res = $this->helper->ws_mofluidappstates($store, $country);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "productdetail") {
                $res = $this->helper->ws_productdetail($store, $service, $productid, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "register_push") {
                $res = $this->helper->mofluid_register_push($store, $deviceid, $pushtoken, $platform, $appname, $description);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "getallCMSPages") {
                $res = $this->helper->getallCMSPages($store, $pageId);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "productinfo") {
                //try {
                $res = $this->helper->ws_productinfo($store, $productid, $currency);
                //echo $_GET["callback"].json_encode($res);
                //}
                //catch (Exception $ex) {
                //echo 'Error' . $ex->getMessage();
                //}
            } elseif ($service == "productdetailimage") {
                $res = $this->helper->ws_productdetailImage($store, $service, $productid, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "storedetails") {
                $res = $this->helper->ws_storedetails($store, $service, $theme, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "verifylogin") {
                $res = $this->helper->ws_verifyLogin($store, $service, $username, $password);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "loginwithsocial") {
                $res = $this->helper->ws_loginwithsocial($store, $username, $firstname, $lastname);
                //echo $_GET["callback"]   . json_encode($res) ;
            } elseif ($service == "forgotPassword") {
                $res = $this->helper->ws_forgotPassword($email);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "search") {
                $res = $this->helper->ws_search($store, $service, $search_data, $curr_page, $page_size, $sortType, $sortOrder, $currency);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "getpaymentmethod") {
                $res = $this->helper->ws_getpaymentmethod();
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "productQuantity") {
                $res = $this->helper->ws_productQuantity($product);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "checkout") {
                $res = $this->helper->ws_checkout($store, $service, $theme, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "myorders") {
                $res = null; //$res = $this->helper->ws_myOrder($custid, $curr_page, $page_size, $store, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "listorders") {
                $res = $this->helper->ws_myOrderListByCustomerId($custid, $curr_page, $page_size, $store, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "orderdetails") {
                $res = $this->helper->ws_getOrderAndGetDetailsByOrderId($orderid, $curr_page, $page_size, $store, $currency);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "validatecartitem") {
                $res = $this->helper->validateInventory($products, $store, $inv_store, $cityid);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "preparequote") {
                $res = $this->helper->prepareQuote($custid, $products, $store, $inv_store, $cityid, $address, $smethod, $couponCode, $currency, $is_create_quote, $find_shipping, $theme);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "placeorder") {
                $res = $this->helper->placeorder($custid, $products, $store, $inv_store, $cityid, $address, $couponCode, $is_create_quote, $transid, $pmethod, $smethod, $currency, $messages, $theme, $shipping_id);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "validate_currency") {
                $res = $this->helper->ws_validatecurrency($store, $service, $currency, $paymentgateway);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "setaddress") {
                $res = $this->helper->ws_setaddress($store, $service, $custid, $address, $email, $saveaction);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "mofluid_reorder") {
                $res = $this->helper->ws_mofluid_reorder($store, $service, $pid, $orderid, $currency);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "filter") {
                $res = $this->helper->ws_filter($store, $service, $categoryid, $curr_page, $page_size, $sortType, $sortOrder, $currency, $filterdata);
                //echo $_GET["callback"].json_encode($res);
            } elseif ($service == "getcategoryfilter") {
                $res = $this->helper->ws_getcategoryfilter($store, $categoryid);
                //echo $_GET["callback"] . json_encode($res);
            } else if ($service == "getProductStock1") {
                $res = $this->helper->getProductStock1($store, $service, $product_id);
                //echo $_GET["callback"].json_encode($res);
            } else if ($service == "retrieveCustomerStripe") {
                $res = $this->helper->ws_retrieveCustomerStripe($customer_id);
                //echo $_GET["callback"] . json_encode($res);
            } else if ($service == "createCardStripe") {
                $res = $this->helper->ws_createCardStripe($customer_id, $token_id, $card_id);
                // echo $_GET["callback"] . json_encode($res);
            } else if ($service == "customerUpdateStripe") {
                $res = $this->helper->ws_customerUpdateStripe($customer_id, $discription);
                //echo $_GET["callback"] . json_encode($res);
            } else if ($service == "stripecustomercreate") {  // die('hii');
                $res = $this->helper->stripecustomercreate($mofluid_Custid, $token_id, $email, $name);
                //echo $_GET["callback"] . json_encode($res);
            } else if ($service == "chargeStripe") {
                $res = $this->helper->chargeStripe($customer_id, $price, $currency, $card_id);
                //echo $_GET["callback"] . json_encode($res);
            } else if ($service == "stripeData") {
                $res = $this->helper->stripeData();
                //echo $_GET["callback"] . json_encode($res);
            } else if ($service == "addCartItem") {
                $res = $this->helper->ws_addCartItem($store, $service, $custid, $product_id, $qty);
                //echo $_GET["callback"] . json_encode($res);
            } else if ($service == "authorizecheckout") {
                $res = $this->helper->authorizecheckout($payment_data);
                ///echo $_GET["callback"].json_encode($res);
            } else if ($service == "customeraddress") {
                $res = $this->helper->customerAddress($customer_id);
                ///echo $_GET["callback"].json_encode($res);
            } else if ($service == "recipeingredients") {
                $res = $this->helper->ws_recipeingredients($store, $service, $q, $curr_page, $page_size, $sortType, $sortOrder, $currency, $filterdata);
                ///echo $_GET["callback"].json_encode($res);
            } else if($service == 'notifyme'){
                $res = $this->helper->ws_notifyMe($isloggedIn, $custid, $product_id, $email);
            } else if ($service == "userwishlist") {
                $res = $this->helper->userWishlist($isloggedIn, $customer_id);

            } else if ($service == "addwishlistproduct") {
                $res = $this->helper->addWishlistproduct($isloggedIn, $customer_id, $product_id);

            } else if ($service == "removewishlistproduct") {
            $res = $this->helper->removeWishlistProduct($isloggedIn, $customer_id, $product_id);
            }
            else if ($service == "mysavedcard") {
            $res = $this->helper->mySavedCard($isloggedIn, $customer_id,$stripe_token);
            }
            else if ($service == "updatecard") {
            $res = $this->helper->updateCard($isloggedIn, $customer_id, $srcID, $action);
            }
            else if ($service == "configuration") {
            $res = $this->helper->configuration();
            }

            /**********************************************************/
                    //API FOR STORE OWNER AND PICKER


                        else if($service == "last_order"){
                               //$res = $this->helper-> getlastOrder($customer_id);
                                $res = $this->helper->getlastOrder($customer_id);
                         }
                         else if($service == "item_last_order"){
                               $res = $this->helper->getItemlastOrder($customer_id, $curr_page, $page_size);
                         }
                        else if($service == "tasks2"){
                            //$res = $this->helper->getPickerOrdersv2(3,$taskfilter,$curr_page, $page_size, $store, $currency);
                        }
                        elseif ($service == "debug_sms") {

                            $res =$this->common_helper->sendSMS(["text" => 'Test Message', "to" => ['+12127319863']]);



                        }
                        elseif ($service == "debug_push") {

                            $notification_params=[
                                'user_id'=>2,
                                'user_type'=>'picker',
                                'notification_type'=>'push',
                                'channel'=>$request->getParam("channel"),
                                'type'=>"new-order",
                                'subject'=>"New Order",
                                'message'=>"Hey, you got new order for packing",
                                'push_message'=>(object)   [
                                    "pn_apns" => [
                                        "aps" => [
                                            "alert" => "Hey, you got new order for packing",
                                            "badge"=>1,
                                            "sound" => "default"

                                        ],
                                        "notification_data" => [
                                            [
                                                "id" => "390",
                                                "user_id" => "2",
                                                "user_type" => "picker",
                                                "notification_type" => "normal",
                                                "type" => "new-order",
                                                "subject" => "New Delivery Order",
                                                "message" => "Hey, you got new Delivery order for packing",
                                                "token" => null,
                                                "channel" => null,
                                                "device_id" => null,
                                                "platform" => "ios",
                                                "readed" => "0",
                                                "updated_at" => "2020-08-06 13:07:03",
                                                "created_at" => "2020-08-06 13:07:03"
                                            ]
                                        ],
                                        "pn_push" => [
                                            [
                                                "targets" => [
                                                    [
                                                        "environment" => "development",
                                                        "topic" => "com.bravvura.PickNPackBeta"
                                                    ]
                                                ],
                                                "version" => "v2"
                                            ]
                                        ]
                                    ]
                                ]
                            ,
                                'platform'=>'ios',
                            ];


                            $res= $this->helper->pushNotification($notification_params);

                        }
                    elseif ($service == "login_user") {
                        return $this->common_helper->login($email,$password);
                        die;
                    }

                    elseif ($service == "order_item_review") {
                      $res= $this->helper->updateReviewOrderItem($orderid,$order_item_id,$review_action);//customer_reject,customer_accept,

                    }
                    elseif ($service == "extra_tips") {
                        $res= $this->helper->extraTip($stripe_token,$orderid,$store=1,$customer_id,$picker_extra_tip_percent,$picker_extra_tip_amount,$driver_extra_tip_percent,$driver_extra_tip_amount);//picker and driver


                    }
                    elseif ($service == "orderDetailsCustomer") {
                        $res = $this->helper->getOrderDetail(null,$orderid, $curr_page, $page_size, $store, $currency);

                    }
                    elseif ($service == "delivery_slots") {
                        $res = $this->common_helper->getDeliverySlots();

                    }
                    elseif ($service == "reset_password") {
                        return $this->common_helper->sendResetOtp($email);
                        die;
                    }
                    elseif ($service == "verify_otp") {
                        return $this->common_helper->verifyOtp($email,$otp);
                        die;
                    }
                    elseif ($service == "change_password") {
                        return $this->common_helper->changePassword($email,$otp,$newpassword,$confirmpassword);
                        die;
                    }
                    elseif ($service == "best_selling_brands") {
                        $res = $this->common_helper->bestSellingbrands();

                    }
                    elseif ($service == "best_selling_products") {
                        $res = $this->helper->bestSellingProducts($store, $service, $curr_page, $page_size, $sortType, $sortOrder, $currency);


                    }
                    elseif ($service == "previous_order_categories") {
                        $res = $this->helper->previousOrderedCategories($customer_id);

                    }
                    else if($service == "pickerlist"){
                        $res = $this->helper->getAllShopperListForOrderId($orderid);
                    }
                    else if($service == "getpickerdetailoforder"){
                                $res = $this->helper->getAssinedShopperDetails($orderid);
                    }
                    else if($service == "getdriverdetailoforder"){
                                $res = $this->helper->getAssinedDriverDetails($orderid);
                    }
                    elseif (in_array($service, $validate_routes)) {
                        $is_auth=$this->common_helper->isAuth($request->getHeader('Authorization'));

                        if($is_auth){
                             if($request->getHeader('lat') && $request->getHeader('lng')){
                                 $this->common_helper->updateLocation($is_auth['user_id'],$request->getHeader('lat'),$request->getHeader('lng'));

                             }

                            if($service == "refresh_token"){
                                 $res=$this->common_helper->isAuth($request->getHeader('Authorization'),1);
                            }
                            else if($service == "assign_task" && $is_auth['role']=='storeowner'){
                                $res = $this->helper->createDeliveryTask($request);
                            }
                            else if($service == "get_picker_checkin" && $is_auth['role']=='storeowner'){
                                $res = $this->helper->getPickerCheckin($picker_id,$maxId);
                            }
                            else if($service == "reassign_picker" && $is_auth['role']=='storeowner'){
                                $res = $this->helper->reassignOrderToPicker($orderid,$order_type,$picker_id,$total_earning,$tip_amount,$is_schedule);
                            }else if($service == "user_detail" && $is_auth['role']=='storeowner'){

                                $res = $this->common_helper->getUsersById($user_id,$role,$status,$active);

                            }else if($service == "get_drivers" && $is_auth['role']=='storeowner'){
                              //  $res = $this->helper->getDrivers();
                                $res = $this->common_helper->getUsersList('driver',$status,$active);

                            }else if($service == "assign_driver" && $is_auth['role']=='storeowner'){
                                $res = $this->helper->assignDrivers($job_ids);
                            }
                            else if($service == "all_orders" && $is_auth['role']=='storeowner'){
                                //$res = $this->helper->getOrdersList('all_orders',$request);
                                $res = $this->helper->getOrdersListNew('all_orders',$request);
                            }
                            else if($service == "new_orders" && $is_auth['role']=='storeowner'){
                                $res = $this->helper->getOrdersList('new_orders',$request);
                            }
                            else if($service == "running_orders" && $is_auth['role']=='storeowner'){
                                $res = $this->helper->getOrdersList('running_orders',$request);
                            }
                            else if($service == "completed_orders" && $is_auth['role']=='storeowner'){
                                $res = $this->helper->getOrdersList('completed_orders',$request);
                            }
                            elseif ($service == "tasks" && $is_auth['role']=='picker') {
                                // $customerID = $request->getParam("customerID");
                                $res = $this->helper->getPickerOrdersv2($is_auth['user_id'],$request,$curr_page, $page_size, $store, $currency);
                            }
                            elseif ($service == "order_details") {
                                $auth=$is_auth['role']=='picker'?$is_auth['user_id']:null;
                                $res = $this->helper->getOrderDetail($auth,$orderid, $curr_page, $page_size, $store, $currency);
                         
                            }
                            elseif ($service == "update_order_status") {
                                $picker_id=null;
                                
                                if($is_auth['role']=='picker'){
                                    $picker_id=$is_auth['user_id'];
                                }                               
                               
                                $res = $this->helper->updateOrderStatus($orderid,$orderState, $orderStatus,$picker_id,$update_msg,$qr_codes,$locker_no);
                            }
                            elseif ($service == "picker_order_status") {                                
                                $res = $this->helper->getPickerOrderStatus($orderid,$is_auth['user_id']);
                            }
                            elseif ($service == "update_order_product" && $is_auth['role']=='picker') {
                                $res = $this->helper->updateOrder($is_auth['user_id'],$orderid,$itemstatus,$product_sku,$order_quantity,$quantity,$product_id,$old_product_id,$old_product_sku,$comment,$reason,$old_order_item_id,$is_weighted);
                            }
                            elseif ($service == "movepicker_order_active") {
                                $res = $this->helper->moverPickerOrderToActiveOrder($orderid);
                            }
                            elseif ($service == "picker_order_packing" && $is_auth['role']=='picker') {
                                $res = $this->helper->pickerPackingHistory($is_auth['user_id'],$orderid);
                            }
                            elseif ($service == "refund_review_items" && $is_auth['role']=='picker') {
                                $res = $this->common_helper->refundTheReviewItems($is_auth['user_id'],$orderid);
                            }
                            elseif ($service == "search_data") {

                                if ($search_type == 'product') {
                                    $res = $this->helper->searchStoreData($store, $service, $q, $curr_page, $page_size, $sortType, $sortOrder, $currency, $customer_id, $filterdata, $search_type, $instock,$categoryid,$pid);
                                }
                            }
                            elseif ($service == "notifications" && $is_auth['role']=='picker') {
                                $res = $this->helper->getNotifications($is_auth['user_id']);
                            }
                            elseif ($service == "notification_read" && $is_auth['role']=='picker') {
                                $res = $this->common_helper->readNotification($is_auth['user_id'],$notification_ids);
                            }
                            elseif ($service == "get_pickers" && $is_auth['role']=='storeowner') {
                                $res = $this->common_helper->getUsersList('picker',$status,$active);
                            }
                            elseif ($service == "get_pickers_update_by_shopper_app" && $is_auth['role']=='storeowner') {
                                $res = $this->common_helper->getUsersListUpdateByShopperApp();
                            }
                            elseif ($service == "get_pickers_list" && $is_auth['role']=='storeowner') {
                                $res = $this->common_helper->getPickersList($status,$active);
                            }
                            elseif ($service == "delete_picker" && $is_auth['role']=='storeowner') {
                                $res = $this->common_helper->deletePicker($picker_id);
                            }
                            elseif ($service == "add_picker" && $is_auth['role']=='storeowner') {
                                $res = $this->common_helper->addPicker($allparams);
                            }
                            elseif ($service == "update_picker" && $is_auth['role']=='storeowner') {
                                $res = $this->common_helper->updatePicker($allparams);
                            }
                            elseif($service=='schedule_order_test'){
                                $res = $this->helper->scheduleTodayOrderTest($is_auth['user_id']);
                            }elseif($service=='asign_order_picker'){
                                $res = $this->helper->assignToPicker($is_auth['user_id']);
                            }
                            elseif ($service == "picker_detail" && $is_auth['role']=='picker') {
                                $res = $this->common_helper->getPickerDetail($is_auth['user_id']);
                            }
                            elseif ($service == "notification" && $is_auth['role']=='picker') {
                                $res = $this->helper->sendNotification($is_auth['user_id']);
                            }
                            elseif ($service == "assign_picker") {
                                $res = $this->helper->getPicker();
                            }
                            elseif ($service == "picker_first_slot") {
                                $res = $this->helper->getFirstSlotOfPickers();
                            }
                            elseif ($service == "picker_update_detail" && $is_auth['role']=='picker') {
                                $res = $this->common_helper->updatePickerDetail($is_auth['user_id'],$allparams);
                            }
                            
                            elseif ($service == "add_driver" && $is_auth['role']=='storeowner') {
                                $res = $this->common_helper->addDriver($allparams);
                            }
                            elseif ($service == "logout") {
                                $res = $this->common_helper->updateActive($is_auth['user_id'],0);
                            }
                            elseif ($service == "timeslots") {
                                $res = $this->common_helper->timeslotsPicker();
                            }

                            elseif ($service == "picker_slots") {
                                $res = $this->common_helper->getPickerSlots($picker_id);
                            }
                            elseif ($service == "myearnings" && $is_auth['role']=='picker') {

                            $res = $this->helper->myEarningsPicker($is_auth['user_id'],$earning_type);
                            }
                            elseif ($service == "myearnings_orderdetails" && $is_auth['role']=='picker') {
                                $res = $this->helper->taskOrderDetails($is_auth['user_id'],$orderid,$curr_page, $page_size, $store, $currency);
                            }
                            elseif ($service == "myearnings_taskdetails" && $is_auth['role']=='picker') {
                                $res = $this->helper->getTaskDetailOfPicker($is_auth['user_id'],$taskfilter,$filterval);
                            }
                            elseif ($service == "checkinUser") {
                                $res = $this->common_helper->checkinUser($is_auth['user_id']);
                            }
                            elseif ($service == "updateLocation") {
                                $res = $this->common_helper->updateLocation($is_auth['user_id'],$lat,$lng);
                            } 
                            elseif ($service == "update_driver" && $is_auth['role']=='storeowner') {
                                $res = $this->common_helper->updateDriver($allparams);
                            }
                           // $this->common_helper->insertTheFees($base_total_amount, $total_amount, $fee_label="Shopper's Tip", $fee_option_label="Shopper's Tip (10%)", $order_id, $fee_id, $option_id)


                            else{
                                $mesg = "unauthorized";
                                echo $this->formatOutput(null, null, null, false, $mesg);
                                return;
                            }
                        }else{

                            $mesg = "unauthorized";
                            echo $this->formatOutput(null, null, null, false, $mesg);
                            return;
                        }


                    }

            /**********************************************************/
            else {
                $_GET["callback"] = isset($_GET["callback"])?$_GET["callback"]:null;
                $mesg = 'Error :- 404';
                $res = $this->ws_service404($service);
                echo $this->formatOutput($_GET["callback"], $res, Null, false, $mesg,$service);
                return;
            }

            echo $this->formatOutput($_GET["callback"], $res, Null, true, $mesg);
            exit;
        } catch (Exception $ex) {
            //echo 'Error' . $ex->getMessage();
            $mesg = 'Error' . $ex->getMessage();
            echo $this->formatOutput($_GET["callback"], $data, Null, false, $mesg);
            return;
        }
    }

    private function formatOutput($callBack, $data, $errorCode = Null, $success = true, $mesg = null) {
        $array = array('metadata' =>
            array('success' => $success, 'errorCode' => $errorCode, 'message' => $mesg)
            , 'payload' =>
            array('data' => $data)
        );
        return $callBack . json_encode($array);
    }

    /* =====================      Handle When Store Not Found      ========================= */

    public function ws_store404($store) {
        return 'Store 404 Error :  Store ' . $store . ' is not found on your host ';
    }

    /* =====================      Handle When Service Not Found      ========================= */

    public function ws_service404($service) {
        if ($service == "" || $service == null)
            return 'Service 404 Error :  No Such Web Service found under Mofluid APIs at your domain';
        else
            return 'Service 404 Error : ' . $service . ' Web Service is not found under Mofluid APIs at your domain';

            //changes
    }

}