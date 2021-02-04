<?php
class ControllerExtensionModuleThemeFeaturesBlocks extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/theme_features_blocks');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('theme_features_blocks', $this->request->post);
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
				'href' => $this->url->link('extension/module/theme_features_blocks', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/theme_features_blocks', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);			
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/theme_features_blocks', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/theme_features_blocks', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
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
		
		if (isset($this->request->post['features_block'])) {
			$data['features_block'] = $this->request->post['features_block'];
		} elseif (!empty($module_info)) {
			$data['features_block'] = $module_info['features_block'];
		} else {
			$data['features_block'] = '';
		}
		
		if (isset($this->request->post['module_description_1'])) {
			$data['module_description_1'] = $this->request->post['module_description_1'];
		} elseif (!empty($module_info)) {
			$data['module_description_1'] = $module_info['module_description_1'];
		} else {
			$data['module_description_1'] = array();
		}
		
		if (isset($this->request->post['module_description_2'])) {
			$data['module_description_2'] = $this->request->post['module_description_2'];
		} elseif (!empty($module_info)) {
			$data['module_description_2'] = $module_info['module_description_2'];
		} else {
			$data['module_description_2'] = array();
		}
		
		if (isset($this->request->post['module_description_3'])) {
			$data['module_description_3'] = $this->request->post['module_description_3'];
		} elseif (!empty($module_info)) {
			$data['module_description_3'] = $module_info['module_description_3'];
		} else {
			$data['module_description_3'] = array();
		}
		
		if (isset($this->request->post['module_description_4'])) {
			$data['module_description_4'] = $this->request->post['module_description_4'];
		} elseif (!empty($module_info)) {
			$data['module_description_4'] = $module_info['module_description_4'];
		} else {
			$data['module_description_4'] = array();
		}
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['bpr_id'])) {
			$data['bpr_id'] = $this->request->post['bpr_id'];
		} elseif (!empty($module_info)) {
			$data['bpr_id'] = $module_info['bpr_id'];
		} else {
			$data['bpr_id'] = '3';
		}
		
		if (isset($this->request->post['features_blocks_style'])) {
			$data['features_blocks_style'] = $this->request->post['features_blocks_style'];
		} elseif (!empty($module_info)) {
			$data['features_blocks_style'] = $module_info['features_blocks_style'];
		} else {
			$data['features_blocks_style'] = 'style-1';
		}
		
		if (isset($this->request->post['module_bg_status'])) {
			$data['module_bg_status'] = $this->request->post['module_bg_status'];
		} elseif (!empty($module_info)) {
			$data['module_bg_status'] = $module_info['module_bg_status'];
		} else {
			$data['module_bg_status'] = '1';
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
		
		if (isset($this->request->post['module_subtitle_color'])) {
			$data['module_subtitle_color'] = $this->request->post['module_subtitle_color'];
		} elseif (!empty($module_info)) {
			$data['module_subtitle_color'] = $module_info['module_subtitle_color'];
		} else {
			$data['module_subtitle_color'] = '';
		}
		
		if (isset($this->request->post['module_icon_1_bg_color'])) {
			$data['module_icon_1_bg_color'] = $this->request->post['module_icon_1_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_icon_1_bg_color'] = $module_info['module_icon_1_bg_color'];
		} else {
			$data['module_icon_1_bg_color'] = '';
		}
		
		if (isset($this->request->post['module_icon_2_bg_color'])) {
			$data['module_icon_2_bg_color'] = $this->request->post['module_icon_2_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_icon_2_bg_color'] = $module_info['module_icon_2_bg_color'];
		} else {
			$data['module_icon_3_bg_color'] = '';
		}
		
		if (isset($this->request->post['module_icon_3_bg_color'])) {
			$data['module_icon_3_bg_color'] = $this->request->post['module_icon_3_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_icon_3_bg_color'] = $module_info['module_icon_3_bg_color'];
		} else {
			$data['module_icon_3_bg_color'] = '';
		}
		
		if (isset($this->request->post['module_icon_4_bg_color'])) {
			$data['module_icon_4_bg_color'] = $this->request->post['module_icon_4_bg_color'];
		} elseif (!empty($module_info)) {
			$data['module_icon_4_bg_color'] = $module_info['module_icon_4_bg_color'];
		} else {
			$data['module_icon_4_bg_color'] = '';
		}
		
		if (isset($this->request->post['module_icon_1_color'])) {
			$data['module_icon_1_color'] = $this->request->post['module_icon_1_color'];
		} elseif (!empty($module_info)) {
			$data['module_icon_1_color'] = $module_info['module_icon_1_color'];
		} else {
			$data['module_icon_1_color'] = '';
		}
		
		if (isset($this->request->post['module_icon_2_color'])) {
			$data['module_icon_2_color'] = $this->request->post['module_icon_2_color'];
		} elseif (!empty($module_info)) {
			$data['module_icon_2_color'] = $module_info['module_icon_2_color'];
		} else {
			$data['module_icon_2_color'] = '';
		}
		
		if (isset($this->request->post['module_icon_3_color'])) {
			$data['module_icon_3_color'] = $this->request->post['module_icon_3_color'];
		} elseif (!empty($module_info)) {
			$data['module_icon_3_color'] = $module_info['module_icon_3_color'];
		} else {
			$data['module_icon_3_color'] = '';
		}
		
		if (isset($this->request->post['module_icon_4_color'])) {
			$data['module_icon_4_color'] = $this->request->post['module_icon_4_color'];
		} elseif (!empty($module_info)) {
			$data['module_icon_4_color'] = $module_info['module_icon_4_color'];
		} else {
			$data['module_icon_4_color'] = '';
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

		$this->response->setOutput($this->load->view('extension/module/theme_features_blocks', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/theme_features_blocks')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
				
		return !$this->error;
	}
}