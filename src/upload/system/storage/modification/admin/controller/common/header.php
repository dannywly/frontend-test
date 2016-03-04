<?php
class ControllerCommonHeader extends Controller {

                public function is_in_permission($val, $permissions) {
                    if (in_array($val, $permissions)) {
                        return true;
                    }
                    return false;
                }
            
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$this->load->language('common/header');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_order'] = $this->language->get('text_order');
		$data['text_processing_status'] = $this->language->get('text_processing_status');
		$data['text_complete_status'] = $this->language->get('text_complete_status');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_online'] = $this->language->get('text_online');
		$data['text_approval'] = $this->language->get('text_approval');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_front'] = $this->language->get('text_front');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_homepage'] = $this->language->get('text_homepage');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
		$data['text_logout'] = $this->language->get('text_logout');

		if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
			$data['logged'] = '';

			$data['home'] = $this->url->link('common/dashboard', '', 'SSL');
		} else {
			$data['logged'] = true;

			$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
			$data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');

			// Orders
			$this->load->model('sale/order');

			// Processing Orders
			$data['processing_status_total'] = $this->model_sale_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_processing_status'))));
			$data['processing_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&filter_order_status=' . implode(',', $this->config->get('config_processing_status')), 'SSL');

			// Complete Orders
			$data['complete_status_total'] = $this->model_sale_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_complete_status'))));
			$data['complete_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&filter_order_status=' . implode(',', $this->config->get('config_complete_status')), 'SSL');

			// Returns
			$this->load->model('sale/return');

			$return_total = $this->model_sale_return->getTotalReturns(array('filter_return_status_id' => $this->config->get('config_return_status_id')));

			$data['return_total'] = $return_total;

			$data['return'] = $this->url->link('sale/return', 'token=' . $this->session->data['token'], 'SSL');

			// Customers
			$this->load->model('report/customer');

			$data['online_total'] = $this->model_report_customer->getTotalCustomersOnline();

			$data['online'] = $this->url->link('report/customer_online', 'token=' . $this->session->data['token'], 'SSL');

			$this->load->model('customer/customer');

			$customer_total = $this->model_customer_customer->getTotalCustomers(array('filter_approved' => false));

			$data['customer_total'] = $customer_total;
			$data['customer_approval'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&filter_approved=0', 'SSL');

			// Products
			$this->load->model('catalog/product');

			$product_total = $this->model_catalog_product->getTotalProducts(array('filter_quantity' => 0));

			$data['product_total'] = $product_total;

			$data['product'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&filter_quantity=0', 'SSL');

			// Reviews
			$this->load->model('catalog/review');

			$review_total = $this->model_catalog_review->getTotalReviews(array('filter_status' => false));

			$data['review_total'] = $review_total;

			$data['review'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . '&filter_status=0', 'SSL');

			// Affliate
			$this->load->model('marketing/affiliate');

			$affiliate_total = $this->model_marketing_affiliate->getTotalAffiliates(array('filter_approved' => false));

			$data['affiliate_total'] = $affiliate_total;
			$data['affiliate_approval'] = $this->url->link('marketing/affiliate', 'token=' . $this->session->data['token'] . '&filter_approved=1', 'SSL');

			$data['alerts'] = $customer_total + $product_total + $review_total + $return_total + $affiliate_total;

			// Online Stores
			$data['stores'] = array();

			$data['stores'][] = array(
				'name' => $this->config->get('config_name'),
				'href' => HTTP_CATALOG
			);

			$this->load->model('setting/store');

			$results = $this->model_setting_store->getStores();


                if (isset($this->user->getPermissions()['access'])) {
                    $data['permissions'] = $this->user->getPermissions()['access'];
                } else {
                    $data['permissions'] = array();
                }

                $data['show_sale_order'] = $this->is_in_permission('sale/order', $data['permissions']);
                $data['show_sale_return'] = $this->is_in_permission('sale/order', $data['permissions']);
                $data['show_sale'] = $data['show_sale_return'] || $data['show_sale_order'];

                $data['show_report_customer_online'] = $this->is_in_permission('report/customer_online', $data['permissions']);
                $data['show_customer'] = $this->is_in_permission('customer/customer', $data['permissions']);
                $data['show_customer_list'] = $data['show_customer'] || $data['show_report_customer_online'];

                $data['show_catelog_product'] = $this->is_in_permission('catalog/product', $data['permissions']);
                $data['show_catelog_review'] = $this->is_in_permission('catalog/review', $data['permissions']);
                $data['show_catelog'] = $data['show_catelog_product'] || $data['show_catelog_review'];

                $data['show_marketing_affiliate'] = $this->is_in_permission('marketing/affiliate', $data['permissions']);

                $data['show_alert'] = $data['show_sale'] || $data['show_customer_list'] || $data['show_catelog'] || $data['show_marketing_affiliate'];
                $total = 0;

                if ($data['show_sale']) {
                    if ($data['show_sale_return']) {
                        $total += $return_total;
                    }
                }
                if ($data['show_customer_list']) {
                    if ($data['show_customer']) {
                        $total += $customer_total;
                    }
                }
                if ($data['show_catelog']) {
                    if ($data['show_catelog_product']) {
                        $total += $product_total;
                    }
                    if ($data['show_catelog_review']) {
                        $total += $review_total;
                    }
                }
                if ($data['show_marketing_affiliate']) {
                    $total += $affiliate_total;
                }
                $data['alerts'] = $total;
            
			foreach ($results as $result) {
				$data['stores'][] = array(
					'name' => $result['name'],
					'href' => $result['url']
				);
			}
		}

		return $this->load->view('common/header.tpl', $data);
	}
}
