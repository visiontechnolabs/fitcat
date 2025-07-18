<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Category extends MY_Controller
{



    public function __construct()
    {



        parent::__construct();



        $this->load->library('form_validation');

        $this->load->library('session');

        $this->load->model('general_model');
        $this->load->helper(['url', 'form']);

        if (!$this->session->userdata('admin')) {

            redirect('admin');
        }


    }

    public function index()
    {

        $this->load->view('admin/header');
        $this->load->view('admin/category_view');
        $this->load->view('admin/footer');

    }
    public function ajax_list()
    {
        $page = intval($this->input->post('page') ?? 1);
        $per_page = 10;
        $search = $this->input->post('search');

        $offset = ($page - 1) * $per_page;

        // Build WHERE clause for search if any
        $where = [];
        if (!empty($search)) {
            $this->db->like('category_name', $search);
        }

        // Fetch paginated data
        $this->db->limit($per_page, $offset);
        $categories = $this->general_model->getData('categories', '*', $where); // Use your table name

        // Get total count (with search if any)
        if (!empty($search)) {
            $this->db->like('category_name', $search);
        }
        $total = $this->general_model->getCount('categories', $where);

        $total_pages = ceil($total / $per_page);

        echo json_encode([
            'data' => $categories,
            'total_pages' => $total_pages,
            'current_page' => $page
        ]);
    }

    public function add_category()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/category_form');
        $this->load->view('admin/footer');
    }

    public function save()
    {
        $categoryName = $this->input->post('category_title');

        // Check if already exists
        $exists = $this->db->where('name', $categoryName)->get('categories')->row();

        if ($exists) {
            echo json_encode([
                'status' => 'exists',
                'message' => 'Category already exists!'
            ]);
            return;
        }

        // Image upload
        if (!empty($_FILES['category_image']['name'])) {
            $config['upload_path'] = './uploads/categoryimage/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = time();

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('category_image')) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $this->upload->display_errors()
                ]);
                return;
            }

            $uploadData = $this->upload->data();
            $image = 'uploads/category/' . $uploadData['file_name'];
        } else {
            $image = '';
        }

        // Save to DB
        $data = [
            'name' => $categoryName,
            'image' => $image,
            'created_on' => date('Y-m-d H:i:s')
        ];
        // echo "<pre>";
