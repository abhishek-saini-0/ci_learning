<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/JWT/JWT.php';
require_once APPPATH . 'third_party/JWT/ExpiredException.php';
require_once APPPATH . 'third_party/JWT/SignatureInvalidException.php';
require_once APPPATH . 'third_party/JWT/BeforeValidException.php';

use \Firebase\JWT\JWT;

if (!function_exists('generate_jwt')) {
    function generate_jwt($payload, $key = 'MY_SECRET_KEY') {
        return JWT::encode($payload, $key);
    }
}

if (!function_exists('verify_jwt')) {
    function verify_jwt($token, $key = 'MY_SECRET_KEY') {
        try {
            return JWT::decode($token, $key, ['HS256']);
        } catch (Exception $e) {
            return false;
        }
    }
}
