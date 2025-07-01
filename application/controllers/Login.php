<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper(['url', 'form']);
        // $this->load->database();
        $this->load->model('general_model');

    }

    public function index() {
        $this->load->view('login_form');
    }

    public function send_otp() {
        $mobile = $this->input->post('mobile');
        if (!$mobile) {
            $this->session->set_flashdata('error', 'Mobile number is required.');
            redirect('login');
        }

        
        $otp = rand(100000, 999999);
        $this->session->set_userdata('otp', $otp);
        $this->session->set_userdata('mobile', $mobile);

       
        $this->send_otp_via_sms($mobile, $otp);

        $this->session->set_flashdata('success', 'OTP sent successfully.');
        $this->load->view('otp_form');
    }

    public function verify_otp() {
        $input_otp = $this->input->post('otp');
        $session_otp = $this->session->userdata('otp');
        $mobile = $this->session->userdata('mobile');

        if ($input_otp == $session_otp) {
            // Check in DB
            $query = $this->db->get_where('users', ['mobile' => $mobile]);
            $user = $query->row_array();

            if ($user) {
                
                if ($user['user_type'] == 1) {
                    redirect('admin/dashboard');
                } elseif ($user['user_type'] == 2) {
                    redirect('provider/dashboard');
                } else {
                    redirect('user/dashboard');
                }

            } else {
                
                $public_user = ['mobile' => $mobile, 'user_type' => 0];
                $this->session->set_userdata('user', $public_user);
                redirect('user/dashboard');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid OTP');
            $this->load->view('otp_form');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

   
 private function send_otp_via_sms($mobile, $otp) {
    $url = "https://mobicomm.dove-sms.com/submitsms.jsp";
    $message = "Hi, Your OTP is $otp. Do not share it. - OMKARENT";
    $params = [
        'user'      => 'Fitcketsp',
        'key'       => '81a6b2f99cXX',
        'mobile'    => $mobile,
        'message'   => $message,
        'senderid'  => 'OMENTO',
        'accusage'  => '1',
        'entityid'  => '1401487200000053882',
        'tempid'    => '1407168611506367587'
    ];

    $query = http_build_query($params);
    $fullUrl = $url . '?' . $query;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $fullUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set timeout
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        log_message('error', 'cURL error: ' . curl_error($ch));
        curl_close($ch);
        return false;
    }

    curl_close($ch);

    log_message('info', "OTP $otp sent to $mobile. Response: $response");

    // Check response for success (modify based on Dove-SMS response format)
    if (strpos($response, 'success') !== false) {
        return true;
    } else {
        log_message('error', "Failed to send OTP to $mobile. Response: $response");
        return false;
    }
}

}
