<?php
class ControllerExtensionModuleThemeLookBook extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$data['lookbook'] = $setting['lookbook'][$this->config->get('config_language_id')];

		$this->load->model('design/banner');
		$this->load->model('tool/image');
				
		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);
		
		$data['pr_id'] = $setting['pr_id'];
		$data['module_bg_color'] = $setting['module_bg_color'];
		$data['module_title_color'] = $setting['module_title_color'];
		$data['module_title_border_color'] = $setting['module_title_border_color'];
		$data['module_subtitle_color'] = $setting['module_subtitle_color'];
		
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
		
		return $this->load->view('extension/module/theme_lookbook', $data);

	}
}