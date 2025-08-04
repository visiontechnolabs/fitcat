<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/User_Controller.php');



class Profile extends User_Controller
{



    public function __construct()
    {



        parent::__construct();



    }

    public function index()
    {
        $this->db->select('
    provider.profile_image, 
    users.name as gym_name, 
    provider.provider_id, 
    COUNT(service.id) as service_count
');
        $this->db->from('provider');
        $this->db->join('users', 'users.id = provider.provider_id', 'left');
        $this->db->join('service', 'service.provider_id = provider.provider_id', 'left');
        $this->db->where('users.isActive', 1);
        $this->db->group_by('provider.provider_id');

        $this->data['provider'] = $this->db->get()->result_array();



        $this->load->view('header');
        $this->load->view('profile_view', $this->data);
        $this->load->view('footer');


    }

    public function provider_details($id)
    {
        $this->db->select('provider.*, 
                   users.gym_name, users.email,users.name, users.mobile, 
                   COUNT(DISTINCT service.id) as service_count, 
                   GROUP_CONCAT(DISTINCT expertise_tag.tag) as expertise_tags');
        $this->db->from('provider');
        $this->db->join('users', 'users.id = provider.provider_id', 'left');
        $this->db->join('service', 'service.provider_id = provider.provider_id AND service.isActive = 1', 'left');
        $this->db->join('expertise_tag', 'expertise_tag.provider_id = provider.provider_id', 'left');
        $this->db->where('provider.provider_id', $id);
        $this->db->where('provider.isActive', 1);
        $this->db->group_by('provider.provider_id'); // avoid duplicates
        $this->data['provider'] = $this->db->get()->row();


        $this->data['service'] = $this->general_model->getAll('service', array('provider_id' => $id, 'isactive' => 1));
        if (!empty($this->data['provider'])) {
            $locationData = $this->getCityState(
                $this->data['provider']->latitude,
                $this->data['provider']->longitude
            );
            // echo "<pre>";
//      print_r($this->data['provider']);

            //     die;

            $this->data['city'] = $locationData['city'];
            $this->data['state'] = $locationData['state'];

            $this->load->view('header');
            $this->load->view('profile_details', $this->data);
            $this->load->view('footer');
        }
    }
    private function getCityState($latitude, $longitude)
    {
        $apiKey = 'AIzaSyAR5-9XtV0r0VyR7uu0ppEKhNHanKlGwWk';

        // ✅ Validate input
        if (empty($latitude) || empty($longitude)) {
            return ['city' => '', 'state' => ''];
        }

        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";

        $response = @file_get_contents($url);
        if ($response === false) {
            return ['city' => '', 'state' => '']; // Prevent warnings
        }

        $response = json_decode($response, true);

        $city = '';
        $state = '';

        if (!empty($response['results'][0]['address_components'])) {
            foreach ($response['results'][0]['address_components'] as $component) {
                if (in_array('locality', $component['types'])) {
                    $city = $component['long_name'];
                }
                if (in_array('administrative_area_level_1', $component['types'])) {
                    $state = $component['long_name'];
                }
            }
        }

        return ['city' => $city, 'state' => $state];
    }

}
