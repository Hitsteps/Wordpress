<?php

if (!class_exists('HITSTEPS_GF_hitsteps')) {
    class HITSTEPS_GF_hitsteps
    {
    
	private static $name = "Gravity Forms - Hitsteps tracker";
    private static $slug = 'hitsteps_gf_hitsteps_field';
	private static $version = '1.2.4';
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
            if (self::is_gravityforms_installed()) {

                //start plug in
                add_filter('gform_add_field_buttons', array(&$this,'hitsteps_add_field') );
				add_filter('gform_field_type_title' , array(&$this,'hitsteps_title'), 10, 2);
				add_action('gform_editor_js', array(&$this,'hitsteps_editor_js'));
				add_action('gform_field_standard_settings', array(&$this,'hitsteps_settings_visitor_title'), 10, 2 );
				add_action('gform_field_standard_settings', array(&$this,'hitsteps_settings_visitor_ip'), 10, 2 );
				add_action('gform_field_standard_settings', array(&$this,'hitsteps_settings_visitor_path'), 10, 2 );
				add_action('gform_field_standard_settings', array(&$this,'hitsteps_settings_visitor_base'), 10, 2 );
				add_action('gform_field_standard_settings', array(&$this,'hitsteps_settings_visitor_link'), 10, 2 );
				add_filter('gform_tooltips', array(&$this,'hitsteps_settings_visitor_ip_tooltip'));
				add_filter('gform_tooltips', array(&$this,'hitsteps_settings_visitor_path_tooltip'));
				add_filter('gform_tooltips', array(&$this,'hitsteps_settings_visitor_base_tooltip'));
				add_filter('gform_tooltips', array(&$this,'hitsteps_settings_visitor_link_tooltip'));

				add_action('gform_enqueue_scripts', array(&$this,'hitsteps_custom_js'), 90, 3);
                add_action( "gform_field_input" , "hs_gravity_field_input", 10, 5 );    
 
            }
        } // END __construct
        
        /**
         * Add hitsteps field to 'standard fields' group in Gravity Forms forms editor
         */        
        public static function hitsteps_add_field($field_groups)
        {

            foreach ($field_groups as &$group) {
                if ($group["name"] == "standard_fields") {
                    $group["fields"][] = array(
                        "class" => "button",
                        "value" => __("HS Analytics", "hitsteps-visitor-manager")
                        ,"onclick" => "StartAddField('hitsteps');"
                    );
                    break;
                }
            }
           
            return $field_groups;
        } // END hitsteps_add_field
        
        /**
         * Add title to hitsteps field, displayed in Gravity Forms forms editor
         */        
        public static function hitsteps_title($title, $field_type)
        {
            if ($field_type == "hitsteps") return "Hitsteps Analytics";
        } // END hitsteps_title
        
        /**
         * JavaSript to add field options to infoxbox field in the Gravity forms editor
         */
        public static function hitsteps_editor_js()
        {
?>
		<script type='text/javascript'>
			jQuery(document).ready(function($) {
				// standard field options
				fieldSettings["hitsteps"] = ".hitsteps_field_visitor_title_setting, .label_setting, .hitsteps_field_visitor_ip_setting, .hitsteps_field_visitor_path_setting, .hitsteps_field_visitor_base_setting, .hitsteps_field_visitor_link_setting, .conditional_logic_field_setting"; 
		 
				//custom field options				
				jQuery(document).bind("gform_load_field_settings", function(event, field, form){
					if ('hitsteps' == field['type']) {

					jQuery("#hitsteps_field_visitor_ip").prop('checked', field["hitsteps_field_visitor_ip"] == false ? false : true);
					jQuery("#hitsteps_field_visitor_path").prop('checked', field["hitsteps_field_visitor_path"] == false ? false : true);
					jQuery("#hitsteps_field_visitor_base").prop('checked', field["hitsteps_field_visitor_base"] == false ? false : true);
					jQuery("#hitsteps_field_visitor_link").prop('checked', field["hitsteps_field_visitor_link"] == false ? false : true);

					}
				});
			});
		 
		</script>
		<?php
        } // END hitsteps_editor_js
        
 
		/**
         * Add hitsteps 'Visitor Title' field, displayed in Gravity Forms emails 
         */
        public static function hitsteps_settings_visitor_title($position, $form_id)
        {
            // Create settings on position
            if ($position == 50) {
?>
		 
			<li class="hitsteps_field_visitor_title_setting field_setting">
												<label for="hitsteps_field_visitor_title">
												
												
												
<?php echo __("Label won't be visible to your visitors, it is just for your reference in this page.",'hitsteps-visitor-manager');?>



</label>
												
												
												
												
											</li>
											
											
			<?php
                
            }
        } // END
        
        
        
        
		/**
         * Add hitsteps 'Visitor IP' field, displayed in Gravity Forms emails 
         */
        public static function hitsteps_settings_visitor_ip($position, $form_id)
        {
            // Create settings on position
            if ($position == 50) {
?>
		 
			<li class="hitsteps_field_visitor_ip_setting field_setting">
												<label for="hitsteps_field_visitor_ip">
												
												
												

												<input type="checkbox" name="hitsteps_field_visitor_ip" id="hitsteps_field_visitor_ip" value="1"  onchange="SetFieldProperty('hitsteps_field_visitor_ip', this.checked);"  />  <?php _e("Show Visitor IP and Details", "hitsteps-visitor-manager"); ?>
												<?php gform_tooltip("hitsteps_field_visitor_ip_tooltip");?></label>
												
												
												
												
											</li>
											
											
			<?php
                
            }
        } // END hitsteps_settings_visitor_ip
        
		public static function hitsteps_settings_visitor_ip_tooltip($tooltips){
			$tooltips["hitsteps_field_visitor_ip_tooltip"] = __("Visitor IP, ISP, Name and details will be shown in email",'hitsteps-visitor-manager');
			return $tooltips;
		}





 
        
		/**
         * Add hitsteps 'Visitor Path' field, displayed in Gravity Forms emails 
         */
        public static function hitsteps_settings_visitor_path($position, $form_id)
        {
            // Create settings on position
            if ($position == 50) {
?>
		 
			<li class="hitsteps_field_visitor_path_setting field_setting">
												<label for="hitsteps_field_visitor_path">
												
												
												

												<input type="checkbox" name="hitsteps_field_visitor_path" id="hitsteps_field_visitor_path" value="1"  onchange="SetFieldProperty('hitsteps_field_visitor_path', this.checked);"  />  <?php _e("Show Visitor Path", "hitsteps-visitor-manager"); ?>
												<?php gform_tooltip("hitsteps_field_visitor_path_tooltip");?></label>
												
												
												
												
											</li>
											
											
			<?php
                
            }
        } // END hitsteps_settings_visitor_path
        
		public static function hitsteps_settings_visitor_path_tooltip($tooltips){
			$tooltips["hitsteps_field_visitor_path_tooltip"] = __("Recent visitor pageviews path and their referrers will be shown in email",'hitsteps-visitor-manager');
			return $tooltips;
		}



        
		/**
         * Add hitsteps 'Visitor Base' field, displayed in Gravity Forms emails 
         */
        public static function hitsteps_settings_visitor_base($position, $form_id)
        {
            // Create settings on position
            if ($position == 50) {
?>
		 
			<li class="hitsteps_field_visitor_base_setting field_setting">
												<label for="hitsteps_field_visitor_base">
												
												
												

												<input type="checkbox" name="hitsteps_field_visitor_base" id="hitsteps_field_visitor_base" value="1"  onchange="SetFieldProperty('hitsteps_field_visitor_base', this.checked);"  />  <?php _e("Show Visitor Base", "hitsteps-visitor-manager"); ?>
												<?php gform_tooltip("hitsteps_field_visitor_base_tooltip");?></label>
												
												
												
												
											</li>
											
											
			<?php
                
            }
        } // END hitsteps_settings_visitor_base
        
		public static function hitsteps_settings_visitor_base_tooltip($tooltips){
			$tooltips["hitsteps_field_visitor_base_tooltip"] = __("Visitor first landing time, landing page and landing referrer will be shown",'hitsteps-visitor-manager');
			return $tooltips;
		}




        
		/**
         * Add hitsteps 'Visitor Link' field, displayed in Gravity Forms emails 
         */
        public static function hitsteps_settings_visitor_link($position, $form_id)
        {
            // Create settings on position
            if ($position == 50) {
?>
		 
			<li class="hitsteps_field_visitor_link_setting field_setting">
												<label for="hitsteps_field_visitor_link">
												
												
												

												<input type="checkbox" name="hitsteps_field_visitor_link" id="hitsteps_field_visitor_link" value="1"  onchange="SetFieldProperty('hitsteps_field_visitor_link', this.checked);"  />  <?php _e("Show Visitor Link", "hitsteps-visitor-manager"); ?>
												<?php gform_tooltip("hitsteps_field_visitor_link_tooltip");?></label>
												
												
												
												
												<?php
												 $option=get_hst_conf();
												 if ($option['code']=='')
												 {
												 ?>
												<div class="highlight" style="background:lightyellow; padding:10px; ">
												<?php echo __("You need to install Hitsteps API code for this function to work. Please use hitsteps menu under setting.",'hitsteps-visitor-manager');?>
												</div>
												<?php
												}
												?>
												
												
											</li>
											
											
			<?php
                
            }
        } // END hitsteps_settings_visitor_link
        
        
        
        

        
        
		public static function hitsteps_settings_visitor_link_tooltip($tooltips){
			$tooltips["hitsteps_field_visitor_link_tooltip"] = __("Contain a link to click and view visitor profile in web dashboard",'hitsteps-visitor-manager');
			return $tooltips;
		}





        /**
         * Queue JavaScript and stylesheet for front end
         */
        public function hitsteps_custom_js()
        {
            //add_action('wp_footer', array(&$this,'hitsteps_custom_js_script'));
        } // END hitsteps_custom_js
        
        

        /*
         * Check if GF is installed
         */
        private static function is_gravityforms_installed()
        {
            return class_exists('GFAPI');
        } // END is_gravityforms_installed
    }
    $HITSTEPS_GF_hitsteps = new HITSTEPS_GF_hitsteps();
    
    add_filter("gform_pre_send_email", "_hits_gf_before_email");
    add_action( 'gform_pre_submission', '_hits_gf_pre_submission', 10, 2 );
    
}






