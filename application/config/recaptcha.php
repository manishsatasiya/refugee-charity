<?php
/*
The reCaptcha server keys and API locations

Obtain your own keys from:
http://www.recaptcha.net
*/
$config['recaptcha'] = array(
  'public'=>'6LcVHdYSAAAAAL5GIYUlyeZASyfrcG45DskBmzlZ',
  'private'=>'6LcVHdYSAAAAALHLkuPBIJsHYqG3rSBLUvVmfThq',
  'RECAPTCHA_API_SERVER' =>'http://www.google.com/recaptcha/api',
  'RECAPTCHA_API_SECURE_SERVER'=>'https://www.google.com/recaptcha/api',
  'RECAPTCHA_VERIFY_SERVER' =>'www.google.com',
  'RECAPTCHA_SIGNUP_URL' => 'https://www.google.com/recaptcha/admin/create',
  'theme' => Settings_model::$db_config['recaptcha_theme']
);
