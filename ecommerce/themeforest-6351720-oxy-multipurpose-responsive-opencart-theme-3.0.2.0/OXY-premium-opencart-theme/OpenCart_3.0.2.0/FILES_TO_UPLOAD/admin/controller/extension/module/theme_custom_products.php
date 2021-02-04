<?php
class ControllerExtensionModuleThemeCustomProducts extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/theme_custom_products');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$languages = $this->model_localisation_language->getLanguages();
		
		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('theme_custom_products', $this->request->post);
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
		
		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}
		
		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
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
				'href' => $this->url->link('extension/module/theme_custom_products', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/theme_custom_products', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);			
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/theme_custom_products', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/theme_custom_products', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}
		
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}
		
		$data['user_token'] = $this->session->data['user_token'];
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		$this->load->model('catalog/product');
		
		$data['products'] = array();
		
		if (isset($this->request->post['product'])) {
			$products = $this->request->post['product'];
		} elseif (!empty($module_info)) {
			$products = $module_info['product'];
		} else {
			$products = array();
		}	
		
		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}
		
		if (isset($this->request->post['custom_products'])) {
			$data['custom_products'] = $this->request->post['custom_products'];
		} elseif (!empty($module_info)) {
			$data['custom_products'] = $module_info['custom_products'];
		} else {
			$data['custom_products'] = '';
		}	
		
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 10;
		}	
		
		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = '300';
		}	
			
		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = '400';
		}		
		
		if (isset($this->request->post['pr_id'])) {
			$data['pr_id'] = $this->request->post['pr_id'];
		} elseif (!empty($module_info)) {
			$data['pr_id'] = $module_info['pr_id'];
		} else {
			$data['pr_id'] = '4';
		}
		
		if (isset($this->request->post['module_title_position'])) {
			$data['module_title_position'] = $this->request->post['module_title_position'];
		} elseif (!empty($module_info)) {
			$data['module_title_position'] = $module_info['module_title_position'];
		} else {
			$data['module_title_position'] = 'left';
		}
		
		if (isset($this->request->post['module_title_width'])) {
			$data['module_title_width'] = $this->request->post['module_title_width'];
		} elseif (!empty($module_info)) {
			$data['module_title_width'] = $module_info['module_title_width'];
		} else {
			$data['module_title_width'] = '3';
		}
		
		if (isset($this->request->post['module_items_width'])) {
			$data['module_items_width'] = $this->request->post['module_items_width'];
		} elseif (!empty($module_info)) {
			$data['module_items_width'] = $module_info['module_items_width'];
		} else {
			$data['module_items_width'] = '9';
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

		$this->response->setOutput($this->load->view('extension/module/theme_custom_products', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/theme_custom_products')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
				
		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}
		
		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}	

		return !$this->error;
	}
}