if (!class_exists('HITSTEPS_GFRD_hitsteps')){
    class HITSTEPS_GFRD_hitsteps
    {
    
	private static $name = "Gravity Forms - Hitsteps tracker - Base Referral (RAW)";
    private static $slug = 'HITSTEPS_GFRD_hitsteps_field';
	private static $version = '1.2.4';
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
            if (self::is_gravityforms_installed()) {
                //start plug in
                add_filter('gform_add_field_buttons', array(&$this,'hitsteps_add_field') );
				add_filter('gform_field_type_title' , array(&$this,'hitsteps_title'), 10, 2);
				add_action('gform_editor_js', array(&$this,'hitsteps_editor_js'));
				add_action('gform_enqueue_scripts', array(&$this,'hitsteps_custom_js'), 90, 3);   
                add_action( "gform_field_input" , "hs_gravity_field_input", 10, 5 );             
            }
        } // END __construct
        
        /**
         * Add hitsteps field to 'standard fields' group in Gravity Forms forms editor
         */        
        public static function hitsteps_add_field($field_groups)
        {
            foreach ($field_groups as &$group) {
                if ($group["name"] == "standard_fields") {
                    $group["fields"][] = array(
                        "class" => "button",
                        "value" => __("HS Base Ref", "hitsteps-visitor-manager")
                       , "onclick" => "StartAddField('hitstepsraw');"
                    );
                    break;
                }
            }
            return $field_groups;
        } // END hitsteps_add_field
        
        /**
         * Add title to hitsteps field, displayed in Gravity Forms forms editor
         */        
        public static function hitsteps_title( $field_type)
        {
            if ($field_type == "hitstepsraw") return "Hitsteps Base Referral";
        } // END hitsteps_title
        
        /**
         * JavaSript to add field options to infoxbox field in the Gravity forms editor
         */
        public static function hitsteps_editor_js()
        {
?>
		<script type='text/javascript'>
			jQuery(document).ready(function($) {
				// standard field options
				fieldSettings["hitstepsraw"] = ".hitsteps_field_visitor_title_setting, .label_setting, .conditional_logic_field_setting"; 
		 
				//custom field options				
				jQuery(document).bind("gform_load_field_settings", function(event, field, form){

				});
			});
		 
		</script>
		<?php
        } // END hitsteps_editor_js
        
 
		/**
         * Add hitsteps 'Visitor Title' field, displayed in Gravity Forms emails 
         */
        public static function hitsteps_settings_visitor_title($position, $form_id)
        {
            // Create settings on position
            if ($position == 50) {
?>
		 
			<li class="hitsteps_field_visitor_title_setting field_setting">
												<label for="hitsteps_field_visitor_title">
												
												
												
<?php echo __("Label won't be visible to your visitors, it is just for your reference in this page.",'hitsteps-visitor-manager');?>



</label>
												
												
												
												
											</li>
											
											
			<?php
                
            }
        } // END
        


        /**
         * Queue JavaScript and stylesheet for front end
         */
        public function hitsteps_custom_js()
        {
            //add_action('wp_footer', array(&$this,'hitsteps_custom_js_script'));
        } // END hitsteps_custom_js
        

        

        /*
         * Check if GF is installed
         */
        private static function is_gravityforms_installed()
        {
            return class_exists('GFAPI');
        } // END is_gravityforms_installed
    }
    $HITSTEPS_GFRD_hitsteps = new HITSTEPS_GFRD_hitsteps();
    
    
    add_action( 'gform_pre_submission', '_hits_gf_pre_submission_raw', 10, 2 );
    
}

