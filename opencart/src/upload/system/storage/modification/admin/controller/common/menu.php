<?php
class ControllerCommonMenu extends Controller {

                public function getHtml($arrKey, $arrVal, $permissions, $html) {
                    $show = false;
                    if(is_array($arrVal)) {
                        $html = $html.'<li><a class="parent">'.$this->language->get($arrKey).'</a><ul>';
                        foreach ($arrVal as $key => $value) {
                            if (is_array($value)) {
                                $html = $this->getHtml($key, $value, $permissions, $html);
                            } else {
                                if (in_array($key, $permissions)) {
                                    $show = true;
                                    $html = $html.'<li><a href="'.$this->url->link($key, 'token=' . $this->session->data['token'], 'SSL').'">'.$this->language->get($value).'</a></li>';
                                }
                            }
                        }
                        $html = $html.'</ul></li>';
                    } elseif (in_array($arrKey, $permissions)) {
             
                        $show = true;
                        $html = $html.'<li><a href="'.$this->url->link($arrKey, 'token=' . $this->session->data['token'], 'SSL').'">'.$this->language->get($arrVal).'</a></li>';
                    }

                    if ($show) {
                        return $html;
                    }

                }

                public function is_in_permission($arr, $permissions) {
                    foreach ($arr as $key => $value) {
                        if (is_array($value)) {
                            return $this->is_in_permission($value, $permissions);
                        } elseif (in_array($key, $permissions)) {
                            return true;
                        }
                    }
                    return false;
                }

