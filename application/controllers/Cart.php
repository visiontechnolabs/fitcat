<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/User_Controller.php');



class Cart extends User_Controller
{



    public function __construct()
    {



        parent::__construct();
        if (!$this->user) {
            redirect('login');
        }


    }

    public function index(){
        $this->load->view('header');
        $this->load->view('cart_view');
        $this->load->view('footer');

    }

    public function add_to_cart() {
        $data = array(
        'id'       => $this->input->post('provider_id'),
        'name'     => $this->input->post('provider_name'),
        'image'    => $this->input->post('provider_image'),
        'price'    => $this->input->post('price'),
        'duration' => $this->input->post('duration'),
        'qty'      => $this->input->post('quantity'),
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

    public function view() {
        $data['cart_items'] = $this->session->userdata('cart_items');
        $this->load->view('header');
        $this->load->view('cart_view', $data);
        $this->load->view('footer');

    }

    public function remove($index) {
        $cart = $this->session->userdata('cart_items');
        unset($cart[$index]);
        $this->session->set_userdata('cart_items', $cart);
        redirect('cart/view');
    }
    public function clear_cart() {
    $this->session->unset_userdata('cart_items');
    redirect('cart/view');
}
public function increase_qty($provider_id, $duration) {
    $cart = $this->session->userdata('cart_items') ?? [];
    foreach ($cart as &$item) {
        if ($item['id'] == $provider_id && $item['duration'] == $duration) {
            $item['qty'] += 1;
        }
    }
    $this->session->set_userdata('cart_items', $cart);
    redirect('cart/view');
}

public function decrease_qty($provider_id, $duration) {
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
            'id'       => $provider_id,
            'name'     => $this->input->post('provider_name'),
            'image'    => $this->input->post('provider_image'),
            'price'    => $this->input->post('price'),
            'duration' => $duration,
            'qty'      => $quantity,
            'start_date' => $this->input->post('start_date')
        ];
    }

    $this->session->set_userdata('cart_items', $cart);

    echo json_encode(['status' => 'success']);
}

}