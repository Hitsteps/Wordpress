<?php

$_hitsteps_jetpack_init=0;

add_filter('grunion_contact_form_field_html', 'add_hitsteps_analytics_jetpack_field', 10, 3);
add_filter('contact_form_message', 'add_hitsteps_analytics_jetpack_contact_form_result', 10, 3);


function _hitsteps_jetpack_form(){
global $_hitsteps_jetpack_init;
if ($_hitsteps_jetpack_init==0){
$option=get_hst_conf();
if ($option['jetpack']!=2){
if ($option['code'] !='') {
$_hitsteps_jetpack_init=1;
return  "<input type='hidden' name='_hs_post_data' value='1' /><input type='hidden' value='' name='_hs_uid_data' id='_hs_data_uid_auto_fill' />
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


function add_hitsteps_analytics_jetpack_contact_form_result($msg){
global $_POST;
 $option=get_hst_conf();
 if ($option['jetpack']!=2){
 if ($option['code']!=''){


if (round($_POST['_hs_post_data'])>0){
	$input=array("input_UID"=>round($_POST['_hs_uid_data']),	"output_visitor_ip"=>1,	"output_visitor_path"=>1,	"output_visitor_base"=>1,	"output_visitor_link"=>1
	);

		$msg.="\n\n". _hs_contact_form_query_plain($input);
	}
}
}

return $msg;
}

function add_hitsteps_analytics_jetpack_field($fieldBlock, $fieldLabel, $postId){

		$pageContactFormDetected   = false;
		$widgetContactFormDetected = false;
		if($pageContactFormDetected && $widgetContactFormDetected)
			return $fieldBlock;

		$arrAttributes = shortcode_parse_atts($fieldBlock);

		$fieldId   = isset($arrAttributes['id'])   ? $arrAttributes['id']   : null;
		$fieldName = isset($arrAttributes['name']) ? $arrAttributes['name'] : null;


		if(null === $fieldName || $fieldId !== $fieldName)
			return $fieldBlock;

		$arrNameParts = explode('-', $fieldName);
		if( !isset($arrNameParts[0]) || empty($arrNameParts))
			return $fieldBlock;

		if(!$widgetContactFormDetected)
		{
			$widgetContactFormDetected = ( false !== strpos( $arrNameParts[0], 'widget' ) );

			if ( $widgetContactFormDetected && isset( $arrNameParts[2] ) && is_numeric( $arrNameParts[2] ) ) {
				return $fieldBlock . _hitsteps_jetpack_form();
			}
		}

		if(!$pageContactFormDetected)
		{
			$postId = (string) $postId;

			if ( ! empty( $postId ) && ( substr( $arrNameParts[0], - strlen( $postId ) ) === $postId ) ) {
				$pageContactFormDetected = true;
				return $fieldBlock . _hitsteps_jetpack_form();
			}

			if ( empty( $postId ) && preg_match( "/g([0-9]+)/", $arrNameParts[0], $matches ) && $arrNameParts[0] === $matches[0] ) { $pageContactFormDetected = true; return $fieldBlock . _hitsteps_jetpack_form();}
		}
		return $fieldBlock;
}

?>