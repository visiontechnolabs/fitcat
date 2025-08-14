<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/User_Controller.php');




class Cart extends User_Controller
{

    private $MERCHANT_KEY = "HMOTYj";
    private $SALT = "QhQBoy3OluMpjZAb804CHRGgRscXpPLO";
private $PAYU_BASE_URL = "https://secure.payu.in";

    public function __construct()
    {



        parent::__construct();
        if (!$this->user) {
            redirect('login');
        }


    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('cart_view');
        $this->load->view('footer');

    }

    public function add_to_cart()
    {
        $data = array(
            'id' => $this->input->post('provider_id'),
            'name' => $this->input->post('provider_name'),
            'image' => $this->input->post('provider_image'),
            'price' => $this->input->post('price'),
            'duration' => $this->input->post('duration'),
            'qty' => $this->input->post('quantity'),
            'start_date' => $this->input->post('start_date')
        );

        $cart = $this->session->userdata('cart_items') ?? [];
        $found = false;

        foreach ($cart as $index => $item) {
            if ($item['id'] == $data['id'] && $item['duration'] == $data['duration']) {
                $cart[$index]['qty'] += $data['qty'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = $data;
        }

        $this->session->set_userdata('cart_items', $cart);

        redirect('cart/view');
    }

    public function view()
    {
        $data['cart_items'] = $this->session->userdata('cart_items');
        $this->load->view('header');
        $this->load->view('cart_view', $data);
        $this->load->view('footer');

    }

    public function remove($index)
    {
        $cart = $this->session->userdata('cart_items');
        unset($cart[$index]);
        $this->session->set_userdata('cart_items', $cart);
        redirect('cart/view');
    }
    public function clear_cart()
    {
        $this->session->unset_userdata('cart_items');
        redirect('cart/view');
    }
    public function increase_qty($provider_id, $duration)
    {
        $cart = $this->session->userdata('cart_items') ?? [];
        foreach ($cart as &$item) {
            if ($item['id'] == $provider_id && $item['duration'] == $duration) {
                $item['qty'] += 1;
            }
        }
        $this->session->set_userdata('cart_items', $cart);
        redirect('cart/view');
    }

    public function decrease_qty($provider_id, $duration)
    {
        $cart = $this->session->userdata('cart_items') ?? [];
        foreach ($cart as &$item) {
            if ($item['id'] == $provider_id && $item['duration'] == $duration && $item['qty'] > 1) {
                $item['qty'] -= 1;
            }
        }
        $this->session->set_userdata('cart_items', $cart);
        redirect('cart/view');
    }
    public function update_cart()
    {
        $provider_id = $this->input->post('provider_id');
        $duration = $this->input->post('duration'); // always coming as 'day'
        $quantity = $this->input->post('quantity');

        $cart = $this->session->userdata('cart_items') ?? [];

        $found = false;
        foreach ($cart as &$item) {
            if ($item['id'] == $provider_id && $item['duration'] == $duration) {
                $item['qty'] = $quantity; // ✅ Update only the day card
                $found = true;
                break;
            }
        }

        if (!$found) {
            // If not found, add it as new
            $cart[] = [
                'provider_id' => $provider_id,
                'name' => $this->input->post('provider_name'),
                'image' => $this->input->post('provider_image'),
                'price' => $this->input->post('price'),
                'duration' => $duration,
                'qty' => $quantity,
                'start_date' => $this->input->post('start_date')
            ];
        }

        $this->session->set_userdata('cart_items', $cart);

        echo json_encode(['status' => 'success']);
    }
   public function pay()
{
    $cart_items = $this->session->userdata('cart_items');

    if (!$cart_items || empty($cart_items)) {
        redirect('cart/view');
    }

    // Calculate total
    $subtotal = 0;
    foreach ($cart_items as $item) {
        $subtotal += floatval($item['price']) * intval($item['qty']);
    }

    $total = $subtotal;

    // Validate amount
    if ($total <= 0) {
        $this->session->set_flashdata('error', 'Invalid payment amount.');
        redirect('cart/view');
    }

    // Generate unique txnid
    $txnid = 'TXN' . uniqid();

    // Format amount
    $amount = number_format((float)$total, 2, '.', '');

    // Product info
    $productinfo = "Cart Payment";

    // Validate and set email
    $email = filter_var($this->user['email'], FILTER_VALIDATE_EMAIL) 
        ? $this->user['email'] 
        : 'test@test.com';
        // print_r($this->user['email']);p
        // echo $email;
        // die;

    $firstname = $this->user['name'];
    $phone = preg_replace('/\D/', '', $this->user['mobile']); // Ensure numeric

    // 1. Save order to `orders` table
    $order_data = [
        'user_id' => $this->user['id'],
        'total' => $amount,
        'txnid' => $txnid,
        'status' => 'pending',
        'created_at' => date('Y-m-d H:i:s')
    ];
    $this->db->insert('orders', $order_data);
    $order_id = $this->db->insert_id();

    // 2. Save each cart item to `order_items`
    foreach ($cart_items as $item) {
        $item_data = [
            'order_id' => $order_id,
            'provider_id' => $item['id'],
            'name' => $item['name'],
            'image' => $item['image'],
            'price' => $item['price'],
            'duration' => $item['duration'],
            'qty' => $item['qty'],
            'start_date' => $item['start_date']
        ];
        $this->db->insert('order_items', $item_data);
    }

    // 3. Prepare PayU Pay form parameters
    $hash_string = $this->MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' .
                   $productinfo . '|' . $firstname . '|' . $email .
                   '|||||||||||' . $this->SALT;
    $hash = strtolower(hash('sha512', $hash_string));

    $data = [
        "action" => $this->PAYU_BASE_URL . "/_payment",
        "MERCHANT_KEY" => $this->MERCHANT_KEY,
        "txnid" => $txnid,
        "amount" => $amount,
        "productinfo" => $productinfo,
        "firstname" => $firstname,
        "email" => $email,
        "phone" => $phone,
        "surl" => base_url('cart/payu_callback'),
        "furl" => base_url('cart/payu_callback'),
        "hash" => $hash,
        "service_provider" => "payu_paisa",
        "order_id" => $order_id
    ];

// echo "<pre>";
// print_r($data);
// die;
    // Log for debugging
    log_message('debug', 'PayU Payment Data: ' . json_encode($data));

    $this->load->view('header');
    $this->load->view('payu_redirect', $data);
    $this->load->view('footer');
}


  public function payu_callback()
{
    $posted = $this->input->post();
    $status = $posted['status'] ?? '';
    $txnid = $posted['txnid'] ?? '';
    $amount = $posted['amount'] ?? '';
    $email = $posted['email'] ?? '';
    $firstname = $posted['firstname'] ?? '';
    $productinfo = $posted['productinfo'] ?? '';
    $hash = $posted['hash'] ?? '';

    $order = $this->db->get_where('orders', ['txnid' => $txnid])->row();

    if (!$order) {
        $this->session->set_flashdata('error', 'Invalid transaction!');
        redirect('cart/view');
        return;
    }

    // Build hash sequence (reverse order as per PayU docs)
    $hashSeq = $this->SALT . '|' . $status
        . '|||||||||||' . $email
        . '|' . $firstname
        . '|' . $productinfo
        . '|' . $amount
        . '|' . $txnid
        . '|' . $this->MERCHANT_KEY;

    $calculatedHash = strtolower(hash('sha512', $hashSeq));

    if ($hash !== $calculatedHash) {
        $this->session->set_flashdata('error', 'Hash mismatch! Payment could not be verified.');
        redirect('cart/view');
        return;
    }

    if ($status === "success") {
        // Mark order as success
        $this->db->where('txnid', $txnid)->update('orders', ['status' => 'success']);

        // // Optionally update all order_items to success
        // $this->db->where('order_id', $order->id)->update('order_items', ['status' => 'success']);

        $this->session->unset_userdata('cart_items');
        $this->session->set_flashdata('success', 'Payment successful! Transaction ID: ' . htmlspecialchars($txnid));
    } else {
        $this->db->where('txnid', $txnid)->update('orders', ['status' => 'failed']);
        $this->db->where('order_id', $order->id)->update('order_items', ['status' => 'failed']);

        $this->session->set_flashdata('error', 'Payment failed or cancelled!');
    }

    redirect('cart/view');
}



}