function _hits_gf_pre_submission_raw( $form ) {
global $_POST, $_hs_uid_data_cache_raw;
if (!isset($_POST['_hs_uid_data'])) $_POST['_hs_uid_data']=0;
if (round($_POST['_hs_uid_data'])>0){

//get hitstep's field input ID in gravity form
$inputID=0;
	foreach ($form['fields'] as $field){
		if ($field->type=='hitstepsraw'){
		$inputID=$field->id;
		


//input ID: $inputID?

if (!isset($_hs_uid_base_data_cache[round($_POST['_hs_uid_data'])])) $_hs_uid_base_data_cache[round($_POST['_hs_uid_data'])]=='';
if ($_hs_uid_base_data_cache[round($_POST['_hs_uid_data'])]==''){

$input=array("input_UID"=>round($_POST['_hs_uid_data']),
	"output_visitor_ip"=>0,
	"output_visitor_path"=>0,
	"output_visitor_base"=>1,
	"output_visitor_baseraw"=>1,
	"output_visitor_link"=>0
	);
	$_hs_uid_base_data_cache[round($_POST['_hs_uid_data'])]=_hs_contact_form_query_base_raw($input);
}

$_POST['input_'.$inputID]=$_hs_uid_base_data_cache[round($_POST['_hs_uid_data'])];


}
}
}
}
















