<?php

use PhpParser\JsonDecoder;
use function PHPUnit\Framework\isEmpty;
defined('BASEPATH') or exit("No Direct Script Allowed");

class AdminController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('adminDash/AdminModel');
        if ($this->router->method !== 'login') {
            if (!$this->session->userdata('admin_logged_in')) {
                redirect('admin/login');
                exit;
            }
        }
    }

    public function index()
    {
        $data['total_users'] = $this->AdminModel->count_users();
        $this->load->view('adminDash/header');
        $this->load->view('adminDash/sidebar');
        $this->load->view('adminDash/dashboard', $data);
        $this->load->view('adminDash/footer');
    }

    public function users()
    {
        $data['users'] = $this->AdminModel->get_users();

        $this->load->view('adminDash/header');
        $this->load->view('adminDash/sidebar');
        $this->load->view('adminDash/users', $data);
        $this->load->view('adminDash/footer');
    }
    public function add_users()
    {
        // $data['users'] = $this->AdminModel->get_users();
        $data['title'] = 'Add User';
        $this->load->view('adminDash/header');
        $this->load->view('adminDash/sidebar');
        $this->load->view('adminDash/create', $data);
        $this->load->view('adminDash/footer');
    }
    public function login()
    {
        // $data['users'] = $this->AdminModel->get_users();
        $data['title'] = 'Add User';
        $this->load->view('adminDash/login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }

}

?>