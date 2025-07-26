<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/Provider_Controller.php');
class Service extends Provider_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // echo "<pre>";
        // print_r($this->provider);
        // die;
        $this->load->view('provider/header');
        $this->load->view('provider/service_view');
        $this->load->view('provider/footer');

    }
    public function fetch_services()
    {
        $search = $this->input->post('search');
        $page = $this->input->post('page');
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $where = ['provider_id' => $this->provider['id']]; // from Provider_Controller

        $search_fields = ['name', 'description'];
        $search_array = [];

        if (!empty($search)) {
            foreach ($search_fields as $field) {
                $search_array[$field] = $search;
            }
        }

        $params = [];
        if (!empty($search_array)) {
            $params['search'] = $search_array;
        }

        $total = $this->general_model->count_with_search('service', array_merge($params, ['provider_id' => $this->provider['id']]));
        $services = $this->general_model->get_with_search('service', $params, $limit, $offset);

        echo json_encode([
            'status' => 'success',
            'data' => $services,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }
    public function toggle_status()
    {
        if ($this->input->method() === 'post') {
            $id = $this->input->post('id');
            $status = $this->input->post('status');

            if (is_numeric($id) && ($status === '0' || $status === '1')) {
                // $this->load->model('Category_model');

                $where = ['id' => $id];
                $data = ['isActive' => $status];

                $update = $this->general_model->update('service', $where, $data);


                if ($update) {
                    echo json_encode([
                        'success' => true,
                        'message' => $status == '1' ? 'Published successfully' : 'Unpublished successfully'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to update status'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid input'
                ]);
            }
        }
    }

    public function add_service()
    {
        $this->load->view('provider/header');
        $this->load->view('provider/service_form');
        $this->load->view('provider/footer');
    }
    public function save()
    {
        $serviceName = $this->input->post('service_title');


        $exists = $this->db->where('name', $serviceName)->get('service')->row();

        if ($exists) {
            echo json_encode([
                'status' => 'exists',
                'message' => 'Category already exists!'
            ]);
            return;
        }

        // Image upload
        if (!empty($_FILES['service_image']['name'])) {
            $config['upload_path'] = './uploads/serviceimage/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = time();

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('service_image')) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $this->upload->display_errors()
                ]);
                return;
            }

            $uploadData = $this->upload->data();
            $image = 'uploads/serviceimage/' . $uploadData['file_name'];
        } else {
            $image = '';
        }

        $provider_id = $this->provider['id'];
        $data = [
            'provider_id' => $provider_id,
            'name' => $serviceName,
            'image' => $image,
            'description' => $this->input->post('service_description'),
            'created_on' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('service', $data);

        echo json_encode([
            'status' => 'success',
            'message' => 'Service saved successfully!'
        ]);
    }
    public function edit_service($id)
    {
        $serevice = $this->general_model->getOne('service', ['id' => $id]);

        if (!$serevice) {
            show_404();
        }

        $data['service'] = $serevice;
        //    echo "<pre>";
        //    print_r($data['category']);
        //    die;
        $this->load->view('provider/header');
        $this->load->view('provider/edit_service_form', $data);
        $this->load->view('provider/footer');
    }
    public function update(){
     $id = $this->input->post('service_id');
    $name = $this->input->post('service_title'); 
    // $isActive = $this->input->post('isActive'); 

    // // Fetch old record for image cleanup
    $old = $this->general_model->getOne('service', ['id' => $id]);

    $data = [
        'name' => $name,
    'description' => $this->input->post('service_description')
    ];

    // Handle new image upload
    if (!empty($_FILES['service_image']['name'])) {
    $config['upload_path'] = './uploads/serviceimage/';
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['file_name'] = time() . '_' . $_FILES['service_image']['name'];
    $this->load->library('upload', $config);

    if ($this->upload->do_upload('service_image')) {
        $uploadData = $this->upload->data();
        $data['image'] = 'uploads/serviceimage/' . $uploadData['file_name'];

        if (!empty($old->image) && file_exists('./' . $old->image)) {
            unlink('./' . $old->image);
        }
    }
} else {
            echo json_encode(['status' => false, 'message' => strip_tags($this->upload->display_errors())]);
            return;
        }
    
    $update = $this->general_model->update('service', ['id' => $id], $data);

    if ($update) {
        echo json_encode(['status' => true, 'message' => 'Service updated successfully']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to update service']);
    }
}
}