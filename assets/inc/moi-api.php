<?php


function ProductUpdated( ) {

  $store_loc = get_option('store_location');

  $url = "/inventory-svc/api/InventoryItem/GetInventoryItems?warehouseId=$store_loc&pageNo=0&pageSize=20&sellOnline=True";	
	$response = moi_do_curl($url,'GET');
  //print_r($response);



  
  function getImage($url) {
    include_once( ABSPATH . 'wp-admin/includes/image.php' );
    $imageurl = $url;        
    $imagetype = end(explode('/', getimagesize($imageurl)['mime']));
    $uniq_name = date('dmY').''.(int) microtime(true); 
    $filename = $uniq_name.'.'.$imagetype;
    $uploaddir = wp_upload_dir();
    $uploadfile = $uploaddir['path'] . '/' . $filename;
    $contents= file_get_contents($imageurl);
    $savefile = fopen($uploadfile, 'w');
    fwrite($savefile, $contents);
    fclose($savefile);

    $wp_filetype = wp_check_filetype(basename($filename), null );
    $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title' => $filename,
      'post_content' => '',
      'post_status' => 'inherit'
        );

    $attach_id = wp_insert_attachment( $attachment, $uploadfile );
    $imagenew = get_post( $attach_id );
    $fullsizepath = get_attached_file( $imagenew->ID );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
    wp_update_attachment_metadata( $attach_id, $attach_data ); 

    return $attach_id;


    }

function get_termId($catId , $termName) {
      $targs = array(
      'hide_empty' => false, 
      'meta_query' => array(
        array(
          'key'       => 't_id',
          'value'     => $catId,
          'compare'   => '='
        )
      ),
      'taxonomy'  => $termName,
      );
      $get_terms = get_terms( $targs );                   
      foreach($get_terms as $term)
          {  $termId = $term->term_id;  }
      return $termId;
}



