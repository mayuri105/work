<?php
class ControllerExtensionModuleThemeHighlyRecommended extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$this->load->language('extension/module/theme_highly_recommended');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['highlyrecommended'] = $setting['highlyrecommended'][$this->config->get('config_language_id')];

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		
		$data['module_bottom_bar_bg_color'] = $setting['module_bottom_bar_bg_color'];
		
		$data['lang_id'] = $this->config->get('config_language_id');
		$lang_id = $this->config->get('config_language_id');
		
		$data['t1o_text_sale'] = $this->config->get('t1o_text_sale');
		$data['t1o_text_new_prod'] = $this->config->get('t1o_text_new_prod');
		$data['t1o_text_quickview'] = $this->config->get('t1o_text_quickview');
		
		$data['t1o_out_of_stock_badge_status'] = $this->config->get('t1o_out_of_stock_badge_status');
		$data['t1o_sale_badge_status'] = $this->config->get('t1o_sale_badge_status');
		$data['t1o_sale_badge_type'] = $this->config->get('t1o_sale_badge_type');
		$data['t1o_new_badge_status'] = $this->config->get('t1o_new_badge_status');
		$data['t1d_img_style'] = $this->config->get('t1d_img_style');
		$data['t1o_category_prod_box_style'] = $this->config->get('t1o_category_prod_box_style');
		
		$data['lazy_load_placeholder'] = 'catalog/view/theme/' . $this->config->get('config_theme') . '/js/lazyload/loading.gif';

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

      if (!empty($setting['product'])) {
		$products = array_slice($setting['product'], 0, (int)$setting['limit']);

		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				if ($product_info['image']) {
					$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}
				
				$swapimages = $this->model_catalog_product->getProductImages($product_info['product_id']);
			    if ($swapimages) {
			    	$swapimage = $this->model_tool_image->resize($swapimages[0]['image'], $setting['width'], $setting['height']);
			    } else {
			    	$swapimage = false;
		    	}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $product_info['rating'];
				} else {
					$rating = false;
				}
				
				$out_of_stock_badge = $product_info['quantity'] <= 0 ? $product_info['stock_status'] : 1;

				$data['products'][] = array(
					'product_id'  => $product_info['product_id'],
					'thumb'       => $image,
					'thumb_swap'  => $swapimage,
					'newstart'    => $product_info['date_added'],
					'quickview'   => $this->url->link('product/quickview', 'product_id=' . $product_info['product_id']),
					'name'        => $product_info['name'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
					'out_of_stock_quantity'  => $product_info['quantity'],
                    'out_of_stock_badge'  => $out_of_stock_badge,
					'brand'       => $product_info['manufacturer'],
					'brand_url'   => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']),
					'val1'        => preg_replace("/[^0-9.]/", "", $product_info['special']),
					'val2'        => preg_replace("/[^0-9.]/", "", $product_info['price']),
					'startDate1'  => strtotime(mb_substr($product_info['date_added'], 0, 10)),
					'endDate2'    => strtotime(date("Y-m-d")),
				);
			}
		}
	  }
	  
	  $data['module'] = $module++;

		if ($data['products']) {
			return $this->load->view('extension/module/theme_highly_recommended', $data);
		}
	}
}