                public function simpleGetHtml($ProductArr, $permissions) {
                    $html = '';
                    foreach ($ProductArr as $key => $value) {
                        $html = $html. $this->getHtml($key, $value, $permissions, '');
                    }
                    return $html;
                }

            
	public function index() {
		$this->load->language('common/menu');

		$data['text_analytics'] = $this->language->get('text_analytics');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_api'] = $this->language->get('text_api');
		$data['text_attribute'] = $this->language->get('text_attribute');
		$data['text_attribute_group'] = $this->language->get('text_attribute_group');
		$data['text_backup'] = $this->language->get('text_backup');
		$data['text_banner'] = $this->language->get('text_banner');
		$data['text_captcha'] = $this->language->get('text_captcha');
		$data['text_catalog'] = $this->language->get('text_catalog');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_country'] = $this->language->get('text_country');
		$data['text_coupon'] = $this->language->get('text_coupon');
		$data['text_currency'] = $this->language->get('text_currency');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_customer_group'] = $this->language->get('text_customer_group');
		$data['text_customer_field'] = $this->language->get('text_customer_field');
		$data['text_custom_field'] = $this->language->get('text_custom_field');
		$data['text_sale'] = $this->language->get('text_sale');
		$data['text_paypal'] = $this->language->get('text_paypal');
		$data['text_paypal_search'] = $this->language->get('text_paypal_search');
		$data['text_design'] = $this->language->get('text_design');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_error_log'] = $this->language->get('text_error_log');
		$data['text_extension'] = $this->language->get('text_extension');
		$data['text_feed'] = $this->language->get('text_feed');
		$data['text_fraud'] = $this->language->get('text_fraud');
		$data['text_filter'] = $this->language->get('text_filter');
		$data['text_geo_zone'] = $this->language->get('text_geo_zone');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_installer'] = $this->language->get('text_installer');
		$data['text_language'] = $this->language->get('text_language');
		$data['text_layout'] = $this->language->get('text_layout');
		$data['text_localisation'] = $this->language->get('text_localisation');
		$data['text_location'] = $this->language->get('text_location');
		$data['text_marketing'] = $this->language->get('text_marketing');
		$data['text_modification'] = $this->language->get('text_modification');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_module'] = $this->language->get('text_module');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_order_status'] = $this->language->get('text_order_status');
		$data['text_opencart'] = $this->language->get('text_opencart');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_reports'] = $this->language->get('text_reports');
		$data['text_report_sale_order'] = $this->language->get('text_report_sale_order');
		$data['text_report_sale_tax'] = $this->language->get('text_report_sale_tax');
		$data['text_report_sale_shipping'] = $this->language->get('text_report_sale_shipping');
		$data['text_report_sale_return'] = $this->language->get('text_report_sale_return');
		$data['text_report_sale_coupon'] = $this->language->get('text_report_sale_coupon');
		$data['text_report_sale_return'] = $this->language->get('text_report_sale_return');
		$data['text_report_product_viewed'] = $this->language->get('text_report_product_viewed');
		$data['text_report_product_purchased'] = $this->language->get('text_report_product_purchased');
		$data['text_report_customer_activity'] = $this->language->get('text_report_customer_activity');
		$data['text_report_customer_online'] = $this->language->get('text_report_customer_online');
		$data['text_report_customer_order'] = $this->language->get('text_report_customer_order');
		$data['text_report_customer_reward'] = $this->language->get('text_report_customer_reward');
		$data['text_report_customer_credit'] = $this->language->get('text_report_customer_credit');
		$data['text_report_customer_order'] = $this->language->get('text_report_customer_order');
		$data['text_report_affiliate'] = $this->language->get('text_report_affiliate');
		$data['text_report_affiliate_activity'] = $this->language->get('text_report_affiliate_activity');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_return_action'] = $this->language->get('text_return_action');
		$data['text_return_reason'] = $this->language->get('text_return_reason');
		$data['text_return_status'] = $this->language->get('text_return_status');
		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_setting'] = $this->language->get('text_setting');
		$data['text_stock_status'] = $this->language->get('text_stock_status');
		$data['text_system'] = $this->language->get('text_system');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_tax_class'] = $this->language->get('text_tax_class');
		$data['text_tax_rate'] = $this->language->get('text_tax_rate');
		$data['text_tools'] = $this->language->get('text_tools');
		$data['text_total'] = $this->language->get('text_total');
		$data['text_upload'] = $this->language->get('text_upload');
		$data['text_tracking'] = $this->language->get('text_tracking');
		$data['text_user'] = $this->language->get('text_user');
		$data['text_user_group'] = $this->language->get('text_user_group');
		$data['text_users'] = $this->language->get('text_users');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_voucher_theme'] = $this->language->get('text_voucher_theme');
		$data['text_weight_class'] = $this->language->get('text_weight_class');
		$data['text_length_class'] = $this->language->get('text_length_class');
		$data['text_zone'] = $this->language->get('text_zone');
		$data['text_recurring'] = $this->language->get('text_recurring');
		$data['text_order_recurring'] = $this->language->get('text_order_recurring');
		$data['text_openbay_extension'] = $this->language->get('text_openbay_extension');
		$data['text_openbay_dashboard'] = $this->language->get('text_openbay_dashboard');
		$data['text_openbay_orders'] = $this->language->get('text_openbay_orders');
		$data['text_openbay_items'] = $this->language->get('text_openbay_items');
		$data['text_openbay_ebay'] = $this->language->get('text_openbay_ebay');
		$data['text_openbay_etsy'] = $this->language->get('text_openbay_etsy');
		$data['text_openbay_amazon'] = $this->language->get('text_openbay_amazon');
		$data['text_openbay_amazonus'] = $this->language->get('text_openbay_amazonus');
		$data['text_openbay_settings'] = $this->language->get('text_openbay_settings');
		$data['text_openbay_links'] = $this->language->get('text_openbay_links');
		$data['text_openbay_report_price'] = $this->language->get('text_openbay_report_price');
		$data['text_openbay_order_import'] = $this->language->get('text_openbay_order_import');

