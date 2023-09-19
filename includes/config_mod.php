<?php
@session_start();
@ob_start();
$time_zone ='Asia/Manila';
define( 'WEB_NAME',		'WMSU Online Canteen' );	
date_default_timezone_set($time_zone);	



	define('DB_HOST'		,'localhost');
	define('DB_USER'		,'root');
	define('DB_PASSWORD'	,'bigfishB');
	define('DB_NAME'		,'onlinecanteendb');
	
	
	

define('TABLE_PREFIX'					,'tbl_');
define('PATH_TEMPLATE'					,'template/');
define('PATH_JPLUGINS'					,'assets/js/');
define('PATH_IMAGES'					,'images/');
define('PATH_CSS'						,'assets/css/');
define('PATH_VENDOR'					,'assets/vendor/');
define('PATH_V_IMAGES'					,'assets/images/');


	
$messages = array();

$messages['fg']['customer_Suc_Update'] 			= "<b>Customer's Records is Successfully <strong>UPDATED</strong>!.</b>";
$messages['fg']['customer_Er_Save'] 			= "<b>There's an <strong>ERROR</strong> while Saving! .. Please try again.</b>.";

$messages['fg']['vendor_Suc_Save'] 				= "<b>Vendor's Records is Successfully <strong>SAVE</strong>!.</b>";
$messages['fg']['vendor_Suc_Update'] 			= "<b>Vendor's Records is Successfully <strong>UPDATED</strong>!.</b>";
$messages['fg']['vendor_Er_Save'] 				= "<b>There's an <strong>ERROR</strong> while Saving! .. Please try again.</b>.";

$messages['fg']['staff_Suc_Save'] 				= "<b>Staff's Records is Successfully <strong>SAVE</strong>!.</b>";
$messages['fg']['staff_Suc_Update'] 			= "<b>Staff's Records is Successfully <strong>UPDATED</strong>!.</b>";
$messages['fg']['staff_Er_Save'] 				= "<b>There's an <strong>ERROR</strong> while Saving! .. Please your <span style='font-weight: 700 !important;color: red;'>Check details again</span> Or You haven't <span style='font-weight: 700 !important;color: red;'>change Anything!</span>.</b>.";

$messages['fg']['errand_Suc_Save'] 				= "<b>Errand's Records is Successfully <strong>SAVE</strong>!.</b>";
$messages['fg']['errand_Suc_Update'] 			= "<b>Errand's Records is Successfully <strong>UPDATED</strong>!.</b>";
$messages['fg']['errand_Er_Save'] 				= "<b>There's an <strong>ERROR</strong> while Saving! .. Please try again.</b>.";

$messages['fg']['password_notmatch']			= "<b>Password entered is <strong>different</strong></b>.";
$messages['fg']['old_password_notmatch']		= "<b>The <strong>OLD password</strong> doesn’t match.! </b>.";
$messages['fg']['password_Suc_Update'] 			= "<b><strong>Password</strong> is Successfully <strong>UPDATED</strong>!.</b>";

$messages['fg']['food_Suc_Save'] 				= "<b>Food / Product is Successfully <strong>SAVE</strong>!.</b>";
$messages['fg']['food_Suc_Update'] 				= "<b>Food / Product is Successfully <strong>UPDATED</strong>!.</b>";
$messages['fg']['food_Er_Save'] 				= "<b>There's an <strong>ERROR</strong> while Saving! .. Please try again.</b>.";

$messages['fg']['cart_Suc_Save'] 			    = "<b>Successfully Save to your Cart!.</b>";
$messages['fg']['cart_Er_Save'] 				= "<b>Save has not been successful</b>... Please try again.";

$messages['fg']['Payment_Success'] 				= "<b class='mb-0 text-white'>You're Order has been Place.. &nbsp; <small><em><mark>Remainder: No Cancellation of Order.</mark></em></small></b>";
$messages['fg']['Payment_err'] 					= "<b>Place Order has not been successful</b>... Please try again.";
$messages['fg']['Payment_method_err'] 			= "<b>Please Select on Payment Method</b>... and try again.";

$messages['fg']['sel_rec_notlogin'] 			= " <strong>Sorry!</strong> - Please <a href='LoginForm' class='note'><strong>LOG-IN</strong></a> to continue your transaction.";

?>