function _hits_gf_pre_submission( $form ) {


global $_POST, $_hs_uid_data_cache;
if (!isset($_POST['_hs_uid_data'])) $_POST['_hs_uid_data']=0;
if (round($_POST['_hs_uid_data'])>0){

//get hitstep's field input ID in gravity form
$inputID=0;
	foreach ($form['fields'] as $field){
		if ($field->type=='hitsteps'){
		$inputID=$field->id;


//input ID: $inputID?

if (!isset($_hs_uid_data_cache[round($_POST['_hs_uid_data'])])) $_hs_uid_data_cache[round($_POST['_hs_uid_data'])]=='';
if ($_hs_uid_data_cache[round($_POST['_hs_uid_data'])]==''){

$input=array("input_UID"=>round($_POST['_hs_uid_data']),
	"output_visitor_ip"=>round($_POST['_hs_data_output_visitor_ip']),
	"output_visitor_path"=>round($_POST['_hs_data_output_visitor_path']),
	"output_visitor_base"=>round($_POST['_hs_data_output_visitor_base']),
	"output_visitor_link"=>round($_POST['_hs_data_output_visitor_link'])
	);
	$_hs_uid_data_cache[round($_POST['_hs_uid_data'])]=_hs_contact_form_query($input);
}

$_POST['input_'.$inputID]="Hitsteps Analytics only visible inside Notification Email.";

}
            }
    }
}



function _hits_gf_before_email($email){
global $_POST, $_hs_uid_data_cache;
if (!isset($_POST['_hs_uid_data'])) $_POST['_hs_uid_data']=0;
if (round($_POST['_hs_post_data'])>0){

if (!isset($_hs_uid_data_cache[round($_POST['_hs_uid_data'])])) $_hs_uid_data_cache[round($_POST['_hs_uid_data'])]=='';
if ($_hs_uid_data_cache[round($_POST['_hs_uid_data'])]==''){


$input=array("input_UID"=>round($_POST['_hs_uid_data']),
    "output_visitor_ip"=>round($_POST['_hs_data_output_visitor_ip']),
    "output_visitor_path"=>round($_POST['_hs_data_output_visitor_path']),
    "output_visitor_base"=>round($_POST['_hs_data_output_visitor_base']),
    "output_visitor_link"=>round($_POST['_hs_data_output_visitor_link'])
    );
    $_hs_uid_data_cache[round($_POST['_hs_uid_data'])]=_hs_contact_form_query($input);

}

$email['message']=str_replace("Hitsteps Analytics only visible inside Notification Email.",$_hs_uid_data_cache[round($_POST['_hs_uid_data'])],$email['message']);
}


return $email;
}

