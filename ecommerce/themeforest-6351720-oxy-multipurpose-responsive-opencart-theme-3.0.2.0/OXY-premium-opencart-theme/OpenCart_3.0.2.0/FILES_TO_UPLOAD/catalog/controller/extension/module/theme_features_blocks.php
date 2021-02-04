<?php
class ControllerExtensionModuleThemeFeaturesBlocks extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$data['features_block'] = $setting['features_block'][$this->config->get('config_language_id')];
		
		$data['bpr_id'] = $setting['bpr_id'];
		$data['features_blocks_style'] = $setting['features_blocks_style'];
		
		$data['module_bg_status'] = $setting['module_bg_status'];
		$data['module_bg_color'] = $setting['module_bg_color'];
		$data['module_image_custom'] = $setting['module_image_custom'];
		$data['module_title_color'] = $setting['module_title_color'];
		$data['module_subtitle_color'] = $setting['module_subtitle_color'];
        $data['module_icon_1_bg_color'] = $setting['module_icon_1_bg_color'];
		$data['module_icon_2_bg_color'] = $setting['module_icon_2_bg_color'];
		$data['module_icon_3_bg_color'] = $setting['module_icon_3_bg_color'];
		$data['module_icon_4_bg_color'] = $setting['module_icon_4_bg_color'];
		$data['module_icon_1_color'] = $setting['module_icon_1_color'];
		$data['module_icon_2_color'] = $setting['module_icon_2_color'];
		$data['module_icon_3_color'] = $setting['module_icon_3_color'];
		$data['module_icon_4_color'] = $setting['module_icon_4_color'];
		
		$data['config_ssl'] = $this->config->get('config_ssl');
		$data['config_url'] = $this->config->get('config_url');
		
		if (isset($setting['module_description_1'][$this->config->get('config_language_id')])) {
			$data['module_description_1'] = html_entity_decode($setting['module_description_1'][$this->config->get('config_language_id')]['description_1'], ENT_QUOTES, 'UTF-8');
			$data['module_description_2'] = html_entity_decode($setting['module_description_2'][$this->config->get('config_language_id')]['description_2'], ENT_QUOTES, 'UTF-8');
			$data['module_description_3'] = html_entity_decode($setting['module_description_3'][$this->config->get('config_language_id')]['description_3'], ENT_QUOTES, 'UTF-8');
			$data['module_description_4'] = html_entity_decode($setting['module_description_4'][$this->config->get('config_language_id')]['description_4'], ENT_QUOTES, 'UTF-8');
		
			$data['module'] = $module++;
			
			return $this->load->view('extension/module/theme_features_blocks', $data);

		}
	}
}