//	$apiproducts = $response->data;

  if($response->success==true)	{	
		foreach($response->data as $apiproduct) {	

			$itemName = $apiproduct->itemName;
			$allowNegativeStock = $apiproduct->allowNegativeStock;		
			$description = $apiproduct->description;
			$id = $apiproduct->id;
			$isActive = $apiproduct->isActive;
			$trackStock = $apiproduct->trackStock;
			$itemId = $apiproduct->itemId;
			$itemSKUId = $apiproduct->itemSKUId;		
			$productCode = $apiproduct->productCode;
			$itemType = $apiproduct->itemType;
			$image_url = $apiproduct->image;
			$barcode = $apiproduct->barcode;		
			$costPrice = $apiproduct->costPrice;
			$isDefault = $apiproduct->isDefault;
			$isTaxable = $apiproduct->isTaxable;
			$isVisible = $apiproduct->isVisible;
			$categoryName = $apiproduct->categoryName;
			$manufacturerName = $apiproduct->manufacturerName;
			$vendorName = $apiproduct->vendorName;
			$departmentName = $apiproduct->departmentName;
			$salePrice = $apiproduct->salePrice;
			$salePriceA = $apiproduct->salePriceA;
			$salePriceB = $apiproduct->salePriceB;
			$salePriceC = $apiproduct->salePriceC;
			$caseQty = $apiproduct->caseQty;
			$defaultPrice = $apiproduct->defaultPrice;	
			$sellQuantity = $apiproduct->sellQuantity;
			$skuCode = $apiproduct->skuCode;
			$uomId = $apiproduct->uomId;			
			$ageRestriction = $apiproduct->ageRestriction;
			$allowDiscount = $apiproduct->allowDiscount;
			$gender = $apiproduct->gender;
			$grouping = $apiproduct->grouping;
			$isOpnDept = $apiproduct->isOpnDept;
			$isTaxable = $apiproduct->isTaxable;
			$notes = $apiproduct->notes;
			$soldAs = $apiproduct->soldAs;
			$manufacturerId = $apiproduct->manufacturerId;
			$departmentId = $apiproduct->departmentId;
			$categoryId = $apiproduct->categoryId;
			$vendorId = $apiproduct->vendorId;
			$wareHouseId = $apiproduct->wareHouseId;
			$quantity = $apiproduct->quantity;
			$itemPictures =  $apiproduct->itemPictures;	
			$gallerypics = array(); 
					foreach($itemPictures as $galleryitems)
					{
						$galleryUrl = $galleryitems->picture;
						$gallerypics[] = getImage($galleryUrl);	
					}
				$galleryIds =  implode(",",$gallerypics);
		

			
			if($defaultPrice == '1')
			{

				$Sale_Price  = $salePriceA;
			}
			elseif($defaultPrice == '2') {
				$Sale_Price  = $salePriceB;
			}
			else {
				$Sale_Price  = $salePriceC;
			}

		
			

			//echo $Sale_Price;		

			$f_categoryId = get_termId($categoryId ,'product_cat');  
			$f_manufacturerId = get_termId($manufacturerId ,'manufacturer');   
			$f_vendorId = get_termId($vendorId ,'vendors');   
			$f_departmentId = get_termId($departmentId ,'department');  
			$f_location_id = get_termId($wareHouseId ,'product_location');  
			
			
				
				
		
			

			if (get_page_by_title($itemName, OBJECT, 'product')) {

				// Update Product

				$check_title = get_page_by_title($itemName, 'OBJECT', 'product');
				$u_product_id = $check_title->ID;	
				$upate_product = array(
						'ID'           => $u_product_id,
						'post_status'   => 'publish',
						'post_content'   => $description,
						'post_excerpt'   => $notes,		
						
					);
				$feature_image = getImage($image_url);
				wp_update_post( $upate_product );
				set_post_thumbnail($u_product_id, $feature_image);
				set_post_thumbnail($u_product_id, $feature_image);	
				wp_set_post_terms($u_product_id, array($f_location_id), 'product_location' );
				wp_set_post_terms($u_product_id, array($f_manufacturerId), 'manufacturer' );
				wp_set_post_terms($u_product_id, array($f_vendorId), 'vendors' );
				wp_set_post_terms($u_product_id, array($f_departmentId), 'department' );
				wp_set_post_terms($u_product_id, array($f_categoryId), 'product_cat');
				update_post_meta( $u_product_id, 'productCode', $productCode ); 
				update_post_meta( $u_product_id, 'itemSKUId', $itemSKUId ); 
				update_post_meta( $u_product_id, 'allowNegativeStock', $allowNegativeStock ); 
				update_post_meta( $u_product_id, 'trackStock', $trackStock ); 
				update_post_meta( $u_product_id, 'barcode', $barcode ); 
				update_post_meta( $u_product_id, 'costPrice', $costPrice ); 
				update_post_meta( $u_product_id, 'salePriceA', $salePriceA ); 
				update_post_meta( $u_product_id, 'salePriceB', $salePriceB ); 
				update_post_meta( $u_product_id, 'salePriceC', $salePriceC ); 
				update_post_meta( $u_product_id, 'categoryName', $categoryName ); 
				update_post_meta( $u_product_id, 'manufacturerName', $manufacturerName ); 
				update_post_meta( $u_product_id, 'vendorName', $vendorName ); 
				update_post_meta( $u_product_id, 'departmentName', $departmentName ); 
				update_post_meta( $u_product_id, 'ageRestriction', $ageRestriction ); 
				update_post_meta( $u_product_id, 'allowDiscount', $allowDiscount ); 
				update_post_meta( $u_product_id, 'gender', $gender ); 
				update_post_meta( $u_product_id, 'grouping', $grouping ); 
				update_post_meta( $u_product_id, 'id', $id ); 
				update_post_meta( $u_product_id, 'itemid', $itemId ); 
				update_post_meta( $u_product_id, 'isTaxable', $isTaxable ); 			
				update_post_meta( $u_product_id, 'isActive', $isActive ); 
				update_post_meta( $u_product_id, 'isOpnDept', $isOpnDept ); 
				update_post_meta( $u_product_id, 'itemType', $itemType ); 
				update_post_meta( $u_product_id, 'soldAs', $soldAs ); 
				update_post_meta( $u_product_id, 'caseQty', $caseQty ); 
				update_post_meta( $u_product_id, 'defaultPrice', $defaultPrice ); 
				update_post_meta( $u_product_id, 'isDefault', $isDefault ); 
				update_post_meta( $u_product_id, 'isVisible', $isVisible ); 
				update_post_meta( $u_product_id, 'taxable', $taxable ); 
				update_post_meta( $u_product_id, 'uomId', $uomId ); 
				update_post_meta( $u_product_id, 'sellQuantity', $sellQuantity ); 
				update_post_meta( $u_product_id, '_product_image_gallery', $galleryIds);					
				update_post_meta( $u_product_id, '_sku', $skuCode);
				update_post_meta( $u_product_id, '_price', $salePriceA);
				update_post_meta( $u_product_id, '_regular_price', $salePriceA);	
				update_post_meta( $u_product_id, '_sale_price', $Sale_Price);
				update_post_meta( $u_product_id, '_product_image_gallery', $galleryIds);	
				update_post_meta( $u_product_id, 'wareHouseId', $wareHouseId , false);
				update_post_meta( $u_product_id, '_manage_stock', true);
				update_post_meta( $u_product_id, '_stock', $quantity);
				update_post_meta( $u_product_id, 'manufacturerId', $manufacturerId);
				update_post_meta( $u_product_id, 'departmentId', $departmentId);
				update_post_meta( $u_product_id, 'categoryId', $categoryId);
				update_post_meta( $u_product_id, 'vendorId', $vendorId);

				if($allowNegativeStock == 'true' )
				{
					
					update_post_meta( $u_product_id, '_stock', 0);
					update_post_meta($product_id, '_stock_status', 'instock');
				}
				else {
					update_post_meta( $u_product_id, 'quantity', $quantity ); 	
					update_post_meta( $u_product_id, '_stock', $quantity);
		
		
				}



			// echo "Update Product";
			
			}
			else
			{

				// Add New Product

				
						$feature_image = getImage($image_url);
						$postarg = array(
							'post_author' => '1',
							'post_status' => "publish",
							'post_title' => $itemName,
							'post_parent' => '',
							'post_content'   => $description,
							'post_excerpt'   => $notes,
							'post_type' => "product",
						);
						$post_id = wp_insert_post($postarg);
						set_post_thumbnail($post_id, $feature_image);	
						wp_set_post_terms($post_id, array($f_location_id), 'product_location' );
						wp_set_post_terms($post_id, array($f_manufacturerId), 'manufacturer' );
						wp_set_post_terms($post_id, array($f_vendorId), 'vendors' );
						wp_set_post_terms($post_id, array($f_departmentId), 'department' );
						wp_set_post_terms($post_id, array($f_categoryId), 'product_cat');
						add_post_meta( $post_id, 'productCode', $productCode ); 
						add_post_meta( $post_id, 'itemSKUId', $itemSKUId ); 			
						add_post_meta( $post_id, 'allownegativestock', $allowNegativeStock ); 
						add_post_meta( $post_id, 'trackstock', $trackStock ); 
						add_post_meta( $post_id, 'barcode', $barcode ); 
						add_post_meta( $post_id, 'costPrice', $costPrice ); 
						add_post_meta( $post_id, 'salepricea', $salePriceA ); 
						add_post_meta( $post_id, 'salePriceB', $salePriceB ); 
						add_post_meta( $post_id, 'salePriceC', $salePriceC ); 
						add_post_meta( $post_id, 'categoryName', $categoryName ); 
						add_post_meta( $post_id, 'manufacturerName', $manufacturerName ); 
						add_post_meta( $post_id, 'vendorName', $vendorName ); 
						add_post_meta( $post_id, 'departmentName', $departmentName ); 
						add_post_meta( $post_id, 'ageRestriction', $ageRestriction ); 
						add_post_meta( $post_id, 'allowDiscount', $allowDiscount ); 
						add_post_meta( $post_id, 'gender', $gender ); 
						add_post_meta( $post_id, 'grouping', $grouping ); 
						add_post_meta( $post_id, 'id', $id ); 
						add_post_meta( $post_id, 'itemid', $itemId ); 
						add_post_meta( $post_id, 'isTaxable', $isTaxable ); 			
						add_post_meta( $post_id, 'isActive', $isActive ); 
						add_post_meta( $post_id, 'isOpnDept', $isOpnDept ); 
						add_post_meta( $post_id, 'itemType', $itemType ); 
						add_post_meta( $post_id, 'soldAs', $soldAs ); 
						add_post_meta( $post_id, 'caseQty', $caseQty ); 
						add_post_meta( $post_id, 'defaultPrice', $defaultPrice ); 
						add_post_meta( $post_id, 'isDefault', $isDefault ); 
						add_post_meta( $post_id, 'isVisible', $isVisible ); 
						add_post_meta( $post_id, 'taxable', $taxable ); 
						add_post_meta( $post_id, 'uomId', $uomId ); 
						add_post_meta( $post_id, 'sellQuantity', $sellQuantity ); 				
						add_post_meta( $post_id, '_sku', $skuCode);
						add_post_meta( $post_id, '_price', $salePriceA);
						add_post_meta( $post_id, '_regular_price', $salePriceA);	
						add_post_meta( $post_id, '_sale_price', $Sale_Price);
						add_post_meta( $post_id, '_product_image_gallery', $galleryIds);
						add_post_meta( $post_id, 'wareHouseId', $wareHouseId);				
						add_post_meta( $post_id, 'manufacturerId', $manufacturerId);
						add_post_meta( $post_id, 'departmentId', $departmentId);
						add_post_meta( $post_id, 'categoryId', $categoryId);
						add_post_meta( $post_id, 'vendorId', $vendorId);

						if($allowNegativeStock == 'true' )
								{
									
									update_post_meta( $post_id, '_stock', 0);
									update_post_meta($post_id, '_stock_status', 'instock');
								}
								else {
									update_post_meta( $post_id, 'quantity', $quantity ); 	
									update_post_meta( $post_id, '_stock', $quantity);
						
						
								}
					// echo "Add Product";

			
			}		
		}
	}
}

