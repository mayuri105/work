<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');
		
		$data['config_ssl'] = $this->config->get('config_ssl');
		$data['config_url'] = $this->config->get('config_url');
		
		$data['lang_id'] = $this->config->get('config_language_id');
		$lang_id = $this->config->get('config_language_id');
		
		$data['t1d_bg_image_f1_parallax'] = $this->config->get('t1d_bg_image_f1_parallax');
		$data['t1o_custom_top_1_status'] = $this->config->get('t1o_custom_top_1_status');
		$data['t1o_custom_top_1_content'] = $this->config->get('t1o_custom_top_1_content');
		$data['t1o_custom_top_1_content'] = html_entity_decode($data['t1o_custom_top_1_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_information_column_1_status'] = $this->config->get('t1o_information_column_1_status');
		$data['t1o_information_column_2_status'] = $this->config->get('t1o_information_column_2_status');
		$data['t1o_information_column_3_status'] = $this->config->get('t1o_information_column_3_status');
		$data['t1o_information_block_width'] = $this->config->get('t1o_information_block_width');
		$data['t1o_custom_1_status'] = $this->config->get('t1o_custom_1_status');
		$data['t1o_custom_1_title'] = $this->config->get('t1o_custom_1_title');
		$data['t1o_custom_1_content'] = $this->config->get('t1o_custom_1_content');
		$data['t1o_custom_1_content'] = html_entity_decode($data['t1o_custom_1_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_custom_1_column_width'] = $this->config->get('t1o_custom_1_column_width');
		$data['t1o_custom_2_status'] = $this->config->get('t1o_custom_2_status');
		$data['t1o_custom_2_title'] = $this->config->get('t1o_custom_2_title');
		$data['t1o_custom_2_content'] = $this->config->get('t1o_custom_2_content');
		$data['t1o_custom_2_content'] = html_entity_decode($data['t1o_custom_2_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_custom_2_column_width'] = $this->config->get('t1o_custom_2_column_width');
		$data['t1o_newsletter_status'] = $this->config->get('t1o_newsletter_status');
		$data['t1o_newsletter_campaign_url'] = $this->config->get('t1o_newsletter_campaign_url');
		$data['t1o_newsletter_promo_text'] = $this->config->get('t1o_newsletter_promo_text');
		$data['t1o_newsletter_email'] = $this->config->get('t1o_newsletter_email');
		$data['t1o_newsletter_subscribe'] = $this->config->get('t1o_newsletter_subscribe');
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
		$data['t1o_payment_block_status'] = $this->config->get('t1o_payment_block_status');
		$data['t1o_payment_block_custom_status'] = $this->config->get('t1o_payment_block_custom_status');
		$data['t1o_payment_block_custom'] = $this->config->get('t1o_payment_block_custom');
		$data['t1o_payment_block_custom_url'] = $this->config->get('t1o_payment_block_custom_url');
		$data['t1d_f3_payment_images_style'] = $this->config->get('t1d_f3_payment_images_style');
		$data['t1o_payment_paypal'] = $this->config->get('t1o_payment_paypal');
		$data['t1o_payment_paypal_url'] = $this->config->get('t1o_payment_paypal_url');
		$data['t1o_payment_visa'] = $this->config->get('t1o_payment_visa');
		$data['t1o_payment_visa_url'] = $this->config->get('t1o_payment_visa_url');
		$data['t1o_payment_mastercard'] = $this->config->get('t1o_payment_mastercard');
		$data['t1o_payment_mastercard_url'] = $this->config->get('t1o_payment_mastercard_url');
		$data['t1o_payment_maestro'] = $this->config->get('t1o_payment_maestro');
		$data['t1o_payment_maestro_url'] = $this->config->get('t1o_payment_maestro_url');
		$data['t1o_payment_discover'] = $this->config->get('t1o_payment_discover');
		$data['t1o_payment_discover_url'] = $this->config->get('t1o_payment_discover_url');
		$data['t1o_payment_skrill'] = $this->config->get('t1o_payment_skrill');
		$data['t1o_payment_skrill_url'] = $this->config->get('t1o_payment_skrill_url');
		$data['t1o_payment_american_express'] = $this->config->get('t1o_payment_american_express');
		$data['t1o_payment_american_express_url'] = $this->config->get('t1o_payment_american_express_url');
		$data['t1o_payment_cirrus'] = $this->config->get('t1o_payment_cirrus');
		$data['t1o_payment_cirrus_url'] = $this->config->get('t1o_payment_cirrus_url');
		$data['t1o_payment_delta'] = $this->config->get('t1o_payment_delta');
		$data['t1o_payment_delta_url'] = $this->config->get('t1o_payment_delta_url');
		$data['t1o_payment_google'] = $this->config->get('t1o_payment_google');
		$data['t1o_payment_google_url'] = $this->config->get('t1o_payment_google_url');
		$data['t1o_payment_2co'] = $this->config->get('t1o_payment_2co');
		$data['t1o_payment_2co_url'] = $this->config->get('t1o_payment_2co_url');
		$data['t1o_payment_sage'] = $this->config->get('t1o_payment_sage');
		$data['t1o_payment_sage_url'] = $this->config->get('t1o_payment_sage_url');
		$data['t1o_payment_solo'] = $this->config->get('t1o_payment_solo');
		$data['t1o_payment_solo_url'] = $this->config->get('t1o_payment_solo_url');
		$data['t1o_payment_amazon'] = $this->config->get('t1o_payment_amazon');
		$data['t1o_payment_amazon_url'] = $this->config->get('t1o_payment_amazon_url');
		$data['t1o_payment_western_union'] = $this->config->get('t1o_payment_western_union');
		$data['t1o_payment_western_union_url'] = $this->config->get('t1o_payment_western_union_url');
		$data['t1o_powered_status'] = $this->config->get('t1o_powered_status');
		$data['t1o_powered_content'] = $this->config->get('t1o_powered_content');
		$data['t1o_powered_content'] = html_entity_decode($data['t1o_powered_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_follow_us_status'] = $this->config->get('t1o_follow_us_status');
		$data['t1o_facebook'] = $this->config->get('t1o_facebook');
		$data['t1o_twitter'] = $this->config->get('t1o_twitter');
		$data['t1o_googleplus'] = $this->config->get('t1o_googleplus');
		$data['t1o_rss'] = $this->config->get('t1o_rss');
		$data['t1o_pinterest'] = $this->config->get('t1o_pinterest');
		$data['t1o_vimeo'] = $this->config->get('t1o_vimeo');
		$data['t1o_flickr'] = $this->config->get('t1o_flickr');
		$data['t1o_linkedin'] = $this->config->get('t1o_linkedin');
		$data['t1o_youtube'] = $this->config->get('t1o_youtube');
		$data['t1o_dribbble'] = $this->config->get('t1o_dribbble');
		$data['t1o_instagram'] = $this->config->get('t1o_instagram');
		$data['t1o_behance'] = $this->config->get('t1o_behance');
		$data['t1o_skype'] = $this->config->get('t1o_skype');
		$data['t1o_tumblr'] = $this->config->get('t1o_tumblr');
		$data['t1o_reddit'] = $this->config->get('t1o_reddit');
		$data['t1o_vk'] = $this->config->get('t1o_vk');
		$data['t1o_custom_bottom_1_status'] = $this->config->get('t1o_custom_bottom_1_status');
		$data['t1o_custom_bottom_1_content'] = $this->config->get('t1o_custom_bottom_1_content');
		$data['t1o_custom_bottom_1_content'] = html_entity_decode($data['t1o_custom_bottom_1_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_category_prod_box_style'] = $this->config->get('t1o_category_prod_box_style');
		$data['t1o_product_grid_per_row'] = $this->config->get('t1o_product_grid_per_row');
		$data['t1o_header_fixed_header_status'] = $this->config->get('t1o_header_fixed_header_status');
		$data['t1o_header_auto_suggest_status'] = $this->config->get('t1o_header_auto_suggest_status');
		$data['t1o_others_totop'] = $this->config->get('t1o_others_totop');
		$data['t1o_eu_cookie_status'] = $this->config->get('t1o_eu_cookie_status');
		$data['t1o_eu_cookie_message'] = $this->config->get('t1o_eu_cookie_message');
		$data['t1o_eu_cookie_message'] = html_entity_decode($data['t1o_eu_cookie_message'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_eu_cookie_close'] = $this->config->get('t1o_eu_cookie_close');
		$data['t1o_custom_js'] = $this->config->get('t1o_custom_js');
		$data['t1o_custom_js'] = htmlspecialchars_decode($data['t1o_custom_js'], ENT_QUOTES);
		$data['t1o_custom_bottom_2_status'] = $this->config->get('t1o_custom_bottom_2_status');
		$data['t1o_custom_bottom_2_content'] = $this->config->get('t1o_custom_bottom_2_content');
		$data['t1o_custom_bottom_2_content'] = html_entity_decode($data['t1o_custom_bottom_2_content'][$this->config->get('config_language_id')]['htmlcontent'], ENT_QUOTES, 'UTF-8');
		$data['t1o_layout_style'] = $this->config->get('t1o_layout_style');

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

		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', true);
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['tracking'] = $this->url->link('information/tracking');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', true);
		$data['affiliate'] = $this->url->link('affiliate/login', '', true);
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = ($this->request->server['HTTPS'] ? 'https://' : 'http://') . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}
		
		$data['scripts'] = $this->document->getScripts('footer');

		return $this->load->view('common/footer', $data);
	}
}
