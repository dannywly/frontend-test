<?php
class ControllerModuleHomeTop extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->language('module/home_top');
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		$this->load->model('extension/module');

		$this->document->addStyle('catalog/view/theme/atwowo/stylesheet/home_top.css');
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		// if (isset($this->request->get['route'])) {
		// 	$route = (string)$this->request->get['route'];
		// } else {
		// 	$route = 'common/home';
		// }

		// $setting_info = $this->model_extension_module->getModuleByCodeAndName('slideshow', 'Slideshow');
		// if ($setting_info && $setting_info['status']) {
		// 	$data['slideshow'] = $this->load->controller('module/slideshow', $setting_info);
		// }

		$data['heading_title'] = $this->language->get('heading_title');

		$data['catagory_menu'] = $this->load->controller('module/category_menu');


		// $data['slideshow'] = $this->load->controller('module/slideshow');

		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/home_top.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/home_top.tpl', $data);
		} else {
			return $this->load->view('default/template/module/home_top.tpl', $data);
		}
	}
}