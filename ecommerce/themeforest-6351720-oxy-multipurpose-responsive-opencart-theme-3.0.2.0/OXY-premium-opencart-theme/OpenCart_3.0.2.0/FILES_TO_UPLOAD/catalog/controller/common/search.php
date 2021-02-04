<?php
class ControllerCommonSearch extends Controller {
	public function index() {
		$this->load->language('common/search');
		
		$data['lang_id'] = $this->config->get('config_language_id');
		$lang_id = $this->config->get('config_language_id');
		
		$data['t1o_header_style'] = $this->config->get('t1o_header_style');
		$data['t1o_header_popular_search_status'] = $this->config->get('t1o_header_popular_search_status');
		$data['t1o_text_popular_search'] = $this->config->get('t1o_text_popular_search');
		$data['t1o_header_popular_search'] = $this->config->get('t1o_header_popular_search');
		$data['t1o_text_advanced_search'] = $this->config->get('t1o_text_advanced_search');

		$data['text_search'] = $this->language->get('text_search');

		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';
		}

		return $this->load->view('common/search', $data);
	}
}