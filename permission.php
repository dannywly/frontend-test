<?php
$permissions = array(
    "access" => array(
        "analytics/google_analytics",
        "captcha/basic_captcha",
        "captcha/google_captcha",
        "catalog/attribute",
        "catalog/attribute_group",
        "catalog/category",
        "catalog/download",
        "catalog/filter",
        "catalog/information",
        "catalog/manufacturer",
        "catalog/option",
        "catalog/product",
        "catalog/recurring",
        "catalog/review",
        "common/column_left",
        "common/filemanager",
        "common/menu",
        "common/profile",
        "common/sass",
        "common/stats",
        "customer/custom_field",
        "customer/customer",
        "customer/customer_group",
        "design/banner",
        "design/layout",
        "extension/analytics",
        "extension/captcha",
        "extension/feed",
        "extension/fraud",
        "extension/installer",
        "extension/modification",
        "extension/module",
        "extension/openbay",
        "extension/payment",
        "extension/shipping",
        "extension/total",
        "feed/google_base",
        "feed/google_sitemap",
        "feed/openbaypro",
        "fraud/fraudlabspro",
        "fraud/ip",
        "fraud/maxmind",
        "localisation/country",
        "localisation/currency",
        "localisation/geo_zone",
        "localisation/language",
        "localisation/length_class",
        "localisation/location",
        "localisation/order_status",
        "localisation/return_action",
        "localisation/return_reason",
        "localisation/return_status",
        "localisation/stock_status",
        "localisation/tax_class",
        "localisation/tax_rate",
        "localisation/weight_class",
        "localisation/zone",
        "marketing/affiliate",
        "marketing/contact",
        "marketing/coupon",
        "marketing/marketing",
        "module/account",
        "module/affiliate",
        "module/amazon_login",
        "module/amazon_pay",
        "module/banner",
        "module/bestseller",
        "module/carousel",
        "module/category",
        "module/ebay_listing",
        "module/featured",
        "module/filter",
        "module/google_hangouts",
        "module/html",
        "module/information",
        "module/latest",
        "module/pp_button",
        "module/pp_login",
        "module/slideshow",
        "module/special",
        "module/store",
        "openbay/amazon",
        "openbay/amazon_listing",
        "openbay/amazon_product",
        "openbay/amazonus",
        "openbay/amazonus_listing",
        "openbay/amazonus_product",
        "openbay/ebay",
        "openbay/ebay_profile",
        "openbay/ebay_template",
        "openbay/etsy",
        "openbay/etsy_product",
        "openbay/etsy_shipping",
        "openbay/etsy_shop",
        "payment/amazon_login_pay",
        "payment/authorizenet_aim",
        "payment/authorizenet_sim",
        "payment/bank_transfer",
        "payment/bluepay_hosted",
        "payment/bluepay_redirect",
        "payment/cheque",
        "payment/cod",
        "payment/firstdata",
        "payment/firstdata_remote",
        "payment/free_checkout",
        "payment/g2apay",
        "payment/globalpay",
        "payment/globalpay_remote",
        "payment/klarna_account",
        "payment/klarna_invoice",
        "payment/liqpay",
        "payment/nochex",
        "payment/paymate",
        "payment/paypoint",
        "payment/payza",
        "payment/perpetual_payments",
        "payment/pp_express",
        "payment/pp_payflow",
        "payment/pp_payflow_iframe",
        "payment/pp_pro",
        "payment/pp_pro_iframe",
        "payment/pp_standard",
        "payment/realex",
        "payment/realex_remote",
        "payment/sagepay_direct",
        "payment/sagepay_server",
        "payment/sagepay_us",
        "payment/securetrading_pp",
        "payment/securetrading_ws",
        "payment/skrill",
        "payment/twocheckout",
        "payment/web_payment_software",
        "payment/worldpay",
        "report/affiliate",
        "report/affiliate_activity",
        "report/affiliate_login",
        "report/customer_activity",
        "report/customer_credit",
        "report/customer_login",
        "report/customer_online",
        "report/customer_order",
        "report/customer_reward",
        "report/marketing",
        "report/product_purchased",
        "report/product_viewed",
        "report/sale_coupon",
        "report/sale_order",
        "report/sale_return",
        "report/sale_shipping",
        "report/sale_tax",
        "sale/order",
        "sale/recurring",
        "sale/return",
        "sale/voucher",
        "sale/voucher_theme",
        "setting/setting",
        "setting/store",
        "shipping/auspost",
        "shipping/citylink",
        "shipping/fedex",
        "shipping/flat",
        "shipping/free",
        "shipping/item",
        "shipping/parcelforce_48",
        "shipping/pickup",
        "shipping/royal_mail",
        "shipping/ups",
        "shipping/usps",
        "shipping/weight",
        "tool/backup",
        "tool/error_log",
        "tool/upload",
        "total/coupon",
        "total/credit",
        "total/handling",
        "total/klarna_fee",
        "total/low_order_fee",
        "total/reward",
        "total/shipping",
        "total/sub_total",
        "total/tax",
        "total/total",
        "total/voucher",
        "user/api",
        "user/user",
        "user/user_permission",
        "module/affiliate"
    )
);

$catalog = array(
        'catalog/category' => 'text_category', 
        'catalog/download' => 'text_download',
        'catalog/filter' => 'text_filter',
        'catalog/information' => 'text_information',
        'catalog/manufacturer' => 'text_manufacturer',
        'catalog/option' => 'text_option',
        'catalog/product' => 'text_product',
        'catalog/review' => 'text_review',
        'catalog/recurring' => 'text_recurring',
        'text_attribute' => array(
                    'catalog/attribute' => 'text_attribute',
                    'catalog/attribute_group' => 'text_attribute_group'
                    )
        );

echo var_dump($catalog);
 $html = $html.'<li><a href="<?php echo $'.$temp.'; ?>">"<?php echo $'.$arrVal.'; ?>"</a></li>'

foreach ($variable as $key => $value) {
    
}
 public function getHtml($arrKey, $arrVal, $permissions, $html) {
    $show = false;
    if(is_array($arrVal)) {
        $html . '<li><a class="parent"><?php echo $arrKey; ?></a><ul>';
        foreach ($arrVal as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key1 => $value1) {
                    $html = $html.$this->getHtml($key1, $value1, $permissions, $html);
                }
            }
            if (in_array($key, $permissions)) {
                $show = true;
                $temp = explode('/', $key)[1];
                $html = $html. '<li><a href="<?php echo $temp; ?>"><?php echo $value; ?></a></li>';
            }
        }
        $html . '</ul></li>';
    } elseif (in_array($arrKey, $permissions)) {
        $show = true;
        $temp = explode('/', $arrKey)[1];
        $html = $html.'<li><a href="<?php echo $'.$temp.'; ?>">"<?php echo $'.$arrVal.'; ?>"</a></li>';
    }
    if ($show) {
        return $html;
    }
}

                        $html = $html.'<li><a href="'.$$temp.'">"<?php echo $'.$arrVal.'; ?>"</a></li>';
$html = $html.'<li><a href="'.$this->url->link($arrKey, 'token=' . $this->session->data['token'], 'SSL');.'">'.$this->language->get($arrVal);.'</a></li>';
$html = $html.'<li><a class="parent">'.$this->language->get($arrVal).'</a><ul>';