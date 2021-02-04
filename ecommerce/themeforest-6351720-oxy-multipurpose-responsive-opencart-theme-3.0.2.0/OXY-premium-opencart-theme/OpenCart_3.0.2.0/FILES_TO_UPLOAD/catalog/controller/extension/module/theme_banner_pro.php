<?php
class ControllerExtensionModuleThemeBannerPro extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$this->load->model('tool/image');

		$data['banner_pro_image_custom'] = $setting['banner_pro_image_custom'];
		$data['banner_pro_title_shadow'] = $setting['banner_pro_title_shadow'];
		$data['banner_pro_hover_bg_color_status'] = $setting['banner_pro_hover_bg_color_status'];
		$data['banner_pro_hover_bg_color'] = $setting['banner_pro_hover_bg_color'];
		$data['banner_pro_hover_bg_color_opacity'] = $setting['banner_pro_hover_bg_color_opacity'];
		$data['banner_pro_padding'] = $setting['banner_pro_padding'];
		
		$data['banner_pro_item'] = $setting['banner_pro_item'];
		
		$data['banner_pro_item_title_1'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['title_1'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_subtitle_1'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['subtitle_1'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_title_2'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['title_2'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_subtitle_2'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['subtitle_2'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_title_3'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['title_3'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_subtitle_3'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['subtitle_3'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_title_4'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['title_4'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_subtitle_4'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['subtitle_4'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_title_5'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['title_5'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_subtitle_5'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['subtitle_5'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_title_6'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['title_6'], ENT_QUOTES, 'UTF-8');
		$data['banner_pro_item_subtitle_6'] = html_entity_decode($data['banner_pro_item'][$this->config->get('config_language_id')]['subtitle_6'], ENT_QUOTES, 'UTF-8');
		
		$data['banner_pro_item_image_custom_1'] = $setting['banner_pro_item_image_custom_1'];
		$data['banner_pro_item_image_custom_2'] = $setting['banner_pro_item_image_custom_2'];
		$data['banner_pro_item_image_custom_3'] = $setting['banner_pro_item_image_custom_3'];
		$data['banner_pro_item_image_custom_4'] = $setting['banner_pro_item_image_custom_4'];
		$data['banner_pro_item_image_custom_5'] = $setting['banner_pro_item_image_custom_5'];
		$data['banner_pro_item_image_custom_6'] = $setting['banner_pro_item_image_custom_6'];
		
		$data['banner_pro_label_color_1'] = $setting['banner_pro_label_color_1'];
		$data['banner_pro_title_color_1'] = $setting['banner_pro_title_color_1'];
		$data['banner_pro_subtitle_color_1'] = $setting['banner_pro_subtitle_color_1'];
		$data['banner_pro_label_color_2'] = $setting['banner_pro_label_color_2'];
		$data['banner_pro_title_color_2'] = $setting['banner_pro_title_color_2'];
		$data['banner_pro_subtitle_color_2'] = $setting['banner_pro_subtitle_color_2'];
		$data['banner_pro_label_color_3'] = $setting['banner_pro_label_color_3'];
		$data['banner_pro_title_color_3'] = $setting['banner_pro_title_color_3'];
		$data['banner_pro_subtitle_color_3'] = $setting['banner_pro_subtitle_color_3'];
		$data['banner_pro_label_color_4'] = $setting['banner_pro_label_color_4'];
		$data['banner_pro_title_color_4'] = $setting['banner_pro_title_color_4'];
		$data['banner_pro_subtitle_color_4'] = $setting['banner_pro_subtitle_color_4'];
		$data['banner_pro_label_color_5'] = $setting['banner_pro_label_color_5'];
		$data['banner_pro_title_color_5'] = $setting['banner_pro_title_color_5'];
		$data['banner_pro_subtitle_color_5'] = $setting['banner_pro_subtitle_color_5'];
		$data['banner_pro_label_color_6'] = $setting['banner_pro_label_color_6'];
		$data['banner_pro_title_color_6'] = $setting['banner_pro_title_color_6'];
		$data['banner_pro_subtitle_color_6'] = $setting['banner_pro_subtitle_color_6'];
		
		$data['config_ssl'] = $this->config->get('config_ssl');
		$data['config_url'] = $this->config->get('config_url');
		
		$data['lang_id'] = $this->config->get('config_language_id');
		$lang_id = $this->config->get('config_language_id');
		
		
		if (isset($section['thumb_image'])){
				$image = 'image/' . $section['thumb_image'];
				} else {
				$image = false;
				}
		

		
		if (isset($setting['sections'])) {        
            $data['sections'] = array();
            
            foreach($setting['sections'] as $section) {
                $this->load->model('tool/image');
                			
				if (isset($section['thumb_image'])){
				$image = 'image/' . $section['thumb_image'];
				} else {
				$image = false;
				}
				
				if (isset($section['banner_pro_url'][$this->config->get('config_language_id')])){
                    $banner_pro_url = html_entity_decode($section['banner_pro_url'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $banner_pro_url = false;
                }
				
				if (isset($section['banner_pro_label'][$this->config->get('config_language_id')])){
                    $banner_pro_label = html_entity_decode($section['banner_pro_label'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $banner_pro_label = false;
                }
				
				if (isset($section['banner_pro_title'][$this->config->get('config_language_id')])){
                    $banner_pro_title = html_entity_decode($section['banner_pro_title'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $banner_pro_title = false;
                }
				
				if (isset($section['banner_pro_subtitle'][$this->config->get('config_language_id')])){
                    $banner_pro_subtitle = html_entity_decode($section['banner_pro_subtitle'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $banner_pro_subtitle = false;
                }
				
				if (isset($section['banner_pro_button'][$this->config->get('config_language_id')])){
                    $banner_pro_button = html_entity_decode($section['banner_pro_button'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $banner_pro_button = false;
                }
				
				if (isset($section['banner_pro_button_style'])){
                    $banner_pro_button_style = $section['banner_pro_button_style'];
                } else {
                    $banner_pro_button_style = false;
                }
				
				if (isset($section['banner_pro_content_position'])){
                    $banner_pro_content_position = $section['banner_pro_content_position'];
                } else {
                    $banner_pro_content_position = false;
                }
				
				if (isset($section['banner_pro_hover_effect'])){
                    $banner_pro_hover_effect = $section['banner_pro_hover_effect'];
                } else {
                    $banner_pro_hover_effect = false;
                }
				
				if (isset($section['banner_pro_width'])){
                    $banner_pro_width = $section['banner_pro_width'];
                } else {
                    $banner_pro_width = false;
                }


                $data['sections'][] = array(
 					'image' => $image,
					'banner_pro_url' => $banner_pro_url,
					'banner_pro_label' => $banner_pro_label,
                    'banner_pro_title' => $banner_pro_title,
					'banner_pro_subtitle' => $banner_pro_subtitle,
					'banner_pro_button' => $banner_pro_button,
					'banner_pro_button_style' => $banner_pro_button_style,
					'banner_pro_content_position' => $banner_pro_content_position,
					'banner_pro_hover_effect' => $banner_pro_hover_effect,
					'banner_pro_width' => $banner_pro_width
                );
            }
		}

		$data['module'] = $module++;
		
		return $this->load->view('extension/module/theme_banner_pro', $data);

	}
}