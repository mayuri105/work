<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		// Analytics
		$this->load->model('setting/extension');

		$data['analytics'] = array();

		$analytics = $this->model_setting_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get('analytics_' . $analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get('analytics_' . $analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}
		
		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts('header');
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		
		$data['name'] = $this->config->get('config_name');
		
		$this->load->model('catalog/information');
		
		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
    	}	

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');

        // Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}
		
		
		$data['config_ssl'] = $this->config->get('config_ssl');
		$data['config_url'] = $this->config->get('config_url');
		
		$data['lang_id'] = $this->config->get('config_language_id');
		$lang_id = $this->config->get('config_language_id');
		
		$data['t1d_skin'] = $this->config->get('t1d_skin');
		$data['t1d_body_bg_color'] = $this->config->get('t1d_body_bg_color');
		$data['t1d_bg_image_custom'] = $this->config->get('t1d_bg_image_custom');
		$data['t1d_pattern_body'] = $this->config->get('t1d_pattern_body');
		$data['t1d_bg_image_position'] = $this->config->get('t1d_bg_image_position');
		$data['t1d_bg_image_repeat'] = $this->config->get('t1d_bg_image_repeat');
		$data['t1d_bg_image_attachment'] = $this->config->get('t1d_bg_image_attachment');
		$data['t1d_headings_color'] = $this->config->get('t1d_headings_color');
		$data['t1d_headings_border_status'] = $this->config->get('t1d_headings_border_status');
		$data['t1d_headings_border_color'] = $this->config->get('t1d_headings_border_color');
		$data['t1d_body_text_color'] = $this->config->get('t1d_body_text_color');
		$data['t1d_light_text_color'] = $this->config->get('t1d_light_text_color');
		$data['t1d_other_links_color'] = $this->config->get('t1d_other_links_color');
		$data['t1d_links_hover_color'] = $this->config->get('t1d_links_hover_color');
		$data['t1d_icons_color'] = $this->config->get('t1d_icons_color');
		$data['t1d_icons_hover_color'] = $this->config->get('t1d_icons_hover_color');
		$data['t1d_wrapper_frame_bg_color_status'] = $this->config->get('t1d_wrapper_frame_bg_color_status');
		$data['t1d_wrapper_frame_bg_color'] = $this->config->get('t1d_wrapper_frame_bg_color');
		$data['t1d_wrapper_shadow'] = $this->config->get('t1d_wrapper_shadow');
		$data['t1d_boxes_shadow'] = $this->config->get('t1d_boxes_shadow');
		$data['t1o_product_grid_per_row'] = $this->config->get('t1o_product_grid_per_row');
		$data['t1d_content_column_bg_color'] = $this->config->get('t1d_content_column_bg_color');
		$data['t1d_content_column_hli_bg_color'] = $this->config->get('t1d_content_column_hli_bg_color');
		$data['t1d_content_column_hli_buy_column'] = $this->config->get('t1d_content_column_hli_buy_column');
		$data['t1d_content_column_separator_color'] = $this->config->get('t1d_content_column_separator_color');
		$data['t1d_sidebar_bg_color_status'] = $this->config->get('t1d_sidebar_bg_color_status');
		$data['t1d_sidebar_margin_bottom'] = $this->config->get('t1d_sidebar_margin_bottom');
		$data['t1d_left_column_head_title_bg_color'] = $this->config->get('t1d_left_column_head_title_bg_color');
		$data['t1d_left_column_box_bg_color'] = $this->config->get('t1d_left_column_box_bg_color');
		$data['t1d_left_column_head_title_color'] = $this->config->get('t1d_left_column_head_title_color');
		$data['t1d_left_column_box_links_color'] = $this->config->get('t1d_left_column_box_links_color');
		$data['t1d_left_column_box_links_color_hover'] = $this->config->get('t1d_left_column_box_links_color_hover');
		$data['t1d_left_column_box_text_color'] = $this->config->get('t1d_left_column_box_text_color');
		$data['t1d_sidebar_separator_status'] = $this->config->get('t1d_sidebar_separator_status');
		$data['t1d_left_column_box_separator_color'] = $this->config->get('t1d_left_column_box_separator_color');
		$data['t1d_right_column_head_title_bg_color'] = $this->config->get('t1d_right_column_head_title_bg_color');
		$data['t1d_right_column_box_bg_color'] = $this->config->get('t1d_right_column_box_bg_color');
		$data['t1d_right_column_head_title_color'] = $this->config->get('t1d_right_column_head_title_color');
		$data['t1d_right_column_box_links_color'] = $this->config->get('t1d_right_column_box_links_color');
		$data['t1d_right_column_box_links_color_hover'] = $this->config->get('t1d_right_column_box_links_color_hover');
		$data['t1d_right_column_box_text_color'] = $this->config->get('t1d_right_column_box_text_color');
		$data['t1d_right_column_box_separator_color'] = $this->config->get('t1d_right_column_box_separator_color');
		$data['t1d_category_box_head_title_bg_color'] = $this->config->get('t1d_category_box_head_title_bg_color');
		$data['t1d_category_box_box_bg_color'] = $this->config->get('t1d_category_box_box_bg_color');
		$data['t1d_category_box_box_separator_color'] = $this->config->get('t1d_category_box_box_separator_color');
		$data['t1d_category_box_head_title_color'] = $this->config->get('t1d_category_box_head_title_color');
		$data['t1d_category_box_box_links_color'] = $this->config->get('t1d_category_box_box_links_color');
		$data['t1d_category_box_box_links_color_hover'] = $this->config->get('t1d_category_box_box_links_color_hover');
		$data['t1d_category_box_box_subcat_color'] = $this->config->get('t1d_category_box_box_subcat_color');
		$data['t1d_filter_box_head_title_bg_color'] = $this->config->get('t1d_filter_box_head_title_bg_color');
		$data['t1d_filter_box_box_bg_color'] = $this->config->get('t1d_filter_box_box_bg_color');
		$data['t1d_filter_box_box_separator_color'] = $this->config->get('t1d_filter_box_box_separator_color');
		$data['t1d_filter_box_head_title_color'] = $this->config->get('t1d_filter_box_head_title_color');
		$data['t1d_filter_box_box_filter_title_color'] = $this->config->get('t1d_filter_box_box_filter_title_color');
		$data['t1d_filter_box_box_filter_name_color'] = $this->config->get('t1d_filter_box_box_filter_name_color');
		$data['t1d_filter_box_box_filter_name_color_hover'] = $this->config->get('t1d_filter_box_box_filter_name_color_hover');
		$data['t1d_filter_box_box_separator_color'] = $this->config->get('t1d_filter_box_box_separator_color');
		$data['t1o_text_logo_color'] = $this->config->get('t1o_text_logo_color');
		$data['t1o_text_logo_awesome_color'] = $this->config->get('t1o_text_logo_awesome_color');
		$data['t1o_top_custom_block_awesome_color'] = $this->config->get('t1o_top_custom_block_awesome_color');
		$data['t1o_top_custom_block_title_color'] = $this->config->get('t1o_top_custom_block_title_color');
		$data['t1o_top_custom_block_bg_color'] = $this->config->get('t1o_top_custom_block_bg_color');
		$data['t1o_top_custom_block_title_bar_bg_color'] = $this->config->get('t1o_top_custom_block_title_bar_bg_color');
		$data['t1o_top_custom_block_bar_bg'] = $this->config->get('t1o_top_custom_block_bar_bg');
		$data['t1o_top_custom_block_text_color'] = $this->config->get('t1o_top_custom_block_text_color');
		$data['t1o_top_custom_block_bg'] = $this->config->get('t1o_top_custom_block_bg');
		$data['t1o_layout_l'] = $this->config->get('t1o_layout_l');
		$data['t1o_layout_framed_align'] = $this->config->get('t1o_layout_framed_align');
		$data['t1o_layout_full_width_max'] = $this->config->get('t1o_layout_full_width_max');
		$data['t1o_layout_catalog_mode'] = $this->config->get('t1o_layout_catalog_mode');
		$data['t1d_top_area_status'] = $this->config->get('t1d_top_area_status');
		$data['t1d_top_area_bg_color'] = $this->config->get('t1d_top_area_bg_color');
		$data['t1d_bg_image_ta_custom'] = $this->config->get('t1d_bg_image_ta_custom');
		$data['t1d_pattern_k_ta'] = $this->config->get('t1d_pattern_k_ta');
		$data['t1d_bg_image_ta_position'] = $this->config->get('t1d_bg_image_ta_position');
		$data['t1d_bg_image_ta_repeat'] = $this->config->get('t1d_bg_image_ta_repeat');
		$data['t1d_bg_image_ta_attachment'] = $this->config->get('t1d_bg_image_ta_attachment');
		$data['t1d_top_area_mini_bg_color'] = $this->config->get('t1d_top_area_mini_bg_color');
		$data['t1d_top_area_icons_color'] = $this->config->get('t1d_top_area_icons_color');
		$data['t1d_top_area_icons_color_hover'] = $this->config->get('t1d_top_area_icons_color_hover');
		$data['t1d_top_area_icons_separator_status'] = $this->config->get('t1d_top_area_icons_separator_status');
		$data['t1d_top_area_icons_separator_color'] = $this->config->get('t1d_top_area_icons_separator_color');
		$data['t1d_top_area_search_bg_color'] = $this->config->get('t1d_top_area_search_bg_color');
		$data['t1d_top_area_search_border_color'] = $this->config->get('t1d_top_area_search_border_color');
		$data['t1d_top_area_search_color'] = $this->config->get('t1d_top_area_search_color');
		$data['t1d_top_area_search_color_active'] = $this->config->get('t1d_top_area_search_color_active');
		$data['t1d_top_area_search_icon_color'] = $this->config->get('t1d_top_area_search_icon_color');
		$data['t1o_news_bg_color'] = $this->config->get('t1o_news_bg_color');
		$data['t1o_news_icons_color'] = $this->config->get('t1o_news_icons_color');
		$data['t1o_news_word_color'] = $this->config->get('t1o_news_word_color');
		$data['t1o_news_color'] = $this->config->get('t1o_news_color');
		$data['t1o_news_hover_color'] = $this->config->get('t1o_news_hover_color');
		$data['t1o_top_bar_status'] = $this->config->get('t1o_top_bar_status');
		$data['t1d_top_area_tb_bg_status'] = $this->config->get('t1d_top_area_tb_bg_status');
		$data['t1d_top_area_tb_bg_color'] = $this->config->get('t1d_top_area_tb_bg_color');
		$data['t1d_top_area_tb_text_color'] = $this->config->get('t1d_top_area_tb_text_color');
		$data['t1d_top_area_tb_link_color'] = $this->config->get('t1d_top_area_tb_link_color');
		$data['t1d_top_area_tb_link_color_hover'] = $this->config->get('t1d_top_area_tb_link_color_hover');
		$data['t1d_top_area_tb_icons_color'] = $this->config->get('t1d_top_area_tb_icons_color');
		$data['t1d_top_area_tb_bottom_border_status'] = $this->config->get('t1d_top_area_tb_bottom_border_status');
		$data['t1d_top_area_tb_bottom_border_color'] = $this->config->get('t1d_top_area_tb_bottom_border_color');
		$data['t1o_header_style'] = $this->config->get('t1o_header_style');
		$data['t1o_text_logo'] = $this->config->get('t1o_text_logo');
		$data['t1o_text_logo_awesome_status'] = $this->config->get('t1o_text_logo_awesome_status');
		$data['t1o_text_logo_awesome'] = $this->config->get('t1o_text_logo_awesome');
		$data['t1o_header_fixed_header_style'] = $this->config->get('t1o_header_fixed_header_style');
		$data['t1d_mm_bg_color_status'] = $this->config->get('t1d_mm_bg_color_status');
		$data['t1d_mm_bg_color'] = $this->config->get('t1d_mm_bg_color');
		$data['t1d_mm_bg_color_status'] = $this->config->get('t1d_mm_bg_color_status');
		$data['t1d_mm_border_top_status'] = $this->config->get('t1d_mm_border_top_status');
		$data['t1d_mm_border_top_color'] = $this->config->get('t1d_mm_border_top_color');
		$data['t1d_mm_border_top_size'] = $this->config->get('t1d_mm_border_top_size');
		$data['t1d_mm_border_bottom_status'] = $this->config->get('t1d_mm_border_bottom_status');
		$data['t1d_mm_border_bottom_color'] = $this->config->get('t1d_mm_border_bottom_color');
		$data['t1d_mm_border_bottom_size'] = $this->config->get('t1d_mm_border_bottom_size');
		$data['t1d_mm_bg_color_status'] = $this->config->get('t1d_mm_bg_color_status');
		$data['t1d_bg_image_mm_custom'] = $this->config->get('t1d_bg_image_mm_custom');
		$data['t1d_pattern_k_mm'] = $this->config->get('t1d_pattern_k_mm');
		$data['t1d_bg_image_mm_repeat'] = $this->config->get('t1d_bg_image_mm_repeat');
		$data['t1d_mm_separator_status'] = $this->config->get('t1d_mm_separator_status');
		$data['t1d_mm_separator_size'] = $this->config->get('t1d_mm_separator_size');
		$data['t1d_mm_separator_color'] = $this->config->get('t1d_mm_separator_color');
		$data['t1d_mm_shadow_status'] = $this->config->get('t1d_mm_shadow_status');
		$data['t1d_mm_sort_down_icon_status'] = $this->config->get('t1d_mm_sort_down_icon_status');
		$data['t1d_mm1_bg_color_status'] = $this->config->get('t1d_mm1_bg_color_status');
		$data['t1d_mm1_bg_color'] = $this->config->get('t1d_mm1_bg_color');
		$data['t1d_mm1_bg_hover_color'] = $this->config->get('t1d_mm1_bg_hover_color');
		$data['t1d_mm1_link_color'] = $this->config->get('t1d_mm1_link_color');
		$data['t1d_mm1_link_hover_color'] = $this->config->get('t1d_mm1_link_hover_color');
		$data['t1d_mm2_bg_color_status'] = $this->config->get('t1d_mm2_bg_color_status');
		$data['t1d_mm2_bg_color'] = $this->config->get('t1d_mm2_bg_color');
		$data['t1d_mm2_bg_hover_color'] = $this->config->get('t1d_mm2_bg_hover_color');
		$data['t1d_mm2_link_color'] = $this->config->get('t1d_mm2_link_color');
		$data['t1d_mm2_link_hover_color'] = $this->config->get('t1d_mm2_link_hover_color');
		$data['t1o_menu_categories_home_visibility'] = $this->config->get('t1o_menu_categories_home_visibility');
		$data['t1d_mm3_bg_color_status'] = $this->config->get('t1d_mm3_bg_color_status');
		$data['t1d_mm3_bg_color'] = $this->config->get('t1d_mm3_bg_color');
		$data['t1d_mm3_bg_hover_color'] = $this->config->get('t1d_mm3_bg_hover_color');
		$data['t1d_mm3_link_color'] = $this->config->get('t1d_mm3_link_color');
		$data['t1d_mm3_link_hover_color'] = $this->config->get('t1d_mm3_link_hover_color');
		$data['t1d_mm4_bg_color_status'] = $this->config->get('t1d_mm4_bg_color_status');
		$data['t1d_mm4_bg_color'] = $this->config->get('t1d_mm4_bg_color');
		$data['t1d_mm4_bg_hover_color'] = $this->config->get('t1d_mm4_bg_hover_color');
		$data['t1d_mm4_link_color'] = $this->config->get('t1d_mm4_link_color');
		$data['t1d_mm4_link_hover_color'] = $this->config->get('t1d_mm4_link_hover_color');
		$data['t1d_mm5_bg_color_status'] = $this->config->get('t1d_mm5_bg_color_status');
		$data['t1d_mm5_bg_color'] = $this->config->get('t1d_mm5_bg_color');
		$data['t1d_mm5_bg_hover_color'] = $this->config->get('t1d_mm5_bg_hover_color');
		$data['t1d_mm5_link_color'] = $this->config->get('t1d_mm5_link_color');
		$data['t1d_mm5_link_hover_color'] = $this->config->get('t1d_mm5_link_hover_color');
		$data['t1d_mm6_bg_color_status'] = $this->config->get('t1d_mm6_bg_color_status');
		$data['t1d_mm6_bg_color'] = $this->config->get('t1d_mm6_bg_color');
		$data['t1d_mm6_bg_hover_color'] = $this->config->get('t1d_mm6_bg_hover_color');
		$data['t1d_mm6_link_color'] = $this->config->get('t1d_mm6_link_color');
		$data['t1d_mm6_link_hover_color'] = $this->config->get('t1d_mm6_link_hover_color');
		$data['t1d_mm_sub_bg_color'] = $this->config->get('t1d_mm_sub_bg_color');
		$data['t1d_mm_sub_text_color'] = $this->config->get('t1d_mm_sub_text_color');
		$data['t1d_mm_sub_titles_bg_color'] = $this->config->get('t1d_mm_sub_titles_bg_color');
		$data['t1d_mm_sub_link_color'] = $this->config->get('t1d_mm_sub_link_color');
		$data['t1d_mm_sub_link_hover_color'] = $this->config->get('t1d_mm_sub_link_hover_color');
		$data['t1d_mm_sub_subcategory_color'] = $this->config->get('t1d_mm_sub_subcategory_color');
		$data['t1d_mm_sub_box_shadow'] = $this->config->get('t1d_mm_sub_box_shadow');
		$data['t1o_menu_align'] = $this->config->get('t1o_menu_align');
		$data['t1d_mm_sub_border_status'] = $this->config->get('t1d_mm_sub_border_status');
		$data['t1d_mm2_bg_hover_color'] = $this->config->get('t1d_mm2_bg_hover_color');
		$data['t1d_mm_sub_main_category_border_status'] = $this->config->get('t1d_mm_sub_main_category_border_status');
		$data['t1d_mm_sub_subcategory_border_status'] = $this->config->get('t1d_mm_sub_subcategory_border_status');
		$data['t1o_menu_labels_color'] = $this->config->get('t1o_menu_labels_color');
		$data['t1o_custom_bar_below_menu_bg_color'] = $this->config->get('t1o_custom_bar_below_menu_bg_color');
		$data['t1o_custom_bar_below_menu_text_color'] = $this->config->get('t1o_custom_bar_below_menu_text_color');
		$data['t1o_custom_bar_below_menu_bg'] = $this->config->get('t1o_custom_bar_below_menu_bg');
		$data['t1o_custom_bar_below_menu_bg_animation'] = $this->config->get('t1o_custom_bar_below_menu_bg_animation');
		$data['t1o_category_title_above_color'] = $this->config->get('t1o_category_title_above_color');
		$data['t1o_category_title_position'] = $this->config->get('t1o_category_title_position');
		$data['t1d_mid_prod_box_sale_icon_color'] = $this->config->get('t1d_mid_prod_box_sale_icon_color');
		$data['t1d_mid_prod_box_new_icon_color'] = $this->config->get('t1d_mid_prod_box_new_icon_color');
		$data['t1d_mid_prod_box_out_of_stock_icon_color'] = $this->config->get('t1d_mid_prod_box_out_of_stock_icon_color');
		$data['t1d_mid_prod_stars_color'] = $this->config->get('t1d_mid_prod_stars_color');
		$data['t1o_category_prod_name_status'] = $this->config->get('t1o_category_prod_name_status');
		$data['t1o_category_prod_brand_status'] = $this->config->get('t1o_category_prod_brand_status');
		$data['t1o_category_prod_price_status'] = $this->config->get('t1o_category_prod_price_status');
		$data['t1o_category_prod_quickview_status'] = $this->config->get('t1o_category_prod_quickview_status');
		$data['t1o_category_prod_cart_status'] = $this->config->get('t1o_category_prod_cart_status');
		$data['t1o_category_prod_ratings_status'] = $this->config->get('t1o_category_prod_ratings_status');
		$data['t1o_category_prod_wis_com_status'] = $this->config->get('t1o_category_prod_wis_com_status');
		$data['t1o_category_prod_zoom_status'] = $this->config->get('t1o_category_prod_zoom_status');
		$data['t1o_category_prod_swap_status'] = $this->config->get('t1o_category_prod_swap_status');
		$data['t1o_category_prod_shadow_status'] = $this->config->get('t1o_category_prod_shadow_status');
		$data['t1o_category_prod_lift_up_status'] = $this->config->get('t1o_category_prod_lift_up_status');
		$data['t1o_category_prod_align'] = $this->config->get('t1o_category_prod_align');
		$data['t1o_layout_h_align'] = $this->config->get('t1o_layout_h_align');
		$data['t1o_product_prev_next_status'] = $this->config->get('t1o_product_prev_next_status');
		$data['t1o_layout_product_page'] = $this->config->get('t1o_layout_product_page');
		$data['t1o_product_align'] = $this->config->get('t1o_product_align');
		$data['t1o_video_box_bg'] = $this->config->get('t1o_video_box_bg');
		$data['t1o_custom_box_bg'] = $this->config->get('t1o_custom_box_bg');
		$data['t1d_bg_image_f1_custom'] = $this->config->get('t1d_bg_image_f1_custom');
		$data['t1d_pattern_k_f1'] = $this->config->get('t1d_pattern_k_f1');
		$data['t1d_bg_image_f1_position'] = $this->config->get('t1d_bg_image_f1_position');
		$data['t1d_bg_image_f1_repeat'] = $this->config->get('t1d_bg_image_f1_repeat');
		$data['t1d_f6_text_color'] = $this->config->get('t1d_f6_text_color');
		$data['t1d_f6_bg_color_status'] = $this->config->get('t1d_f6_bg_color_status');
		$data['t1d_f6_bg_color'] = $this->config->get('t1d_f6_bg_color');
		$data['t1d_bg_image_f6_custom'] = $this->config->get('t1d_bg_image_f6_custom');
		$data['t1d_pattern_k_f6'] = $this->config->get('t1d_pattern_k_f6');
		$data['t1d_bg_image_f6_position'] = $this->config->get('t1d_bg_image_f6_position');
		$data['t1d_bg_image_f6_repeat'] = $this->config->get('t1d_bg_image_f6_repeat');
		$data['t1d_f6_border_top_status'] = $this->config->get('t1d_f6_border_top_status');
		$data['t1d_f6_border_top_size'] = $this->config->get('t1d_f6_border_top_size');
		$data['t1d_f6_border_top_color'] = $this->config->get('t1d_f6_border_top_color');
		$data['t1d_f6_link_color'] = $this->config->get('t1d_f6_link_color');
		$data['t1d_f6_link_hover_color'] = $this->config->get('t1d_f6_link_hover_color');
		$data['t1d_f2_text_color'] = $this->config->get('t1d_f2_text_color');
		$data['t1d_f2_bg_color_status'] = $this->config->get('t1d_f2_bg_color_status');
		$data['t1d_f2_bg_color'] = $this->config->get('t1d_f2_bg_color');
		$data['t1d_bg_image_f2_custom'] = $this->config->get('t1d_bg_image_f2_custom');
		$data['t1d_pattern_k_f2'] = $this->config->get('t1d_pattern_k_f2');
		$data['t1d_bg_image_f2_position'] = $this->config->get('t1d_bg_image_f2_position');
		$data['t1d_bg_image_f2_repeat'] = $this->config->get('t1d_bg_image_f2_repeat');
		$data['t1d_f2_border_top_status'] = $this->config->get('t1d_f2_border_top_status');
		$data['t1d_f2_border_top_size'] = $this->config->get('t1d_f2_border_top_size');
		$data['t1d_f2_border_top_color'] = $this->config->get('t1d_f2_border_top_color');
		$data['t1d_f2_titles_color'] = $this->config->get('t1d_f2_titles_color');
		$data['t1d_f2_titles_border_status'] = $this->config->get('t1d_f2_titles_border_status');
		$data['t1d_f2_titles_border_size'] = $this->config->get('t1d_f2_titles_border_size');
		$data['t1d_f2_titles_border_color'] = $this->config->get('t1d_f2_titles_border_color');
		$data['t1d_f2_link_color'] = $this->config->get('t1d_f2_link_color');
		$data['t1d_f2_link_hover_color'] = $this->config->get('t1d_f2_link_hover_color');
		$data['t1d_f3_text_color'] = $this->config->get('t1d_f3_text_color');
		$data['t1d_f3_bg_color_status'] = $this->config->get('t1d_f3_bg_color_status');
		$data['t1d_f3_bg_color'] = $this->config->get('t1d_f3_bg_color');
		$data['t1d_bg_image_f3_custom'] = $this->config->get('t1d_bg_image_f3_custom');
		$data['t1d_pattern_k_f3'] = $this->config->get('t1d_pattern_k_f3');
		$data['t1d_bg_image_f3_position'] = $this->config->get('t1d_bg_image_f3_position');
		$data['t1d_bg_image_f3_repeat'] = $this->config->get('t1d_bg_image_f3_repeat');
		$data['t1d_f3_border_top_status'] = $this->config->get('t1d_f3_border_top_status');
		$data['t1d_f3_border_top_size'] = $this->config->get('t1d_f3_border_top_size');
		$data['t1d_f3_border_top_color'] = $this->config->get('t1d_f3_border_top_color');
		$data['t1d_f3_link_color'] = $this->config->get('t1d_f3_link_color');
		$data['t1d_f3_link_hover_color'] = $this->config->get('t1d_f3_link_hover_color');
		$data['t1d_f3_icons_social_style'] = $this->config->get('t1d_f3_icons_social_style');
		$data['t1d_f3_icons_bg_color'] = $this->config->get('t1d_f3_icons_bg_color');
		$data['t1d_f4_text_color'] = $this->config->get('t1d_f4_text_color');
		$data['t1d_f4_bg_color_status'] = $this->config->get('t1d_f4_bg_color_status');
		$data['t1d_f4_bg_color'] = $this->config->get('t1d_f4_bg_color');
		$data['t1d_bg_image_f4_custom'] = $this->config->get('t1d_bg_image_f4_custom');
		$data['t1d_pattern_k_f4'] = $this->config->get('t1d_pattern_k_f4');
		$data['t1d_bg_image_f4_position'] = $this->config->get('t1d_bg_image_f4_position');
		$data['t1d_bg_image_f4_repeat'] = $this->config->get('t1d_bg_image_f4_repeat');
		$data['t1d_f4_border_top_status'] = $this->config->get('t1d_f4_border_top_status');
		$data['t1d_f4_border_top_size'] = $this->config->get('t1d_f4_border_top_size');
		$data['t1d_f4_border_top_color'] = $this->config->get('t1d_f4_border_top_color');
		$data['t1d_f4_link_color'] = $this->config->get('t1d_f4_link_color');
		$data['t1d_f4_link_hover_color'] = $this->config->get('t1d_f4_link_hover_color');
		$data['t1d_f5_text_color'] = $this->config->get('t1d_f5_text_color');
		$data['t1d_f5_bg_color_status'] = $this->config->get('t1d_f5_bg_color_status');
		$data['t1d_f5_bg_color'] = $this->config->get('t1d_f5_bg_color');
		$data['t1d_bg_image_f5_custom'] = $this->config->get('t1d_bg_image_f5_custom');
		$data['t1d_pattern_k_f5'] = $this->config->get('t1d_pattern_k_f5');
		$data['t1d_bg_image_f5_position'] = $this->config->get('t1d_bg_image_f5_position');
		$data['t1d_bg_image_f5_repeat'] = $this->config->get('t1d_bg_image_f5_repeat');
		$data['t1d_f5_border_top_status'] = $this->config->get('t1d_f5_border_top_status');
		$data['t1d_f5_border_top_size'] = $this->config->get('t1d_f5_border_top_size');
		$data['t1d_f5_border_top_color'] = $this->config->get('t1d_f5_border_top_color');
		$data['t1d_f5_link_color'] = $this->config->get('t1d_f5_link_color');
		$data['t1d_f5_link_hover_color'] = $this->config->get('t1d_f5_link_hover_color');
		$data['t1o_custom_bottom_2_status'] = $this->config->get('t1o_custom_bottom_2_status');
		$data['t1o_custom_bottom_2_footer_margin'] = $this->config->get('t1o_custom_bottom_2_footer_margin');
		$data['t1d_price_color'] = $this->config->get('t1d_price_color');
		$data['t1d_price_old_color'] = $this->config->get('t1d_price_old_color');
		$data['t1d_price_new_color'] = $this->config->get('t1d_price_new_color');
		$data['t1d_button_bg_status'] = $this->config->get('t1d_button_bg_status');
		$data['t1d_button_bg_color'] = $this->config->get('t1d_button_bg_color');
		$data['t1d_button_text_color'] = $this->config->get('t1d_button_text_color');
		$data['t1d_button_shadow_status'] = $this->config->get('t1d_button_shadow_status');
		$data['t1d_button_bg_hover_color'] = $this->config->get('t1d_button_bg_hover_color');
		$data['t1d_button_text_hover_color'] = $this->config->get('t1d_button_text_hover_color');
		$data['t1d_button_exclusive_bg_status'] = $this->config->get('t1d_button_exclusive_bg_status');
		$data['t1d_button_exclusive_bg_color'] = $this->config->get('t1d_button_exclusive_bg_color');
		$data['t1d_button_exclusive_text_color'] = $this->config->get('t1d_button_exclusive_text_color');
		$data['t1d_button_exclusive_bg_hover_color'] = $this->config->get('t1d_button_exclusive_bg_hover_color');
		$data['t1d_button_exclusive_text_hover_color'] = $this->config->get('t1d_button_exclusive_text_hover_color');
		$data['t1d_button_border_radius'] = $this->config->get('t1d_button_border_radius');
		$data['t1d_dd_bg_color'] = $this->config->get('t1d_dd_bg_color');
		$data['t1d_dd_headings_color'] = $this->config->get('t1d_dd_headings_color');
		$data['t1d_dd_text_color'] = $this->config->get('t1d_dd_text_color');
		$data['t1d_dd_light_text_color'] = $this->config->get('t1d_dd_light_text_color');
		$data['t1d_dd_links_color'] = $this->config->get('t1d_dd_links_color');
		$data['t1d_dd_links_hover_color'] = $this->config->get('t1d_dd_links_hover_color');
		$data['t1d_dd_icons_color'] = $this->config->get('t1d_dd_icons_color');
		$data['t1d_dd_icons_hover_color'] = $this->config->get('t1d_dd_icons_hover_color');
		$data['t1d_dd_hli_bg_color'] = $this->config->get('t1d_dd_hli_bg_color');
		$data['t1d_dd_separator_color'] = $this->config->get('t1d_dd_separator_color');
		$data['t1d_dd_shadow'] = $this->config->get('t1d_dd_shadow');
		$data['t1d_modal_bg_style'] = $this->config->get('t1d_modal_bg_style');
		$data['t1d_body_font'] = $this->config->get('t1d_body_font');
		$data['t1d_body_font_size'] = $this->config->get('t1d_body_font_size');
		$data['t1d_body_font_uppercase'] = $this->config->get('t1d_body_font_uppercase');
		$data['t1d_small_font_size'] = $this->config->get('t1d_small_font_size');
		$data['t1d_title_font'] = $this->config->get('t1d_title_font');
		$data['t1d_title_font_weight'] = $this->config->get('t1d_title_font_weight');
		$data['t1d_title_font_uppercase'] = $this->config->get('t1d_title_font_uppercase');
		$data['t1d_subtitle_font'] = $this->config->get('t1d_subtitle_font');
		$data['t1d_subtitle_font_size'] = $this->config->get('t1d_subtitle_font_size');
		$data['t1d_subtitle_font_weight'] = $this->config->get('t1d_subtitle_font_weight');
		$data['t1d_subtitle_font_style'] = $this->config->get('t1d_subtitle_font_style');
		$data['t1d_subtitle_font_uppercase'] = $this->config->get('t1d_subtitle_font_uppercase');
		$data['t1d_price_font'] = $this->config->get('t1d_price_font');
		$data['t1d_price_font_weight'] = $this->config->get('t1d_price_font_weight');
		$data['t1d_button_font'] = $this->config->get('t1d_button_font');
		$data['t1d_button_font_size'] = $this->config->get('t1d_button_font_size');
		$data['t1d_button_font_weight'] = $this->config->get('t1d_button_font_weight');
		$data['t1d_button_font_uppercase'] = $this->config->get('t1d_button_font_uppercase');
		$data['t1d_main_menu_font'] = $this->config->get('t1d_main_menu_font');
		$data['t1d_mm_font_size'] = $this->config->get('t1d_mm_font_size');
		$data['t1d_mm_font_weight'] = $this->config->get('t1d_mm_font_weight');
		$data['t1d_mm_font_uppercase'] = $this->config->get('t1d_mm_font_uppercase');
		$data['t1d_mm_sub_main_cat_font_size'] = $this->config->get('t1d_mm_sub_main_cat_font_size');
		$data['t1d_mm_sub_main_cat_font_weight'] = $this->config->get('t1d_mm_sub_main_cat_font_weight');
		$data['t1d_mm_sub_font_size'] = $this->config->get('t1d_mm_sub_font_size');
		$data['t1d_mm_sub_font_weight'] = $this->config->get('t1d_mm_sub_font_weight');
		
		$data['t1o_custom_css'] = $this->config->get('t1o_custom_css');
		$data['t1o_facebook_likebox_status'] = $this->config->get('t1o_facebook_likebox_status');
		$data['t1o_facebook_likebox_id'] = $this->config->get('t1o_facebook_likebox_id');
		$data['t1o_twitter_block_status'] = $this->config->get('t1o_twitter_block_status');
		$data['t1o_twitter_block_user'] = $this->config->get('t1o_twitter_block_user');
		$data['t1o_twitter_block_tweets'] = $this->config->get('t1o_twitter_block_tweets');
		$data['t1o_twitter_block_widget_id'] = $this->config->get('t1o_twitter_block_widget_id');
		$data['t1o_googleplus_box_status'] = $this->config->get('t1o_googleplus_box_status');
		$data['t1o_googleplus_box_user'] = $this->config->get('t1o_googleplus_box_user');
		$data['t1o_pinterest_box_status'] = $this->config->get('t1o_pinterest_box_status');
		$data['t1o_pinterest_box_user'] = $this->config->get('t1o_pinterest_box_user');
		$data['t1o_snapchat_box_status'] = $this->config->get('t1o_snapchat_box_status');
		$data['t1o_snapchat_box_code_custom'] = $this->config->get('t1o_snapchat_box_code_custom');
		$data['t1o_snapchat_box_title'] = $this->config->get('t1o_snapchat_box_title');
		$data['t1o_snapchat_box_subtitle'] = $this->config->get('t1o_snapchat_box_subtitle');
		$data['t1o_snapchat_box_bg'] = $this->config->get('t1o_snapchat_box_bg');
		$data['t1o_video_box_status'] = $this->config->get('t1o_video_box_status');
		$data['t1o_video_box_content'] = $this->config->get('t1o_video_box_content');
		$data['t1o_video_box_content'] = html_entity_decode($data['t1o_video_box_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_custom_box_status'] = $this->config->get('t1o_custom_box_status');
		$data['t1o_custom_box_content'] = $this->config->get('t1o_custom_box_content');
		$data['t1o_custom_box_content'] = html_entity_decode($data['t1o_custom_box_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_eu_cookie_icon_status'] = $this->config->get('t1o_eu_cookie_icon_status');
		$data['t1o_top_custom_block_status'] = $this->config->get('t1o_top_custom_block_status');
		$data['t1o_top_custom_block_title'] = $this->config->get('t1o_top_custom_block_title');
		$data['t1o_top_custom_block_content'] = $this->config->get('t1o_top_custom_block_content');
		$data['t1o_top_custom_block_content'] = html_entity_decode($data['t1o_top_custom_block_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_top_custom_block_awesome_status'] = $this->config->get('t1o_top_custom_block_awesome_status');
		$data['t1o_top_custom_block_awesome'] = $this->config->get('t1o_top_custom_block_awesome');
		$data['t1o_layout_style'] = $this->config->get('t1o_layout_style');
		$data['t1o_news_status'] = $this->config->get('t1o_news_status');
		$data['t1o_text_news'] = $this->config->get('t1o_text_news');
		$data['t1o_news'] = $this->config->get('t1o_news');
		$data['t1o_top_bar_welcome_status'] = $this->config->get('t1o_top_bar_welcome_status');
		$data['t1o_top_bar_welcome'] = $this->config->get('t1o_top_bar_welcome');
		$data['t1o_top_bar_welcome_awesome'] = $this->config->get('t1o_top_bar_welcome_awesome');
		$data['t1o_top_bar_cart_link_status'] = $this->config->get('t1o_top_bar_cart_link_status');
		$data['t1o_i_c_2_1_status'] = $this->config->get('t1o_i_c_2_1_status');
		$data['t1o_i_c_2_2_status'] = $this->config->get('t1o_i_c_2_2_status');
		$data['t1o_i_c_2_3_status'] = $this->config->get('t1o_i_c_2_3_status');
		$data['t1o_i_c_2_4_status'] = $this->config->get('t1o_i_c_2_4_status');
		$data['t1o_i_c_2_5_status'] = $this->config->get('t1o_i_c_2_5_status');
		$data['t1o_i_c_3_1_status'] = $this->config->get('t1o_i_c_3_1_status');
		$data['t1o_i_c_3_2_status'] = $this->config->get('t1o_i_c_3_2_status');
		$data['t1o_i_c_3_3_status'] = $this->config->get('t1o_i_c_3_3_status');
		$data['t1o_i_c_3_4_status'] = $this->config->get('t1o_i_c_3_4_status');
		$data['t1o_i_c_3_5_status'] = $this->config->get('t1o_i_c_3_5_status');
		$data['t1o_i_c_3_6_status'] = $this->config->get('t1o_i_c_3_6_status');
		$data['t1o_header_custom_block_1_status'] = $this->config->get('t1o_header_custom_block_1_status');


        $data['t1o_header_custom_block_1_content'] = $this->config->get('t1o_header_custom_block_1_content');
		$data['t1o_header_custom_block_1_content'] = html_entity_decode($data['t1o_header_custom_block_1_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');

		
		$data['t1o_header_fixed_header_status'] = $this->config->get('t1o_header_fixed_header_status');
		$data['t1o_menu_homepage'] = $this->config->get('t1o_menu_homepage');
		$data['t1o_menu_categories_status'] = $this->config->get('t1o_menu_categories_status');
		$data['t1o_menu_categories_style'] = $this->config->get('t1o_menu_categories_style');
		$data['t1o_menu_main_category_icon_status'] = $this->config->get('t1o_menu_main_category_icon_status');
		$data['t1o_menu_main_category_padding_right'] = $this->config->get('t1o_menu_main_category_padding_right');
		$data['t1o_menu_main_category_padding_bottom'] = $this->config->get('t1o_menu_main_category_padding_bottom');
		$data['t1o_menu_categories_3_level'] = $this->config->get('t1o_menu_categories_3_level');
		$data['t1o_menu_categories_custom_block_left_status'] = $this->config->get('t1o_menu_categories_custom_block_left_status');
		$data['t1o_menu_categories_custom_block_left_content'] = $this->config->get('t1o_menu_categories_custom_block_left_content');
		$data['t1o_menu_categories_custom_block_left_content'] = html_entity_decode($data['t1o_menu_categories_custom_block_left_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_menu_categories_custom_block_right_status'] = $this->config->get('t1o_menu_categories_custom_block_right_status');
		$data['t1o_menu_categories_custom_block_right_content'] = $this->config->get('t1o_menu_categories_custom_block_right_content');
		$data['t1o_menu_categories_custom_block_right_content'] = html_entity_decode($data['t1o_menu_categories_custom_block_right_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_menu_categories_custom_block_status'] = $this->config->get('t1o_menu_categories_custom_block_status');
		$data['t1o_menu_categories_custom_block_content'] = $this->config->get('t1o_menu_categories_custom_block_content');
		$data['t1o_menu_categories_custom_block_content'] = html_entity_decode($data['t1o_menu_categories_custom_block_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_menu_categories_per_row'] = $this->config->get('t1o_menu_categories_per_row');
		$data['t1o_menu_brands_status'] = $this->config->get('t1o_menu_brands_status');
		$data['t1o_menu_brands_style'] = $this->config->get('t1o_menu_brands_style');
		$data['t1o_menu_brands_per_row'] = $this->config->get('t1o_menu_brands_per_row');
		
		$data['t1o_menu_custom_block'] = $this->config->get('t1o_menu_custom_block');
		for ($i = 1; $i <= 5; $i++) {
		$data['t1o_menu_custom_block_htmlcontent'][$i] = html_entity_decode($data['t1o_menu_custom_block'][$i][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		}
		
		$data['t1o_menu_cm_status'] = $this->config->get('t1o_menu_cm_status');
		$data['t1o_menu_cm_title'] = $this->config->get('t1o_menu_cm_title');
		$data['t1o_menu_cm_link'] = $this->config->get('t1o_menu_cm_link');
		$data['t1o_menu_cm_2_status'] = $this->config->get('t1o_menu_cm_2_status');
		$data['t1o_menu_cm_2_title'] = $this->config->get('t1o_menu_cm_2_title');
		$data['t1o_menu_cm_2_link'] = $this->config->get('t1o_menu_cm_2_link');
		$data['t1o_menu_cm_3_status'] = $this->config->get('t1o_menu_cm_3_status');
		$data['t1o_menu_cm_3_title'] = $this->config->get('t1o_menu_cm_3_title');
		$data['t1o_menu_cm_3_link'] = $this->config->get('t1o_menu_cm_3_link');
		$data['t1o_menu_link'] = $this->config->get('t1o_menu_link');
		$data['t1o_custom_bar_below_menu_status'] = $this->config->get('t1o_custom_bar_below_menu_status');
		$data['t1o_custom_bar_below_menu_content'] = $this->config->get('t1o_custom_bar_below_menu_content');
		$data['t1o_custom_bar_below_menu_content'] = html_entity_decode($data['t1o_custom_bar_below_menu_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_menu_labels'] = $this->config->get('t1o_menu_labels');
		$data['t1o_menu_labels_color'] = $this->config->get('t1o_menu_labels_color');

		$data['t1o_text_contact_us'] = $this->config->get('t1o_text_contact_us');
		$data['t1o_text_menu_contact_address'] = $this->config->get('t1o_text_menu_contact_address');
		$data['t1o_text_menu_contact_email'] = $this->config->get('t1o_text_menu_contact_email');
		$data['t1o_text_menu_contact_tel'] = $this->config->get('t1o_text_menu_contact_tel');
		$data['t1o_text_menu_contact_fax'] = $this->config->get('t1o_text_menu_contact_fax');
		$data['t1o_text_menu_contact_hours'] = $this->config->get('t1o_text_menu_contact_hours');
		$data['t1o_text_menu_contact_form'] = $this->config->get('t1o_text_menu_contact_form');
		$data['t1o_text_menu_menu'] = $this->config->get('t1o_text_menu_menu');
		$data['t1o_text_menu_categories'] = $this->config->get('t1o_text_menu_categories');
		$data['t1o_text_menu_brands'] = $this->config->get('t1o_text_menu_brands');

		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
		
		$data['return'] = $this->url->link('account/return/insert', '', true);
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', true);
		$data['affiliate'] = $this->url->link('affiliate/account', '', true);
		$data['special'] = $this->url->link('product/special');
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);
		
		$data['address'] = nl2br($this->config->get('config_address'));
		$data['geocode'] = $this->config->get('config_geocode');
		$data['geocode_hl'] = $this->config->get('config_language');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['email'] = $this->config->get('config_email');
		$data['fax'] = $this->config->get('config_fax');
		$data['open'] = nl2br($this->config->get('config_open'));
		$data['comment'] = $this->config->get('config_comment');
		
		$data['locations'] = array();

		$this->load->model('localisation/location');

		foreach((array)$this->config->get('config_location') as $location_id) {
			$location_info = $this->model_localisation_location->getLocation($location_id);
				$data['locations'][] = array(
					'address'     => nl2br($location_info['address']),
					'geocode'     => $location_info['geocode'],
					'telephone'   => $location_info['telephone'],
					'fax'         => $location_info['fax'],
					'open'        => nl2br($location_info['open']),
					'comment'     => $location_info['comment']
				);
		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');
		$data['menu'] = $this->load->controller('common/menu');
		
		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
		
		$this->load->model('catalog/manufacturer');
		$this->load->model('tool/image');
		$results = $this->model_catalog_manufacturer->getManufacturers();
		foreach ($results as $result) {	
			if ($result['image']) {
						$image = $result['image'];
					} else {
						$image = '';
					}			
			$data['manufacturers'][] = array(
				'name' => $result['name'],
				'image' => $this->model_tool_image->resize($image, 170, 100),
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}	

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

        foreach ($categories as $category) {
			if ($category['top']) {
				$children_data = array();
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);								
					// Level 2
					$children_level_2 = $this->model_catalog_category->getCategories($child['category_id']);
					$children_data_level_2 = array();
					foreach ($children_level_2 as $child_level_2) {
							$data_level_2 = array(
									'filter_category_id'  => $child_level_2['category_id'],
									'filter_sub_category' => true
							);

							$children_data_level_2[] = array(
									'name'  =>  $child_level_2['name'],
									'href'  => $this->url->link('product/category', 'path=' . $child['category_id'] . '_' . $child_level_2['category_id']),
									'id' => $category['category_id']. '_' . $child['category_id']. '_' . $child_level_2['category_id']
							);
					}
					$children_data[] = array(
							'name'  => $child['name'],
							'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
							'id' => $category['category_id']. '_' . $child['category_id'],
							'children_level_2' => $children_data_level_2,
					);		
				}
				// Level 1
				$this->load->model('tool/image');
                $image = $category['image'];
                $thumb = $this->model_tool_image->resize($image, 100, 100);
				$thumbbg = $this->model_tool_image->resize($image, $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_category_height'));

				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'thumb'    => $thumb,		
					'thumbbg'  => $thumbbg,	
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} elseif (isset($this->request->get['information_id'])) {
				$class = '-' . $this->request->get['information_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}

		return $this->load->view('common/header', $data);
	}
}
