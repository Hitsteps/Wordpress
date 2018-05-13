<?php


class Hitsteps_NFA {
	public $file = __FILE__;
	private static $instance;

	public function __construct() {
		$this->init();
	}


	public static function instance() {
		if ( is_null( self::$instance ) ) :
			self::$instance = new self();
		endif;
		return self::$instance;
	}


	public function init() {
		add_action( 'admin_init', array( $this, 'Hitsteps_NFA_setup_license') );
		add_action( 'init', array( $this, 'register_ninja_form_fields') );
		add_action( 'init', array( $this, 'ninja_forms_register_hitsteps_hook') );
		
	}


public function ninja_forms_register_hitsteps_hook(){
  add_action( 'ninja_forms_pre_process',  array( $this, 'ninja_forms_register_hitsteps_hook_process') );
}

public function ninja_forms_register_hitsteps_hook_process(){
  global $ninja_forms_processing, $_POST;
  
   //  $user_value = $ninja_forms_processing->get_field_value( 3 );  $user_value .= "Hello World";
  //  $ninja_forms_processing->update_field_value( 3, $user_value );
  $data=(array) $ninja_forms_processing;
  $data=$data['data']['field_data'];
  $_hs_tracking_info='';
  $id=0;
  foreach ($data as $k=>$val){
  if ($val['type']=='collect_hitsteps_data') $id=$val['id'];
  }
  
	if ($id>0){
		
	$option=get_hst_conf();
	if ($option['code']!=''){
	if (round($_POST['_hs_post_data'])>0){
	$input=array("input_UID"=>round($_POST['_hs_uid_data']),
	"output_visitor_ip"=>round($_POST['_hs_data_output_visitor_ip']),
	"output_visitor_path"=>round($_POST['_hs_data_output_visitor_path']),
	"output_visitor_base"=>round($_POST['_hs_data_output_visitor_base']),
	"output_visitor_link"=>round($_POST['_hs_data_output_visitor_link'])
	);

		$_hs_tracking_info = _hs_contact_form_query($input);
		
		
		 $ninja_forms_processing->update_field_value( $id, $_hs_tracking_info );
	
	
	}
		
		
	}else{
	$_hs_tracking_info=__("Please enable Hitsteps API code in WordPress setting page to enable Contact form Analytics.",'hitsteps-visitor-manager');
	}
	

	
	}
	

}


	public function Hitsteps_NFA_setup_license() {
		if ( class_exists( 'NF_Extension_Updater' ) ) {
			$NF_Extension_Updater = new NF_Extension_Updater( 'Hitsteps Ultimate Web Analytics', '5.37', 'hitsteps', __FILE__, 'option_prefix' );
		}
	}

	public function register_ninja_form_fields() {
		$argsIp = array(
			'name' => __( 'Hitsteps Tracker', 'hitsteps-visitor-manager'),
			'display_function' => array($this, 'collect_hitsteps_data'),
			'edit_function' => array($this, 'ninja_forms_hitsteps_edit'),
			'sidebar' => 'template_fields',
			'display_label' => false,
			'display_wrap' => false,
		);

		if( function_exists( 'ninja_forms_register_field' ) )
		{
			ninja_forms_register_field('collect_hitsteps_data', $argsIp);
		}
	}



