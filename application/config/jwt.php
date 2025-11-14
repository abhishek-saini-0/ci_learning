<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['jwt_key'] = 'my_super_secret_key'; // keep it private!
$config['jwt_algorithm'] = 'HS256';
$config['jwt_expiration_time'] = 3600; // 1 hour
