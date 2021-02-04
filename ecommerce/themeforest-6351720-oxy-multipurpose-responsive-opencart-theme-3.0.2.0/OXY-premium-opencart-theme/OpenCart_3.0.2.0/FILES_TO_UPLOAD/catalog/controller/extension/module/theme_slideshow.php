<?php
class ControllerExtensionModuleThemeSlideshow extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$this->load->model('tool/image');

		$data['slideshow_hover_bg_color_status'] = $setting['slideshow_hover_bg_color_status'];
		$data['slideshow_hover_bg_color'] = $setting['slideshow_hover_bg_color'];
		$data['slideshow_hover_bg_color_opacity'] = $setting['slideshow_hover_bg_color_opacity'];
		$data['slideshow_pagination'] = $setting['slideshow_pagination'];
		$data['slideshow_time'] = $setting['slideshow_time'];
		
		$data['slideshow_item'] = $setting['slideshow_item'];
		
		$data['slideshow_item_title_1'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['title_1'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_subtitle_1'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['subtitle_1'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_title_2'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['title_2'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_subtitle_2'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['subtitle_2'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_title_3'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['title_3'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_subtitle_3'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['subtitle_3'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_title_4'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['title_4'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_subtitle_4'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['subtitle_4'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_title_5'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['title_5'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_subtitle_5'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['subtitle_5'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_title_6'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['title_6'], ENT_QUOTES, 'UTF-8');
		$data['slideshow_item_subtitle_6'] = html_entity_decode($data['slideshow_item'][$this->config->get('config_language_id')]['subtitle_6'], ENT_QUOTES, 'UTF-8');
		
		$data['slideshow_item_image_custom_1'] = $setting['slideshow_item_image_custom_1'];
		$data['slideshow_item_image_custom_2'] = $setting['slideshow_item_image_custom_2'];
		$data['slideshow_item_image_custom_3'] = $setting['slideshow_item_image_custom_3'];
		$data['slideshow_item_image_custom_4'] = $setting['slideshow_item_image_custom_4'];
		$data['slideshow_item_image_custom_5'] = $setting['slideshow_item_image_custom_5'];
		$data['slideshow_item_image_custom_6'] = $setting['slideshow_item_image_custom_6'];
		$data['slideshow_item_main_image_custom_1'] = $setting['slideshow_item_main_image_custom_1'];
		$data['slideshow_item_main_image_custom_2'] = $setting['slideshow_item_main_image_custom_2'];
		$data['slideshow_item_main_image_custom_3'] = $setting['slideshow_item_main_image_custom_3'];
		$data['slideshow_item_main_image_custom_4'] = $setting['slideshow_item_main_image_custom_4'];
		$data['slideshow_item_main_image_custom_5'] = $setting['slideshow_item_main_image_custom_5'];
		$data['slideshow_item_main_image_custom_6'] = $setting['slideshow_item_main_image_custom_6'];
		
		$data['slideshow_label_color_1'] = $setting['slideshow_label_color_1'];
		$data['slideshow_title_color_1'] = $setting['slideshow_title_color_1'];
		$data['slideshow_subtitle_color_1'] = $setting['slideshow_subtitle_color_1'];
		$data['slideshow_label_color_2'] = $setting['slideshow_label_color_2'];
		$data['slideshow_title_color_2'] = $setting['slideshow_title_color_2'];
		$data['slideshow_subtitle_color_2'] = $setting['slideshow_subtitle_color_2'];
		$data['slideshow_label_color_3'] = $setting['slideshow_label_color_3'];
		$data['slideshow_title_color_3'] = $setting['slideshow_title_color_3'];
		$data['slideshow_subtitle_color_3'] = $setting['slideshow_subtitle_color_3'];
		$data['slideshow_label_color_4'] = $setting['slideshow_label_color_4'];
		$data['slideshow_title_color_4'] = $setting['slideshow_title_color_4'];
		$data['slideshow_subtitle_color_4'] = $setting['slideshow_subtitle_color_4'];
		$data['slideshow_label_color_5'] = $setting['slideshow_label_color_5'];
		$data['slideshow_title_color_5'] = $setting['slideshow_title_color_5'];
		$data['slideshow_subtitle_color_5'] = $setting['slideshow_subtitle_color_5'];
		$data['slideshow_label_color_6'] = $setting['slideshow_label_color_6'];
		$data['slideshow_title_color_6'] = $setting['slideshow_title_color_6'];
		$data['slideshow_subtitle_color_6'] = $setting['slideshow_subtitle_color_6'];
		
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
				
				if (isset($section['slideshow_url'][$this->config->get('config_language_id')])){
                    $slideshow_url = html_entity_decode($section['slideshow_url'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $slideshow_url = false;
                }
				
				if (isset($section['slideshow_label'][$this->config->get('config_language_id')])){
                    $slideshow_label = html_entity_decode($section['slideshow_label'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $slideshow_label = false;
                }
				
				if (isset($section['slideshow_title'][$this->config->get('config_language_id')])){
                    $slideshow_title = html_entity_decode($section['slideshow_title'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $slideshow_title = false;
                }
				
				if (isset($section['slideshow_subtitle'][$this->config->get('config_language_id')])){
                    $slideshow_subtitle = html_entity_decode($section['slideshow_subtitle'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $slideshow_subtitle = false;
                }
				
				if (isset($section['slideshow_button'][$this->config->get('config_language_id')])){
                    $slideshow_button = html_entity_decode($section['slideshow_button'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $slideshow_button = false;
                }
				
				if (isset($section['slideshow_button_style'])){
                    $slideshow_button_style = $section['slideshow_button_style'];
                } else {
                    $slideshow_button_style = false;
                }
				
				if (isset($section['slideshow_content_position'])){
                    $slideshow_content_position = $section['slideshow_content_position'];
                } else {
                    $slideshow_content_position = false;
                }
				
				if (isset($section['slideshow_main_image_animation'])){
                    $slideshow_main_image_animation = $section['slideshow_main_image_animation'];
                } else {
                    $slideshow_main_image_animation = false;
                }
				
				if (isset($section['slideshow_title_animation'])){
                    $slideshow_title_animation = $section['slideshow_title_animation'];
                } else {
                    $slideshow_title_animation = false;
                }
				
				if (isset($section['slideshow_subtitle_animation'])){
                    $slideshow_subtitle_animation = $section['slideshow_subtitle_animation'];
                } else {
                    $slideshow_subtitle_animation = false;
                }
				
				if (isset($section['slideshow_button_animation'])){
                    $slideshow_button_animation = $section['slideshow_button_animation'];
                } else {
                    $slideshow_button_animation = false;
                }
				
				if (isset($section['slideshow_hover_effect'])){
                    $slideshow_hover_effect = $section['slideshow_hover_effect'];
                } else {
                    $slideshow_hover_effect = false;
                }


                $data['sections'][] = array(
 					'image' => $image,
					'slideshow_url' => $slideshow_url,
					'slideshow_label' => $slideshow_label,
                    'slideshow_title' => $slideshow_title,
					'slideshow_subtitle' => $slideshow_subtitle,
					'slideshow_button' => $slideshow_button,
					'slideshow_button_style' => $slideshow_button_style,
					'slideshow_content_position' => $slideshow_content_position,
					'slideshow_main_image_animation' => $slideshow_main_image_animation,
					'slideshow_title_animation' => $slideshow_title_animation,
					'slideshow_subtitle_animation' => $slideshow_subtitle_animation,
					'slideshow_button_animation' => $slideshow_button_animation,
					'slideshow_hover_effect' => $slideshow_hover_effect
                );
            }
		}

		$data['module'] = $module++;
		
		return $this->load->view('extension/module/theme_slideshow', $data);

	}
}