function hs_gravity_field_input ( $input , $field , $value , $lead_id , $form_id ){
global $_hs_gravity_shown;
$content="";
    if (!is_admin()){

$option=get_hst_conf();

if ((!is_admin()) && $option['code'] !='') {
            
          $vb=1;
          $vp=1;
          $vi=1;
          $vl=1;
           
           if (isset($field['hitsteps_field_visitor_base'])&&!$field['hitsteps_field_visitor_base']) $vb=0;
           if (isset($field['hitsteps_field_visitor_ip'])&&!$field['hitsteps_field_visitor_ip']) $vi=0;
           if (isset($field['hitsteps_field_visitor_path'])&&!$field['hitsteps_field_visitor_path']) $vp=0;
           if (isset($field['hitsteps_field_visitor_link'])&&!$field['hitsteps_field_visitor_link']) $vl=0;
            
            
            if (round($_hs_gravity_shown)==0){
                $content = "<input type='hidden' name='_hs_post_data' value='1' />
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
                </script>";
                $content.= "<input type='hidden' name='_hs_data_output_visitor_ip' value='".$vi."' />";
                $content.= "<input type='hidden' name='_hs_data_output_visitor_path' value='".$vp."' />";
                $content.= "<input type='hidden' name='_hs_data_output_visitor_link' value='".$vl."' />";
                $content.= "<input type='hidden' name='_hs_data_output_visitor_base' value='".$vb."' />";
               
            }
    }

    if ( $field["type"] == "hitstepslast" ) {
        $max_chars = "";

        $input_name = $form_id .'_' . $field["id"];
        $tabindex = GFCommon::get_tabindex();
        $_hs_gravity_shown=1; 
        return sprintf("<style type='text/css'> #field_" . $form_id . "_".$field["id"]." { display: none;}</style><input type='hidden' name='input_%s' id='%s' value='%s' />", $field["id"], 'hitstepslast-'.$field['id'] , esc_html($value) ).$content;

    }
    if ( $field["type"] == "hitstepsraw" ) {
        $max_chars = "";

        $input_name = $form_id .'_' . $field["id"];
        $tabindex = GFCommon::get_tabindex();
        $_hs_gravity_shown=1; 
        return sprintf("<style type='text/css'> #field_" . $form_id . "_".$field["id"]." { display: none;}</style><input type='hidden' name='input_%s' id='%s' value='%s' />", $field["id"], 'hitstepsraw-'.$field['id'] , esc_html($value) ).$content;

    }
    if ( $field["type"] == "hitsteps" ) {
        $max_chars = "";

        $input_name = $form_id .'_' . $field["id"];
        $tabindex = GFCommon::get_tabindex();
        $_hs_gravity_shown=1; 
        return sprintf("<style type='text/css'> #field_" . $form_id . "_".$field["id"]." { display: none;}</style><input type='hidden' name='input_%s' id='%s' value='%s' />", $field["id"], 'hitsteps-'.$field['id'] ,  esc_html($value) ).$content;

    }
}
    return $input;
}





add_action( 'gform_editor_js_set_default_values', '_hs_gravity_set_defaults' );
function _hs_gravity_set_defaults(){
    ?>
    case "hitsteps" :
        field.label = "Hitsteps Analytics";
    break;
    case "hitstepsraw" :
        field.label = "Hitsteps Base Referral";
    break;
    case "hitstepslast" :
        field.label = "Hitsteps Most Recent External Referral";
    break;
    <?php
}








