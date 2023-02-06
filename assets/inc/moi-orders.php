<?php
/**
 * Register new endpoint to use inside My Account page.
 *
 * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
 */
function my_custom_endpoints() {
	add_rewrite_endpoint( 'my-custom-endpoint', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'my_custom_endpoints' );

/**
 * Add new query var.
 *
 * @param array $vars
 * @return array
 */
function my_custom_query_vars( $vars ) {
	$vars[] = 'my-custom-endpoint';

	return $vars;
}

add_filter( 'query_vars', 'my_custom_query_vars', 0 );
/**
 * Flush rewrite rules on plugin activation.
 */
function my_custom_flush_rewrite_rules() {
	add_rewrite_endpoint( 'my-custom-endpoint', EP_ROOT | EP_PAGES );
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_custom_flush_rewrite_rules' );
register_deactivation_hook( __FILE__, 'my_custom_flush_rewrite_rules' );

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
?>
<img class="moi-logo" src="<?= MOI_CORE_IMG ?>logo.png"> <br/><br/><br/>
<div class="container">
      <div class="row">
        <table id="example"  class="table table-striped table-bordered" cellspacing="0"  width="100%" >
          <thead>
            <tr>
              <th class="th-sm">Order #</th>
              <th class="th-sm">Date - Time</th>
              <th class="th-sm">Type</th>
              <th class="th-sm">Location</th>
              <th class="th-sm">Customer</th>
              <th class="th-sm">Register</th>
              <th class="th-sm">Cashier</th>
              <th class="th-sm">Grand Total</th>
              <th class="th-sm">Action</th>
            </tr>
          </thead>
          <tbody>        
          <?php
          $user_id = get_current_user_id();
          // Get the WP_User instance Object
          $user = new WP_User( $user_id );
          $username     = $user->username; // Get username
          $user_email   = $user->email; // Get account email
          $first_name   = $user->first_name;
          $last_name    = $user->last_name;
          $display_name = $user->display_name;
          $billing_first_name = $user->billing_first_name;          
          $billing_phone    = $user->billing_phone;          
          $response = moi_do_curl('/order-svc/api/Invoice/GetInvoiceByCustId/'.$billing_phone.'?pageNo=0&pageSize=999','GET' );
          $homeulr =  home_url();          
          if($response->success==true)	{         

            foreach($response->data as $orderdata) {	
             echo "<tr>";
             echo "<td>" .$orderdata->invoiceNumber . "</td>";           
             echo "<td>" .$orderdata->date . $orderdata->time  . "</td>";
             echo "<td>" .$orderdata->transactionType . "</td>";             
             echo "<td>" .$orderdata->location . "</td>";
             echo "<td>" .$orderdata->customer . "</td>";
             echo "<td>" .$orderdata->register . "</td>";      
             echo "<td>" .$orderdata->cashier . "</td>";
             echo "<td>" .$orderdata->subTotal . "</td>";
             echo "<td><a href='$homeulr/my-account/view-orders/?id=$orderdata->invoiceNumber' class='btn btn-primary text-light'>View</a></td>";    
             echo "</tr>";

            }

          }

          ?>
              
            </tr>
          
          </tbody>
          <tfoot>
            <tr>
              <th class="th-sm">Order #</th>
              <th class="th-sm">Date - Time</th>
              <th class="th-sm">Type</th>
              <th class="th-sm">Location</th>
              <th class="th-sm">Customer</th>
              <th class="th-sm">Register</th>
              <th class="th-sm">Cashier</th>
              <th class="th-sm">Grand Total</th>
              <th class="th-sm">Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </body>

<?php
  function my_enqueue() {
wp_localize_script( 'ajax-script', 'my_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );

?>
<style>
  .woocommerce-account .woocommerce-MyAccount-content p:first-of-type {
    margin-bottom: 0px !important;
  }
  .woocommerce-account .woocommerce-MyAccount-content p {
    font-size: 16px !important;
}
.list-group-item strong{
  font-size: 15px !important;
}
.list-group-item span{
  font-size: 16px !important;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
