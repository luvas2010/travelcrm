<?php/** * TravelCRM * * An open source CRM system for travel agencies * * @author		Mazvv (vitalii.mazur@gmail.com) * @license		GNU GPLv3 (http://gplv3.fsf.org)  * @link		http://www.travelcrm.org.ua */include_once APPPATH."libraries/core/Doccontroller.php";class Calls extends Doccontroller {	private $jtp = array('val'=>'rid', 'scr'=>'rid', 'val_p'=>'_calls_documents_rid', 'scr_p'=>'call_rid');	public function __construct(){		parent::__construct();		$this->lang->load('calls');		$this->load->model('calls_model');		$this->load->helper('employeers');		$this->load->helper('advertisessources');		$this->load->helper('countries');		$this->load->helper('curourts');		$this->load->helper('hotelscats');		$this->load->helper('clients');				# Overwrite jtp mapper if need 		# It's very usable if form has some value_pickers with one type		if(element('val_p', $this->a_uri_assoc, null)) $this->jtp['val_p'] = element('val_p', $this->a_uri_assoc, null);		if(element('scr_p', $this->a_uri_assoc, null)) $this->jtp['scr_p'] = element('scr_p', $this->a_uri_assoc, null);	}
	public function _remap($m_Name){		switch ($m_Name) {			case 'create': {$this->create();break;}			case 'edit': {$this->edit();break;}			case 'details': {$this->details();break;}			case 'remove': {$this->remove();break;}			case 'move': {$this->move();break;}			case 'sort': {$this->sort();break;}			case 'vcreate': {$this->vcreate();break;}			case 'vedit': {$this->vedit();break;}			case 'vdetails': {$this->vdetails();break;}			case 'vremove': {$this->vremove();break;}			case 'vmove': {$this->vmove();break;}			case 'vsort': {$this->vsort();break;}			case 'vjournal': 			case 'vfind': {$this->vjournal(); break;}			case 'limit': {$this->limit();break;}			case 'l_pr': {$this->output->set_output($this->list_processing());break;}			case 'help': {$this->help(); break;}			default: $this->index();		}	}
	public function journal(){		$data = array();		$data['title'] = lang('CALLS_TITLE');		$data['orid'] = $this->get_orid();		$data['sort'] = $this->get_session('sort');		$data['find'] = $this->find();		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 		$data['fields']['date_doc'] =  array('label'=>lang('DATE_DOC'), 'colwidth'=>'10%', 'sort'=>True);		$data['fields']['f_name'] =  array('label'=>lang('F_NAME'), 'colwidth'=>'10%', 'sort'=>True);		$data['fields']['l_name'] =  array('label'=>lang('L_NAME'), 'colwidth'=>'10%', 'sort'=>True);		$data['fields']['_clients_rid'] =  array('label'=>lang('CLIENT'), 'colwidth'=>'10%', 'sort'=>False, 'type'=>'yes_no');		$data['fields']['country_name'] =  array('label'=>lang('COUNTRY'), 'colwidth'=>'10%', 'sort'=>True);		$data['fields']['source_name'] =  array('label'=>lang('ADVERTISE_SHORT'), 'colwidth'=>'15%', 'sort'=>True);		$data['fields']['emp_name'] =  array('label'=>lang('OWNER'), 'colwidth'=>'15%', 'sort'=>True);		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no'); 		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'10%', 'sort'=>True); 		$data['tools'] = $this->get_tools(); 		$data['ds'] = $this->calls_model->get_ds();		$data['paging'] = $this->get_paging($this->calls_model->get_calc_rows());		return $this->load->view('standart/grid', $data, True);			}

	private function create(){		$data = array();		$this->set_validation();		$data['title'] = lang('CALLS_TITLE_CREATE');		$data['orid'] = $this->get_orid();		$data['success'] = null;		if ($this->form_validation->run() === True){			if($rid = $this->calls_model->create_record()){				$this->session->set_flashdata('success', True);				redirect(get_currcontroller()."/edit/$rid", 'refresh');				return;			}			else {				$data['success'] = false;			} 		}		$data['cc_list'] = $this->list_processing();		$data['content'] = $this->load->view('calls/create', $data, True);		return $this->load->view('layouts/main_layout', $data);	}

	private function edit(){		$rid = (int)$this->uri->segment(3);		if(!$rid) show_404();		$data = array();		$this->set_validation();		$data['title'] = lang('CALLS_TITLE_EDIT');		$data['rid'] = $rid;		$data['orid'] = $this->get_orid();		$data['ds'] = $this->calls_model->get_edit($rid);		$h_cats = $this->calls_model->get_doc_hcats($rid);		$data['sub_ds'] = array();		foreach($h_cats as $h) $data['sub_ds'][] = $h->_hotelscats_rid;  		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;		if(!$data['ds']) show_404(); 		if ($this->form_validation->run() === True){			if($this->calls_model->update_record()) $data['success'] = true;			else $data['success'] = false;		}		$data['cc_list'] = $this->list_processing($rid);		$data['content'] = $this->load->view('calls/edit', $data, True);		return $this->load->view('layouts/main_layout', $data);	}
	private function details(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$data['title'] = lang('CALLS_TITLE_DETAILS');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->calls_model->get_edit($rid);		$h_cats = $this->calls_model->get_doc_hcats($rid);		$data['sub_ds'] = array();		foreach($h_cats as $h) $data['sub_ds'][] = $h->_hotelscats_rid;  		if(!$data['ds']) show_404(); 
		$data['content'] = $this->load->view('calls/details', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}


	private function find(){
		$data['orid'] = $this->get_orid();
		$this->form_validation->set_rules('rid', 'Id', 'trim');
		$this->form_validation->set_rules('doc_from', lang('DOC_FROM'), 'trim');
		$this->form_validation->set_rules('doc_to', lang('DOC_TO'), 'trim');
		$this->form_validation->set_rules('_filials_rid', lang('FILIAL'), 'trim');
		$this->form_validation->set_rules('_employeers_rid', lang('EMPLOYEER'), 'trim');
		$this->form_validation->set_rules('_countries_rid', lang('COUNTRY'), 'trim');			$this->form_validation->set_rules('_clients_rid', lang('CLIENT'), 'trim');				$this->form_validation->set_rules('archive', lang('HIDE_ARCHIVE'), 'trim');		
		if ($this->form_validation->run() == True){
			$search_rule = array();
			if($this->input->post('rid')) $search_rule['where']['_documents.rid'] = $this->input->post('rid');
			if($this->input->post('doc_from')) $search_rule['where']['_calls_headers.date_doc >='] = date('Y-m-d', strtotime($this->input->post('doc_from')));
			if($this->input->post('doc_to')) $search_rule['where']['_calls_headers.date_doc <='] = date('Y-m-d', strtotime($this->input->post('doc_to')));
			if($this->input->post('_filials_rid')) $search_rule['having']['_filials_rid'] = $this->input->post('_filials_rid');
			if($this->input->post('_employeers_rid')) $search_rule['where']['_employeers.rid'] = $this->input->post('_employeers_rid');
			if($this->input->post('_countries_rid')) $search_rule['where']['_countries.rid'] = $this->input->post('_countries_rid');			if($this->input->post('_clients_rid')) $search_rule['where']['_calls_rows._clients_rid'] = $this->input->post('_clients_rid');			if($this->input->post('archive')==0) $search_rule['where']['_documents.archive'] = $this->input->post('archive');
			$this->set_searchrule($search_rule);
		}
		$search = $this->get_session('searchrule');
		$data['search'] = array_merge(element('like', $search, array()), element('where', $search, array()), element('having', $search, array()));
		return $this->load->view('calls/find', $data, True);
	}

	private function move(){
		$rid = (int)$this->uri->segment(3);
		if(!$rid) show_404();
		$data = array();
		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');
		$data['title'] = lang('CALLS_TITLE_MOVE');
		$data['rid'] = $rid;
		$data['orid'] = $this->get_orid();
		$data['ds'] = $this->calls_model->get_edit($rid);
		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;
		if(!$data['ds']) show_404(); 
		if ($this->form_validation->run() === True){
			if($this->calls_model->move_record()) $data['success'] = true;
			else $data['success'] = false;
		}
		$data['content'] = $this->load->view('standart/move', $data, True);
		return $this->load->view('layouts/main_layout', $data);
	}
	
	
	private function set_validation(){		$this->form_validation->set_rules('date_doc', lang('DATE_DOC'), 'required');		$this->form_validation->set_rules('time_doc', lang('TIME_DOC'), 'required');		$this->form_validation->set_rules('_advertisessources_rid', lang('ADVERTISE_SHORT'), 'required');		$this->form_validation->set_rules('date_from', lang('DATE_FROM'), 'required');		$this->form_validation->set_rules('date_to', lang('DATE_TO'), 'required');		$this->form_validation->set_rules('_clients_rid', lang('CLIENT'), 'trim');		$this->form_validation->set_rules('f_name', lang('F_NAME'), 'trim|callback_check_client');		$this->form_validation->set_rules('l_name', lang('F_NAME'), 'trim');		$this->form_validation->set_rules('s_name', lang('F_NAME'), 'trim');		$this->form_validation->set_rules('phones', lang('PHONES'), 'trim|required');		$this->form_validation->set_rules('email', lang('EMAIL'), 'trim|valid_email');		$this->form_validation->set_rules('_countries_rids', lang('COUNTRIES_CUROURTS_LIST'), 'callback_check_countries');		$this->form_validation->set_rules('_curourts_rids', lang('CUROURT'), '');		$this->form_validation->set_rules('_hotelscats_rid', lang('HOTELCAT'), 'callback_check_hotelscats');		$this->form_validation->set_rules('sum_wanted_to', lang('SUM_TO'), 'trim|required|numeric');		$this->form_validation->set_rules('_currencies_rid', lang('CURRENCY'), 'required');		$this->form_validation->set_rules('tourists_quan', lang('TOURISTS_QUAN'), 'trim|required|numeric');		$this->form_validation->set_rules('tourists_wish', lang('TOURISTS_WISH'), 'trim|required|max_length[512]');		$this->form_validation->set_rules('tourists_offers', lang('TOURISTS_OFFERS'), 'trim|required|max_length[512]');		$this->form_validation->set_rules('tourists_answers', lang('TOURISTS_ANSWERS'), 'trim|required|max_length[512]');		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');		return;			}		public function check_hotelscats($hotelscats){		if(!count($hotelscats)){			$this->form_validation->set_message('check_hotelscats', lang('HOTELSCATS_EMPTY'));			return False;		}		return True;	}	public function check_countries($countries){		if(!count($countries)){			$this->form_validation->set_message('check_countries', lang('COUNTRIES_CUROURTS_LIST_EMPTY'));			return False;		}		return True;	}		public function check_client($client_fname){		if(!$client_fname and !$this->input->post('_clients_rid')){			$this->form_validation->set_message('check_client', lang('CALLS_CLIENT_ERROR'));			return False;		}		return True;	}		public function vjournal(){		$data = array();		$data['title'] = lang('CALLS_TITLE');		$data['orid'] = $this->get_orid();		$data['sort'] = $this->get_session('sort');		$data['find'] = $this->vfind();		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'5%', 'sort'=>True); 		$data['fields']['date_doc'] =  array('label'=>lang('DATE_DOC'), 'colwidth'=>'10%', 'sort'=>True);		$data['fields']['f_name'] =  array('label'=>lang('F_NAME'), 'colwidth'=>'10%', 'sort'=>True);		$data['fields']['l_name'] =  array('label'=>lang('L_NAME'), 'colwidth'=>'10%', 'sort'=>True);		$data['fields']['country_name'] =  array('label'=>lang('COUNTRY'), 'colwidth'=>'10%', 'sort'=>True);		$data['fields']['source_name'] =  array('label'=>lang('ADVERTISE_SHORT'), 'colwidth'=>'15%', 'sort'=>True);		$data['fields']['emp_name'] =  array('label'=>lang('OWNER'), 'colwidth'=>'15%', 'sort'=>True);		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'5%', 'sort'=>True, 'type'=>'yes_no'); 		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'20%', 'sort'=>True); 		$data['jtp'] = $this->jtp;		$data['tools'] = $this->get_tools(); 		$data['ds'] = $this->calls_model->get_ds();		$data['paging'] = $this->get_paging($this->calls_model->get_calc_rows(), True);		$content = $this->load->view('standart/vgrid', $data, True);		$this->load->view('layouts/valuepicker_layout', array('content'=>$content));				return;	}	private function vcreate(){		$data = array();		$this->set_validation();		$data['title'] = lang('CALLS_TITLE_CREATE');		$data['orid'] = $this->get_orid();		$data['success'] = null;		if ($this->form_validation->run() === True){			if($rid = $this->calls_model->create_record()){				$this->session->set_flashdata('success', True);				redirect(get_currcontroller()."/vedit/$rid", 'refresh');				return;			}			else {				$data['success'] = false;			} 		}		$data['cc_list'] = $this->list_processing();		$data['content'] = $this->load->view('calls/vcreate', $data, True);		return $this->load->view('layouts/valuepicker_layout', $data);	}	private function vedit(){		$rid = (int)$this->uri->segment(3);		if(!$rid) show_404();		$data = array();		$this->set_validation();		$data['title'] = lang('CALLS_TITLE_EDIT');		$data['rid'] = $rid;		$data['orid'] = $this->get_orid();		$data['ds'] = $this->calls_model->get_edit($rid);		$data['jtp'] = $this->jtp;		$h_cats = $this->calls_model->get_doc_hcats($rid);		$data['sub_ds'] = array();		foreach($h_cats as $h) $data['sub_ds'][] = $h->_hotelscats_rid;  		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;		if(!$data['ds']) show_404(); 		if ($this->form_validation->run() === True){			if($this->calls_model->update_record()) $data['success'] = true;			else $data['success'] = false;		}		$data['cc_list'] = $this->list_processing($rid);		$data['content'] = $this->load->view('calls/vedit', $data, True);		return $this->load->view('layouts/valuepicker_layout', $data);	}		private function vdetails(){		$rid = (int)$this->uri->segment(3);		if(!$rid) show_404();		$data = array();		$data['title'] = lang('CALLS_TITLE_DETAILS');		$data['rid'] = $rid;		$data['orid'] = $this->get_orid();		$data['jtp'] = $this->jtp;		$data['ds'] = $this->calls_model->get_edit($rid);		$h_cats = $this->calls_model->get_doc_hcats($rid);		$data['sub_ds'] = array();		foreach($h_cats as $h) $data['sub_ds'][] = $h->_hotelscats_rid;  		if(!$data['ds']) show_404(); 		$data['content'] = $this->load->view('calls/vdetails', $data, True);		return $this->load->view('layouts/valuepicker_layout', $data);	}	private function vfind(){		$data['orid'] = $this->get_orid();		$this->form_validation->set_rules('rid', 'Id', 'trim');		$this->form_validation->set_rules('doc_from', lang('DOC_FROM'), 'trim');		$this->form_validation->set_rules('doc_to', lang('DOC_TO'), 'trim');		$this->form_validation->set_rules('_filials_rid', lang('FILIAL'), 'trim');		$this->form_validation->set_rules('_employeers_rid', lang('EMPLOYEER'), 'trim');		$this->form_validation->set_rules('_countries_rid', lang('COUNTRY'), 'trim');		$this->form_validation->set_rules('_clients_rid', lang('CLIENT'), 'trim');			$this->form_validation->set_rules('archive', lang('HIDE_ARCHIVE'), 'trim');							if ($this->form_validation->run() == True){			$search_rule = array();			if($this->input->post('rid')) $search_rule['where']['_documents.rid'] = $this->input->post('rid');			if($this->input->post('doc_from')) $search_rule['where']['_calls_headers.date_doc >='] = date('Y-m-d', strtotime($this->input->post('doc_from')));			if($this->input->post('doc_to')) $search_rule['where']['_calls_headers.date_doc <='] = date('Y-m-d', strtotime($this->input->post('doc_to')));			if($this->input->post('_filials_rid')) $search_rule['having']['_filials_rid'] = $this->input->post('_filials_rid');			if($this->input->post('_employeers_rid')) $search_rule['where']['_employeers.rid'] = $this->input->post('_employeers_rid');			if($this->input->post('_countries_rid')) $search_rule['where']['_countries.rid'] = $this->input->post('_countries_rid');			if($this->input->post('_clients_rid')) $search_rule['where']['_calls_rows._clients_rid'] = $this->input->post('_clients_rid');			if($this->input->post('archive')==0) $search_rule['where']['_documents.archive'] = $this->input->post('archive');			$this->set_searchrule($search_rule);		}		$search = $this->get_session('searchrule');		$data['search'] = array_merge(element('like', $search, array()), element('where', $search, array()), element('having', $search, array()));		return $this->load->view('calls/vfind', $data, True);	}	private function vmove(){		$rid = (int)$this->uri->segment(3);		if(!$rid) show_404();		$data = array();		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');		$data['title'] = lang('CALLS_TITLE_MOVE');		$data['rid'] = $rid;		$data['orid'] = $this->get_orid();		$data['ds'] = $this->calls_model->get_edit($rid);		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;		if(!$data['ds']) show_404(); 		if ($this->form_validation->run() === True){			if($this->calls_model->move_record()) $data['success'] = true;			else $data['success'] = false;		}		$data['content'] = $this->load->view('standart/vmove', $data, True);		return $this->load->view('layouts/valuepicker_layout', $data);	}		private function list_processing($doc_rid=null){		$data['res_list'] = array();		$curourts_rids = array();		$countries_rids = array();		if($doc_rid){			$rows = $this->calls_model->get_doc_curourts($doc_rid);			foreach($rows as $row) $curourts_rids[] = $row->_curourts_rid; 		}		if($doc_rid){			$rows = $this->calls_model->get_doc_countries($doc_rid);			foreach($rows as $row) $countries_rids[] = $row->_countries_rid; 		}		if($this->input->post('_curourts_rids') && is_array($this->input->post('_curourts_rids'))) $curourts_rids = $this->input->post('_curourts_rids'); 		if($this->input->post('_countries_rids') && is_array($this->input->post('_countries_rids'))) $countries_rids = $this->input->post('_countries_rids');				foreach($curourts_rids as $curourt_rid){			$country_rid = get_curourtcountry_byrid($curourt_rid);			if(!isset($data['res_list'][$country_rid])) $data['res_list'][$country_rid]['name'] = get_countryname_byrid($country_rid);			$curourt_name = get_curourtname_byrid($curourt_rid);			if($curourt_name) $data['res_list'][$country_rid]['curourts'][$curourt_rid] = $curourt_name;		}		foreach($countries_rids as $country_rid){			$country_name = get_countryname_byrid($country_rid);			if($country_name) $data['res_list'][$country_rid]['name'] = $country_name;		}		return $this->load->view('calls/cc_list', $data, True);	}}

?>