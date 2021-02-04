<?php
class ControllerExtensionModuleThemeSlideshow extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/theme_slideshow');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$languages = $this->model_localisation_language->getLanguages();
		
		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('theme_slideshow', $this->request->post);
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
				'href' => $this->url->link('extension/module/theme_slideshow', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/theme_slideshow', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);			
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/theme_slideshow', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/theme_slideshow', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
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

		$this->load->model('tool/image');
		
		if (isset($this->request->post['slideshow_hover_bg_color_status'])) {
			$data['slideshow_hover_bg_color_status'] = $this->request->post['slideshow_hover_bg_color_status'];
		} elseif (!empty($module_info)) {
			$data['slideshow_hover_bg_color_status'] = $module_info['slideshow_hover_bg_color_status'];
		} else {
			$data['slideshow_hover_bg_color_status'] = '0';
		}
		
		if (isset($this->request->post['slideshow_hover_bg_color'])) {
			$data['slideshow_hover_bg_color'] = $this->request->post['slideshow_hover_bg_color'];
		} elseif (!empty($module_info)) {
			$data['slideshow_hover_bg_color'] = $module_info['slideshow_hover_bg_color'];
		} else {
			$data['slideshow_hover_bg_color'] = '';
		}
		
		if (isset($this->request->post['slideshow_hover_bg_color_opacity'])) {
			$data['slideshow_hover_bg_color_opacity'] = $this->request->post['slideshow_hover_bg_color_opacity'];
		} elseif (!empty($module_info)) {
			$data['slideshow_hover_bg_color_opacity'] = $module_info['slideshow_hover_bg_color_opacity'];
		} else {
			$data['slideshow_hover_bg_color_opacity'] = '0.1';
		}

		if (isset($this->request->post['slideshow_pagination'])) {
			$data['slideshow_pagination'] = $this->request->post['slideshow_pagination'];
		} elseif (!empty($module_info)) {
			$data['slideshow_pagination'] = $module_info['slideshow_pagination'];
		} else {
			$data['slideshow_pagination'] = '';
		}
		
		if (isset($this->request->post['slideshow_time'])) {
			$data['slideshow_time'] = $this->request->post['slideshow_time'];
		} elseif (!empty($module_info)) {
			$data['slideshow_time'] = $module_info['slideshow_time'];
		} else {
			$data['slideshow_time'] = '7000';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		if (isset($this->request->post['slideshow_item'])) {
			$data['slideshow_item'] = $this->request->post['slideshow_item'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item'] = $module_info['slideshow_item'];
		} else {
			$data['slideshow_item'] = '';
		}
		
		if (isset($this->request->post['slideshow_label_color_1'])) {
			$data['slideshow_label_color_1'] = $this->request->post['slideshow_label_color_1'];
		} elseif (!empty($module_info)) {
			$data['slideshow_label_color_1'] = $module_info['slideshow_label_color_1'];
		} else {
			$data['slideshow_label_color_1'] = '';
		}
		
		if (isset($this->request->post['slideshow_title_color_1'])) {
			$data['slideshow_title_color_1'] = $this->request->post['slideshow_title_color_1'];
		} elseif (!empty($module_info)) {
			$data['slideshow_title_color_1'] = $module_info['slideshow_title_color_1'];
		} else {
			$data['slideshow_title_color_1'] = '';
		}
		
		if (isset($this->request->post['slideshow_subtitle_color_1'])) {
			$data['slideshow_subtitle_color_1'] = $this->request->post['slideshow_subtitle_color_1'];
		} elseif (!empty($module_info)) {
			$data['slideshow_subtitle_color_1'] = $module_info['slideshow_subtitle_color_1'];
		} else {
			$data['slideshow_subtitle_color_1'] = '';
		}
		
		if (isset($this->request->post['slideshow_label_color_2'])) {
			$data['slideshow_label_color_2'] = $this->request->post['slideshow_label_color_2'];
		} elseif (!empty($module_info)) {
			$data['slideshow_label_color_2'] = $module_info['slideshow_label_color_2'];
		} else {
			$data['slideshow_label_color_2'] = '';
		}
		
		if (isset($this->request->post['slideshow_title_color_2'])) {
			$data['slideshow_title_color_2'] = $this->request->post['slideshow_title_color_2'];
		} elseif (!empty($module_info)) {
			$data['slideshow_title_color_2'] = $module_info['slideshow_title_color_2'];
		} else {
			$data['slideshow_title_color_2'] = '';
		}
		
		if (isset($this->request->post['slideshow_subtitle_color_2'])) {
			$data['slideshow_subtitle_color_2'] = $this->request->post['slideshow_subtitle_color_2'];
		} elseif (!empty($module_info)) {
			$data['slideshow_subtitle_color_2'] = $module_info['slideshow_subtitle_color_2'];
		} else {
			$data['slideshow_subtitle_color_2'] = '';
		}
		
		if (isset($this->request->post['slideshow_label_color_3'])) {
			$data['slideshow_label_color_3'] = $this->request->post['slideshow_label_color_3'];
		} elseif (!empty($module_info)) {
			$data['slideshow_label_color_3'] = $module_info['slideshow_label_color_3'];
		} else {
			$data['slideshow_label_color_3'] = '';
		}
		
		if (isset($this->request->post['slideshow_title_color_3'])) {
			$data['slideshow_title_color_3'] = $this->request->post['slideshow_title_color_3'];
		} elseif (!empty($module_info)) {
			$data['slideshow_title_color_3'] = $module_info['slideshow_title_color_3'];
		} else {
			$data['slideshow_title_color_3'] = '';
		}
		
		if (isset($this->request->post['slideshow_subtitle_color_3'])) {
			$data['slideshow_subtitle_color_3'] = $this->request->post['slideshow_subtitle_color_3'];
		} elseif (!empty($module_info)) {
			$data['slideshow_subtitle_color_3'] = $module_info['slideshow_subtitle_color_3'];
		} else {
			$data['slideshow_subtitle_color_3'] = '';
		}
		
		if (isset($this->request->post['slideshow_label_color_4'])) {
			$data['slideshow_label_color_4'] = $this->request->post['slideshow_label_color_4'];
		} elseif (!empty($module_info)) {
			$data['slideshow_label_color_4'] = $module_info['slideshow_label_color_4'];
		} else {
			$data['slideshow_label_color_4'] = '';
		}
		
		if (isset($this->request->post['slideshow_title_color_4'])) {
			$data['slideshow_title_color_4'] = $this->request->post['slideshow_title_color_4'];
		} elseif (!empty($module_info)) {
			$data['slideshow_title_color_4'] = $module_info['slideshow_title_color_4'];
		} else {
			$data['slideshow_title_color_4'] = '';
		}
		
		if (isset($this->request->post['slideshow_subtitle_color_4'])) {
			$data['slideshow_subtitle_color_4'] = $this->request->post['slideshow_subtitle_color_4'];
		} elseif (!empty($module_info)) {
			$data['slideshow_subtitle_color_4'] = $module_info['slideshow_subtitle_color_4'];
		} else {
			$data['slideshow_subtitle_color_4'] = '';
		}
		
		if (isset($this->request->post['slideshow_label_color_5'])) {
			$data['slideshow_label_color_5'] = $this->request->post['slideshow_label_color_5'];
		} elseif (!empty($module_info)) {
			$data['slideshow_label_color_5'] = $module_info['slideshow_label_color_5'];
		} else {
			$data['slideshow_label_color_5'] = '';
		}
		
		if (isset($this->request->post['slideshow_title_color_5'])) {
			$data['slideshow_title_color_5'] = $this->request->post['slideshow_title_color_5'];
		} elseif (!empty($module_info)) {
			$data['slideshow_title_color_5'] = $module_info['slideshow_title_color_5'];
		} else {
			$data['slideshow_title_color_5'] = '';
		}
		
		if (isset($this->request->post['slideshow_subtitle_color_5'])) {
			$data['slideshow_subtitle_color_5'] = $this->request->post['slideshow_subtitle_color_5'];
		} elseif (!empty($module_info)) {
			$data['slideshow_subtitle_color_5'] = $module_info['slideshow_subtitle_color_5'];
		} else {
			$data['slideshow_subtitle_color_5'] = '';
		}
		
		if (isset($this->request->post['slideshow_label_color_6'])) {
			$data['slideshow_label_color_6'] = $this->request->post['slideshow_label_color_6'];
		} elseif (!empty($module_info)) {
			$data['slideshow_label_color_6'] = $module_info['slideshow_label_color_6'];
		} else {
			$data['slideshow_label_color_6'] = '';
		}
		
		if (isset($this->request->post['slideshow_title_color_6'])) {
			$data['slideshow_title_color_6'] = $this->request->post['slideshow_title_color_6'];
		} elseif (!empty($module_info)) {
			$data['slideshow_title_color_6'] = $module_info['slideshow_title_color_6'];
		} else {
			$data['slideshow_title_color_6'] = '';
		}
		
		if (isset($this->request->post['slideshow_subtitle_color_6'])) {
			$data['slideshow_subtitle_color_6'] = $this->request->post['slideshow_subtitle_color_6'];
		} elseif (!empty($module_info)) {
			$data['slideshow_subtitle_color_6'] = $module_info['slideshow_subtitle_color_6'];
		} else {
			$data['slideshow_subtitle_color_6'] = '';
		}



		
		if (isset($this->request->post['slideshow_item_image_custom_1'])) {
			$data['slideshow_item_image_custom_1'] = $this->request->post['slideshow_item_image_custom_1'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_image_custom_1'] = $module_info['slideshow_item_image_custom_1'];
		} else {
			$data['slideshow_item_image_custom_1'] = '';
		}

		if (isset($this->request->post['slideshow_item_image_custom_1']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_image_custom_1'])) {
			$data['slideshow_item_image_thumb_1'] = $this->model_tool_image->resize($this->request->post['slideshow_item_image_custom_1'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_image_custom_1'])) {
			$data['slideshow_item_image_thumb_1'] = $this->model_tool_image->resize($module_info['slideshow_item_image_custom_1'], 100, 100);
		} else {
			$data['slideshow_item_image_thumb_1'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_main_image_custom_1'])) {
			$data['slideshow_item_main_image_custom_1'] = $this->request->post['slideshow_item_main_image_custom_1'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_main_image_custom_1'] = $module_info['slideshow_item_main_image_custom_1'];
		} else {
			$data['slideshow_item_main_image_custom_1'] = '';
		}

		if (isset($this->request->post['slideshow_item_main_image_custom_1']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_main_image_custom_1'])) {
			$data['slideshow_item_main_image_thumb_1'] = $this->model_tool_image->resize($this->request->post['slideshow_item_main_image_custom_1'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_main_image_custom_1'])) {
			$data['slideshow_item_main_image_thumb_1'] = $this->model_tool_image->resize($module_info['slideshow_item_main_image_custom_1'], 100, 100);
		} else {
			$data['slideshow_item_main_image_thumb_1'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_image_custom_2'])) {
			$data['slideshow_item_image_custom_2'] = $this->request->post['slideshow_item_image_custom_2'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_image_custom_2'] = $module_info['slideshow_item_image_custom_2'];
		} else {
			$data['slideshow_item_image_custom_2'] = '';
		}

		if (isset($this->request->post['slideshow_item_image_custom_2']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_image_custom_2'])) {
			$data['slideshow_item_image_thumb_2'] = $this->model_tool_image->resize($this->request->post['slideshow_item_image_custom_2'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_image_custom_2'])) {
			$data['slideshow_item_image_thumb_2'] = $this->model_tool_image->resize($module_info['slideshow_item_image_custom_2'], 100, 100);
		} else {
			$data['slideshow_item_image_thumb_2'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_main_image_custom_2'])) {
			$data['slideshow_item_main_image_custom_2'] = $this->request->post['slideshow_item_main_image_custom_2'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_main_image_custom_2'] = $module_info['slideshow_item_main_image_custom_2'];
		} else {
			$data['slideshow_item_main_image_custom_2'] = '';
		}

		if (isset($this->request->post['slideshow_item_main_image_custom_2']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_main_image_custom_2'])) {
			$data['slideshow_item_main_image_thumb_2'] = $this->model_tool_image->resize($this->request->post['slideshow_item_main_image_custom_2'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_main_image_custom_2'])) {
			$data['slideshow_item_main_image_thumb_2'] = $this->model_tool_image->resize($module_info['slideshow_item_main_image_custom_2'], 100, 100);
		} else {
			$data['slideshow_item_main_image_thumb_2'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_image_custom_3'])) {
			$data['slideshow_item_image_custom_3'] = $this->request->post['slideshow_item_image_custom_3'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_image_custom_3'] = $module_info['slideshow_item_image_custom_3'];
		} else {
			$data['slideshow_item_image_custom_3'] = '';
		}

		if (isset($this->request->post['slideshow_item_image_custom_3']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_image_custom_3'])) {
			$data['slideshow_item_image_thumb_3'] = $this->model_tool_image->resize($this->request->post['slideshow_item_image_custom_3'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_image_custom_3'])) {
			$data['slideshow_item_image_thumb_3'] = $this->model_tool_image->resize($module_info['slideshow_item_image_custom_3'], 100, 100);
		} else {
			$data['slideshow_item_image_thumb_3'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_main_image_custom_3'])) {
			$data['slideshow_item_main_image_custom_3'] = $this->request->post['slideshow_item_main_image_custom_3'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_main_image_custom_3'] = $module_info['slideshow_item_main_image_custom_3'];
		} else {
			$data['slideshow_item_main_image_custom_3'] = '';
		}

		if (isset($this->request->post['slideshow_item_main_image_custom_3']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_main_image_custom_3'])) {
			$data['slideshow_item_main_image_thumb_3'] = $this->model_tool_image->resize($this->request->post['slideshow_item_main_image_custom_3'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_main_image_custom_3'])) {
			$data['slideshow_item_main_image_thumb_3'] = $this->model_tool_image->resize($module_info['slideshow_item_main_image_custom_3'], 100, 100);
		} else {
			$data['slideshow_item_main_image_thumb_3'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_image_custom_4'])) {
			$data['slideshow_item_image_custom_4'] = $this->request->post['slideshow_item_image_custom_4'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_image_custom_4'] = $module_info['slideshow_item_image_custom_4'];
		} else {
			$data['slideshow_item_image_custom_4'] = '';
		}

		if (isset($this->request->post['slideshow_item_image_custom_4']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_image_custom_4'])) {
			$data['slideshow_item_image_thumb_4'] = $this->model_tool_image->resize($this->request->post['slideshow_item_image_custom_4'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_image_custom_4'])) {
			$data['slideshow_item_image_thumb_4'] = $this->model_tool_image->resize($module_info['slideshow_item_image_custom_4'], 100, 100);
		} else {
			$data['slideshow_item_image_thumb_4'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_main_image_custom_4'])) {
			$data['slideshow_item_main_image_custom_4'] = $this->request->post['slideshow_item_main_image_custom_4'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_main_image_custom_4'] = $module_info['slideshow_item_main_image_custom_4'];
		} else {
			$data['slideshow_item_main_image_custom_4'] = '';
		}

		if (isset($this->request->post['slideshow_item_main_image_custom_4']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_main_image_custom_4'])) {
			$data['slideshow_item_main_image_thumb_4'] = $this->model_tool_image->resize($this->request->post['slideshow_item_main_image_custom_4'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_main_image_custom_4'])) {
			$data['slideshow_item_main_image_thumb_4'] = $this->model_tool_image->resize($module_info['slideshow_item_main_image_custom_4'], 100, 100);
		} else {
			$data['slideshow_item_main_image_thumb_4'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_image_custom_5'])) {
			$data['slideshow_item_image_custom_5'] = $this->request->post['slideshow_item_image_custom_5'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_image_custom_5'] = $module_info['slideshow_item_image_custom_5'];
		} else {
			$data['slideshow_item_image_custom_5'] = '';
		}

		if (isset($this->request->post['slideshow_item_image_custom_5']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_image_custom_5'])) {
			$data['slideshow_item_image_thumb_5'] = $this->model_tool_image->resize($this->request->post['slideshow_item_image_custom_5'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_image_custom_5'])) {
			$data['slideshow_item_image_thumb_5'] = $this->model_tool_image->resize($module_info['slideshow_item_image_custom_5'], 100, 100);
		} else {
			$data['slideshow_item_image_thumb_5'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_main_image_custom_5'])) {
			$data['slideshow_item_main_image_custom_5'] = $this->request->post['slideshow_item_main_image_custom_5'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_main_image_custom_5'] = $module_info['slideshow_item_main_image_custom_5'];
		} else {
			$data['slideshow_item_main_image_custom_5'] = '';
		}

		if (isset($this->request->post['slideshow_item_main_image_custom_5']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_main_image_custom_5'])) {
			$data['slideshow_item_main_image_thumb_5'] = $this->model_tool_image->resize($this->request->post['slideshow_item_main_image_custom_5'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_main_image_custom_5'])) {
			$data['slideshow_item_main_image_thumb_5'] = $this->model_tool_image->resize($module_info['slideshow_item_main_image_custom_5'], 100, 100);
		} else {
			$data['slideshow_item_main_image_thumb_5'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_image_custom_6'])) {
			$data['slideshow_item_image_custom_6'] = $this->request->post['slideshow_item_image_custom_6'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_image_custom_6'] = $module_info['slideshow_item_image_custom_6'];
		} else {
			$data['slideshow_item_image_custom_6'] = '';
		}

		if (isset($this->request->post['slideshow_item_image_custom_6']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_image_custom_6'])) {
			$data['slideshow_item_image_thumb_6'] = $this->model_tool_image->resize($this->request->post['slideshow_item_image_custom_6'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_image_custom_6'])) {
			$data['slideshow_item_image_thumb_6'] = $this->model_tool_image->resize($module_info['slideshow_item_image_custom_6'], 100, 100);
		} else {
			$data['slideshow_item_image_thumb_6'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['slideshow_item_main_image_custom_6'])) {
			$data['slideshow_item_main_image_custom_6'] = $this->request->post['slideshow_item_main_image_custom_6'];
		} elseif (!empty($module_info)) {
			$data['slideshow_item_main_image_custom_6'] = $module_info['slideshow_item_main_image_custom_6'];
		} else {
			$data['slideshow_item_main_image_custom_6'] = '';
		}

		if (isset($this->request->post['slideshow_item_main_image_custom_6']) && is_file(DIR_IMAGE . $this->request->post['slideshow_item_main_image_custom_6'])) {
			$data['slideshow_item_main_image_thumb_6'] = $this->model_tool_image->resize($this->request->post['slideshow_item_main_image_custom_6'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['slideshow_item_main_image_custom_6'])) {
			$data['slideshow_item_main_image_thumb_6'] = $this->model_tool_image->resize($module_info['slideshow_item_main_image_custom_6'], 100, 100);
		} else {
			$data['slideshow_item_main_image_thumb_6'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/theme_slideshow', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/theme_slideshow')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}
}