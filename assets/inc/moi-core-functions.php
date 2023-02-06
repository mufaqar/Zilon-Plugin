<?php 
/*
*
*	***** MembersOne Integration *****
*
*	Core Functions
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
*
* Custom Front End Ajax Scripts / Loads In WP Footer
*
*/





function cptui_register_my_taxes_manufacturer() {

	/**
	 * Taxonomy: Manufacturer.
	 */

	$labels = [
		"name" => __( "Manufacturer", "hello-elementor" ),
		"singular_name" => __( "Manufacturer", "hello-elementor" ),
	];

	
	$args = [
		"label" => __( "Manufacturer", "hello-elementor" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'manufacturer', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "manufacturer",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "manufacturer", [ "product" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_manufacturer' );


function cptui_register_my_taxes_product_location() {

	/**
	 * Taxonomy: Locations.
	 */

	$labels = [
		"name" => __( "Locations", "hello-elementor" ),
		"singular_name" => __( "Location", "hello-elementor" ),
	];

	
	$args = [
		"label" => __( "Locations", "hello-elementor" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'product_location', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "product_loation",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "product_location", [ "product" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_product_location' );


function cptui_register_my_taxes_staff_departments_taxonomies() {

	/**
	 * Taxonomy: Departments.
	 */

	$labels = [
		"name" => __( "Departments", "hello-elementor" ),
		"singular_name" => __( "Department", "hello-elementor" ),
	];

	
	$args = [
		"label" => __( "Departments", "hello-elementor" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'staff_departments_taxonomies', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "staff_departments_taxonomies",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "staff_departments_taxonomies", [ "staff-profiles" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_staff_departments_taxonomies' );


function cptui_register_my_taxes_vendors() {

	/**
	 * Taxonomy: Vendors.
	 */

	$labels = [
		"name" => __( "Vendors", "hello-elementor" ),
		"singular_name" => __( "Vendor", "hello-elementor" ),
	];

	
	$args = [
		"label" => __( "Vendors", "hello-elementor" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'vendors', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "vendors",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "vendors", [ "product" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_vendors' );


function cptui_register_my_taxes_department() {

	/**
	 * Taxonomy: Departments.
	 */

	$labels = [
		"name" => __( "Departments", "hello-elementor" ),
		"singular_name" => __( "Department", "hello-elementor" ),
	];

	
	$args = [
		"label" => __( "Departments", "hello-elementor" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'department', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "department",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "department", [ "product" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_department' );


function cptui_register_my_cpts_jobs() {

	/**
	 * Post Type: Jobs.
	 */

	$labels = [
		"name" => __( "Jobs", "hello-elementor" ),
		"singular_name" => __( "Job", "hello-elementor" ),
	];

	$args = [
		"label" => __( "Jobs", "hello-elementor" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "jobs", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "jobs", $args );
}

add_action( 'init', 'cptui_register_my_cpts_jobs' );


/**
 * tested with WooCommerce version 3.6.5
 */
  
// ------------------
// STEP 1. Add new endpoint to use on the My Account page
// IMPORTANT*: After uploading Permalinks needs to be rebuilt in order to avoid 404 error on the newly created endpoint
  
function althemist_add_premium_support_endpoint() {
    add_rewrite_endpoint( 'view-orders', EP_ROOT | EP_PAGES );
}
  
add_action( 'init', 'althemist_add_premium_support_endpoint' );
  
  
// ------------------
// 2. Add new query var
  
function althemist_premium_support_query_vars( $vars ) {
    $vars[] = 'view-orders';
    return $vars;
}
  
add_filter( 'query_vars', 'althemist_premium_support_query_vars', 0 );

// ------------------
// 3. Insert the new endpoint into the My Account menu
   
function althemist_add_premium_support_link_my_account( $items ) {
    $items['view-orders'] = 'View Orders';
    return $items;
}
   
//add_filter( 'woocommerce_account_menu_items', 'althemist_add_premium_support_link_my_account' );
   
  

add_action( 'woocommerce_account_view-orders_endpoint', 'althemist_premium_support_content' );
// Note: a
  
// ------------------
// 4. Add content to the new endpoint
  
function althemist_premium_support_content($arg) {

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

 
     
<div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> 
      <?php	$in_id = $_REQUEST['id'];
              $response = moi_do_curl('/order-svc/api/Invoice/GetOrderByInvoiceNo/'.$in_id.'','GET' );
              $data = $response->data; 

              $currency = "$";

           /* print "<pre>";
              print_r($data);  */
      ?> Order #<?php echo $data->invoiceNumber; ?>
          </h5>
          
        </div>
        <div class="d-flex">
          <div class="modal-body">
            <h5 class="modal-title" id="exampleModalLongTitle">
              Invoice Information
            </h5>
            <ul class="list-group mt-3">
              <li class="list-group-item">
                <strong>Transaction Type:</strong>
                <span class="ml-3"><?php echo $data->invoiceTypeString; ?></span>
              </li>
              <li class="list-group-item">
                <strong>Order Status:</strong>
                <span class="ml-3"><?php echo $data->postedStatusString; ?></span>
              </li>
              
              <li class="list-group-item">
                <strong>Customer ID:</strong>
                <span class="ml-3">#<?php echo $data->customerId; ?></span>
              </li>
              <li class="list-group-item">
                <strong>Customer Name:</strong>
                <span class="ml-3"><?php echo $data->customerName; ?></span>
              </li>
              <li class="list-group-item">
                <strong>Customer Phone:</strong>
                <span class="ml-3"><?php echo $data->customerPhone; ?></span>
              </li>
              <li class="list-group-item">
                <strong>Location:</strong>
                <span class="ml-3"><?php echo $data->locationName; ?></span>
              </li>
              <li class="list-group-item">
                <strong>Register:</strong>
                <span class="ml-3"><?php echo $data->registerName; ?></span>
              </li>
              <li class="list-group-item">
                <strong>Cashier:</strong>
                <span class="ml-3"><?php echo $data->userName; ?></span>
              </li>
            </ul>
          </div>

          <div class="w-10 m-1 ">
            <h5 class="modal-title mb-3 ml-4" id="exampleModalLongTitle" >
                Payment Method
            </h5>
            <ul class=" mt-1" >
                <li class="list-unstyled d-flex justify-content-between" style="margin-left: -16px  !important;">
                <p>Cash : </p>
                  <p class="ml-3"><?php echo  $currency.$data->subTotal; ?></p>
                </li>
            </ul>
          </div>

          <div class="w-35 m-3">
            <h5 class="modal-title mb-3 ml-4" id="exampleModalLongTitle">
                Order Summary
            </h5>
            <ul class=" mt-3">
                <li class="list-unstyled d-flex justify-content-between " style="margin-left: -16px  !important;">
                  <p>Total Item:</p>
                  <p class="ml-3"><?php echo $data->totalSaleItems; ?></p>
                </li>
                <li class="list-unstyled d-flex justify-content-between" style="margin-left: -16px  !important;">
                    <p>Subtotal Total:</p>
                    <p class="ml-3"><?php echo $currency.$data->subTotal; ?></p>
                </li>
                <li class="list-unstyled d-flex justify-content-between" style="margin-left: -16px  !important;">
                    <p>Discount:</p>
                    <p class="ml-3"><?php echo $data->discount; ?></p>
                </li>
                <li class="list-unstyled d-flex justify-content-between" style="margin-left: -16px  !important;">
                    <p>Tax:</p>
                    <p class="ml-3"><?php echo $data->salesTax; ?></p>
                </li>
                <li class="list-unstyled d-flex justify-content-between border-bottom pb-2" style="margin-left: -16px  !important;">
                    <p><strong>Grand Total:</strong></p>
                    <p class="ml-3"><strong><?php echo $currency.$data->grandTotal; ?></strong></p>
                </li>
                <li class="list-unstyled d-flex justify-content-between mt-2" style="margin-left: -16px  !important;">
                    <p>Tendered:</p>
                    <p class="ml-3"><?php echo $currency.$data->subTotal; ?></p>
                </li>
                <li class="list-unstyled d-flex justify-content-between" style="margin-left: -16px  !important;">
                    <p>Change:</p>
                    <p class="ml-3"><?php echo $data->change; ?></p>
                </li>
            </ul>
          </div>

        </div>
        <div class="d-flex justify-content-between">
            <div class="ml-3 mt-4">
                <h5 class="modal-title mb-3 " id="exampleModalLongTitle">
                    Sale Items
                </h5>
                <table
                id="example"
                class="table table-striped table-bordered "
                cellspacing="0"
                width="100%"
                >
                <thead>
                  <tr>
                    <th class="th-sm">Item</th>
                    <th class="th-sm">Item Type</th>
                    <th class="th-sm">Price ($)</th>
                    <th class="th-sm">Qty</th>
                    <th class="th-sm">Discount ($)</th>
                    <th class="th-sm">Total ($)</th>
                  </tr>
                </thead>
                <tbody>

                <?php $invocies = $data->invoiceItems;

                  foreach($invocies as $invoice)
                  {  ?>

                  <tr>
                    <td><img src="<?php echo $invoice->image?>" width="30" height="30"> <span class="ml-3"><?php echo $invoice->itemName?></span></td>
                    <td><?php echo $invoice->sellQuantityString?></td>
                    <td><?php echo $invoice->linePrice?></td>
                    <td><?php echo $invoice->qty?></td>
                    <td></td>
                    <td><?php echo $invoice->linePrice?></td>
                  </tr>


               <?php   }
                
                ?>

                  
                 
                </tbody>
              </table>
            </div>
          
        </div>
      </div>

	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



	<?php
	

}
  
