<?php/** * TravelCRM * * An open source CRM system for travel agencies * * @author		Mazvv (vitalii.mazur@gmail.com) * @license		GNU GPLv3 (http://gplv3.fsf.org)  * @link		http://www.travelcrm.org.ua */include_once APPPATH."libraries/core/Reportcontroller.php";class R_sales extends Reportcontroller {	public function __construct(){		parent::__construct();		$this->lang->load('r_sales');		$this->load->model('r_sales_model');		$this->load->helper('filials');	}	public function _remap($m_Name){		switch ($m_Name) {			default: $this->create();		}	}	private function create(){		$data = array();		$data['title'] = lang('R_SALES_TITLE');		$data['orid'] = $this->get_orid();		$data['ds'] = null;		$data['r_body_title'] = null;		$this->set_validation();		if ($this->form_validation->run() === True){			$data['ds'] = $this->r_sales_model->get_ds();			$data['r_body_title'] = sprintf(lang('R_BODY_TITLE'), $this->input->post('date_report_from'),											$this->input->post('date_report_to'),											($this->input->post('_filials_rid')?get_filial_name_byrid($this->input->post('_filials_rid')):lang('R_ALL')));   					}		$data['content'] = $this->load->view('reports/r_sales/create', $data, True);		return $this->load->view('layouts/main_layout', $data);	}	private function set_validation(){		$this->form_validation->set_rules('date_report_from', lang('DATE_REPORT_FROM'), 'required|trim');		$this->form_validation->set_rules('date_report_to', lang('DATE_REPORT_TO'), 'required|trim');		$this->form_validation->set_rules('_filials_rid', lang('FILIAL'), 'trim');		return;	}}?>