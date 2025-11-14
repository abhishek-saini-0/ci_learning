<?php

use PhpParser\JsonDecoder;
defined('BASEPATH') or exit("No Direct Script Allowed");

class UserController extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('FAS/UserModel');
        header('Content-Type: application/json');
        $this->load->library('upload');
    }

    public function index(){
        $filters = [
            'name'=>$this->input->get('name'),
            'email'=>$this->input->get('email'),
            'role'=>$this->input->get('role')
        ];
        $sort = $this->input->get('sort') ?? 'id';
        $order = $this->input->get('order') ?? 'ASC';
        
        $data = $this->UserModel->get_all($filters,$sort,$order);

        echo json_encode(
            [
                'status'=>true,
                'msg'=>'Data Fetched Successfully',
                'data'=>$data
            ]
        );
    }


    public function create(){
        $input = json_decode(file_get_contents('php://input'),true);
         $this->UserModel->insert_user($input);
         echo json_encode(['status' => true, 'message' => 'User added successfully']);
    }

    public function update($id){
        $input = json_decode(file_get_contents('php://input'),true);
        $this->UserModel->update_user($id,$input);
        echo json_encode(['status' => true, 'message' => 'User Updated successfully']);
    }

    public function delete($id){

         if(!$this->UserModel->get_id($id)){
            http_response_code(404);
            echo json_encode(['status'=>false,'msg'=>'Product Not Found']);
            return;
        }
        $this->UserModel->delete_user($id);
        echo json_encode(['status' => true, 'message' => 'User Deleted successfully']);
    }
}

?>