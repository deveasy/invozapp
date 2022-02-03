<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends CI_Controller {

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in')){
            redirect('auth','refresh');
        }
        $this->load->model('patients_model');
	}
	
	public function index()
	{
		$data['patients'] = $this->patients_model->get_patients();
		$this->load->view('med/view_patients', $data);
	}

	//function to generate new patient id
	function new_patient_id(){
		if($this->patients_model->no_patient()){
			return '00000';
		}
		else{
			$last_id = $this->patients_model->get_last_patient_id()->patient_id;

			return $last_id;
		}
	}

	public function view_patient($patient_id){
	    $data['patient_id'] = $patient_id;
		$data['patient'] = $this->patients_model->get_patient($patient_id);
		$data['diagnoses'] = $this->patients_model->get_patient_diagnoses($patient_id);
		$data['vitals'] = $this->patients_model->get_patient_vitals($patient_id);
		$data['appointments'] = $this->patients_model->get_patient_appointments($patient_id);
		$data['observations'] = $this->patients_model->get_patient_observations($patient_id);
		$data['conditions'] = $this->patients_model->get_patient_conditions($patient_id);
		$data['allergies'] = $this->patients_model->get_patient_allergies($patient_id);
		$data['relations'] = $this->patients_model->get_patient_relations($patient_id);
		$data['presenting_complaint'] = $this->patients_model->get_presenting_complaint($patient_id);
		$data['prescriptions'] = $this->patients_model->get_prescriptions($patient_id);
		$data['lab_tests'] = $this->patients_model->get_lab_tests($patient_id);

		$this->load->view('med/view_patient', $data);
	}

	public function view_patient_new($patient_id){
	    $data['patient_id'] = $patient_id;
		$data['patient'] = $this->patients_model->get_patient($patient_id);
		$data['diagnoses'] = $this->patients_model->get_patient_diagnoses($patient_id);
		$data['vitals'] = $this->patients_model->get_patient_vitals($patient_id);
		$data['appointments'] = $this->patients_model->get_patient_appointments($patient_id);
		$data['observations'] = $this->patients_model->get_patient_observations($patient_id);
		$data['conditions'] = $this->patients_model->get_patient_conditions($patient_id);
		$data['allergies'] = $this->patients_model->get_patient_allergies($patient_id);
		$data['relations'] = $this->patients_model->get_patient_relations($patient_id);
		$data['presenting_complaint'] = $this->patients_model->get_presenting_complaint($patient_id);
		$data['prescriptions'] = $this->patients_model->get_prescriptions($patient_id);
		$data['lab_tests'] = $this->patients_model->get_lab_tests($patient_id);

		$this->load->view('med/view_patient_new', $data);
	}

	public function new_patient(){
		//$data['patient_id'] = $this->new_patient_id();
		$data['medicines'] = $this->patients_model->get_medicines();
		$this->load->view('med/add_new_patient');
	}

	public function add_new_patient(){
		$this->patients_model->add_new_patient();
		//$this->patients_model->add_patient_relation($patient_id);
		redirect('patients');
	}

	public function edit_patient($patient_id){
	    $data['patient_id'] = $patient_id;
	    $this->load->view('med/edit_patient', $data);
    }

    public function update_patient($patient_id){
	    $this->patients_model->update_patient($patient_id);
	    redirect('patients/view_patient/'. $patient_id);
    }

	public function delete_patient($patient_id){
		$this->patients_model->delete_patient($patient_id);
		redirect('patients');
	}

	public function upload_file(){
	    $config['upload_path'] = './uploads/';
	    $config['allowed_types'] = 'gif|jpg|png|pdf';
	    $config['max_size'] = 100;
	    $config['max_width'] = 1024;
	    $config['max_height'] = 768;

	    $this->load->library('upload', $config);

	    if(!$this->upload->do_upload('userfile')){
	        $this->form_validation->set_error_delimiters('<p class="error">','</p>');
	        $error = array(
	            'error' => $this->upload->display_errors()
            );
	        $this->load->view('upload', $error);
        }
        else{
	        $data = array(
	            'upload_data' => $this->upload->data()
            );
	        $this->load->view('success', $data);
        }
    }

    public function add_lab_test($patient_id){
    	$this->patients_model->add_lab_test($patient_id);
    	redirect('patients/view_patient/'.$patient_id);
    }

	public function appointments(){
		$data['appointments'] = $this->patients_model->get_patient_appointments();
		$this->load->view('med/view_patient_appointments', $data);
	}

	public function patient_appointment($patient_id){
		$data['appointment'] = $this->db->get_patient_appointment($patient_id);
		$this->load->view('med/view_patient_appointment', $data);
	}

	public function new_appointment($patient_id){
	    $data['patient_id'] = $patient_id;
	    $this->load->view('med/add_patient_appointment', $data);
    }

    public function add_appointment($patient_id){
	    $this->patients_model->add->patient_appointment($patient_id);
	    redirect('patients/view_patient/' . $patient_id);
    }

	public function relations(){
		$data = $this->patients_model->get_patient_relations();
		$this->load->view('med/view_patient_relations', $data);
	}

	public function new_relation($patient_id){
	    $data['patient_id'] = $patient_id;
	    $this->load->view('med/new_relation', $data);
    }

    public function add_new_relation($patient_id){
        $this->patients_model->add_relation($patient_id);
        redirect('patients/view_patient/'. $patient_id);
    }

	public function patient_vitals($patient_id){
		$data['patient'] = $this->patients_model->get_patient($patient_id);
		$this->load->view('med/capture_patient_vitals', $data);
	}

	public function new_vitals($patient_id){
	    $data['patient_id'] = $patient_id;
	    $this->load->view('med/add_patient_vital', $data);
    }

    public function add_patient_vitals($patient_id){
	    $this->patients_model->add_patient_vitals($patient_id);
	    redirect('patients/view_patient/' . $patient_id);
    }

	public function prescriptions(){
	    $data['prescriptions'] = $this->patients_model->get_prescriptions();
	    $this->load->view('med/patient_prescriptions', $data);
    }

    public function view_prescription($prescription_id){
    	$data['prescription'] = $this->patients_model->get_prescription($prescription_id);
	    $data['prescription_details'] = $this->patients_model->get_prescription_details($prescription_id);
	    $this->load->view('med/view_prescription', $data);

	    // print_r($this->patients_model->get_prescription_details($prescription_id));
    }

    public function new_prescription($patient_id){
    	$data['medicines'] = $this->patients_model->get_medicines();
        $data['patient_id'] = $patient_id;
        $this->load->view('med/new_prescription', $data);
    }

	public function new_prescription_id(){
		if($this->patients_model->get_last_prescription_id() == false){
			return 1;
		}
		else{
			$id = $this->patients_model->get_last_prescription_id()->prescription_id + $_SESSION['logged_in']['staff_id'];
			
			return $id;
		}
	}

    public function add_prescription($patient_id){
    	$prescription_id = $this->new_prescription_id();

        $this->patients_model->add_prescription($patient_id, $prescription_id);
        $this->patients_model->add_prescription_details($patient_id, $prescription_id);
        redirect('patients/view_patient/' . $patient_id);
    }

    public function new_diagnosis($patient_id){
        $data['patient_id'] = $patient_id;
        $this->load->view('med/add_patient_diagnosis', $data);
    }

    public function add_patient_diagnosis($patient_id){
        $this->patients_model->add_patient_diagnosis($patient_id);
        redirect('patients/view_patient/' . $patient_id);
    }

    public function new_observation($patient_id){
        $data['patient_id'] = $patient_id;
        $this->load->view('med/add_patient_observation', $data);
    }

    public function add_patient_observation($patient_id){
        $this->patients_model->add_patient_observation($patient_id);
        redirect('patients/view_patient/' . $patient_id);
    }

    public function new_condition($patient_id){
        $data['patient_id'] = $patient_id;
        $this->load->view('med/add_patient_condition', $data);
    }

    public function add_patient_condition($patient_id){
        $this->patients_model->add_patient_condition($patient_id);
        redirect('patients/view_patient/' . $patient_id);
    }

    public function new_allergy($patient_id){
        $data['patient_id'] = $patient_id;
        $this->load->view('med/add_patient_allergy', $data);
    }

    public function add_patient_allergy($patient_id){
        $this->patients_model->add_patient_allergy($patient_id);
        redirect('patients/view_patient/'.$patient_id);
    }

    public function health_trend_summary(){
        //algorithm for patient's health trend goes here
    }

    public function weight_graph(){
        //algorithm for weight graph
    }
}

/* End of file Patients.php */
/* Location: ./application/controllers/Patients.php */