<?php

add_action( 'woocommerce_email_after_order_table', 'add_hitsteps_analytics_to_woo_email', 10, 2 );
add_filter( 'woocommerce_after_order_notes', 'add_hitsteps_analytics_woo_checkout_field' );
add_filter( 'woocommerce_pay_order_after_submit', 'add_hitsteps_analytics_woo_checkout_field' );

$is_hs_checkout_uid_shown=0;
 function add_hitsteps_analytics_woo_checkout_field( $fields ) {
 if ($is_hs_checkout_uid_shown==0){
 	$is_hs_checkout_uid_shown=1;
$option=get_hst_conf();
if ($option['woo']!=2){

if ($option['code'] !='') {

echo  "<input type='hidden' name='_hs_post_data' value='1' />
<input type='hidden' value='' name='_hs_uid_data' id='_hs_data_uid_auto_fill' />
    <script>
                //Load hitsteps script once page fully loaded.
                function _hs_data_uid_auto_fill_func(){
                _hs_uidset=0;
                var _hs_uid_data_fields = document.getElementsByName('_hs_uid_data');
                for (_hs_uid_data_i = 0; _hs_uid_data_i < _hs_uid_data_fields.length; _hs_uid_data_i++) {
				if (_hs_uid_data_fields[_hs_uid_data_i].value !='') {_hs_uidset=1;}
				}
                if (_hs_uidset==0){
                var hstc=document.createElement('script');
				hstc.src='//www.hitsteps.com/api/getUID.php?code=".substr($option['code'],0,32)."';
				var htssc = document.getElementsByTagName('script')[0];
				htssc.parentNode.insertBefore(hstc, htssc);        
				}        
                }
                //load it after 1 second
				(function(){
				setTimeout(function(){ _hs_data_uid_auto_fill_func(); }, 1000);
				})();
                //load it after 3 second
				(function(){
				setTimeout(function(){ _hs_data_uid_auto_fill_func(); }, 3000);
				})();
				//load it after 9 second
				(function(){
				setTimeout(function(){ _hs_data_uid_auto_fill_func(); }, 9000);
				})();
				//load it now first, maybe user is already registered.
				_hs_data_uid_auto_fill_func();
    </script>
    ";

}
}
}
}


function add_hitsteps_analytics_to_woo_email( $order, $is_admin ) {

 global $_POST;

 $option=get_hst_conf();
 if ($option['woo']!=2){

$html='';

	if ( ! $is_admin ) return;
	

 if ($option['code']!=''){
	
	if (round($_POST['_hs_post_data'])>0){
	$input=array("input_UID"=>round($_POST['_hs_uid_data']),	"output_visitor_ip"=>1,	"output_visitor_path"=>1,	"output_visitor_base"=>1,	"output_visitor_link"=>1
	);

		$html ="<br>". _hs_contact_form_query($input);
		echo $html;
	}

}else{
echo __("Please enable Hitsteps API code in WordPress setting page to enable WooCommerce Email Analytics.",'hitsteps-visitor-manager');
}
}
}


?>