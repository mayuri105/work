<?php
class ControllerExtensionModuleThemeTestimonial extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$data['testimonial'] = $setting['testimonial'][$this->config->get('config_language_id')];

		$this->load->model('tool/image');
				
		$data['pr_id'] = $setting['pr_id'];
		$data['module_bg_color'] = $setting['module_bg_color'];
		$data['module_image_custom'] = $setting['module_image_custom'];
		$data['module_title_color'] = $setting['module_title_color'];
		$data['module_title_border_color'] = $setting['module_title_border_color'];
		$data['module_testimonial_color'] = $setting['module_testimonial_color'];
		$data['module_testimonial_bg_color'] = $setting['module_testimonial_bg_color'];
		$data['module_name_color'] = $setting['module_name_color'];
		
		$data['config_ssl'] = $this->config->get('config_ssl');
		$data['config_url'] = $this->config->get('config_url');
		
		if (isset($setting['sections'])) {        
            $data['sections'] = array();
            
            foreach($setting['sections'] as $section) {
                $this->load->model('tool/image');
                			
				if (isset($section['thumb_image'])){
				$image = 'image/' . $section['thumb_image'];
				} else {
				$image = false;
				}
				
				if (isset($section['testimonial_block'][$this->config->get('config_language_id')])){
                    $testimonial_block = html_entity_decode($section['testimonial_block'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $testimonial_block = false;
                }
				
				if (isset($section['reviewer_name'][$this->config->get('config_language_id')])){
                    $reviewer_name = html_entity_decode($section['reviewer_name'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $reviewer_name = false;
                }

                $data['sections'][] = array(
 					'image' => $image,
                    'testimonial_block' => $testimonial_block,
					'reviewer_name' => $reviewer_name
                );
            }
		}

		$data['module'] = $module++;
		
		return $this->load->view('extension/module/theme_testimonial', $data);

	}
}