<?php
class ControllerExtensionModuleThemeBanner extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('design/banner');
		$this->load->model('tool/image');
				
		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);
		
		$data['banner_view'] = $setting['banner_view'];
		$data['pr_id'] = $setting['pr_id'];
		$data['title_position'] = $setting['title_position'];
		$data['title_slide_status'] = $setting['title_slide_status'];
		
		$data['lang_id'] = $this->config->get('config_language_id');
		$lang_id = $this->config->get('config_language_id');
		
		$data['t1o_text_view'] = $this->config->get('t1o_text_view');

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
		
		return $this->load->view('extension/module/theme_banner', $data);

	}
}