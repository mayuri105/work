<?php
class ControllerExtensionModuleOXYTHEMEOPTIONS extends Controller {
	private $error = array();
	
	public function index() {
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$language = $this->load->language('extension/module/oxy_theme_options');
		$this->document->setTitle('OXY Theme Settings - General Options');
        $data = array_merge($data, $language);
		
        $this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$languages = $this->model_localisation_language->getLanguages();

        $this->load->model('tool/image');
		
		/*  Multi Store  */

		if (isset($this->request->post['store_id'])) {
			$data['store_id'] = $this->request->post['store_id'];
		} else {
			$data['store_id'] = $this->config->get('t1o_store_id');
		}

		$data['stores'] = array();
		
		$this->load->model('setting/store');
		
		$results = $this->model_setting_store->getStores();
		
		$data['stores'][] = array(
			'name' => 'Default',
			'href' => '',
			'store_id' => 0
		);
			
		foreach ($results as $result) {
			$data['stores'][] = array(
				'name' => $result['name'],
				'href' => $result['url'],
				'store_id' => $result['store_id']
			);
		}			

		if(isset($_GET['store_id'])) {
			$data['store_id'] = $_GET['store_id'];
		} else {
			if (isset($_GET['submit'])) {
				$data['store_id'] = $data['store_id'];
			} else {
				if (isset($this->request->post['store_id'])) {
					$data['store_id'] = $this->request->post['store_id'];
				} else {
					$data['store_id'] = 0;
				}
			}
		}
		
        $data['text_image_manager'] = 'Image manager';
        $data['user_token'] = $this->session->data['user_token'];
		
		$text_strings = array(
            'heading_title',
            'text_enabled',
            'text_disabled',
            'text_content_top',
            'text_content_bottom',
            'text_column_left',
            'text_column_right',
            'entry_status',
            'entry_sort_order',
            'button_save',
            'button_cancel',
        );
        
        foreach ($text_strings as $text) {
            $data[$text] = $this->language->get($text);
        }

        
        $data['modules'] = array();  

        $config_data = array(

        't1o_status',
		
		't1o_layout_style',
		't1o_layout_l',
		't1o_layout_framed_align',
		't1o_layout_full_width_max',
		't1o_layout_h_align',
		't1o_layout_catalog_mode',
		
		't1o_top_bar_status',
		't1o_top_bar_cart_link_status',
		't1o_top_bar_welcome_status',
		't1o_top_bar_welcome_awesome',
		't1o_top_bar_welcome',
		't1o_header_style',
		't1o_text_logo',
		't1o_text_logo_color',
		't1o_text_logo_awesome_status',
		't1o_text_logo_awesome',
		't1o_text_logo_awesome_color',
		't1o_header_fixed_header_status',
		't1o_header_auto_suggest_status',
		't1o_top_custom_block_status',
		't1o_top_custom_block_awesome_status',
		't1o_top_custom_block_awesome',
		't1o_top_custom_block_awesome_color',
		't1o_top_custom_block_title',
		't1o_top_custom_block_title_color',
		't1o_top_custom_block_title_bar_bg_color',
		
		't1o_top_custom_block_bar_bg',
		't1o_top_custom_block_content',
		't1o_top_custom_block_bg',
		't1o_top_custom_block_bg_color',
		't1o_top_custom_block_text_color',
		
		't1o_news_status',
		't1o_news',
		't1o_news_bg_color',
		't1o_news_icons_color',
		't1o_news_word_color',
		't1o_news_color',
		't1o_news_hover_color',
		
		't1o_header_custom_block_1_status',
		't1o_header_custom_block_1_content',
		
		't1o_header_popular_search_status',
		't1o_header_popular_search',
		
		't1o_menu_align',
		
		't1o_menu_homepage',	
		
        't1o_menu_categories',		
        't1o_menu_categories_status',
        't1o_menu_categories_style',
		't1o_menu_categories_per_row',
		't1o_menu_categories_3_level',
		't1o_menu_categories_home_visibility',
		't1o_menu_main_category_icon_status',
		't1o_menu_main_category_padding_right',
		't1o_menu_main_category_padding_bottom',
		't1o_menu_categories_custom_block_status',
		't1o_menu_categories_custom_block_content',
		't1o_menu_categories_custom_block_right_status',
		't1o_menu_categories_custom_block_right_content',
		't1o_menu_categories_custom_block_left_status',
		't1o_menu_categories_custom_block_left_content',
		
        't1o_menu_brands',		
        't1o_menu_brands_status',
        't1o_menu_brands_style',		
        't1o_menu_brands_per_row',				
		
		't1o_menu_link',
		
        't1o_menu_cm_status',	
		't1o_menu_cm_title',	
		't1o_menu_cm_link',
		't1o_menu_cm_2_status',	
		't1o_menu_cm_2_title',	
		't1o_menu_cm_2_link',
		't1o_menu_cm_3_status',	
		't1o_menu_cm_3_title',	
		't1o_menu_cm_3_link',			
		
        't1o_menu_custom_block',
		
		't1o_menu_labels',
		't1o_menu_labels_color',
		
		't1o_custom_bar_below_menu_status',
		't1o_custom_bar_below_menu_content',
		't1o_custom_bar_below_menu_bg',
		't1o_custom_bar_below_menu_bg_color',
		't1o_custom_bar_below_menu_bg_animation',
		't1o_custom_bar_below_menu_text_color',
		
		't1o_product_grid_per_row',
		't1o_bestseller_style',
		't1o_bestseller_per_row',
        't1o_featured_style',	
		't1o_featured_per_row',	
        't1o_latest_style',
		't1o_latest_per_row',
        't1o_specials_style',
		't1o_specials_per_row',
		't1o_most_viewed_style',
		't1o_most_viewed_per_row',
		't1o_product_tabs_style',
		't1o_product_tabs_per_row',
		't1o_related_per_row',
		't1o_carousel_items_per_row',

		't1o_category_title_position',
		't1o_category_title_above_color',
		't1o_category_desc_status',
		't1o_category_img_status',
		't1o_category_img_parallax',
		't1o_category_subcategories_status',				
        't1o_category_subcategories_style',
		't1o_category_subcategories_per_row',
		't1o_category_subcategories_autoplay',
		't1o_category_prod_box_style',
        't1o_sale_badge_status',
		't1o_sale_badge_type',
		't1o_new_badge_status',
		't1o_out_of_stock_badge_status',
		't1o_category_prod_name_status',
		't1o_category_prod_brand_status',
		't1o_category_prod_price_status',
		't1o_category_prod_quickview_status',
		't1o_category_prod_cart_status',
		't1o_category_prod_ratings_status',
		't1o_category_prod_wis_com_status',
		't1o_category_prod_zoom_status',
		't1o_category_prod_swap_status',
		't1o_category_prod_shadow_status',
		't1o_category_prod_lift_up_status',
		't1o_category_prod_align',
		
		't1o_product_prev_next_status',
		't1o_layout_product_page',
		't1o_additional_images',
		't1o_product_name_position',
		't1o_product_align',
		't1o_product_manufacturer_logo_status',		
		't1o_product_save_percent_status',
		't1o_product_tax_status',			
        't1o_product_viewed_status',	
		't1o_product_i_c_status',
		't1o_product_related_status',
        't1o_product_related_position',
		't1o_product_related_style',
		
		't1o_product_fb1_title',
		't1o_product_fb1_subtitle',
		't1o_product_fb2_title',
		't1o_product_fb2_subtitle',
		't1o_product_fb3_title',
		't1o_product_fb3_subtitle',
		
		't1o_product_fb1_icon',
		't1o_product_fb1_icon_thumb',
		't1o_product_fb2_icon',
		't1o_product_fb2_icon_thumb',
		't1o_product_fb3_icon',
		't1o_product_fb3_icon_thumb',
		
		't1o_product_fb1_awesome',
		't1o_product_fb2_awesome',
		't1o_product_fb3_awesome',
			
        't1o_product_fb1_content',
		't1o_product_fb2_content',
		't1o_product_fb3_content',
		
		't1o_product_custom_block_1_status',
		't1o_product_custom_block_1_title',
		't1o_product_custom_block_1_content',
		't1o_product_custom_block_2_status',
		't1o_product_custom_block_2_title',
		't1o_product_custom_block_2_content',
		't1o_product_custom_block_3_status',
		't1o_product_custom_block_3_title',
		't1o_product_custom_block_3_content',
		
		't1o_product_custom_tab',
		
		't1o_contact_custom_status',
		't1o_contact_map_status',
		't1o_contact_map_ll',
		't1o_contact_map_api',
		't1o_contact_map_type',
		
		't1o_information_block_width',
		't1o_information_column_1_status',	
		't1o_information_column_2_status',	
		't1o_i_c_2_1_status',
		't1o_i_c_2_2_status',
		't1o_i_c_2_3_status',
		't1o_i_c_2_4_status',
		't1o_i_c_2_5_status',
		't1o_information_column_3_status',
		't1o_i_c_3_1_status',
		't1o_i_c_3_2_status',
		't1o_i_c_3_3_status',
		't1o_i_c_3_4_status',
		't1o_i_c_3_5_status',
		't1o_i_c_3_6_status',
		
		't1o_custom_top_1_status',
		't1o_custom_top_1_content',
		't1o_custom_1_status',
		't1o_custom_1_column_width',
		't1o_custom_1_title',
		't1o_custom_1_content',
		't1o_custom_2_status',
		't1o_custom_2_column_width',
		't1o_custom_2_title',
		't1o_custom_2_content',
		't1o_newsletter_status',
		't1o_newsletter_campaign_url',
		't1o_newsletter_promo_text',
		't1o_newsletter_email',
		't1o_newsletter_subscribe',
		't1o_custom_bottom_1_status',
		't1o_custom_bottom_1_content',
		't1o_custom_bottom_2_status',
		't1o_custom_bottom_2_content',
		't1o_custom_bottom_2_footer_margin',
		
		't1o_powered_status',
		't1o_powered_content',
		
		't1o_follow_us_status',
        't1o_facebook',
        't1o_twitter',
        't1o_googleplus',
        't1o_rss',
        't1o_pinterest',
		't1o_vk',
        't1o_vimeo',
        't1o_flickr',		
        't1o_linkedin',	
        't1o_youtube',		
        't1o_dribbble',
		't1o_instagram',
		't1o_behance',	
		't1o_skype',	
		't1o_tumblr',		
		't1o_reddit',
		
		't1o_payment_block_status',
		't1o_payment_block_custom',
		't1o_payment_block_custom_thumb',
		't1o_payment_block_custom_status',
		't1o_payment_block_custom_url',		
        't1o_payment_paypal',
        't1o_payment_paypal_url',		
        't1o_payment_visa',
        't1o_payment_visa_url',			
        't1o_payment_mastercard',	
        't1o_payment_mastercard_url',
        't1o_payment_maestro',	
        't1o_payment_maestro_url',
        't1o_payment_discover',	
        't1o_payment_discover_url',			
        't1o_payment_skrill',	
        't1o_payment_skrill_url',
        't1o_payment_american_express',	
        't1o_payment_american_express_url',		
		't1o_payment_cirrus',	
        't1o_payment_cirrus_url',		
		't1o_payment_delta',
        't1o_payment_delta_url',		
		't1o_payment_google',	
        't1o_payment_google_url',		
		't1o_payment_2co',	
        't1o_payment_2co_url',		
		't1o_payment_sage',	
        't1o_payment_sage_url',		
		't1o_payment_solo',	
        't1o_payment_solo_url',		
		't1o_payment_amazon',	
        't1o_payment_amazon_url',		
		't1o_payment_western_union',	
        't1o_payment_western_union_url',	
		
		't1o_left_right_column_categories_type',
		
		't1o_others_totop',
		
		't1o_facebook_likebox_status',	
        't1o_facebook_likebox_id',	
		
		't1o_twitter_block_status',
        't1o_twitter_block_user',
        't1o_twitter_block_widget_id',
		't1o_twitter_block_tweets',
		
		't1o_googleplus_box_status',	
        't1o_googleplus_box_user',
		
		't1o_pinterest_box_status',	
        't1o_pinterest_box_user',
		
		't1o_snapchat_box_status',	
		't1o_snapchat_box_code_custom',
		't1o_snapchat_box_code_custom_thumb',
		't1o_snapchat_box_title',
		't1o_snapchat_box_subtitle',
		't1o_snapchat_box_bg',
		
		't1o_video_box_status',
		't1o_video_box_content',	
		't1o_video_box_bg',
		
        't1o_custom_box_status',
		't1o_custom_box_content',
		't1o_custom_box_bg',
		
		't1o_eu_cookie_status',
		't1o_eu_cookie_icon_status',
		't1o_eu_cookie_message',
		't1o_eu_cookie_close',
		
		't1o_custom_css',
		't1o_custom_js',
		
		't1o_text_sale',
		't1o_text_new_prod',
		't1o_text_quickview',
		't1o_text_shop_now',
		't1o_text_view',
		't1o_text_next_product',
		't1o_text_previous_product',
		't1o_text_product_viewed',
		't1o_text_special_price',
		't1o_text_old_price',
		't1o_text_percent_saved',
		't1o_text_product_friend',
		't1o_text_menu_categories',
		't1o_text_menu_brands',
		't1o_text_contact_us',
		't1o_text_menu_contact_address',
		't1o_text_menu_contact_email',
		't1o_text_menu_contact_tel',
		't1o_text_menu_contact_fax',
		't1o_text_menu_contact_hours',
		't1o_text_menu_contact_form',
		't1o_text_menu_menu',
		't1o_text_see_all_products_by',
		't1o_text_bestseller',
		't1o_text_featured',
		't1o_text_latest',
		't1o_text_special',
		't1o_text_most_viewed',
		't1o_text_news',
		't1o_text_gallery',
		't1o_text_small_list',
		't1o_text_your_cart',
		't1o_text_popular_search',
		't1o_text_advanced_search',
		
        );
		
		$data['t1o_conf'] = $this->model_setting_setting->getSetting('t1o', $data['store_id']);
		
		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$data[$conf] = $this->request->post[$conf];
			} else {
				if(isset($data['t1o_conf'][$conf])) {
					$data[$conf] = $data['t1o_conf'][$conf];
				} else {
					$data[$conf] = false;
				}
			}
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
					
