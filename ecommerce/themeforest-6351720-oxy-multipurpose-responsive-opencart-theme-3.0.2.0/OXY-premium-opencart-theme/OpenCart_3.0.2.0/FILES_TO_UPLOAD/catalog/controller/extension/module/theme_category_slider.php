<?php
class ControllerExtensionModuleThemeCategorySlider extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$data['category_slider'] = $setting['category_slider'][$this->config->get('config_language_id')];

		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		$data['ca_id'] = $setting['ca_id'];
		$data['module_bg_color'] = $setting['module_bg_color'];
		$data['module_title_color'] = $setting['module_title_color'];
		$data['module_title_border_color'] = $setting['module_title_border_color'];
		$data['module_subtitle_color'] = $setting['module_subtitle_color'];
		
		$data['lazy_load_placeholder'] = 'catalog/view/theme/' . $this->config->get('config_theme') . '/js/lazyload/loading_square.gif';

		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
	
		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'],
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}

				// Level 1
				
				$image = empty($category['image']) ? 'no_image_transparent.png' : $category['image'];
                $thumb = $this->model_tool_image->resize($image, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_height'));
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => 1,
					'thumb'    => $thumb,	
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
		}
		
		$data['module'] = $module++;
		
		return $this->load->view('extension/module/theme_category_slider', $data);

	}
}