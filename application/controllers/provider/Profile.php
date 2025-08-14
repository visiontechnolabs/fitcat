<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/Provider_Controller.php');
class Profile extends Provider_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['provider'] = $this->general_model->getOne('users', array('id' => $this->provider['id']));
        $data['categories'] = $this->general_model->getAll('categories', ['isActive' => 1]);
        $data['city'] = $this->general_model->getAll('cities', ['isActive' => 1]);
        $data['profile'] = $this->general_model->getOne('provider', ['isActive' => 1,'provider_id'=>$this->provider['id']]);
        $data['expertis'] = $this->general_model->getAll('expertise_tag', ['provider_id'=>$this->provider['id']]);




        $this->load->view('provider/header');
        $this->load->view('provider/profile_form', $data);
        $this->load->view('provider/footer');

    }
    public function get_subcategories()
    {
        $category_id = $this->input->post('category_id');
        $subcategories = $this->general_model->getAll('subcategories', ['main_category_id' => $category_id, 'isActive' => 1]);
        echo json_encode($subcategories);
    }
   public function save()
{
    $input = $this->input->post();
    $provider_id = trim($input['id']);
    $profile_image = null;

    // Upload profile image if exists
    if (!empty($_FILES['profile_image']['name'])) {
        $config['upload_path']   = './uploads/profile/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // in KB
        $config['file_name']     = 'profile_' . time();

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('profile_image')) {
            $uploadData   = $this->upload->data();
            $profile_image = 'uploads/profile/' . $uploadData['file_name'];
        } else {
            log_message('error', 'Profile image upload failed: ' . $this->upload->display_errors('', ''));
        }
    }

    // Build provider data
   $address = trim($input['address']);

// Call OpenStreetMap API to get lat/lng
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($address));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'FitTicketApp/1.0 (support@fitticket.com)');
$response = curl_exec($ch);
curl_close($ch);

$latitude = null;
$longitude = null;

if ($response) {
    $data = json_decode($response, true);
    if (!empty($data)) {
        $latitude = $data[0]['lat'];
        $longitude = $data[0]['lon'];
    }
}

$providerData = [
    'provider_id'   => $provider_id,
    'description'   => $input['description'],
    'category'      => $input['category'],
    'sub_category'  => $input['subcategory'],
    'city'          => isset($input['availability']) ? implode(',', $input['availability']) : '',
    'address'       => $address,
    'day_price'     => $input['price_day'],
    'week_price'    => $input['price_week'],
    'month_price'   => $input['price_month'],
    'year_price'    => $input['price_year'],
    'latitude'      => $latitude,
    'longitude'     => $longitude,
    'isActive'      => 1,
    'created_on'    => date('Y-m-d')
];

if ($profile_image) {
    $providerData['profile_image'] = $profile_image;
}

$existing = $this->general_model->getOne('provider', ['provider_id' => $provider_id]);
if ($existing) {
    $this->general_model->update('provider', $providerData, ['provider_id' => $provider_id]);
} else {
    $this->general_model->insert('provider', $providerData);
}


    // Process expertise tags
    $tags = [];
    if (!empty($input['expertise_tags'])) {
        $decoded = json_decode($input['expertise_tags'], true);
        if (is_array($decoded)) {
            $tags = array_map(function ($tag) {
                return ['value' => trim($tag['value'])];
            }, $decoded);
        } else {
            $tags = array_map(function ($tag) {
                return ['value' => trim($tag)];
            }, explode(',', $input['expertise_tags']));
        }
    }

    // Remove old tags
    $this->db->delete('expertise_tag', ['provider_id' => $provider_id]);

    // Insert new tags
    foreach ($tags as $tag) {
        if (!empty($tag['value'])) {
            $this->db->insert('expertise_tag', [
                'provider_id' => $provider_id,
                'tag'         => $tag['value'],
                'created_on'  => date('Y-m-d')
            ]);
        }
    }

    // Return response
    echo json_encode(['status' => 'success', 'message' => 'Profile saved successfully!']);
}



}