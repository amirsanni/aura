<?php

$fbUrl = "https://www.facebook.com/dialog/oauth?client_id=854268104681249&redirect_uri=" . urlencode(base_url()) . "access/login&state=37a1cf7ef65a6b91b0c365dc01cad6c2&sdk=php-sdk-3.2.3&scope=email";
// Load facebook library and pass associative array which contains appId and secret key
$this->load->library('facebook', array('appId' => '854268104681249', 'secret' => 'cf65c934fe05e38b8d2433e2e4e77fa6'));

