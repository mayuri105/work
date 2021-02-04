<?php
class ControllerExtensionModuleThemeFAQ extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/theme_faq');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$languages = $this->model_localisation_language->getLanguages();
		
		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('theme_faq', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
			
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/theme_faq', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/theme_faq', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);			
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/theme_faq', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/theme_faq', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}
		
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['faq'])) {
			$data['faq'] = $this->request->post['faq'];
		} elseif (!empty($module_info)) {
			$data['faq'] = $module_info['faq'];
		} else {
			$data['faq'] = '';
		}		
				
		if (isset($this->request->post['module_question_bg_color'])) {
			$data['module_question_bg_color'] = $this->request->post['module_question_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_question_bg_color'] = $module_info['module_question_bg_color'];
		} else {
			$data['module_question_bg_color'] = '';
		}
		
		if (isset($this->request->post['module_question_color'])) {
			$data['module_question_color'] = $this->request->post['module_question_color'];
		} elseif (!empty($module_info)) {
			$data['module_question_color'] = $module_info['module_question_color'];
		} else {
			$data['module_question_color'] = '';
		}
		
		if (isset($this->request->post['module_question_bg_color_hover'])) {
			$data['module_question_bg_color_hover'] = $this->request->post['module_question_bg_color_hover'];
		} elseif (!empty($module_info)) {
			$data['module_question_bg_color_hover'] = $module_info['module_question_bg_color_hover'];
		} else {
			$data['module_question_bg_color_hover'] = '';
		}
		
		if (isset($this->request->post['module_question_color_hover'])) {
			$data['module_question_color_hover'] = $this->request->post['module_question_color_hover'];
		} elseif (!empty($module_info)) {
			$data['module_question_color_hover'] = $module_info['module_question_color_hover'];
		} else {
			$data['module_question_color_hover'] = '';
		}
		
		if (isset($this->request->post['module_answer_bg_color'])) {
			$data['module_answer_bg_color'] = $this->request->post['module_answer_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_answer_bg_color'] = $module_info['module_answer_bg_color'];
		} else {
			$data['module_answer_bg_color'] = '';
		}
		
		if (isset($this->request->post['module_answer_color'])) {
			$data['module_answer_color'] = $this->request->post['module_answer_color'];
		} elseif (!empty($module_info)) {
			$data['module_answer_color'] = $module_info['module_answer_color'];
		} else {
			$data['module_answer_color'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		if (isset($this->request->post['sections'])) {
			$data['sections'] = $this->request->post['sections'];
		} elseif (!empty($module_info)) {
			$sections = $module_info['sections'];
		} else {
			$sections = array();
		}
		
		$data['sections'] = array();
		
		foreach ($sections as $section) {
			
			$data['sections'][] = array(
				'faq_question' => $section['faq_question'],
				'faq_answer' => $section['faq_answer']
			);
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/theme_faq', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/theme_faq')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}
}