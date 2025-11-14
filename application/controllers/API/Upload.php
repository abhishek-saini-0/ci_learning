<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{

    public function __construct()
    {
        error_reporting(E_ALL);
    ini_set('display_errors', 1);
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->library('upload');
        $this->load->model('FAS/UserModel');

    }

    public function image()
    {

        if (!isset($_FILES['file'])) {
            echo json_encode(["status" => false, "message" => "No file uploaded"]);
            return;
        }
        
        $config = [
            'upload_path' =>FCPATH . 'uploads/',,
            'allowed_types' => 'jpg|jpeg|png|gif',
            'max_size' => 2048,
            'encrypt_name' => TRUE
        ];
        if (!is_dir('./uploads')) {
        echo json_encode(["status" => false, "message" => "Uploads folder NOT found"]);
            return;
        }

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            echo json_encode(["status" => false, "message" => $this->upload->display_errors()]);
            return;
        }

        $fileData = $this->upload->data();

        echo json_encode([
            "status" => true,
            "message" => "File uploaded successfully",
            "file_path" => base_url('uploads/' . $fileData['file_name'])
        ]);
    }

    public function profile($id)
    {

        if (!isset($_FILES['image'])) {
            echo json_encode(["status" => false, "message" => "No file selected"]);
            return;
        }

        $config = [
            'upload_path' => './uploads/',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size' => 2048,
            'encrypt_name' => TRUE
        ];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            echo json_encode(["status" => false, "message" => $this->upload->display_errors()]);
            return;
        }

        $fileData = $this->upload->data();
        $fileName = $fileData['file_name'];

        // Save in DB
        // $this->load->model('UserModel');
        $this->UserModel->update_profile($id, $fileName);

        echo json_encode([
            'status' => true,
            'message' => 'Profile uploaded successfully',
            'file_url' => base_url('uploads/' . $fileName)
        ]);
    }

}
