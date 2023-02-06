<?php


/*
*
*	***** MembersOne Integration *****
*
*	Helpers
*
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
/**
 * Do curl request to eKomi System.
 *
 * @param string $url         The api endpoint.
 * @param string $method      The api method.
 * @param string $post_fields Post fields data.
 * @param array  $headers     The api headers.
 *
 * @return string
 */


function moi_do_curl($end_point,$method, $post_fields=array())
{
  $token = get_option('moi_token');
  $wild     =   get_option('moi_vendor_wild');
  $headers = array(
    'BusinessName: Belta',
    "WLID: {$wild}",
    'Content-Type: text/plain',
    'Accept: application/json',
    "Authorization: Bearer {$token}"
  );
 
  $zilon_api     =   get_option('moi_vendor_api');
  $url = $zilon_api . $end_point;

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_HTTPHEADER =>$headers,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS => json_encode($post_fields)
  ));
  
  $response = curl_exec($curl);   
  curl_close($curl);

 return json_decode($response);  
}


function moi_get_token()
{
  $moi_username  =   get_option('moi_vendor_id');
  $moi_password  =   get_option('moi_vendor_secret_token'); 
  $post_fields= [
    "Username" => $moi_username,
    "Password" => $moi_password
  ];
 
  $response = moi_do_curl('/auth-svc/api/SignIn', 'POST', $post_fields );
 
  if($response->success==true)
  {
    $token=$response->data->access_token;

    return $token;   
  }
  
  return '';    
}

refresh_token();

function refresh_token()
{


  $response = moi_do_curl('/inventory-svc/api/Department','GET');

 
  
if($response->statusCode == 401) {

  moi_get_token();



}  





}