 public function ninja_forms_hitsteps_edit( $field_id, $data ){
	
	$vi = 0;
	$vb = 0;
	$vp = 0;
	$vl = 0;

	if( isset( $data['disable_visitor_ip'] 	 ) )	$vi = $data['disable_visitor_ip'];
	if( isset( $data['disable_visitor_base'] ) )	$vb = $data['disable_visitor_base'];
	if( isset( $data['disable_visitor_link'] ) )	$vl = $data['disable_visitor_link'];
	if( isset( $data['disable_visitor_path'] ) )	$vp = $data['disable_visitor_path'];

	?>
	<div>

		
		
<input type="radio" name="ninja_forms_field_<?php echo $field_id;?>[disable_visitor_ip]" class="option" value="1" <?php if( $vi){ echo 'checked';}?> />&nbsp;Yes&nbsp;<input type="radio" name="ninja_forms_field_<?php echo $field_id;?>[disable_visitor_ip]" class="option" value="0" <?php if( !$vi){ echo 'checked';}?> />&nbsp;No&nbsp;&nbsp;<?php echo esc_html( __( 'Disable Visitor IP, Name, ISP and Country information', 'hitsteps-visitor-manager' ) ); ?>
<br>
<input type="radio" name="ninja_forms_field_<?php echo $field_id;?>[disable_visitor_path]" class="option" value="1" <?php if( $vp){ echo 'checked';}?> />&nbsp;Yes&nbsp;<input type="radio" name="ninja_forms_field_<?php echo $field_id;?>[disable_visitor_path]" class="option" value="0" <?php if( !$vp){ echo 'checked';}?> />&nbsp;No&nbsp;&nbsp;<?php echo esc_html( __( 'Disable Visitor Viewed Pages Path', 'hitsteps-visitor-manager' ) ); ?>
<br><input type="radio" name="ninja_forms_field_<?php echo $field_id;?>[disable_visitor_link]" class="option" value="1" <?php if( $vl){ echo 'checked';}?> />&nbsp;Yes&nbsp;<input type="radio" name="ninja_forms_field_<?php echo $field_id;?>[disable_visitor_link]" class="option" value="0" <?php if(! $vl){ echo 'checked';}?> />&nbsp;No&nbsp;&nbsp;<?php echo esc_html( __( 'Disable Visitor More Information Link', 'hitsteps-visitor-manager' ) ); ?>
<br><input type="radio" name="ninja_forms_field_<?php echo $field_id;?>[disable_visitor_base]" class="option" value="1" <?php if( $vb){ echo 'checked';}?> />&nbsp;Yes&nbsp;<input type="radio" name="ninja_forms_field_<?php echo $field_id;?>[disable_visitor_base]" class="option" value="0" <?php if( !$vb){ echo 'checked';}?> />&nbsp;No&nbsp;&nbsp;<?php echo esc_html( __( 'Disable Visitor Base Visits', 'hitsteps-visitor-manager' ) ); ?>


		
		
	
	</div>


	<?php
}





	public function collect_hitsteps_data( $field_id, $data )
	{
		global $post;



		if(!empty($post))
		{
		$html='';
		$vi=round($data['disable_visitor_ip'])? 0 : 1;
		$vb=round($data['disable_visitor_base'])? 0 : 1;
		$vp=round($data['disable_visitor_path'])? 0 : 1;
		$vl=round($data['disable_visitor_link'])? 0 : 1;

    $option=get_hst_conf();
	if ($option['code'] !='') {
    $html .= "
    <input type='hidden'  name='_hs_post_data' value='1' />
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
				hstc.src='//log.hitsteps.com/api/getUID.php?code=".substr($option['code'],0,32)."';
				var htssc = document.getElementsByTagName('script')[0];
				htssc.parentNode.insertBefore(hstc, htssc);        
				}        
                }
                //load it after 1 second
				(function(){
				setTimeout(function(){ _hs_data_uid_auto_fill_func(); }, 1000);
				})();
                //load it after 5 second
				(function(){
				setTimeout(function(){ _hs_data_uid_auto_fill_func(); }, 5000);
				})();
				//load it after 10 second
				(function(){
				setTimeout(function(){ _hs_data_uid_auto_fill_func(); }, 10000);
				})();
				//load it now first, maybe user is already registered.
				_hs_data_uid_auto_fill_func();
    </script>
                
    ";
    
    

                $html.= "<input type='hidden' name='_hs_data_output_visitor_ip' value='".$vi."' />";
                $html.= "<input type='hidden' name='_hs_data_output_visitor_path' value='".$vp."' />";
                $html.= "<input type='hidden' name='_hs_data_output_visitor_link' value='".$vl."' />";
                $html.= "<input type='hidden' name='_hs_data_output_visitor_base' value='".$vb."' />";
        
     }
		
		
		echo $html;
		

		}
		
	    if(is_admin())
		{
			?>
				<div class="field-wrap text-wrap label-above">
					<label for="ninja_forms_field_<?php echo $field_id;?>"><?php _e( 'Hitsteps Analytics', 'hitsteps-visitor-manager' ); ?></label>
					<input type="text" name="ninja_forms_field_<?php echo $field_id;?>" value="<?php echo $data;?>">
					<?php echo $data;?>
				</div>
			<?php
		}
	}

}

if ( ! function_exists( 'Hitsteps_NFA' ) ) :

 	function Hitsteps_NFA() {
		return Hitsteps_NFA::instance();
	}

endif;

Hitsteps_NFA();




?>