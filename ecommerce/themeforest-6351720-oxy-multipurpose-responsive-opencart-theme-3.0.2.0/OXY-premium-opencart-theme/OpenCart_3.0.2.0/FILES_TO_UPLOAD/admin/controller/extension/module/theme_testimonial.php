<?php
class ControllerExtensionModuleThemeTestimonial extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/theme_testimonial');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$languages = $this->model_localisation_language->getLanguages();
		
		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('theme_testimonial', $this->request->post);
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
				'href' => $this->url->link('extension/module/theme_testimonial', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/theme_testimonial', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);			
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/theme_testimonial', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/theme_testimonial', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
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
		
		if (isset($this->request->post['testimonial'])) {
			$data['testimonial'] = $this->request->post['testimonial'];
		} elseif (!empty($module_info)) {
			$data['testimonial'] = $module_info['testimonial'];
		} else {
			$data['testimonial'] = '';
		}		
		
		if (isset($this->request->post['pr_id'])) {
			$data['pr_id'] = $this->request->post['pr_id'];
		} elseif (!empty($module_info)) {
			$data['pr_id'] = $module_info['pr_id'];
		} else {
			$data['pr_id'] = '3';
		}
				
		if (isset($this->request->post['module_bg_color'])) {
			$data['module_bg_color'] = $this->request->post['module_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_bg_color'] = $module_info['module_bg_color'];
		} else {
			$data['module_bg_color'] = '';
		}
		
		if (isset($this->request->post['module_image_custom'])) {
			$data['module_image_custom'] = $this->request->post['module_image_custom'];
		} elseif (!empty($module_info)) {
			$data['module_image_custom'] = $module_info['module_image_custom'];
		} else {
			$data['module_image_custom'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['module_image_custom']) && is_file(DIR_IMAGE . $this->request->post['module_image_custom'])) {
			$data['module_image_thumb'] = $this->model_tool_image->resize($this->request->post['module_image_custom'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['module_image_custom'])) {
			$data['module_image_thumb'] = $this->model_tool_image->resize($module_info['module_image_custom'], 100, 100);
		} else {
			$data['module_image_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['module_title_color'])) {
			$data['module_title_color'] = $this->request->post['module_title_color'];
		} elseif (!empty($module_info)) {
			$data['module_title_color'] = $module_info['module_title_color'];
		} else {
			$data['module_title_color'] = '';
		}
		
		if (isset($this->request->post['module_title_border_color'])) {
			$data['module_title_border_color'] = $this->request->post['module_title_border_color'];
		} elseif (!empty($module_info)) {
			$data['module_title_border_color'] = $module_info['module_title_border_color'];
		} else {
			$data['module_title_border_color'] = '';
		}
		
		if (isset($this->request->post['module_testimonial_color'])) {
			$data['module_testimonial_color'] = $this->request->post['module_testimonial_color'];
		} elseif (!empty($module_info)) {
			$data['module_testimonial_color'] = $module_info['module_testimonial_color'];
		} else {
			$data['module_testimonial_color'] = '';
		}
		
		if (isset($this->request->post['module_testimonial_bg_color'])) {
			$data['module_testimonial_bg_color'] = $this->request->post['module_testimonial_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_testimonial_bg_color'] = $module_info['module_testimonial_bg_color'];
		} else {
			$data['module_testimonial_bg_color'] = '';
		}
		
		if (isset($this->request->post['module_name_color'])) {
			$data['module_name_color'] = $this->request->post['module_name_color'];
		} elseif (!empty($module_info)) {
			$data['module_name_color'] = $module_info['module_name_color'];
		} else {
			$data['module_name_color'] = '';
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
				'thumb_image' => $section['thumb_image'],
				'image' => $this->model_tool_image->resize($section['thumb_image'], 100, 100),
				'testimonial_block' => $section['testimonial_block'],
				'reviewer_name' => $section['reviewer_name']
			);
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/theme_testimonial', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/theme_testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}
}