function update_products_stock(){ 
	
	$store_loc = get_option('store_location');

	$url = "/inventory-svc/api/InventoryItem/GetUpdatedInventoryItems?warehouseId=$store_loc&pageNo=0&pageSize=2000";
	$url = str_replace(" ","T",$url); 
	$response = moi_do_curl($url,'GET');
	
	if($response->success==true){			
		foreach($response->data as $apiproduct) {				
			$quantity = $apiproduct->quantity;	
			if (get_page_by_title($itemName, OBJECT, 'product')) {	
				$check_title = get_page_by_title($itemName, 'OBJECT', 'product');
				$u_product_id = $check_title->ID;					 			
				update_post_meta( $u_product_id, 'quantity', $quantity ); 				
				update_post_meta( $u_product_id, '_stock', $quantity);		
			
			}
				
		}	

    return "Stock Update";	
	}	
	 
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'zilon/v2', '/StockUpdated', array(
    'methods' => 'GET',
    'callback' => 'update_products_stock',
  ) );
  register_rest_route( 'zilon/v2', '/ProductUpdated', array(
    'methods' => 'GET',
    'callback' => 'ProductUpdated',
  ) );
} );

function moi_reg_hook () {
	$url = "https://dev-connect.azure-api.net/inventory-svc/api/SaveHookRegister";
	$post_fields= [		
		"Url"=> "https=>//testing.connect-cbd.com/settings",
		"LocationId"=> "1458001",
		"RegisterId"=> "",
		"Trigger"=> "StockUpdated"
	  ];
	$response = moi_do_curl($url, 'POST', $post_fields );

}