// print_r($data);
// die;
        $this->db->insert('categories', $data);

        echo json_encode([
            'status' => 'success',
            'message' => 'Category saved successfully!'
        ]);
    }
    public function sub_category()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/sub_category_view');
        $this->load->view('admin/footer');
    }

    public function add_sub_category()
    {
        $data['main_categories'] = $this->general_model->getAll('categories');

        $this->load->view('admin/header');
        $this->load->view('admin/sub_category_form', $data);
        $this->load->view('admin/footer');
    }
    public function save_sub_category()
    {
        $subcategory_title = $this->input->post('subcategory_title');
        $main_category_id = $this->input->post('main_category_id');

        if (empty($subcategory_title) || empty($main_category_id)) {
            echo json_encode(['success' => false]);
            return;
        }

        // Check for duplicate
        $exist = $this->general_model->getOne('subcategories', [
            'title' => $subcategory_title,
            'main_category_id' => $main_category_id
        ]);

        if ($exist) {
            echo json_encode(['success' => 'exist']);
            return;
        }

        // Insert data
        $data = [
            'title' => $subcategory_title,
            'main_category_id' => $main_category_id,
            'created_on' => date('Y-m-d H:i:s')
        ];

        $this->general_model->insert('subcategories', $data);
        $insert_id = $this->db->insert_id();

        echo json_encode(['success' => (bool) $insert_id]);
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

                $update = $this->general_model->update('categories', $where, $data);


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

    public function sub_ajax_list()
    {
        $page = $this->input->post('page') ?: 1;
        $search = trim($this->input->post('search'));
        $limit = 3;
        $offset = ($page - 1) * $limit;

        $this->load->model('general_model');

        // Base query
        $this->db->select('s.id, s.title AS subcategory_name, s.isActive, c.name AS category_name');
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.main_category_id', 'left');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s.title', $search);
            $this->db->or_like('c.name', $search);
            $this->db->group_end();
        }

        $this->db->limit($limit, $offset);
        $data = $this->db->get()->result_array();

        // Count total records
        $this->db->select('COUNT(*) AS total');
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.main_category_id', 'left');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s.title', $search);
            $this->db->or_like('c.name', $search);
            $this->db->group_end();
        }

        $total = $this->db->get()->row()->total;
        $totalPages = ceil($total / $limit);

        echo json_encode([
            'data' => $data,
            'current_page' => (int) $page,
            'total_pages' => (int) $totalPages,
            'start_index' => $offset + 1,
        ]);
    }

    public function toggle_status_sub_2()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if (is_numeric($id)) {
            $this->load->model('general_model');
            $updated = $this->general_model->update('subcategories', ['id' => $id], ['isActive' => $status]);

            echo json_encode([
                'success' => $updated,
                'message' => $status == 1 ? 'Published successfully' : 'Unpublished successfully'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID']);
        }
    }

    public function edit($id){
        $subcategory = $this->general_model->getOne('subcategories', ['id' => $id], true);
    if (!$subcategory) {
        show_404();
    }

    // Fetch all main categories for dropdown (assuming table name is `main_category`)
    $data['main_categories'] = $this->general_model->getAll('categories');
$data['sub_categories'] = $subcategory;
        // echo "<pre>";
        // print_r($data['main_categories']);
        // echo "<pre>";
        // print_r($data['sub_categories']);
        // die;
        $this->load->view('admin/header');
        $this->load->view('admin/edit_subcat_form',$data);
        $this->load->view('admin/footer');
    }
    public function update_subcategory()
{
    $id = $this->input->post('id'); // Hidden field or URL param
    $title = $this->input->post('subcategory_title');
    $main_category_id = $this->input->post('main_category_id');

    // Validate input
    if (empty($title) || empty($main_category_id)) {
        echo json_encode(['status' => false, 'message' => 'Required fields missing.']);
        return;
    }

    // Prepare data
    $data = [
        'title' => $title,
        'main_category_id' => $main_category_id
    ];

    // Update database
    $this->db->where('id', $id);
    $updated = $this->db->update('sub_categories', $data);

    if ($updated) {
        echo json_encode(['status' => true, 'message' => 'Subcategory updated successfully!']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to update subcategory.']);
    }
}
 public function edit_subcategory(){
$id = $this->input->post('id'); // Hidden field or URL param
    $title = $this->input->post('subcategory_title');
    $main_category_id = $this->input->post('main_category_id');

    // Validate input
    if (empty($title) || empty($main_category_id)) {
        echo json_encode(['status' => false, 'message' => 'Required fields missing.']);
        return;
    }

    // Prepare data
    $data = [
        'title' => $title,
        'main_category_id' => $main_category_id
    ];

    // Update database
    $this->db->where('id', $id);
    $updated = $this->db->update('subcategories', $data);

    if ($updated) {
        echo json_encode(['status' => true, 'message' => 'Subcategory updated successfully!']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to update subcategory.']);
    }

 }
 public function edit_main($id){
 $category = $this->general_model->getOne('categories', ['id' => $id]);

    if (!$category) {
        show_404();
    }

    $data['category'] = $category;
    //    echo "<pre>";
    //    print_r($data['category']);
    //    die;
        $this->load->view('admin/header');
        $this->load->view('admin/edit_main_cat_form',$data);
        $this->load->view('admin/footer');
 }
 public function update_main_cat()
{
    $id = $this->input->post('id');
    $name = $this->input->post('category_title'); // maps to `name` field in DB
    $isActive = $this->input->post('isActive'); // optional status toggle

    // Fetch old record for image cleanup
    $old = $this->general_model->getOne('categories', ['id' => $id]);

    $data = [
        'name' => $name,
        'isActive' => isset($isActive) ? $isActive : 1, // default to 1 (active) if not set
    ];

    // Handle new image upload
    if (!empty($_FILES['image']['name'])) {
        $config['upload_path'] = './uploads/category/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['file_name'] = time() . '_' . $_FILES['image']['name'];
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $data['image'] = 'uploads/category/' . $uploadData['file_name'];

            // Delete old image if it exists
            if (!empty($old->image) && file_exists('./' . $old->image)) {
                unlink('./' . $old->image);
            }
        } else {
            echo json_encode(['status' => false, 'message' => strip_tags($this->upload->display_errors())]);
            return;
        }
    }
// echo "<pre>";
// print_r($data);
// die;
    // Update the record
    $update = $this->general_model->update('categories', ['id' => $id], $data);

    if ($update) {
        echo json_encode(['status' => true, 'message' => 'Category updated successfully']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to update category']);
    }
}

public function Slider(){
    $this->load->view('admin/header');
    $this->load->view('admin/slider_view');
    $this->load->view('admin/footer');

}
public function ajax_list_slider()
{
    $limit = 10;
    $page = $this->input->post('page') ?? 1;
    $keyword = trim($this->input->post('keyword'));

    $offset = ($page - 1) * $limit;

    $where = [];
    if (!empty($keyword)) {
        $where['search'] = ['title' => $keyword, 'sub_title' => $keyword]; // fields to search
    }

    // total records
    $total = $this->general_model->count_with_search('slider', $where);

    // fetch records
    $sliders = $this->general_model->get_with_search('slider', $where, $limit, $offset);

    if ($sliders) {
        $html = '';
        $index = $offset + 1;
        $index = 1;
foreach ($sliders as $slider) {
    $html .= '<tr>';
    $html .= '<td>' . $index++ . '</td>';
    $html .= '<td><img src="' . base_url('uploads/slider/' . $slider['slider_image']) . '" style="width:60px;"></td>';
    $html .= '<td>' . $slider['slider_title'] . '</td>';
    $html .= '<td>' . $slider['sub_title'] . '</td>';
    $html .= '<td>' . $slider['display_order'] . '</td>';

    // Active/Inactive badge
    if ($slider['isActive'] == 1) {
        $html .= '<td>
            <div class="d-flex align-items-center text-success">
                <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                <span>Published</span>
            </div>
        </td>';
    } else {
        $html .= '<td>
            <div class="d-flex align-items-center text-danger">
                <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                <span>Unpublished</span>
            </div>
        </td>';
    }

    // Action buttons (Edit + Publish/Unpublish)
    $html .= '<td>
        <div class="d-flex order-actions align-items-center">
            <a href="' . site_url('admin/slider/edit_main/' . $slider['id']) . '" class="me-2">
                <i class="bx bxs-edit"></i>
            </a>';

    if ($slider['isActive'] == 1) {
        $html .= '<button class="btn btn-sm btn-danger toggle-status-btn_slider" data-id="' . $slider['id'] . '" data-status="0">
            <i class="bx bx-x-circle me-1"></i> Unpublish
        </button>';
    } else {
        $html .= '<button class="btn btn-sm btn-success toggle-status-btn_slider" data-id="' . $slider['id'] . '" data-status="1">
            <i class="bx bx-check-circle me-1"></i> Publish
        </button>';
    }

    $html .= '</div></td>';
    $html .= '</tr>';
}


        // pagination logic
        $totalPages = ceil($total / $limit);
        $pagination = '';

        if ($totalPages > 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="javascript:;" data-page="' . max(1, $page - 1) . '">Previous</a></li>';

            $start = max(1, $page - 1);
            $end = min($start + 2, $totalPages);

            for ($i = $start; $i <= $end; $i++) {
                $active = ($i == $page) ? 'active' : '';
                $pagination .= '<li class="page-item ' . $active . '"><a class="page-link" href="javascript:;" data-page="' . $i . '">' . $i . '</a></li>';
            }

            $pagination .= '<li class="page-item"><a class="page-link" href="javascript:;" data-page="' . min($totalPages, $page + 1) . '">Next</a></li>';
        }

        echo json_encode(['status' => true, 'html' => $html, 'pagination' => $pagination]);
    } else {
        echo json_encode(['status' => false]);
    }
}

public function toggle_status_slider(){
     $id = $this->input->post('id');
     $status = $this->input->post('status');

        if (is_numeric($id)) {
            $this->load->model('general_model');
            $updated = $this->general_model->update('slider', ['id' => $id], ['isActive' => $status]);

            echo json_encode([
                'success' => $updated,
                'message' => $status == 1 ? 'Published successfully' : 'Unpublished successfully'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID']);
        }
}
public function add_slider(){
     $this->load->view('admin/header');
    $this->load->view('admin/slider_form');
    $this->load->view('admin/footer');
}

public function create(){
     $this->load->library('form_validation');
    $this->form_validation->set_rules('title', 'sub_title', 'required');

    if ($this->form_validation->run() == FALSE) {
        echo json_encode(['status' => false, 'message' => validation_errors()]);
        return;
    }

    $data = [
        'slider_title' => $this->input->post('title', true),
        'sub_title' => $this->input->post('sub_title', true),
        'page_link' => $this->input->post('page_link', true),
        'display_order' => $this->input->post('display_order',true),
         'created_at' => date('Y-m-d H:i:s')
    ];

    // Image Upload
    if (!empty($_FILES['slider_image']['name'])) {
        $config['upload_path'] = './uploads/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['file_name'] = time() . '_' . $_FILES['slider_image']['name'];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('slider_image')) {
            $uploadData = $this->upload->data();
            $data['slider_image'] = $uploadData['file_name'];
        } else {
            echo json_encode(['status' => false, 'message' => $this->upload->display_errors()]);
            return;
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Please select an image.']);
        return;
    }

    $insert = $this->general_model->insert('slider', $data);

    if ($insert) {
        echo json_encode(['status' => true, 'message' => 'Slider added successfully']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to add slider']);
    }
}

    }