		$data['analytics'] = $this->url->link('extension/analytics', 'token=' . $this->session->data['token'], 'SSL');
		$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
		$data['affiliate'] = $this->url->link('marketing/affiliate', 'token=' . $this->session->data['token'], 'SSL');
		$data['api'] = $this->url->link('user/api', 'token=' . $this->session->data['token'], 'SSL');
		$data['attribute'] = $this->url->link('catalog/attribute', 'token=' . $this->session->data['token'], 'SSL');
		$data['attribute_group'] = $this->url->link('catalog/attribute_group', 'token=' . $this->session->data['token'], 'SSL');
		$data['backup'] = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');
		$data['banner'] = $this->url->link('design/banner', 'token=' . $this->session->data['token'], 'SSL');
		$data['captcha'] = $this->url->link('extension/captcha', 'token=' . $this->session->data['token'], 'SSL');
		$data['category'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'], 'SSL');
		$data['country'] = $this->url->link('localisation/country', 'token=' . $this->session->data['token'], 'SSL');
		$data['contact'] = $this->url->link('marketing/contact', 'token=' . $this->session->data['token'], 'SSL');
		$data['coupon'] = $this->url->link('marketing/coupon', 'token=' . $this->session->data['token'], 'SSL');
		$data['currency'] = $this->url->link('localisation/currency', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer_fields'] = $this->url->link('customer/customer_field', 'token=' . $this->session->data['token'], 'SSL');
		$data['customer_group'] = $this->url->link('customer/customer_group', 'token=' . $this->session->data['token'], 'SSL');
		$data['custom_field'] = $this->url->link('customer/custom_field', 'token=' . $this->session->data['token'], 'SSL');
		$data['download'] = $this->url->link('catalog/download', 'token=' . $this->session->data['token'], 'SSL');
		$data['error_log'] = $this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL');
		$data['feed'] = $this->url->link('extension/feed', 'token=' . $this->session->data['token'], 'SSL');
		$data['filter'] = $this->url->link('catalog/filter', 'token=' . $this->session->data['token'], 'SSL');
		$data['fraud'] = $this->url->link('extension/fraud', 'token=' . $this->session->data['token'], 'SSL');
		$data['geo_zone'] = $this->url->link('localisation/geo_zone', 'token=' . $this->session->data['token'], 'SSL');
		$data['information'] = $this->url->link('catalog/information', 'token=' . $this->session->data['token'], 'SSL');
		$data['installer'] = $this->url->link('extension/installer', 'token=' . $this->session->data['token'], 'SSL');
		$data['language'] = $this->url->link('localisation/language', 'token=' . $this->session->data['token'], 'SSL');
		$data['layout'] = $this->url->link('design/layout', 'token=' . $this->session->data['token'], 'SSL');
		$data['location'] = $this->url->link('localisation/location', 'token=' . $this->session->data['token'], 'SSL');
		$data['modification'] = $this->url->link('extension/modification', 'token=' . $this->session->data['token'], 'SSL');
		$data['manufacturer'] = $this->url->link('catalog/manufacturer', 'token=' . $this->session->data['token'], 'SSL');
		$data['marketing'] = $this->url->link('marketing/marketing', 'token=' . $this->session->data['token'], 'SSL');
		$data['module'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		$data['option'] = $this->url->link('catalog/option', 'token=' . $this->session->data['token'], 'SSL');
		$data['order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL');
		$data['order_status'] = $this->url->link('localisation/order_status', 'token=' . $this->session->data['token'], 'SSL');
		$data['payment'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		$data['paypal_search'] = $this->url->link('payment/pp_express/search', 'token=' . $this->session->data['token'], 'SSL');
		$data['product'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_order'] = $this->url->link('report/sale_order', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_tax'] = $this->url->link('report/sale_tax', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_shipping'] = $this->url->link('report/sale_shipping', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_return'] = $this->url->link('report/sale_return', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_sale_coupon'] = $this->url->link('report/sale_coupon', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_product_viewed'] = $this->url->link('report/product_viewed', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_product_purchased'] = $this->url->link('report/product_purchased', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_activity'] = $this->url->link('report/customer_activity', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_online'] = $this->url->link('report/customer_online', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_order'] = $this->url->link('report/customer_order', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_reward'] = $this->url->link('report/customer_reward', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_customer_credit'] = $this->url->link('report/customer_credit', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_marketing'] = $this->url->link('report/marketing', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_affiliate'] = $this->url->link('report/affiliate', 'token=' . $this->session->data['token'], 'SSL');
		$data['report_affiliate_activity'] = $this->url->link('report/affiliate_activity', 'token=' . $this->session->data['token'], 'SSL');
		$data['review'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'], 'SSL');
		$data['return'] = $this->url->link('sale/return', 'token=' . $this->session->data['token'], 'SSL');
		$data['return_action'] = $this->url->link('localisation/return_action', 'token=' . $this->session->data['token'], 'SSL');
		$data['return_reason'] = $this->url->link('localisation/return_reason', 'token=' . $this->session->data['token'], 'SSL');
		$data['return_status'] = $this->url->link('localisation/return_status', 'token=' . $this->session->data['token'], 'SSL');
		$data['shipping'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
		$data['setting'] = $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL');
		$data['stock_status'] = $this->url->link('localisation/stock_status', 'token=' . $this->session->data['token'], 'SSL');
		$data['tax_class'] = $this->url->link('localisation/tax_class', 'token=' . $this->session->data['token'], 'SSL');
		$data['tax_rate'] = $this->url->link('localisation/tax_rate', 'token=' . $this->session->data['token'], 'SSL');
		$data['total'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');
		$data['upload'] = $this->url->link('tool/upload', 'token=' . $this->session->data['token'], 'SSL');
		$data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
		$data['user_group'] = $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], 'SSL');
		$data['voucher'] = $this->url->link('sale/voucher', 'token=' . $this->session->data['token'], 'SSL');
		$data['voucher_theme'] = $this->url->link('sale/voucher_theme', 'token=' . $this->session->data['token'], 'SSL');
		$data['weight_class'] = $this->url->link('localisation/weight_class', 'token=' . $this->session->data['token'], 'SSL');
		$data['length_class'] = $this->url->link('localisation/length_class', 'token=' . $this->session->data['token'], 'SSL');
		$data['zone'] = $this->url->link('localisation/zone', 'token=' . $this->session->data['token'], 'SSL');
		$data['recurring'] = $this->url->link('catalog/recurring', 'token=' . $this->session->data['token'], 'SSL');
		$data['order_recurring'] = $this->url->link('sale/recurring', 'token=' . $this->session->data['token'], 'SSL');

		$data['openbay_show_menu'] = $this->config->get('openbaypro_menu');
		$data['openbay_link_extension'] = $this->url->link('extension/openbay', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_orders'] = $this->url->link('extension/openbay/orderlist', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_items'] = $this->url->link('extension/openbay/items', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_ebay'] = $this->url->link('openbay/ebay', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_ebay_settings'] = $this->url->link('openbay/ebay/settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_ebay_links'] = $this->url->link('openbay/ebay/viewitemlinks', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_etsy'] = $this->url->link('openbay/etsy', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_etsy_settings'] = $this->url->link('openbay/etsy/settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_etsy_links'] = $this->url->link('openbay/etsy_product/links', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_ebay_orderimport'] = $this->url->link('openbay/ebay/vieworderimport', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazon'] = $this->url->link('openbay/amazon', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazon_settings'] = $this->url->link('openbay/amazon/settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazon_links'] = $this->url->link('openbay/amazon/itemlinks', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazonus'] = $this->url->link('openbay/amazonus', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazonus_settings'] = $this->url->link('openbay/amazonus/settings', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_link_amazonus_links'] = $this->url->link('openbay/amazonus/itemlinks', 'token=' . $this->session->data['token'], 'SSL');
		$data['openbay_markets'] = array(
			'ebay' => $this->config->get('ebay_status'),
			'amazon' => $this->config->get('openbay_amazon_status'),
			'amazonus' => $this->config->get('openbay_amazonus_status'),
			'etsy' => $this->config->get('etsy_status'),
		);


                //catalog------------------------------------
                $data['data_catalog'] = array(
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
                //extension------------------------------------
                $data['data_extension'] = array(
                    'extension/installer' => 'text_installer',
                    'extension/modification' => 'text_modification',
                    'extension/analytics' => 'text_analytics',
                    'extension/captcha' => 'text_captcha',
                    'extension/feed' => 'text_feed',
                    'extension/fraud' => 'text_fraud',
                    'extension/module' => 'text_module',
                    'extension/payment' => 'text_payment',
                    'extension/shipping' => 'text_shipping',
                    'extension/total' => 'text_total'
                );
                //design------------------------------------
                $data['data_design'] = array(
                    'design/layout' => 'text_layout',
                    'design/banner' => 'text_banner'
                );
                //sale------------------------------------
                $data['data_sale'] = array(
                    'sale/return' => 'text_return',
                    'sale/order' => 'text_order',
                    'sale/recurring' => 'text_order_recurring',
                    'text_voucher' => array(
                        'sale/voucher' => 'text_voucher',
                        'sale/voucher_theme' => 'text_voucher_theme'
                        ),
                    'text_paypal' => array(
                        'payment/pp_express' => 'text_paypal_search'
                        )
                );
                //customers------------------------------------
                $data['data_customers'] = array(
                    'customer/customer' => 'text_customer',
                    'customer/customer_group' => 'text_customer_group',
                    'customer/custom_field' => 'text_custom_field'
                );
                //marketing------------------------------------
                $data['data_marketing'] = array(
                    'marketing/marketing' => 'text_marketing',
                    'marketing/affiliate' => 'text_affiliate',
                    'marketing/coupon' => 'text_coupon',
                    'marketing/contact' => 'text_contact'
                );
                //system------------------------------------
                $data['data_system_setting'] = array(
                    'setting/store' => 'text_setting',
                    'text_users' => array(
                        'user/user' => 'text_user',
                        'user/user_permission' => 'text_user_group',
                        'user/api' => 'text_api'
                    ),
                    'text_localisation' => array(
                        'localisation/location' => 'text_location',
                        'localisation/language' => 'text_language',
                        'localisation/currency' => 'text_currency',
                        'localisation/stock_status' => 'text_stock_status',
                        'localisation/order_status' => 'text_order_status',
                        'text_return' => array(
                            'localisation/return_status' => 'text_return_status',
                            'localisation/return_action' => 'text_return_action',
                            'localisation/return_reason' => 'text_return_reason'
                        ),
                        'localisation/country' => 'text_country',
                        'localisation/zone' => 'text_zone',
                        'localisation/geo_zone' => 'text_geo_zone',
                        'text_tax' => array(
                            'localisation/tax_class'  => 'text_tax_class',
                            'localisation/tax_rate' => 'text_tax_rate'
                        ),
                        'localisation/length_class' => 'text_length_class',
                        'localisation/weight_class' => 'text_weight_class'
                    ),
                    'text_tools' => array(
                        'tool/upload' => 'text_upload',
                        'tool/backup' => 'text_backup',
                        'tool/error_log' => 'text_error_log'
                    )
                );
                //reports------------------------------------
                $data['data_report'] = array(
                    'text_sale' => array(
                        'report/sale_order' => 'text_report_sale_order',
                        'report/sale_tax' => 'text_report_sale_tax',
                        'report/sale_shipping' => 'text_report_sale_shipping',
                        'report/sale_return' => 'text_report_sale_return',
                        'report/sale_coupon' => 'text_report_sale_coupon'
                    ),
                    'text_product' => array(
                        'report/product_viewed' => 'text_report_product_viewed',
                        'report/product_purchased' => 'text_report_product_purchased'
                    ),
                    'text_customer' => array(
                        'report/customer_online' => 'text_report_customer_online',
                        'report/customer_activity' => 'text_report_customer_activity',
                        'report/customer_order' => 'text_report_customer_order',
                        'report/customer_reward' => 'text_report_customer_reward',
                        'report/customer_credit' => 'text_report_customer_credit'
                    ),
                    'text_marketing' => array(
                        'report/marketing' => 'text_marketing',
                        'report/affiliate' => 'text_report_affiliate',
                        'report/affiliate_activity' => 'text_report_affiliate_activity'
                    )
                );
                if (isset($this->user->getPermissions()['access'])) {
                    $data['permissions'] = $this->user->getPermissions()['access'];
                } else {
                    $data['permissions'] = array();
                }
                //show menu or not
                $data['show_catalog'] = $this->is_in_permission($data['data_catalog'], $data['permissions']);
                $data['show_extension'] = $this->is_in_permission($data['data_extension'], $data['permissions']);
                $data['show_design'] = $this->is_in_permission($data['data_design'], $data['permissions']);
                $data['show_sale'] = $this->is_in_permission($data['data_sale'], $data['permissions']);
                $data['show_customers'] = $this->is_in_permission($data['data_customers'], $data['permissions']);
                $data['show_marketing'] = $this->is_in_permission($data['data_marketing'], $data['permissions']);
                $data['show_system'] = $this->is_in_permission($data['data_system_setting'], $data['permissions']);
                $data['show_report'] = $this->is_in_permission($data['data_report'], $data['permissions']);
                
                //menu's html
                $data['catalog_html'] = $this->simpleGetHtml($data['data_catalog'], $data['permissions']);
                $data['extension_html'] = $this->simpleGetHtml($data['data_extension'], $data['permissions']);
                $data['design_html'] = $this->simpleGetHtml($data['data_design'], $data['permissions']);
                $data['sale_html'] = $this->simpleGetHtml($data['data_sale'], $data['permissions']);
                $data['customers_html'] = $this->simpleGetHtml($data['data_customers'], $data['permissions']);
                $data['marketing_html'] = $this->simpleGetHtml($data['data_marketing'], $data['permissions']);
                $data['system_setting_html'] = $this->simpleGetHtml($data['data_system_setting'], $data['permissions']);
                $data['report_html'] = $this->simpleGetHtml($data['data_report'], $data['permissions']);
            
		return $this->load->view('common/menu.tpl', $data);
	}
}
