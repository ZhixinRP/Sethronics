<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wppathfinder.com/
 * @since      1.0.0
 *
 * @package    Dwp_Courier_Management
 * @subpackage Dwp_Courier_Management/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dwp_Courier_Management
 * @subpackage Dwp_Courier_Management/admin
 * @author     Nira Rahman <zindexbd@gmail.com>
 */
class Dwp_Courier_Management_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	private $table_activator;
 
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//Activator Method
		require_once DWP_COURIER_MANAGEMENT_PLUGIN_PATH . 'includes/class-dwp-courier-management-activator.php';
		$activator = new Dwp_Courier_Management_Activator();
		$this->table_activator = $activator;

	}

	
	public function sanitize_field($type, $value) {
		$fValue = '';
		switch ( $type ) {
			case 'text':    
			case 'select':    
				$fValue = isset( $value ) ? sanitize_text_field( $value ) : null; 
				break;  
	
			case 'url': 
				$fValue = isset( $value ) ? esc_url_raw( $value ) : null;  
				break;   
	
			case 'email': 
				$fValue = isset( $value ) ? sanitize_email( $value ) : null;  
				break; 
	
			case 'number': 
			case 'switch':  
			case 'checkbox':
				$fValue = isset( $value ) ? absint( $value ) : null;
				break;
	
			case 'float': 
				$fValue = isset( $value ) ? floatval( $value ) : null;
				break;   
	
			case 'color':
				$fValue = isset( $value ) ? sanitize_hex_color( $value ) : null; 
				break; 
				
			case 'style':  
				$fValue = isset( $value ) ? array_map( 'sanitize_text_field', $value ) : null;   
				break;
			  
			
			default: 
				$fValue = isset( $value ) ? sanitize_text_field( $value ) : null;
				break;
		}
		return $fValue;
	}

	public function sanitize_image( $input ) {
		$filetype = wp_check_filetype( $input );
		if ( $filetype['ext'] && wp_ext2type( $filetype['ext'] ) === 'image' ) {
			return esc_url( $input );
		}
		return '';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dwp_Courier_Management_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dwp_Courier_Management_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$valid_pages = array("dwp-courier-management","dwp-merchant-registration","dwp-merchant-list","dwp-delivery-list","dwp-submit-delivery-request");

		$page = isset($_REQUEST['page']) ? $this->sanitize_field('text',$_REQUEST['page']) : '';

		if(in_array($page,$valid_pages)){

			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dwp-courier-management-admin.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'dwp-bootstrap', DWP_COURIER_MANAGEMENT_PLUGIN_URL . 'assets/css/bootstrap.min.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'dwp-bootstrapIcons', DWP_COURIER_MANAGEMENT_PLUGIN_URL . 'assets/bootstrap/bootstrap-icons.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'dwp-dataTables', DWP_COURIER_MANAGEMENT_PLUGIN_URL . 'assets/css/jquery.dataTables.min.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'dwp-sweetAlert', DWP_COURIER_MANAGEMENT_PLUGIN_URL . 'assets/css/sweetalert.min.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 */

		$valid_pages = array("dwp-courier-management","dwp-merchant-registration","dwp-merchant-list","dwp-delivery-list","dwp-submit-delivery-request");
		$page = isset($_REQUEST['page']) ? $this->sanitize_field('text',$_REQUEST['page']) : '';

		if(in_array($page,$valid_pages)){

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dwp-courier-management-admin.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( 'dwp-bootstrap', DWP_COURIER_MANAGEMENT_PLUGIN_URL . 'assets/js/bootstrap.bundle.min.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( 'dwp-dataTables', DWP_COURIER_MANAGEMENT_PLUGIN_URL . 'assets/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( 'dwp-validateJs', DWP_COURIER_MANAGEMENT_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );

			wp_enqueue_script( 'dwp-sweetAlert', DWP_COURIER_MANAGEMENT_PLUGIN_URL . 'assets/js/sweetalert.min.js', array( 'jquery' ), $this->version, false );

			wp_localize_script($this->plugin_name, "dwp_delivery_ajax", array(
				"name" => esc_html__("Drag WP Delivery & Courier Management Plugin"),
				"author" => esc_html__("Nira Rahman", 'dwp-courier-delivery-management'),
				"u_s_image" => esc_html__("Upload Shop Icon or Image", 'dwp-courier-delivery-management'),
				"v_msg" => esc_html__("Upload Verification Document as Image", 'dwp-courier-delivery-management'),
				"c_delete" => esc_html__("Are you really want to delete this record?", 'dwp-courier-delivery-management'),
				"ajax_admin_url" => esc_url(admin_url('admin-ajax.php')) 
			));
		}

	}

	public function dwp_register_admin_menu_pages(){

		/**
		 * 
		 * This function is a callback function of add_action("admin_menu").
		 *
		 * All Menu Pages We will Register Here. These all will be displayed in the admin dashboard.
		 * 
		 */


		add_menu_page( esc_html__( 'DWP Courier & Delivery Management', 'dwp-courier-delivery-management' ),esc_html__( 'DWP Courier Management', 'dwp-courier-delivery-management' ),'manage_options','dwp-courier-management',array($this,'dwp_courier_management_fn'),'dashicons-table-row-after',10);

		//Submenu Page Dashboard
		add_submenu_page("dwp-courier-management",esc_html__( "DWP Dashboard", "dwp-courier-delivery-management" ),esc_html__( "Dashboard", "dwp-courier-delivery-management" ),"manage_options","dwp-courier-management",array($this,"dwp_courier_management_fn"));

		//Submenu Page Merchant Registration
		add_submenu_page("dwp-courier-management",esc_html__( "DWP Merchant Registration", "dwp-courier-delivery-management" ),esc_html__( "Merchant Registration", "dwp-courier-delivery-management" ),"manage_options","dwp-merchant-registration",array($this,"dwp_merchant_registration_fn"));

		//Submenu Page Merchant List
		add_submenu_page("dwp-courier-management",esc_html__( "DWP Merchant List", "dwp-courier-delivery-management" ),esc_html__( "Merchant List", "dwp-courier-delivery-management" ),"manage_options","dwp-merchant-list",array($this,"dwp_merchant_list_fn"));

		//Submenu Page Submit Delivery Request
		add_submenu_page("dwp-courier-management",esc_html__( "DWP Submit Delivery Request", "dwp-courier-delivery-management" ),esc_html__( "Submit Delivery Request", "dwp-courier-delivery-management" ),"manage_options","dwp-submit-delivery-request",array($this,"dwp_submit_delivery_request_fn"));

		//Submenu Page Delivery List
		add_submenu_page("dwp-courier-management",esc_html__( "DWP Delivery Request List", "dwp-courier-delivery-management" ),esc_html__( "Delivery List", "dwp-courier-delivery-management" ),"manage_options","dwp-delivery-list",array($this,"dwp_delivery_list_fn"));

	}

	public function dwp_courier_management_fn(){

		/**
		 * 
		 * Callback function of add_menu_page.
		 * 
		 */	

		ob_start();

		include_once(DWP_COURIER_MANAGEMENT_PLUGIN_PATH.'admin/partials/tmpl-admin-dashboard.php');

		echo ob_get_clean();
		
		
	}

	public function dwp_merchant_registration_fn(){

		/**
		 * 
		 * Callback function of add_submenu_page Merchant Registration.
		 * 
		 */	

		ob_start();

		include_once(DWP_COURIER_MANAGEMENT_PLUGIN_PATH.'admin/partials/tmpl-merchant-registration.php');

		echo ob_get_clean();

	}

	public function dwp_merchant_list_fn(){

		/**
		 * 
		 * Callback function of add_submenu_page Merchant Registration.
		 * 
		 */	

		global $wpdb;

		$merchant_list = $wpdb->get_results(

				$wpdb->prepare(
						"SELECT * FROM ".$wpdb->prefix."dwp_merchant_registration",""
					) 
		); 
		
		ob_start();

		include_once(DWP_COURIER_MANAGEMENT_PLUGIN_PATH.'admin/partials/tmpl-merchant-list.php');

		echo ob_get_clean();
		
	}

	public function dwp_submit_delivery_request_fn(){

		/**
		 * 
		 * Callback function of add_submenu_page Submit Delivery Request Page.
		 * 
		 */	

		 
		global $wpdb;

		$select_merchant = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT id, mrcnt_name FROM " . $this->table_activator->wp_dwp_merchant_registration(),""
			)
		);
		
		ob_start();

		include_once(DWP_COURIER_MANAGEMENT_PLUGIN_PATH.'admin/partials/tmpl-submit-delivery-request.php');

		echo ob_get_clean();
		
	}

	public function dwp_delivery_list_fn(){

		/**
		 * 
		 * Callback function of add_submenu_page Delivery List Page.
		 * 
		 */	
		global $wpdb;

		$delivery_list = $wpdb->get_results(


			$wpdb->prepare(
				"SELECT delivery.*, merchant.mrcnt_name, merchant.mrcnt_phone,merchant.business_address FROM ". $this->table_activator->wp_dwp_delivery_request_submit()." as delivery LEFT JOIN ". $this->table_activator->wp_dwp_merchant_registration() ." as merchant ON delivery.mrcnt_id = merchant.id ORDER BY id DESC",""
			)

		);


		 ob_start();

		 include_once(DWP_COURIER_MANAGEMENT_PLUGIN_PATH.'admin/partials/tmpl-delivery-list.php');


		echo ob_get_clean();
		
		
	}


	public function admin_ajax_request_handle_fn(){

		/**
		 * 
		 * Admin Ajax Request Operation Function.
		 * 
		 */	

		global $wpdb;

		$param = isset($_REQUEST['param']) ? $this->sanitize_field('text',$_REQUEST['param']) : ''; 

		if(!empty($param)){

			if($param == "create_merchant_account"){
				
				//Storing All Data into Variables

				if(wp_verify_nonce($_REQUEST['merchant_delete_name_nonce'], "merchant_delete_action_nonce")){

					$mrchnt_name = isset($_REQUEST['mrchnt_name']) ? $this->sanitize_field('text', $_REQUEST['mrchnt_name']) : '';

					$mrchnt_email = isset($_REQUEST['mrchnt_email']) ? $this->sanitize_field('email', $_REQUEST['mrchnt_email']) : '';


					$mrchnt_phone = isset($_REQUEST['mrchnt_phone']) ? $this->sanitize_field('number', $_REQUEST['mrchnt_phone']) : '';

					$mrchnt_address = isset($_REQUEST['mrchnt_address']) ? $this->sanitize_field('text', $_REQUEST['mrchnt_address']) : '';

					$mrchnt_webpage = isset($_REQUEST['mrchnt_webpage']) ? $this->sanitize_field('url', $_REQUEST['mrchnt_webpage']) : '';

					$product_type = isset($_REQUEST['product_type']) ? $this->sanitize_field('number', $_REQUEST['product_type']) : '';

					$product_weight = isset($_REQUEST['product_weight']) ? $this->sanitize_field('number', $_REQUEST['product_weight']) : '';

					$expected_delivery = isset($_REQUEST['expected_delivery']) ? $this->sanitize_field('number',$_REQUEST['expected_delivery']) : '';

					$mrcnt_document = isset($_REQUEST['merchant-verify-doc-hide']) ? $this->sanitize_image($_REQUEST['merchant-verify-doc-hide']) : '';

					$mrcnt_shop_doc = isset($_REQUEST['merchant_shop_hidden_image']) ? $this->sanitize_image( $_REQUEST['merchant_shop_hidden_image']) : ''; 

					//Table Insert Query for Merchant Registration

					$wpdb->insert($this->table_activator->wp_dwp_merchant_registration(),array(
						'mrcnt_name' 			=> $mrchnt_name,
						'mrcnt_email' 			=> $mrchnt_email,
						'mrcnt_phone'			=> $mrchnt_phone,
						'business_address'		=> $mrchnt_address,
						'web_address' 			=> $mrchnt_webpage,
						'product_type'			=> $product_type,
						'product_weight'		=> $product_weight,
						'expected_deliveery'	=> $expected_delivery,
						'mrcnt_document'	=> $mrcnt_document,
						'shop_image'	=> $mrcnt_shop_doc
					));

				// Register Merchant if Registration form is Submitted

					if($wpdb->insert_id > 0){
						echo json_encode(array(
							'status' => 1,
							'message' => 'Merchant Registration Successful',
						));
					}

				}else{
					echo json_encode(array(
						'status' => 0,
						'message' => 'Merchant Registration Failed',
					));
				}


			}elseif($param=="delete_merchant_record"){
				$merchant_id = isset($_REQUEST['merchant_id']) ? intval($this->sanitize_field('number',$_REQUEST['merchant_id'])) : 0;

				if($merchant_id > 0){

					$wpdb->delete($this->table_activator->wp_dwp_merchant_registration(),array(
						"id" => $merchant_id
					));

					echo json_encode(array(
						"status" => 1,
						"message" => "Merchant Record Deleted Successfully!"
					));

				}else{
					echo json_encode(array(
						"status" => 0,
						"message" => "Merchant Record not Deleted!"
					));
				}

			}elseif($param == "submit_delivery_request"){

				// Storing All Registration Form Data in Variables

				if(wp_verify_nonce($_REQUEST['submit_delivery_name_nonce'], "submit_delivery_action_nonce")){

					$mrcnt_id = isset($_REQUEST['select_mrchnt']) ? intval($this->sanitize_field('number', $_REQUEST['select_mrchnt'])) : 0;

					$mrcnt_name = isset($_REQUEST['merchant_name_optional']) ? $this->sanitize_field('text',$_REQUEST['merchant_name_optional']) : ""; 

					$mrcnt_phn = isset($_REQUEST['merchant_phone_optional']) ? intval($this->sanitize_field('number',$_REQUEST['merchant_phone_optional'])) : 0;

					$mrcnt_addr = isset($_REQUEST['merchant_address_optional']) ? $this->sanitize_field('text',$_REQUEST['merchant_address_optional']) : "";

					$customer_name = isset($_REQUEST['customer_name']) ? $this->sanitize_field('text',$_REQUEST['customer_name']) : "";

					$customer_phone = isset($_REQUEST['customer_phone']) ? intval($this->sanitize_field('text',$_REQUEST['customer_phone'])) : 0;

					$customer_address = isset($_REQUEST['customer_address']) ? $this->sanitize_field('text',$_REQUEST['customer_address']) : "";

					$payment_status = isset($_REQUEST['payment_status']) ? intval($this->sanitize_field('number',$_REQUEST['payment_status'])) : 0;

					$amount_collect = isset($_REQUEST['amount_collect']) ? intval($this->sanitize_field('number',$_REQUEST['amount_collect'])) : 0;

					$edd = isset($_REQUEST['edd']) ? $this->sanitize_field('text',$_REQUEST['edd']) : "";

					$edt = isset($_REQUEST['edt']) ? $this->sanitize_field('text',$_REQUEST['edt']) : "";

					$wpdb->insert($this->table_activator->wp_dwp_delivery_request_submit(),array(
						"mrcnt_id" => $mrcnt_id,
						"mrchnt_name" => $mrcnt_name,
						"mrcnt_phn" => $mrcnt_phn,
						"mrcnt_addr"	=> $mrcnt_addr,
						"cstmr_name"	=> $customer_name,
						"cstmr_phone"	=> $customer_phone,
						"cstmr_addr"	=> $customer_address,
						"pmnt_stus"	=> $payment_status,
						"amnt_collect"	=> $amount_collect,
						"edd"	=> $edd,
						"edt"	=> $edt 
					));

					if($wpdb->insert_id > 0){

						echo json_encode(array(
							"status" => 1,
							"message" => "Delivery Request Created Successfully."
						));
					}
				}else{

					echo json_encode(array(
						"status" => 0,
						"message" => "Delivery Request Not Created."
					));
				}
				
			}elseif($param == "delete_delivery_record"){
				
				$delivery_request_id = isset($_REQUEST['delivery_request_id']) ? intval($this->sanitize_field('number',$_REQUEST['delivery_request_id'])) : 0;

				if($delivery_request_id > 0){

					$wpdb->delete($this->table_activator->wp_dwp_delivery_request_submit(),array(
						"id" => $delivery_request_id
					));

					echo json_encode(array(
						"status" => 1,
						"message" => "Delivery Record Deleted Successfully!"
					));

				}else{
					echo json_encode(array(
						"status" => 0,
						"message" => "Delivery Record not Deleted!"
					));
				}

			}

			wp_die();

		}		

	}
}