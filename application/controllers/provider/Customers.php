<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/Provider_Controller.php');
class Customers extends Provider_Controller
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
        $this->load->view('provider/customer_view');
        $this->load->view('provider/footer');

    }
    public function get_customers_ajax()
    {
        $provider_id = $this->provider['id'];
        $search = $this->input->get('search');
        $page = (int) $this->input->get('page') ?: 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Get paginated customers
        $this->db->distinct();
        $this->db->select('u.id, u.name, u.mobile, u.email');
        $this->db->from('users u');
        $this->db->join('orders o', 'u.id = o.user_id');
        $this->db->join('order_items oi', 'o.id = oi.order_id');
        $this->db->where('oi.provider_id', $provider_id);

        if (!empty($search)) {
            $this->db->group_start()
                ->like('u.name', $search)
                ->or_like('u.mobile', $search)
                ->or_like('u.email', $search)
                ->group_end();
        }

        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $customers = $query->result();

        // Get total distinct user count
        $this->db->distinct();
        $this->db->select('u.id');
        $this->db->from('users u');
        $this->db->join('orders o', 'u.id = o.user_id');
        $this->db->join('order_items oi', 'o.id = oi.order_id');
        $this->db->where('oi.provider_id', $provider_id);

        if (!empty($search)) {
            $this->db->group_start()
                ->like('u.name', $search)
                ->or_like('u.mobile', $search)
                ->or_like('u.email', $search)
                ->group_end();
        }

        $total = $this->db->get()->num_rows();

        echo json_encode([
            'customers' => $customers,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ]);
    }
    public function booking()
    {
        $this->load->view('provider/header');
        $this->load->view('provider/booking_view');
        $this->load->view('provider/footer');
    }
 public function get_bookings_ajax()
{
    $provider_id = $this->provider['id'];
    $search = $this->input->get('search');
    $page = (int) $this->input->get('page') ?: 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    // STEP 1: Get ALL matching DISTINCT order IDs
    $this->db->distinct();
    $this->db->select('o.id');
    $this->db->from('orders o');
    $this->db->join('users u', 'u.id = o.user_id');
    $this->db->join('order_items oi', 'o.id = oi.order_id');
    $this->db->where('oi.provider_id', $provider_id);

    if (!empty($search)) {
        $this->db->group_start()
            ->like('u.name', $search)
            ->or_like('u.mobile', $search)
            ->group_end();
    }

    $this->db->order_by('o.created_at', 'DESC');
    $all_order_ids_result = $this->db->get()->result();

    // STEP 2: Extract just the IDs
    $all_order_ids = array_column($all_order_ids_result, 'id');
    $total = count($all_order_ids); // total before slicing

    // STEP 3: Paginate the order IDs
    $paginated_order_ids = array_slice($all_order_ids, $offset, $limit);

    // STEP 4: Get booking details for paginated orders (preserve ID order)
    $bookings = [];

    if (!empty($paginated_order_ids)) {
        $this->db->select('u.name, u.mobile, o.created_at, o.total, o.id');
        $this->db->from('orders o');
        $this->db->join('users u', 'u.id = o.user_id');
        $this->db->where_in('o.id', $paginated_order_ids);
        
        // This keeps the result in the same order as $paginated_order_ids
        $order_ids_order = implode(',', $paginated_order_ids);
        $this->db->order_by("FIELD(o.id, $order_ids_order)", '', false);

        $bookings = $this->db->get()->result();
    }
// echo "<pre>";
// print_r($total);
// die;
    // STEP 5: Respond
    echo json_encode([
        'bookings' => $bookings,
        'total' => $total,
        'page' => $page,
        'limit' => $limit
    ]);
}












}