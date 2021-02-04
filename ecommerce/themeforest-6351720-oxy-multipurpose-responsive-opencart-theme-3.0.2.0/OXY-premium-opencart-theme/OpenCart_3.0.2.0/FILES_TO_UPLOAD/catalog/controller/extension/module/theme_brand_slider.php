<?php
class ControllerExtensionModuleThemeBrandSlider extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$data['brand_slider'] = $setting['brand_slider'][$this->config->get('config_language_id')];

		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		$data['ca_id'] = $setting['ca_id'];
		$data['brands_display_style'] = $setting['brands_display_style'];
		$data['module_bg_color'] = $setting['module_bg_color'];
		$data['module_title_color'] = $setting['module_title_color'];
		$data['module_title_border_color'] = $setting['module_title_border_color'];
		$data['module_subtitle_color'] = $setting['module_subtitle_color'];
		
		$data['lazy_load_placeholder'] = 'catalog/view/theme/' . $this->config->get('config_theme') . '/js/lazyload/loading_horizontal.gif';

		$this->load->model('catalog/manufacturer');
		$this->load->model('tool/image');
		$results = $this->model_catalog_manufacturer->getManufacturers();
		foreach ($results as $result) {	
			if ($result['image']) {
						$image = $result['image'];
					} else {
						$image = '';
					}			
			$data['manufacturers'][] = array(
				'name' => $result['name'],
				'image' => $this->model_tool_image->resize($image, 170, 100),
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}		

		$data['module'] = $module++;
		
		return $this->load->view('extension/module/theme_brand_slider', $data);

	}
}