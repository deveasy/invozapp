<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patient extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('logged_in')){
            redirect('auth','refresh');
        }
        $this->load->model('patients_model');
    }

    private $patient_id;

    public function presenting_complaint($patient_id){
    	$this->patients_model->add_presenting_complaint($patient_id);
    	redirect('patients/view_patient/'.$patient_id);
    }
}