			$data['array'] = array( 't1o_store_id' => $this->request->post['store_id'] );

			$this->model_setting_setting->editSetting('t1o_store_id', $data['array']);
			$this->model_setting_setting->editSetting('t1o', $this->request->post, $this->request->post['store_id']);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/oxy_theme_options&submit=true', 'user_token=' . $this->session->data['user_token'], true));						
		}
		
		if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'user_token=' . $this->session->data['user_token'], true),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/oxy_theme_options', 'user_token=' . $this->session->data['user_token'], true),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('extension/module/oxy_theme_options', 'user_token=' . $this->session->data['user_token'], true);
		
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		
		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();
					 	
		if (isset($data['t1o_top_custom_block_bar_bg']) && $data['t1o_top_custom_block_bar_bg'] != "" && file_exists(DIR_IMAGE . $data['t1o_top_custom_block_bar_bg'])) {
            $data['t1o_top_custom_block_bar_bg_thumb'] = $this->model_tool_image->resize($data['t1o_top_custom_block_bar_bg'], 100, 100);
        } else {
            $data['t1o_top_custom_block_bar_bg_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
		if (isset($data['t1o_top_custom_block_bg']) && $data['t1o_top_custom_block_bg'] != "" && file_exists(DIR_IMAGE . $data['t1o_top_custom_block_bg'])) {
            $data['t1o_top_custom_block_bg_thumb'] = $this->model_tool_image->resize($data['t1o_top_custom_block_bg'], 100, 100);
        } else {
            $data['t1o_top_custom_block_bg_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
		if (isset($data['t1o_custom_bar_below_menu_bg']) && $data['t1o_custom_bar_below_menu_bg'] != "" && file_exists(DIR_IMAGE . $data['t1o_custom_bar_below_menu_bg'])) {
            $data['t1o_custom_bar_below_menu_bg_thumb'] = $this->model_tool_image->resize($data['t1o_custom_bar_below_menu_bg'], 100, 100);
        } else {
            $data['t1o_custom_bar_below_menu_bg_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }							
		if (isset($data['t1o_product_fb1_icon']) && $data['t1o_product_fb1_icon'] != "" && file_exists(DIR_IMAGE . $data['t1o_product_fb1_icon'])) {
            $data['t1o_product_fb1_icon_thumb'] = $this->model_tool_image->resize($data['t1o_product_fb1_icon'], 100, 100);
        } else {
            $data['t1o_product_fb1_icon_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
		if (isset($data['t1o_product_fb2_icon']) && $data['t1o_product_fb2_icon'] != "" && file_exists(DIR_IMAGE . $data['t1o_product_fb2_icon'])) {
            $data['t1o_product_fb2_icon_thumb'] = $this->model_tool_image->resize($data['t1o_product_fb2_icon'], 100, 100);
        } else {
            $data['t1o_product_fb2_icon_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
		if (isset($data['t1o_product_fb3_icon']) && $data['t1o_product_fb3_icon'] != "" && file_exists(DIR_IMAGE . $data['t1o_product_fb3_icon'])) {
            $data['t1o_product_fb3_icon_thumb'] = $this->model_tool_image->resize($data['t1o_product_fb3_icon'], 100, 100);
        } else {
            $data['t1o_product_fb3_icon_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
		if (isset($data['t1o_about_logo_icon']) && $data['t1o_about_logo_icon'] != "" && file_exists(DIR_IMAGE . $data['t1o_about_logo_icon'])) {
            $data['t1o_about_logo_icon_thumb'] = $this->model_tool_image->resize($data['t1o_about_logo_icon'], 100, 100);
        } else {
            $data['t1o_about_logo_icon_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }	
			
	    if (isset($data['t1o_bg_image_f1_custom']) && $data['t1o_bg_image_f1_custom'] != "" && file_exists(DIR_IMAGE . $data['t1o_bg_image_f1_custom'])) {
            $data['t1o_bg_image_f1_thumb'] = $this->model_tool_image->resize($data['t1o_bg_image_f1_custom'], 100, 100);
        } else {
            $data['t1o_bg_image_f1_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
	    if (isset($data['t1o_bg_image_f2_custom']) && $data['t1o_bg_image_f2_custom'] != "" && file_exists(DIR_IMAGE . $data['t1o_bg_image_f2_custom'])) {
            $data['t1o_bg_image_f2_thumb'] = $this->model_tool_image->resize($data['t1o_bg_image_f2_custom'], 100, 100);
        } else {
            $data['t1o_bg_image_f2_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }	
	    if (isset($data['t1o_bg_image_f4_custom']) && $data['t1o_bg_image_f4_custom'] != "" && file_exists(DIR_IMAGE . $data['t1o_bg_image_f4_custom'])) {
            $data['t1o_bg_image_f4_thumb'] = $this->model_tool_image->resize($data['t1o_bg_image_f4_custom'], 100, 100);
        } else {
            $data['t1o_bg_image_f4_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
	    if (isset($data['t1o_bg_image_f5_custom']) && $data['t1o_bg_image_f5_custom'] != "" && file_exists(DIR_IMAGE . $data['t1o_bg_image_f5_custom'])) {
            $data['t1o_bg_image_f5_thumb'] = $this->model_tool_image->resize($data['t1o_bg_image_f5_custom'], 100, 100);
        } else {
            $data['t1o_bg_image_f5_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }			
        if (isset($data['t1o_payment_block_custom']) && $data['t1o_payment_block_custom'] != "" && file_exists(DIR_IMAGE . $data['t1o_payment_block_custom'])) {
            $data['t1o_payment_block_custom_thumb'] = $this->model_tool_image->resize($data['t1o_payment_block_custom'], 100, 100);
        } else {
            $data['t1o_payment_block_custom_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }
		if (isset($data['t1o_snapchat_box_code_custom']) && $data['t1o_snapchat_box_code_custom'] != "" && file_exists(DIR_IMAGE . $data['t1o_snapchat_box_code_custom'])) {
            $data['t1o_snapchat_box_code_custom_thumb'] = $this->model_tool_image->resize($data['t1o_snapchat_box_code_custom'], 100, 100);
        } else {
            $data['t1o_snapchat_box_code_custom_thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }			
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		
		$this->response->setOutput($this->load->view('extension/module/oxy_theme_options', $data));
	}
		
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/oxy_theme_options')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>