<?php
class ControllerExtensionModuleThemefaq extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$data['faq'] = $setting['faq'][$this->config->get('config_language_id')];
				
		$data['module_question_bg_color'] = $setting['module_question_bg_color'];
		$data['module_question_bg_color_hover'] = $setting['module_question_bg_color_hover'];
		$data['module_question_color'] = $setting['module_question_color'];
		$data['module_question_color_hover'] = $setting['module_question_color_hover'];
		$data['module_answer_bg_color'] = $setting['module_answer_bg_color'];
		$data['module_answer_color'] = $setting['module_answer_color'];
		
		if (isset($setting['sections'])) {        
            $data['sections'] = array();
            
            foreach($setting['sections'] as $section) {

				if (isset($section['faq_question'][$this->config->get('config_language_id')])){
                    $faq_question = html_entity_decode($section['faq_question'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $faq_question = false;
                }
				
				if (isset($section['faq_answer'][$this->config->get('config_language_id')])){
                    $faq_answer = html_entity_decode($section['faq_answer'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
                } else {
                    $faq_answer = false;
                }

                $data['sections'][] = array(
                    'faq_question' => $faq_question,
					'faq_answer' => $faq_answer
                );
            }
		}

		$data['module'] = $module++;
		
		return $this->load->view('extension/module/theme_faq', $data);

	}
}