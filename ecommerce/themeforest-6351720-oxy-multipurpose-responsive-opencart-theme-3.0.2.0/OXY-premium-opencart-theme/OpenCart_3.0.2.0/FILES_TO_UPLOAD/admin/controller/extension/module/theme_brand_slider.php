<?php
class ControllerExtensionModuleThemeBrandSlider extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/theme_brand_slider');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$languages = $this->model_localisation_language->getLanguages();
		
		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('theme_brand_slider', $this->request->post);
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
				'href' => $this->url->link('extension/module/theme_brand_slider', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/theme_brand_slider', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);			
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/theme_brand_slider', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/theme_brand_slider', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
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
		
		if (isset($this->request->post['brand_slider'])) {
			$data['brand_slider'] = $this->request->post['brand_slider'];
		} elseif (!empty($module_info)) {
			$data['brand_slider'] = $module_info['brand_slider'];
		} else {
			$data['brand_slider'] = '';
		}	
		
		if (isset($this->request->post['ca_id'])) {
			$data['ca_id'] = $this->request->post['ca_id'];
		} elseif (!empty($module_info)) {
			$data['ca_id'] = $module_info['ca_id'];
		} else {
			$data['ca_id'] = '6';
		}	
		
		if (isset($this->request->post['brands_display_style'])) {
			$data['brands_display_style'] = $this->request->post['brands_display_style'];
		} elseif (!empty($module_info)) {
			$data['brands_display_style'] = $module_info['brands_display_style'];
		} else {
			$data['brands_display_style'] = 2;
		}
		
		if (isset($this->request->post['module_bg_color'])) {
			$data['module_bg_color'] = $this->request->post['module_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_bg_color'] = $module_info['module_bg_color'];
		} else {
			$data['module_bg_color'] = '';
		}
		
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
		
		if (isset($this->request->post['module_subtitle_color'])) {
			$data['module_subtitle_color'] = $this->request->post['module_subtitle_color'];
		} elseif (!empty($module_info)) {
			$data['module_subtitle_color'] = $module_info['module_subtitle_color'];
		} else {
			$data['module_subtitle_color'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/theme_brand_slider', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/theme_brand_slider')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}	

		return !$this->error;
	}
}