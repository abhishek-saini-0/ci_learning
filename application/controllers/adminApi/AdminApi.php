<?php

use PhpParser\JsonDecoder;
use function PHPUnit\Framework\isEmpty;
defined('BASEPATH') or exit("No Direct Script Allowed");
require_once(APPPATH . 'helpers/jwt_helper.php');
class AdminApi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //  header("Content-Type:application/json");
        $this->load->library('session');
        $this->load->model('adminDash/AdminModel');
        $this->load->helper('jwt');
    }

    public function index($id = null)
    {

        if ($id) {
            $user = $this->AdminModel->get_users($id);
            if ($user) {
                echo json_encode(['status' => true, 'data' => $user]);
            } else {
                http_response_code(404);
                echo json_encode(['status' => false, 'message' => 'User Not Found']);
            }
        } else {
            $filters = [
                'name' => $this->input->get('name'),
                'email' => $this->input->get('email'),
                'role' => $this->input->get('role')
            ];
            
            $sort = $this->input->get('sort') ?? 'id';
            $order = $this->input->get('order') ?? 'ASC';
            $users = $this->AdminModel->get_users($filters, $sort, $order);
            echo json_encode(['status' => true, 'data' => $users]);
        }
    }

    public function login()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $email = $input['email'];
        $password = $input['password'];

        $user = $this->AdminModel->get_user_by_email($email);

        if (!$user || !password_verify($password, $user['password'])) {
            http_response_code(404);
            echo json_encode(['status' => false, 'message' => 'Invalid Credentials']);
            return;
        }

        unset($user['password']);

        $token = generate_jwt($user);

        $this->session->set_userdata([
            'admin_logged_in' => true,
            'admin_user' => $user,
            'jwt_token' => $token
        ]);

        echo json_encode([
            'status' => true,
            'message' => 'User Login Successfully',
            'token' => $token,
            'user' => $user
        ]);
    }



    public function create()
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($input['name'])
            || !isset($input['email'])
            || !isset($input['password'])
            || !isset($input['mobile'])
            || !isset($input['role'])
        ) {

            http_response_code(404);
            echo json_encode(['status' => false, 'message' => "Fields Missing"]);
            return;
        }

        $hash_pass = password_hash($input['password'], PASSWORD_BCRYPT);

        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'role' => $input['role'],
            'password' => $hash_pass,
        ];

        $user_id = $this->AdminModel->create_user($data);
        http_response_code(201);
        echo json_encode(['status' => true, 'message' => 'User Created Successfully', 'id' => $user_id]);
        return;
    }

    public function update($id)
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$this->AdminModel->get_users($id)) {
            http_response_code(404);
            echo json_encode(['status' => false, 'message' => 'User Not Found']);
            return;
        }

        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile' => $input['mobile']
        ];

        $this->AdminModel->update_user($id, $data);

        echo json_encode(['status' => true, 'message' => 'User Updated Successfully']);
    }

    public function delete($id)
    {
        if (!$this->AdminModel->get_users($id)) {
            http_response_code(404);
            echo json_encode(['status' => false, 'message' => 'User Not Found']);
            return;
        }
        $this->AdminModel->delete_user($id);
        echo json_encode(['status' => true, 'message' => 'User Deleted Successfully']);
    }

}

?>