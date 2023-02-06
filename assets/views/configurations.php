
<div class="moi-configurations" >
    <div class="moi-center">
        <img class="moi-logo" src="<?= MOI_CORE_IMG ?>logo.png"> <br/><br/><br/>
    </div>
    <div class="moi-row">
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner1"></span>
        </div>
    </div>
   

        <div class="moi-config-block">
        <?php
        
            $store_loc = get_option('store_location');
            $last_import = "2022-03-01 10:25:49";   
            $url = '/inventory-svc/api/InventoryItem/GetInventoryItems?warehouseId='.$store_loc.'&pageNo=0&pageSize=2000&checkUpdate=true&lastSyncDateTime='.$last_import.'';
            $url = str_replace(" ","T",$url); 
            $response = moi_do_curl($url,'GET');
            print "<pre>";
            print_r($response);
            print "</pre>";
   

        ?>

            <div class="moi-config-content moi-center">
                <div class="moi-center">
                    <h2 class=""><?php echo __( 'Plugin Configuration', 'membersone-integration' ); ?></h2>
                </div>
                <div class="container">

                    <form action="" method="post">
                        <div class="row">
	                        <?php if ( $response['is_submited'] ) : ?>
		                        <?php if ( 'success' === $response['status'] ) : ?>
                                    <div class="notice notice-success is-dismissible">
                                        <p><?php echo esc_html( $response['message'] ); ?></p>
                                    </div>
		                        <?php endif; ?>
		                        <?php if ( 'error' === $response['status'] ) : ?>
                                    <div class="notice notice-error is-dismissible">
                                        <p><?php echo esc_html( $response['message'] ); ?></p>
                                    </div>
		                        <?php endif; ?>
	                        <?php endif; ?>
                            <br/>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="moi_enable"><?php echo __( 'Status', 'membersone-integration' ); ?></label>
                            </div>
                            <div class="col-75">
                                <select name="moi_enable" id="moi_enable" value="<?php echo $options['moi_enable']; ?>" >
                                    <option value="1" <?php echo ( 1 == $options['moi_enable'] ) ? "selected=''" : ''; ?> ><?php echo __( 'Enable', 'membersone-integration' ); ?></option>
                                    <option value="0" <?php echo ( 0 == $options['moi_enable'] ) ? "selected=''" : ''; ?> ><?php echo __( 'Disable', 'membersone-integration' ); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="moi_vendor_id">Username</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="vendor_id" name="moi_vendor_id" value="<?= $options['moi_vendor_id'] ?>" placeholder="Username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="moi_vendor_secret_token">Password</label>
                            </div>
                            <div class="col-75">
                                <input type="password" id="moi_vendor_secret_token" name="moi_vendor_secret_token" value="<?= $options['moi_vendor_secret_token'] ?>" placeholder="Password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="moi_vendor_api">WILD</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="moi_vendor_wild" name="moi_vendor_wild" value="<?= $options['moi_vendor_wild'] ?>" placeholder="WILD">
                            </div>
                        </div>
                        
                      
                        <div class="row">
                            <div class="col-25">
                                <label for="moi_vendor_api">API URL</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="moi_vendor_api" name="moi_vendor_api" value="<?= $options['moi_vendor_api'] ?>" placeholder="Api URL">
                            </div>
                        </div>
                                       
                        <div class="row">
                            <div class="col-25">
                                <label for="moi_vendor_loc">Store Location</label>
                                
                            </div>
                            <div class="col-75">
                                <select name="store_location" id="store_location" value="" >
                                    <option> Select Location </option>
                                    <?php $store =  get_option('store_location_data');   
                                    
                                        foreach($store as $location)
                                            {                                                
                                                
                                                ?>
                                                 <option value="<?php echo $location['id'] ;?>" <?php if($location['id']  == $options['store_location']) { echo 'selected' ;} ?>  >
                                                      <?php echo $location['name'] ?>
                                                  </option>
                                                 
                                            <?php  }  ?> 
                                  </select>                
                            </div>
                        </div>           

                        <br>
                        <div class="row">
                            <div class="col-25">
	                            <?php wp_nonce_field( 'membersone-integration-nonce', 'moi_nonce_field' ); ?>
                            </div>
                            <div class="col-75">
                                <input type="submit" value="<?php echo __( 'Save Configurations', 'membersone-integration' ); ?>">

                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

          
        <div class="moi-right-block">
            <div class="moi-center">
                <h2 class=""><?php echo __( 'Product Registration', 'membersone-integration' ); ?></h2>               
            </div>
           

                <div class=" message notice-success is-dismissible notice ">
                           <p><div id="msg"></div></p>
                      </div>       
              
            <?php  $plugin_status = get_option('moi_enable');  ?>   
            <div class="moi-config-content moi-center">
                <div class="container">
                    <div class="row">
                        <div id="alert_error_message" class="col-100 moi-alert moi-alert-danger moi-d-none"></div>
                        <div id="alert_success_message" class="col-100 moi-alert moi-alert-success moi-d-none"></div>
                        <div class="col-50">
                            <label for="get_products">Get Inventory</label>
                        </div>                       
                        <div class="col-50">
                        <?php if ( $plugin_status == '1' ) : ?>
                            <input type="submit"  id="get_products" value="<?php echo __( 'Import Products', 'membersone-integration' ); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div id="alert_error_message" class="col-100 moi-alert moi-alert-danger moi-d-none"></div>
                        <div id="alert_success_message" class="col-100 moi-alert moi-alert-success moi-d-none"></div>
                        <div class="col-50">
                            <label for="moi_product_id">Get Categories</label>
                        </div>                       
                        <div class="col-50">
                        <?php if ( $plugin_status == '1' ) : ?>
                            <input type="submit"  id="get_category" value="<?php echo __( 'Import Categories', 'membersone-integration' ); ?>">
                            <?php endif; ?>
                        </div>
                    </div>                  

                    <div class="row">
                        <div id="alert_error_message" class="col-100 moi-alert moi-alert-danger moi-d-none"></div>
                        <div id="alert_success_message" class="col-100 moi-alert moi-alert-success moi-d-none"></div>
                        <div class="col-50">                            
                            <label for="moi_location_id">Get Manufacturer</label>
                        </div>                       
                        <div class="col-50">
                        <?php if ( $plugin_status == '1' ) : ?>
                            <input type="submit"  id="get_manufacturer" value="<?php echo __( 'Import Manufacturer', 'membersone-integration' ); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div id="alert_error_message" class="col-100 moi-alert moi-alert-danger moi-d-none"></div>
                        <div id="alert_success_message" class="col-100 moi-alert moi-alert-success moi-d-none"></div>
                        <div class="col-50">
                            <label for="get_vendors">Get Vendors</label>
                        </div>
                       
                        <div class="col-50">
                        <?php if ( $plugin_status == '1' ) : ?>
                            <input type="submit"  id="get_vendors" value="<?php echo __( 'Import Vendors', 'membersone-integration' ); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div id="alert_error_message" class="col-100 moi-alert moi-alert-danger moi-d-none"></div>
                        <div id="alert_success_message" class="col-100 moi-alert moi-alert-success moi-d-none"></div>
                        <div class="col-50">
                            <label for="get_department">Get Departments</label>
                        </div>
                       
                        <div class="col-50">
                        <?php if ( $plugin_status == '1' ) : ?>
                            <input type="submit"  id="get_department" value="<?php echo __( 'Import Departments', 'membersone-integration' ); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {

        jQuery(function($){
            $(document).ajaxSend(function() {
                      //   $("#overlay").fadeIn(300);　
            });

            $('#get_products').click(function () {
         
            jQuery.ajax({
                type: "get",
                url: moi_core_ajax.ajax_url + "?action=get_products",
                dataType: "json",
                beforeSend: function() {
                   $("#overlay").fadeIn(300);
                },
                success: function(data){  
                 
                    $('.message').fadeIn('slow');                      
                    $('#msg').html(data.record).fadeIn('slow');                     
                    $('.message').delay(5000).fadeOut('slow');                 

                }
                 }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
             });
        });

        $('#get_category').click(function () {
            jQuery.ajax({
                type: "get",
                url: moi_core_ajax.ajax_url + "?action=get_category",
                dataType: "json",
                beforeSend: function() {
                   $("#overlay").fadeIn(300);
                },
                success: function(data){
                    $('.message').fadeIn('slow');                      
                    $('#msg').html(data.record).fadeIn('slow');                     
                    $('.message').delay(5000).fadeOut('slow');
                }
                 }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
             });
        });

        $('#get_locations').click(function () {         
            jQuery.ajax({
                type: "get",
                url: moi_core_ajax.ajax_url + "?action=get_locations",
                dataType: "json",
                beforeSend: function() {
                   $("#overlay").fadeIn(300);
                },
                success: function(data){                
                    $('.message').fadeIn('slow');                      
                    $('#msg').html(data.record).fadeIn('slow');                     
                    $('.message').delay(5000).fadeOut('slow'); 
                }
                 }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
             });
        });


        $('#get_manufacturer').click(function () {
            jQuery.ajax({
                type: "get",
                url: moi_core_ajax.ajax_url + "?action=get_manufacturer",
                dataType: "json",
                beforeSend: function() {
                   $("#overlay").fadeIn(300);
                },
                   success: function(data){  
                    $('.message').fadeIn('slow');                      
                    $('#msg').html(data.record).fadeIn('slow');                     
                    $('.message').delay(5000).fadeOut('slow');
                    }
                 }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
             });
        });

        $('#get_vendors').click(function () {
            jQuery.ajax({
                type: "get",
                url: moi_core_ajax.ajax_url + "?action=get_vendors",
                dataType: "json",
                beforeSend: function() {
                   $("#overlay").fadeIn(300);
                },
                success: function(data){                
                    $('.message').fadeIn('slow');                      
                    $('#msg').html(data.record).fadeIn('slow');                     
                    $('.message').delay(5000).fadeOut('slow');
                    
                }
                 }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
             });
        });
        $('#get_department').click(function () {
            jQuery.ajax({
                type: "get",
                url: moi_core_ajax.ajax_url + "?action=get_department",
                dataType: "json",
                beforeSend: function() {
                   $("#overlay").fadeIn(300);
                },
                success: function(data){   
                    $('.message').fadeIn('slow');                      
                    $('#msg').html(data.record).fadeIn('slow');                     
                    $('.message').delay(5000).fadeOut('slow');                 

                }
                 }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
             });
        });

      
        jQuery.ajax({
                type: "get",
                url: moi_core_ajax.ajax_url + "?action=get_register_product",
                dataType: "json",
                success: function(data){                               
                    $('.message').fadeIn('slow');                      
                    $('#msg').html(data.record).fadeIn('slow');                     
                    $('.message').delay(5000).fadeOut('slow');
                    
                    
                }
                 }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
             });
        });

       
        function getStoreUrl() {
            moi_url = window.location.href;
            moi_url = moi_url.split('admin.php');
            return moi_url[0];
        }
    })
</script>