if (!class_exists('HITSTEPS_GFRDL_hitsteps')){
    class HITSTEPS_GFRDL_hitsteps
    {
    
    private static $name = "Gravity Forms - Hitsteps tracker - Last Referral";
    private static $slug = 'HITSTEPS_GFRDL_hitsteps_field';
    private static $version = '1.2.4';
        /**
         * Construct the plugin object
         */
        public function __construct()
        {
            // register actions
            if (self::is_gravityforms_installed()) {
                //start plug in
                add_filter('gform_add_field_buttons', array(&$this,'hitsteps_add_field') );
                add_filter('gform_field_type_title' , array(&$this,'hitsteps_title'), 10, 2);
                add_action('gform_editor_js', array(&$this,'hitsteps_editor_js'));
                add_action('gform_enqueue_scripts', array(&$this,'hitsteps_custom_js'), 90, 3);   
                add_action('gform_field_input', "hs_gravity_field_input", 10, 5 );             
            }
        } // END __construct
        
        /**
         * Add hitsteps field to 'standard fields' group in Gravity Forms forms editor
         */        
        public static function hitsteps_add_field($field_groups)
        {
            foreach ($field_groups as &$group) {
                if ($group["name"] == "standard_fields") {
                    $group["fields"][] = array(
                        "class" => "button",
                        "value" => __("Recent Referral", "hitsteps-visitor-manager")
                       , "onclick" => "StartAddField('hitstepslast');"
                    );
                    break;
                }
            }
            return $field_groups;
        } // END hitsteps_add_field
        
        /**
         * Add title to hitsteps field, displayed in Gravity Forms forms editor
         */        
        public static function hitsteps_title( $field_type)
        {
            if ($field_type == "hitstepslast") return "Hitsteps Recent Referral";
        } // END hitsteps_title
        
        /**
         * JavaSript to add field options to infoxbox field in the Gravity forms editor
         */
        public static function hitsteps_editor_js()
        {
?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
                // standard field options
                fieldSettings["hitstepslast"] = ".hitsteps_field_visitor_title_setting, .label_setting, .conditional_logic_field_setting"; 
         
                //custom field options              
                jQuery(document).bind("gform_load_field_settings", function(event, field, form){

                });
            });
         
        </script>
        <?php
        } // END hitsteps_editor_js
        
 
        /**
         * Add hitsteps 'Visitor Title' field, displayed in Gravity Forms emails 
         */
        public static function hitsteps_settings_visitor_title($position, $form_id)
        {
            // Create settings on position
            if ($position == 50) {
?>
         
            <li class="hitsteps_field_visitor_title_setting field_setting">
                                                <label for="hitsteps_field_visitor_title">
                                                
                                                
                                                
<?php echo __("Label won't be visible to your visitors, it is just for your reference in this page.",'hitsteps-visitor-manager');?>



</label>
                                                
                                                
                                                
                                                
                                            </li>
                                            
                                            
            <?php
                
            }
        } // END
        


        /**
         * Queue JavaScript and stylesheet for front end
         */
        public function hitsteps_custom_js()
        {
            //add_action('wp_footer', array(&$this,'hitsteps_custom_js_script'));
        } // END hitsteps_custom_js
        

        

        /*
         * Check if GF is installed
         */
        private static function is_gravityforms_installed()
        {
            return class_exists('GFAPI');
        } // END is_gravityforms_installed
    }
    $HITSTEPS_GFRDL_hitsteps = new HITSTEPS_GFRDL_hitsteps();
    
    
    add_action( 'gform_pre_submission', '_hits_gf_pre_submission_last', 10, 2 );
    
}


function _hits_gf_pre_submission_last( $form ) {
global $_POST, $_hs_uid_data_cache_raw;

if (!isset($_POST['_hs_uid_data'])) $_POST['_hs_uid_data']=0;
if (round($_POST['_hs_uid_data'])>0){

//get hitstep's field input ID in gravity form
$inputID=0;
    foreach ($form['fields'] as $field){
        if ($field->type=='hitstepslast'){
        $inputID=$field->id;
        

//input ID: $inputID?

if (!isset($_hs_uid_last_data_cache_raw[round($_POST['_hs_uid_data'])])) $_hs_uid_last_data_cache_raw[round($_POST['_hs_uid_data'])]=='';
if ($_hs_uid_last_data_cache_raw[round($_POST['_hs_uid_data'])]==''){

$input=array("input_UID"=>round($_POST['_hs_uid_data']),
    "output_visitor_ip"=>0,
    "output_visitor_path"=>0,
    "output_visitor_base"=>0,
    "output_visitor_baseraw"=>0,
    "output_visitor_link"=>0,
    "output_visitor_external_ref"=>1
    );



    $_hs_uid_last_data_cache_raw[round($_POST['_hs_uid_data'])]=_hs_contact_form_query_base_raw($input);
}

$_POST['input_'.$inputID]=$_hs_uid_last_data_cache_raw[round($_POST['_hs_uid_data'])];


}
}
}
}




?>