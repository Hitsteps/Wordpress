<?php
/*
Plugin Name: Hitsteps Ultimate Web Analytics
Plugin URI: https://www.hitsteps.com/
Description: Hitsteps is a powerful real time website visitor manager, it allow you to view and interact with your visitors in real time.
Author: hitsteps
Version: 5.53
Author URI: http://www.hitsteps.com/
*/ 

add_action('admin_menu', 'hst_admin_menu');
add_action('wp_footer', 'hitsteps');
add_action('wp_head', 'hitsteps');

function hitsteps_load_plugin_textdomain() {
	$domain = 'hitsteps-visitor-manager';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	if ( $loaded = load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' ) ) {
		return $loaded;
	} else {
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
}
add_action( 'plugins_loaded', 'hitsteps_load_plugin_textdomain' );


  


function hitsteps(){
global $_SERVER,$_COOKIE,$hitsteps_tracker;

$option=get_hst_conf();

if (!isset($option['code'])) $option['code']='';

$option['code']=str_replace("\r",'',str_replace("\n",'',str_replace(" ","",trim(html_entity_decode($option['code'])))));

if ( $option['code']!=''){
if ( !strpos(strtolower($option['code']),"hitsteps") ){

	if( round($option['iga'])==1 && current_user_can("manage_options") ) {

		echo "\n<!-- ".__("Hitsteps tracking code not shown because you're an administrator and you've configured Hitsteps plugin to ignore administrators visits.", 'hitsteps-visitor-manager')." -->\n";

		return;

	}

$htmlpar='';
$purl='https://www.';
$htssl='';
  if (isset($_SERVER["HTTPS"])){
      if ($_SERVER["HTTPS"]=='on'){
        $purl='https://';
        $htssl=" - SSL";
      }
  }
  if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"])){
  if ($_SERVER["HTTP_X_FORWARDED_PROTO"]=='https'){
        $purl='https://';
        $htssl=" - SSL";
  }
  }

?><!-- HITSTEPS TRACKING CODE<?php echo $htssl; ?> v5.51 - DO NOT CHANGE --><?php


if (is_search()){



if (round($hitsteps_tracker)==0){

?><script>MySearch='<?php echo addslashes(get_search_query()); ?>';</script><?php

}












$htmlpar.='&MySearch='.urlencode(addslashes(get_search_query()));
} ?><?php
	if( $option['tkn']!=2 ) {
?><?php if (round($hitsteps_tracker)==0){ ?>

	<script type='text/javascript'>
	function hitsteps_gc( name ) { if (document.cookie){ var hs_cookie_split = document.cookie.split(';'); if (hs_cookie_split){ for( var i in hs_cookie_split ) { if (typeof hs_cookie_split[i] == "undefined"){}else{ if( hs_cookie_split[i].indexOf( name+'=' ) != -1 ) return decodeURIComponent( hs_cookie_split[i].split('=')[1] ); }}}} return '';}
<?php
global $current_user; 

//visitor name
if (isset($_COOKIE['comment_author_'.md5( get_option("siteurl"))])){
$ipname=$_COOKIE['comment_author_'.md5( get_option("siteurl"))]; 
}else{
$ipname='';
}

if ($ipname=='') {
@get_currentuserinfo(); 
@$ipname=$current_user->user_login;
}

if ($ipname!=''){
$htmlpar.='&amp;ipname='.urlencode(addslashes($ipname));
}


//visitor aliasing

if (isset($_COOKIE['comment_author_email_'.md5( get_option("siteurl"))])){
$ipemail=$_COOKIE['comment_author_email_'.md5( get_option("siteurl"))]; 
}else{
$ipemail='';
}

if ($ipemail=='') {
@get_currentuserinfo(); 
@$ipemail=$current_user->user_email;
}

if ($ipemail!=''){
$htmlpar.='&amp;uniqueid='.urlencode(addslashes($ipemail));
}	


?>

		_hs_uniqueid='<?php echo addslashes($ipemail); ?>';
		ipname='<?php echo addslashes($ipname); ?>';

		ipnames=hitsteps_gc( 'comment_author_<?php echo md5( get_option("siteurl") ); ?>' );
		ipemails=hitsteps_gc( 'comment_author_email_<?php echo md5( get_option("siteurl") ); ?>' );
		if (ipnames!=''&&ipname=='') ipname=ipnames;
		if (ipemails!=''&&_hs_uniqueid=='') _hs_uniqueid=ipemails;

  	</script><?php } ?>

<?php



	

	}

	
if (isset($_SERVER["HTTP_REFERER"])){
$htmlpar.='&amp;ref='.urlencode(addslashes($_SERVER["HTTP_REFERER"]));
}
$htmlpar.='&amp;title='.urlencode(addslashes(wp_title('',false)));





$keyword=array();
$keyword[]='real time web analytics';
$keyword[]='realtime web analytics';
$keyword[]='blog statistics';
$keyword[]='blog tracking';
$keyword[]='Realtime website statistics';
$keyword[]='Realtime website tracking';
$keyword[]='Realtime blog statistics';
$keyword[]='free website tracking';
$keyword[]='visitor activity tracker';
$keyword[]='visitor activity monitoring';
$keyword[]='visitor activity monitor';
$keyword[]='user activity tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website tracking';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='website analytics';
$keyword[]='blog analytics';
$keyword[]='visitor analytics';
$keyword[]='web stats';
$keyword[]='web analytics';
$keyword[]='real time web stats';
$keyword[]='real time web analytics';
$keyword[]='track web visitors';
$keyword[]='website visitor tracker';
$keyword[]='wordpress analytics';
$keyword[]='woocommerce analytics';
$keyword[]='web statistics';
$keyword[]='joomla analytics';
$keyword[]='wordpress blog analytics';
$keyword[]='joomla cms analytics';
$keyword[]='how track web site visitors';
$keyword[]='analytics';
$keyword[]='website traffic analytics';
$keyword[]='website traffic tracker';
$keyword[]='live chat';
$keyword[]='heatmap';

$kwid=mt_rand(0,count($keyword));

$stats_widget="";


?><?php if (round($hitsteps_tracker==0)){



?>

<script>
(function(){
var hstc=document.createElement('script');
var hstcs='www.';
hstc.src='https://log.hitsteps.com/track.php?<?php echo $stats_widget; ?>code=<?php echo substr($option['code'],0,32); ?>';
hstc.async=true;
var htssc = document.getElementsByTagName('script')[0];
htssc.parentNode.insertBefore(hstc, htssc);
})();

<?php if (round($option['allowchat'])==2){ ?>var nochat=1; var _hs_heatmap_allowed=0;<?php }else{ ?>var nochat=0;<?php } ?>

</script>
<?php }else{ ?>

<noscript><a href="https://www.hitsteps.com/"><img src="https://log.hitsteps.com/track.php?mode=img&amp;code=<?php echo substr($option['code'],0,32); ?><?php echo $htmlpar; ?>" alt="Tracking for non-javascript browsers by Hitsteps <?php echo $keyword[$kwid]; ?>" border='0' width='1' height='1' /></a></noscript>

<?php } ?>

<!-- HITSTEPS TRACKING CODE<?php echo $htssl; ?><?php if (round($hitsteps_tracker==0)){ ?> - Header Code<?php }else{ ?> - Footer Code<?php } ?> - DO NOT CHANGE --><?php 



$hitsteps_tracker=1;


}
}
}






if (!function_exists("hst_clean_cache")){
function hst_clean_cache(){


	if(function_exists('wp_cache_clean_cache')){
	//to avoid a nasty bug!
	if(function_exists('wp_cache_debug')){
	global $file_prefix;
	@wp_cache_clean_cache($file_prefix);
	}
	}
	
	if (defined('W3TC')) {
	
	if(function_exists('w3tc_flush_all')){
	w3tc_flush_all();
	do_action('w3tc_flush_all');
	}
	
	if (function_exists('w3tc_pgcache_flush')) {
	w3tc_pgcache_flush();
	do_action('w3tc_pgcache_flush');
	}
	
	
	}

	


}
}


if (!function_exists("get_hst_conf")){
function get_hst_conf(){

$option=get_option('hst_setting');

//remove PHP Notices
if (!isset($option['code'])) $option['code']='';
if (!isset($option['wgd'])) $option['wgd']=1;
if (!isset($option['wgl'])) $option['wgl']=2;
if (!isset($option['tkn'])) $option['tkn']=1;
if (!isset($option['iga'])) $option['iga']=0;
if (!isset($option['igac'])) $option['igac']=0;
if (!isset($option['woo'])) $option['woo']=1;
if (!isset($option['jetpack'])) $option['jetpack']=1;
if (!isset($option['allowchat'])) $option['allowchat']=1;
if (!isset($option['stats'])) $option['stats']=2;
if (!isset($option['stats'])) $option['stats']=2;
if (!isset($option['wpmap'])) $option['wpmap']=2;
if (!isset($option['wpdash'])) $option['wpdash']=2;

//define pre-defined values.
if (round($option['wgd'])==0) $option['wgd']=1;
if (round($option['wgl'])==0) $option['wgl']=2;
if (round($option['tkn'])==0) $option['tkn']=1;
if (round($option['iga'])==0) $option['iga']=0;
if (round($option['igac'])==0) $option['igac']=0;
if (round($option['woo'])==0) $option['woo']=1;
if (round($option['jetpack'])==0) $option['jetpack']=1;
if (round($option['allowchat'])==0) $option['allowchat']=1;
if (!isset($option['stats'])) $option['stats']=2;
if (round($option['stats'])==0) $option['stats']=2;
if (round($option['wpmap'])==0) $option['wpmap']=2;
if (round($option['wpdash'])==0) $option['wpdash']=2;

return $option;

}
}
if (!function_exists("set_hst_conf")){
function set_hst_conf($conf){update_option('hst_setting',$conf);}
}



if (!function_exists("hst_admin_menu")){
function hst_admin_menu(){

$x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

	add_options_page(__("Hitsteps Options",'hitsteps-visitor-manager'), __("Hitsteps",'hitsteps-visitor-manager'), 'manage_options', __FILE__, 'hst_optionpage');

}
}



if (!function_exists("hitsteps_admin_bar_head")){
		function hitsteps_admin_bar_head() {

			if (current_user_can('manage_options')){
			$option=get_hst_conf();
			if (!isset($option['code'])) $option['code']='';
			
			if ( $option['code']!=''){
			if( round($option['igac'])==1) {
			?>
			<script src="https://www.hitsteps.com/forceblockcookie.php?code=<?php echo $option['code']; ?>"></script>
			<script src="https://log.hitsteps.com/forceblockcookie.php?code=<?php echo $option['code']; ?>"></script>
			<?php
			}
			}
			}



		}
add_action('admin_bar_menu','hitsteps_admin_bar_head');

}	

	if (!function_exists("hitsteps_admin_top_graph")){
		function hitsteps_admin_top_graph() {	
		add_action( 'admin_bar_menu', 'hitsteps_admintop_graph', 1001 );
		}
	}		
		
	if (!function_exists("hitsteps_admintop_graph")){
		function hitsteps_admintop_graph( &$wp_admin_bar ) {	
		if (current_user_can('manage_options')){
		
			$option=get_hst_conf();
			if (!isset($option['code'])) $option['code']='';
			
			if ( $option['code']!=''){
			$url = 'https://www.hitsteps.com/login-code.php?code=' . $option['code'];

			$cookieblock='';
			if( round($option['igac'])==1) {
			$cookieblock="&cookieblock=1";
			}
			$title = __("Website last 48 hours pageviews graph",'hitsteps-visitor-manager');
			

			$menu = array(
				'id'    => 'hitstepsgraph',
				'title' => "<img width='96' height='24' src='https://log.hitsteps.com/api/wp-graph.php?code=".$option['code'].$cookieblock."' alt='" . $title . "' title='" . $title . "' style='padding-top:5px;' />",
				'href'  => $url,
				'target'  => '_blank'
			);

			$wp_admin_bar->add_menu( $menu );
			
			}
		}
		
		}
	}
		
	if (!function_exists("hitsteps_admin_bar_menu")){
		function hitsteps_admin_bar_menu( &$wp_admin_bar ) {
		
		if (current_user_can('manage_options')){
		
			$option=get_hst_conf();
			if (!isset($option['code'])) $option['code']='';
			
			if ( $option['code']!=''){		
			$url = 'https://www.hitsteps.com/login-code.php?code=' . $option['code'];
			}else{
			$url =  get_site_url().'/wp-admin/options-general.php?page=hitsteps-visitor-manager/hitsteps.php';
			}

			$title = __('Hitsteps Analytics','hitsteps-visitor-manager');

			$menu = array(
				'id'    => 'hitstepsbtn',
				'title' => "<img width='83' height='20' src='" . WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)). "logo.png' alt='" . $title . "' title='" . $title . "' />",
				'href'  => $url
			);

			$wp_admin_bar->add_menu( $menu );

			$cookieblock='';
			if( round($option['igac'])==1) {
			$cookieblock="&cookieblock=1";
			}


			$title = __("Website last 48 hours pageviews graph",'hitsteps-visitor-manager');
			if ( $option['code']!=''){	
			$menu = array(
				'id'    => 'hitstepsgraph',
				'title' => "<img width='96' height='24' src='https://log.hitsteps.com/api/wp-graph.php?code=".$option['code'].$cookieblock."' alt='" . $title . "' title='" . $title . "' />",
				'href'  => $url
			);

			$wp_admin_bar->add_menu( $menu );
			}
		}
		}
	}




if (!function_exists("hitsteps_admin_warnings")){
function hitsteps_admin_warnings() {

$option=get_hst_conf();

if (!isset($option['code'])) $option['code']='';
if (!isset($_REQUEST['hitmagic'])) $_REQUEST['hitmagic']='';

if (isset($_POST['action'])){
$postaction=$_POST['action'];
}else{
$postaction='';
}

	if ( $option['code']=='' && $postaction!='do' && $_REQUEST['hitmagic']!='do' ) {
		function hitsteps_warning() {
			echo "
			<div id='hitsteps-warning' class='updated fade'><p><strong>".__('Get to know Hitsteps Analytics.','hitsteps-visitor-manager')."</strong> ".sprintf(__('You must <a href="%1$s">enter your hitsteps API key</a> to start tracking your visitors, get detailed report of every single visitors, watch them live, get notification when they visit, and receive list of pages they visit included in messages they send to you via contact forms.','hitsteps-visitor-manager'), "options-general.php?page=hitsteps-visitor-manager/hitsteps.php")."</p></div>
			
			<script type=\"text/javascript\">setTimeout(function(){jQuery('#hitsteps-warning').slideUp('slow');}, 30000);</script>

			";

		}

		add_action('admin_notices', 'hitsteps_warning');

		return;

	}

}
hitsteps_admin_warnings();
$option=get_hst_conf();


if ($option['wgd']!=2){
hitsteps_admin_top_graph();

}

}


if (!function_exists("hitsteps_call")){
	function hitsteps_call($post){
		$hitsteps_api_receiver="http://89.163.148.18/api/wp-register.php";
		$post['v']=1;
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_USERAGENT, "Hitsteps API Agent");
		 
		 //Set the URL to work with
		 curl_setopt($ch, CURLOPT_URL, $hitsteps_api_receiver);
		
		 // ENABLE HTTP POST
		 curl_setopt($ch, CURLOPT_POST, 1);
		
		 //Set the post parameters
		 curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));
		
		//return answer as string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		//execute the request (the login)
		$result = curl_exec($ch);

		$arr=array();
		
		if ($result=='db_down_for_maintaince'){
		$arr['error']=99;
		$arr['msg']="Hitstep's internal database error";
		curl_close($ch);
		return $arr;
		}
		if(curl_errno($ch))
		{
		$arr['error']=98;
		$arr['msg']="CURL connection error #".curl_errno($ch).": ".curl_error($ch);
		curl_close($ch);
		return $arr;	
		}
		curl_close($ch);
		
		$arr=(array) json_decode($result, true);
				
		return $arr;
		
		
	}
}











if (!function_exists("hst_optionpage")){
function hst_optionpage(){

$option=get_hst_conf();

$option['code']=html_entity_decode($option['code']);
$option['wgd']=html_entity_decode($option['wgd']);
$option['wgl']=html_entity_decode($option['wgl']);
$option['woo']=html_entity_decode($option['woo']);
$option['jetpack']=html_entity_decode($option['jetpack']);
$option['allowchat']=html_entity_decode($option['allowchat']);
$option['stats']=html_entity_decode($option['stats']);
$option['wpmap']=html_entity_decode($option['wpmap']);
$option['wpdash']=html_entity_decode($option['wpdash']);

$magicable=1;

global $current_user;

if(function_exists('get_currentuserinfo')){

get_currentuserinfo();


}





if ($current_user->user_email==''){
$magicable=0;
}

if ($current_user->display_name==''){

$current_user->display_name=$current_user->user_firstname;
}

if ($current_user->user_identity!=''){

$current_user->display_name=$current_user->user_identity;

}

if ($current_user->user_firstname==''){

$current_user->user_firstname=$current_user->display_name;

}



if ($current_user->display_name==''){

$magicable=0;
}

if(!function_exists('get_bloginfo')){

$magicable=0;
}

if(!function_exists('curl_init')){

$magicable=0;

}



if (isset($_REQUEST['hitmagic'])&&$_REQUEST['hitmagic']=='do'){

if ($magicable==1){

//check data
$magic_error=1;
$error_msg=array();

if ($_POST['hitmode']=='new'){

$magic_error=0;
$email=$_POST['magic']['email'];
$password=$_POST['magic']['password'];
$nickname=$_POST['magic']['nickname'];
$refhow=$_POST['magic']['refhow'];
$wname=$_POST['magic']['wname'];
$summary=$_POST['magic']['summary'];
$site=$_POST['magic']['site'];
$fname=$_POST['magic']['fname'];
$lname=$_POST['magic']['lname'];
$lang=$_POST['magic']['lang'];

if ($_POST['$term']!='1'){$magic_error=1;$error_msg[]=__("You need to accept terms and conditions.",'hitsteps-visitor-manager');}
if ($site==''){$magic_error=1;$error_msg[]=__("Cannot find your website address",'hitsteps-visitor-manager');}
if ($wname==''){$magic_error=1;$error_msg[]=__("Cannot find your website name",'hitsteps-visitor-manager');}
if ($email==''){$magic_error=1;$error_msg[]=__("Email cannot be empty",'hitsteps-visitor-manager');}
if ($password==''){$magic_error=1;$error_msg[]=__("Password cannot be empty",'hitsteps-visitor-manager');}
if ($nickname==''){$magic_error=1;$error_msg[]=__("Nickname cannot be empty",'hitsteps-visitor-manager');}



}


if ($_POST['hitmode']=='loyal'){

$magic_error=0;
$email=$_POST['magic']['email'];
$password=$_POST['magic']['password'];
$nickname="";
$refhow="";
$wname=$_POST['magic']['wname'];
$summary=$_POST['magic']['summary'];
$site=$_POST['magic']['site'];
$fname="";
$lname="";
$lang="";

if ($site==''){$magic_error=1;$error_msg[]=__("Cannot find your website address",'hitsteps-visitor-manager');}
if ($wname==''){$magic_error=1;$error_msg[]=__("Cannot find your website name",'hitsteps-visitor-manager');}

}


if ($magic_error==0){

$mdata = array(
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'fname'=>$fname,
            'lname'=>$lname,
            'password'=>$password,
            'email'=>$email,
            'nick'=>$nickname,
            'name'=>$wname,
            'summary'=>$summary,
            'site'=>$site,
            'lang'=>$lang,
            'refhow'=>$refhow,
            'mode'=>$_POST['hitmode']

        );
        

$hcresult=hitsteps_call($mdata);

if (isset($hcresult['error'])&&$hcresult['error']==0){
$option['code']=$hcresult['code'];
set_hst_conf($option);
$saved=1;
$magiced=1;
$error_msg[]=$hcresult['msg'];
$magicable=0;
}else{
$magic_error=1;
if (!isset($hcresult['error'])) $hcresult['error']=9999;
if (!isset($hcresult['msg'])) $hcresult['msg']='';
$error_msg[]=$hcresult['msg']." (Err #".round($hcresult['error']).")";

}

}




}


}







		if (isset($_POST['action'])&&$_POST['action']=='do'){
		
if (!current_user_can('manage_options')){
$_POST['wgl']=$option['wgl'];
}
			$option=$_POST;

			$option['code']=htmlentities(str_replace(" ","",stripslashes($option['code'])));

            set_hst_conf($option);

			$saved=1;
		}


?>

<div class="wrap">


<style>
.clear{
clear: both;
}
</style>

<?php

if (isset($saved)&&$saved==1){

?>



<br>

<div id='hitsteps-saved' class='updated fade' ><p><strong><?php echo __("Hitsteps plugin setting have been saved.",'hitsteps-visitor-manager');?></strong> <?php if ($option['code']!=''){ ?><?php { ?><?php echo __("We have started tracking your visitors.",'hitsteps-visitor-manager');?><?php }}else{ ?><?php echo __("Please get your hitsteps API code to enable us to start tracking your site visitors, for you.",'hitsteps-visitor-manager');?><?php } ?></p></div>

<script type="text/javascript">setTimeout(function(){jQuery('#hitsteps-saved').slideUp('slow');}, 11000);</script>




		<br>	



<?php




hst_clean_cache();





}
$x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
?>


<div style="max-width: 1300px; margin:auto;">
<h1 style="font-weight: 400;">




<img src="<?php echo $x; ?>favicon.png" style="vertical-align: middle; padding-right: 3px; " />

<a target="_blank" href="https://www.hitsteps.com/?tag=wordpress-to-homepage" style="color: #000; text-decoration: none;   font-weight: lighter;"><?php echo __("Hitsteps - Ultimate Realtime Web Analytics",'hitsteps-visitor-manager');?></a></h1>
</div>
<br>


<div>


<?php if ($option['code']!=''){

$magicable=0;

 ?>
 
 
 
<div style="max-width:1300px; margin-left: auto; margin-right: auto;">
<a class='button button-primary button-large' style="width:100%; margin-bottom: 15px;  height: 50px;  line-height: 50px; text-align: center;" href="https://www.hitsteps.com/login-code.php?code=<?php echo $option['code']; ?>" target="_blank"><?php echo __("Click here to open your Hitsteps dashboard.",'hitsteps-visitor-manager');?></a>
</div>
<?php } 
$x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
?>


<style>
.postbox {
  margin: 0 20px 20px 0;
}
.form-field input[type=email], .form-field input[type=number], .form-field input[type=password], .form-field input[type=search], .form-field input[type=tel], .form-field input[type=text], .form-field input[type=url], .form-field textarea {
  width: 100%;
  padding:6px;
}
</style>
<div style="max-width:1300px; margin-left: auto; margin-right: auto;">
<div class="postbox-container" style="width:70%;">
					<div class="metabox-holder">
						<div class="meta-box-sortables">
			
			
<?php 
if (isset($error_msg))
if (count($error_msg)>0){ 
foreach($error_msg as $errmsg){
?>
<div class='updated fade hitsteps-msg' ><p><?php echo $errmsg; ?></p></div>

<script type="text/javascript">setTimeout(function(){jQuery('.hitsteps-msg').slideUp('slow');}, 21000);</script>
<?php }
} ?>
			
			
			
			
			
							

<?php if ($magicable==1){
 if ($option['code']=='') { 
 
 
 
$lang=get_bloginfo('language');

if (strpos($lang,"-")>0){
$splitlang=explode("-",$lang);
$lang=$splitlang[0];
}

if ($lang=='') $lang='en';
 if (!isset($_POST['hitmode'])) $_POST['hitmode']='';
 ?>





<div class="postbox">
				<h3 class="hndle" style="cursor: pointer;" onclick="jQuery('.hitmagicauto').slideToggle();"><span><?php echo __("Hitsteps Auto Registration",'hitsteps-visitor-manager');?></span></h3>

				<div class="inside hitmagicauto-main form-field">

<form method="POST" class="hitmagicauto" style="<?php if ($_POST['hitmode']=='loyal') { ?>display: none;<?php } ?>">

<div >

<div class="button" style="float: right;" onclick="jQuery('.hitmagicauto').hide();jQuery('.hitmagicloyal').fadeIn(500);"><?php echo __("Already a hitsteps user? Login here.",'hitsteps-visitor-manager');?></div><br>

<small>
<?php echo __("Email",'hitsteps-visitor-manager');?>:<br><input type="email" name="magic[email]" value="<?php if (isset($_POST['magic']['email'])){echo $_POST['magic']['email'];}else{ echo $current_user->user_email;} ?>" /><br><br>
<?php echo __("Password",'hitsteps-visitor-manager');?>:<br><input type="password" name="magic[password]" value="<?php if (isset($_POST['magic']['password'])){echo $_POST['magic']['password'];} ?>" /><br><br>
<?php echo __("Nickname",'hitsteps-visitor-manager');?>:<br><input type="text" name="magic[nickname]" value="<?php if (isset($_POST['magic']['nickname'])){ echo $_POST['magic']['nickname']; }else{  echo $current_user->display_name; } ?>" /><br><br>
<?php echo __("How did you heard about Hitsteps",'hitsteps-visitor-manager');?>:<br><input type="text" name="magic[refhow]" value="<?php  if (isset($_POST['magic']['refhow'])){echo $_POST['magic']['refhow'];} ?>" /><br><br>
</small>


<input type="hidden" name="hitmagic" value="do">
<input type="hidden" name="hitmode" value="new">
<input type="hidden" name="magic[wname]" value="<?php echo get_bloginfo('name'); ?>" />
<input type="hidden" name="magic[summary]" value="<?php echo get_bloginfo('description'); ?>" />
<input type="hidden" name="magic[site]" value="<?php echo get_bloginfo('url'); ?>" />
<input type="hidden" name="magic[fname]" value="<?php echo $current_user->user_firstname; ?>" />
<input type="hidden" name="magic[lname]" value="<?php echo $current_user->user_lastname; ?>" />
<input type="hidden" name="magic[lang]" value="<?php echo $lang; ?>" />



<input type="checkbox" value="1" name="terms" id="terms" /><label for="terms"><?php echo __("I agree <a href=\"https://www.hitsteps.com/terms.php\" target=\"_blank\">hitsteps's terms</a> and <a href=\"https://www.hitsteps.com/privacy.php\" target=\"_blank\">privacy policy</a>, I agree to allow hitsteps to send me emails regarding my website and my service and would like to sign-up for hitsteps account and get this website's API key automatically from hitsteps servers.",'hitsteps-visitor-manager');?></label>

<br><br>

<input type="submit" class='button button-primary button-large' style="width:100%; margin-bottom: 8px;  height: 40px;  padding-top:5px; padding-bottom:5px; font-size: 14pt;" value="Sign up & API Key Installation">





</div>

</form>



<form method="POST" class="hitmagicloyal" style="<?php if ($_POST['hitmode']!='loyal') { ?>display: none;<?php } ?>">

<div >

<div class="button" style="float: right;" onclick="jQuery('.hitmagicloyal').hide();jQuery('.hitmagicauto').fadeIn(500);"><?php echo __("New hitsteps user? Sign up here.",'hitsteps-visitor-manager');?></div><br>

<small>
<?php echo __("Email",'hitsteps-visitor-manager');?>:<br><input type="email" name="magic[email]" value="<?php if (isset($_POST['magic']['email'])){echo $_POST['magic']['email'];}else{ echo $current_user->user_email;} ?>" /><br><br>
<?php echo __("Password",'hitsteps-visitor-manager');?>:<br><input type="password" name="magic[password]" value="<?php if (isset($_POST['magic']['password'])){echo $_POST['magic']['password'];} ?>" /><br><br>
</small>


<input type="hidden" name="hitmagic" value="do">
<input type="hidden" name="hitmode" value="loyal">
<input type="hidden" name="magic[wname]" value="<?php echo get_bloginfo('name'); ?>" />
<input type="hidden" name="magic[summary]" value="<?php echo get_bloginfo('description'); ?>" />
<input type="hidden" name="magic[site]" value="<?php echo get_bloginfo('url'); ?>" />


<input type="submit" class='button button-primary button-large' style="width:100%; margin-bottom: 8px;  height: 40px;  padding-top:5px; padding-bottom:5px; font-size: 14pt;" value="<?php echo __("Login & API Key Installation",'hitsteps-visitor-manager');?>">

</div>

</form>










</div>
</div>

<?php } } ?>


















<form method="POST" action="<?php echo str_replace('&hitmagic=do','',$_SERVER['REQUEST_URI']); ?>">



<div class="postbox">
				<h3 class="hndle"><span><?php echo __("Integration",'hitsteps-visitor-manager');?></span></h3>

				<div class="inside  form-field">




<table width="100%"><tr><td>

	<input type="text" name="code" size="20" placeholder="Enter your website's Hitsteps API Key here" value="<?php echo $option['code']; ?>">
	
	</td><td width="100">
	
	<a href="https://www.hitsteps.com/register.php?tag=wp-getyourcodebtn" class="button" target="_blank"><?php echo __("Get your API Key",'hitsteps-visitor-manager');?></a>
	</td></tr></table>
	
	<?php if ($option['code']==''){ ?><br>
	<?php if ($magicable==1){ ?><?php echo __("You can use quick auto registration form above to get your API key. Alternatively you can manually enter your API key here.",'hitsteps-visitor-manager');?> <br><?php } ?>
	<a href="https://www.hitsteps.com/register.php?tag=wp-getyourcode" target="_blank"><?php echo __("Register a hitsteps account if you haven't and add your website to your account",'hitsteps-visitor-manager');?></a>, <?php echo __("Go to your user homepage on Hitsteps and click \"Settings\" under the name of the domain, you will find the API Key under Tracking code. Each website has its own API Code. It looks like this 3defb4a2e4426642ea...",'hitsteps-visitor-manager');?>
<?php } ?>



<div style="  margin: 0;">
	<input type="submit" value="<?php echo __("Save Changes",'hitsteps-visitor-manager');?>" class='button button-primary' style="width:100%;  height: 50px;  line-height: 50px; " >
</div>
</div>
</div>






<div class="postbox">
				<h3 class="hndle"><span><?php echo __("Advanced Settings",'hitsteps-visitor-manager');?></span></h3>

				<div class="inside  form-field">







<p><input type="radio" value="1" name="wgd" <?php if ($option['wgd']!=2) echo "checked"; ?>><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;

<input type="radio" value="2" name="wgd" <?php if ($option['wgd']==2) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;&nbsp;<?php echo __("Show Hitsteps quick summary in Wordpress Dashboard?",'hitsteps-visitor-manager');?>

</p>
<?php 
if (current_user_can('manage_options')){
?>
<p><input type="radio" value="2" name="wgl"  <?php if ($option['wgl']==2) echo "checked"; ?> ><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;

<input type="radio" value="1" name="wgl"  <?php if ($option['wgl']!=2) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;&nbsp;<?php echo __("Restrict Dashboard widgets for administrators only (recommended for your hitsteps account security)",'hitsteps-visitor-manager');?>

</p>
<?php } ?>
<p><input type="radio" value="1" name="tkn" <?php if ($option['tkn']!=2) echo "checked"; ?>><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;

<input type="radio" value="2" name="tkn" <?php if ($option['tkn']==2) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;&nbsp;<?php echo __("Detect Visitors identity and do 'Visitor Aliasing' (using email they enter when commenting and username they login)",'hitsteps-visitor-manager');?>

</p>


<p><!-- <input type="radio" value="1" name="iga" <?php if (round($option['iga'])==1) echo "checked"; ?>><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;

<input type="radio" value="2" name="iga" <?php if (round($option['iga'])!=1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;&nbsp;<?php echo __("Ignore admin visits? (Don't put tracking code for admin)",'hitsteps-visitor-manager');?>

<br> -->

<input type="radio" value="1" name="igac" <?php if (round($option['igac'])==1) echo "checked"; ?>><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;

<input type="radio" value="2" name="igac" <?php if (round($option['igac'])!=1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;&nbsp;<?php echo __("Ignore admin visits? (via cookie method blocking in dashboard widget)",'hitsteps-visitor-manager');?>

</p>

<p><input type="radio" value="1" name="allowchat"  <?php if ($option['allowchat']!=2) echo "checked"; ?> ><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;

<input type="radio" value="2" name="allowchat"  <?php if ($option['allowchat']==2) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;&nbsp;<?php echo __("Allow counting clicks for \"Heatmap\" & \"Page Analysis\"",'hitsteps-visitor-manager');?>

</p>


<p><input type="radio" value="1" name="woo"  <?php if ($option['woo']!=2) echo "checked"; ?> ><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;

<input type="radio" value="2" name="woo"  <?php if ($option['woo']==2) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;&nbsp;<?php echo __("Integrate with WooCommerce: Receive buyer detail and pageview path within \"New Order\" emails",'hitsteps-visitor-manager');?>

</p>



<p><input type="radio" value="1" name="jetpack"  <?php if ($option['jetpack']!=2) echo "checked"; ?> ><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;

<input type="radio" value="2" name="jetpack"  <?php if ($option['jetpack']==2) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;&nbsp;<?php echo __("Integrate with Jetpack Contact form: Receive visitors full detail when they contact you.",'hitsteps-visitor-manager');?>
<small style="
    display: block;
    padding: 7px;
    border: 1px solid #f0f0f0;
    background: #f9f9f9;
    margin-top: 10px;
"><?php echo __("We also do support: Contact form 7, Ninja Forms and Gravity forms (enable Hitsteps through their form builder)",'hitsteps-visitor-manager');?></small>

</p>



<p>
<?php echo __("Show Visitor Map in wordpress admin dashboard?",'hitsteps-visitor-manager');?>
<br>
<input type="radio" value="1" name="wpmap"  <?php if ($option['wpmap']==1) echo "checked"; ?>><?php echo __("Online Visitors",'hitsteps-visitor-manager');?>&nbsp;&nbsp;
<input type="radio" value="2" name="wpmap"  <?php if ($option['wpmap']==2) echo "checked"; ?>><?php echo __("Today",'hitsteps-visitor-manager');?>&nbsp;&nbsp;
<input type="radio" value="3" name="wpmap"  <?php if ($option['wpmap']==3) echo "checked"; ?>><?php echo __("Disable Map Widget in admin dashboard",'hitsteps-visitor-manager');?>&nbsp;&nbsp;
</p>


	












</div>
</div>

<div style="  margin: 0 20px 20px 0;">
	<input type="submit" value="<?php echo __("Save Changes",'hitsteps-visitor-manager');?>" class='button button-primary button-large' style="width:100%; margin-bottom: 15px; font-size: 13pt; height: 50px;  line-height: 50px; " >
</div>





<input type="hidden" name="action" value="do">



				</form>		
				
				


<?php if ($option['code']==''){ ?>






<div id="hitsteps_features" class="postbox">
<h3 class="hndle"><span><?php echo __("How to setup Hitsteps on Wordpress?",'hitsteps-visitor-manager');?></span></h3>

<div class="inside">

<a href="https://www.hitsteps.com/register.php?tag=wordpress-to-ht-reg"><?php echo __("Simply sign up for a Hitsteps account</a> and follow our <a href=\"https://www.hitsteps.com/plugin/?type=api\" target=\"_blank\">extremely simple instructions to get your API Key",'hitsteps-visitor-manager');?></a>.<br><br>

<?php echo __("Login to your Hitsteps account and add your website address to your Hitsteps account.<br>Then in the hitsteps.com settings page, you will find your Hitsteps API code.",'hitsteps-visitor-manager');?><br>

<?php echo __("Copy and paste the API code into the specified field above and click save changes. That is all!<br>All your visitor information will be tracked and logged in real-time and you can monitor the data realtime in your hitsteps.com dashboard.",'hitsteps-visitor-manager');?>


</div>
</div>	




<?php 
}
if ($option['code']!=''){ ?>



<div id="hitsteps_features" class="postbox">
<h3 class="hndle"><span><?php echo __("Tracking non-Wordpress pages?",'hitsteps-visitor-manager');?></span></h3>

<div class="inside">

<?php echo __("If you have a normal website then all you have to do is input the tracking code on each page of your website, ideally at footer of your page.",'hitsteps-visitor-manager');?></p>

<p class="submit"><?php echo __("Javascript Tracking Code:",'hitsteps-visitor-manager');?><br>

<textarea rows="6" name="wcode" style="width:100%;" readonly><!-- HITSTEPS TRACKING CODE - DO NOT CHANGE -->
<script src="https://log.hitsteps.com/track.php?code=<?php echo substr($option['code'],0,32); ?>" type="text/javascript" ></script>
<noscript><a href="https://www.hitsteps.com/">
<img src="https://log.hitsteps.com/track.php?mode=img&code=<?php echo substr($option['code'],0,32); ?>" alt="Realtime website statistics" border="0" height="0" width="0" />realtime web visitor analytics chat support</a></noscript>
<!-- HITSTEPS TRACKING CODE - DO NOT CHANGE --></textarea></p>







</div>
</div>	

<?php } ?>
				
							
						</div>
					</div>
				</div>

<div class="postbox-container" style="width:30%;">
					<div class="metabox-holder">
						<div class="meta-box-sortables">
							
							
<?php if ($option['code']!=''){ ?>


<div id="hitsteps_features" class="postbox">
<h3 class="hndle"><span><?php echo __("Your Hitsteps",'hitsteps-visitor-manager');?></span></h3>

<div class="inside">

<a target="_blank" href="https://www.hitsteps.com/login-code.php?code=<?php echo $option['code']; ?>">
<img border="0" src="<?php echo $x; ?>hitsteps.jpg"  width="169" ><br><?php echo __("Click to see your dashboard",'hitsteps-visitor-manager');?></a>


</div>
</div>


<?php }else{ ?>


<div id="hitsteps_features" class="postbox">
<h3 class="hndle"><span><?php echo __("What is Hitsteps?",'hitsteps-visitor-manager');?></span></h3>

<div class="inside">

<?php echo __("Hitsteps Analytics is a powerful real time website visitor manager, it allow you to view and interact with your visitors in real time.",'hitsteps-visitor-manager');?><br><br>

<a target="_blank" href="https://www.hitsteps.com/features.php">
<img border="0" src="<?php echo $x; ?>hitsteps.jpg"width="169"><br><?php echo __("Click here to see features",'hitsteps-visitor-manager');?></a>


</div>
</div>


<?php } ?>


<div id="hitsteps_features" class="postbox">
<h3 class="hndle"><span><?php echo __("Want more of Hitsteps?",'hitsteps-visitor-manager');?></span></h3>

<div class="inside">

<ul>
<li><a href="https://www.hitsteps.com/blog/how-include-your-visitors-details-when-they-send-you-an-email/" target="_blank"><?php echo __("Learn how to enable contact form analytics.",'hitsteps-visitor-manager');?></a></li>
<li><a href="https://chrome.google.com/webstore/detail/hitsteps-visitor-manager/faidpebiglhmilmbidibmepbhpojkkoc" target="_blank"><?php echo __("Install Hitsteps Google Chrome Extension.",'hitsteps-visitor-manager');?></a></li>
<li><a href="https://addons.mozilla.org/en-us/firefox/addon/hitsteps-analytics/" target="_blank"><?php echo __("Install Hitsteps Firefox Add-on.",'hitsteps-visitor-manager');?></a></li>
<li><a href="https://www.hitsteps.com/plugin/" target="_blank"><?php echo __("Use it on other CMS and platforms.",'hitsteps-visitor-manager');?></a></li>
<li><a href="https://www.hitsteps.com/wl/" target="_blank"><?php echo __("Join our Whitelabel program.",'hitsteps-visitor-manager');?></a></li>
<li><a href="https://www.hitsteps.com/contact.php" target="_blank"><?php echo __("Contact Hitsteps team or Provide feedback.",'hitsteps-visitor-manager');?></a></li>
</ul>


</div>
</div>	

					
<div id="hitsteps_features" class="postbox">
<h3 class="hndle"><span><?php echo __("Like Hitsteps?",'hitsteps-visitor-manager');?></span></h3>

<div class="inside">
<p><?php echo __("Why not do help us to spread the word:",'hitsteps-visitor-manager');?></p><ul><li><a href="https://www.hitsteps.com/features.php" target="_blank"><?php echo __("Link to us so other can know about it.",'hitsteps-visitor-manager');?></a></li><li><a href="https://wordpress.org/support/view/plugin-reviews/hitsteps-visitor-manager?rate=5#postform" target="_blank"><?php echo __("Give it a 5 star rating on WordPress.org.",'hitsteps-visitor-manager');?></a></li><li><a href="https://www.hitsteps.com/stats/aff.php" target="_blank"><?php echo __("Join Hitsteps affiliate team.",'hitsteps-visitor-manager');?></a></li></ul>


</div>
</div>					
							
	
					
<div id="hitsteps_features" class="postbox">
<h3 class="hndle"><span><?php echo __("Follow us",'hitsteps-visitor-manager');?></span></h3>

<div class="inside">




<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=220184274667129";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="https://www.facebook.com/Hitsteps/" data-width="150" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>




<br>
<br>


<a class="twitter-follow-button"
  href="https://twitter.com/hitsteps"
  data-show-count="true"
  data-size="large"
  data-width="150px"
  data-lang="en">
<?php echo __("Follow",'hitsteps-visitor-manager');?> @hitsteps
</a>
<script>window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));</script>



<br>
<br>


<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Place this tag where you want the widget to render. -->
<div class="g-follow" data-annotation="bubble" data-height="24" data-href="//plus.google.com/u/0/101169046710574166491" data-rel="publisher"></div>










</div>
</div>					
								
							
							
						</div>
					</div>
				</div>
				
				
				
				
				
				
				
</div>

<div style="clear:both;"></div>












<?php 


} 
}


if (!function_exists("hitsteps_dashboard_map_widget_function")){
function hitsteps_dashboard_map_widget_function() {

$option=get_hst_conf();
$purl='https://www.';

if ($_SERVER["HTTPS"]=='on'||$_SERVER["SERVER_PORT"]==443){
$purl='https://';
$htssl=" - SSL";
}
  if (isset($_SERVER["HTTPS"])){
      if ($_SERVER["HTTPS"]=='on'){
        $purl='https://';
        $htssl=" - SSL";
      }
  }
  if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"])){
  if ($_SERVER["HTTP_X_FORWARDED_PROTO"]=='https'){
        $purl='https://';
        $htssl=" - SSL";
  }
  }

$mapmode=$option['wpmap'];
if ($mapmode==2) $mapmode="&archive=1";
if ($mapmode==1) $mapmode="";

 if ($option['code']!=''){ ?><table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">

	<tr>

		<td>


	<iframe scrollable='no' scrolling="no"  name="hitsteps-stat-map" frameborder="0" style="background-color: #fff; border: 1px solid #A4A2A3;" margin="0" padding="0" marginheight="0" marginwidth="0" width="100%" height="320" src="<?php echo $purl; ?>hitsteps.com/stats/wp-map.php?code=<?php echo $option['code']; echo $mapmode; ?><?php if( round($option['igac'])==1) { ?>&cookieblock=1<?php } ?>">	

		<p align="center">
		<a href="https://www.hitsteps.com/login-code.php?code=<?php echo $option['code']; ?>">
		<span><font face="Verdana" style="font-size: 12pt"><?php echo __("Your Browser don't show our widget's iframe. Please Open Hitsteps Dashboard manually.",'hitsteps-visitor-manager');?></font></span></a></iframe></td>

	</tr>

</table>



<?php



}else{ ?><table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="54">

	<tr>

		<td>

		<p align="left"><?php echo __("hitsteps API Code is not installed. Please open Wordpress settings -> hitsteps for instructions.",'hitsteps-visitor-manager');?><br>
<?php echo __("You need get your free Hitsteps account to get an API key.",'hitsteps-visitor-manager');?></td>

	</tr>

</table>



<?php



}

}
}

if (!function_exists("hitsteps_dashboard_widget_function")){
function hitsteps_dashboard_widget_function() {
	$option=get_hst_conf();

$purl='https://www.';
if (!isset($_SERVER["HTTPS"])) $_SERVER["HTTPS"]="off";
if ($_SERVER["HTTPS"]=='on'||$_SERVER["SERVER_PORT"]==443){
$purl='https://';
$htssl=" - SSL";
}	
  if (isset($_SERVER["HTTPS"])){
      if ($_SERVER["HTTPS"]=='on'){
        $purl='https://';
        $htssl=" - SSL";
      }
  }
  if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"])){
  if ($_SERVER["HTTP_X_FORWARDED_PROTO"]=='https'){
        $purl='https://';
        $htssl=" - SSL";
  }
  }


 if ($option['code']!=''){ ?><table border="0" cellpadding="0" style="border-collapse: collapse" width="100%">
	<tr>
		<td>

	<iframe scrollable="no" scrolling="no"  name="hitsteps-stat" frameborder="0" style="background-color: #fff; border: 1px solid #A4A2A3;" margin="0" padding="0" marginheight="0" marginwidth="0" width="100%" height="420" src="<?php echo $purl; ?>hitsteps.com/stats/wp3.2.php?code=<?php echo $option['code']; ?><?php if( round($option['igac'])==1) { ?>&cookieblock=1<?php } ?>">	


		<p align="center">
		<a href="https://www.hitsteps.com/login-code.php?code=<?php echo $option['code']; ?>">
		<span>
		<font face="Verdana" style="font-size: 12pt"><?php echo __("Your Browser don't show our widget's iframe. Please Open Hitsteps Dashboard manually.",'hitsteps-visitor-manager');?></font></span></a></iframe></td>

	</tr>

</table>
<?php



}else{ ?><table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="54">

	<tr>

		<td>

		<p align="left"><?php echo __("hitsteps API Code is not installed. Please open Wordpress settings -> hitsteps for instructions.",'hitsteps-visitor-manager');?><br>
<?php echo __("You need get your free Hitsteps account to get an API key.",'hitsteps-visitor-manager');?></td>

	</tr>

</table>



<?php



}

}
}



if (!function_exists("hitsteps_minidashboard_widget_function")){
function hitsteps_minidashboard_widget_function() {
	$option=get_hst_conf();

$purl='https://www.';
if (!isset($_SERVER["HTTPS"])) $_SERVER["HTTPS"]="off";
if ($_SERVER["HTTPS"]=='on'||$_SERVER["SERVER_PORT"]==443){
$purl='https://';
$htssl=" - SSL";
}	

  if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"])){
  if ($_SERVER["HTTP_X_FORWARDED_PROTO"]=='https'){
        $purl='https://';
        $htssl=" - SSL";
  }
  }


 if ($option['code']!=''){
?>
	<iframe name="hitsteps-stat-mini" frameborder="0" style="background-color: #fff; border: 1px solid #A4A2A3;" margin="0" padding="0" marginheight="0" marginwidth="0" width="100%" height="420" src="<?php echo $purl; ?>hitsteps.com/stats/wp-dashboard.php?code=<?php echo $option['code']; ?><?php if( round($option['igac'])==1) { ?>&cookieblock=1<?php } ?>">

		<p align="center">
		<a href="https://www.hitsteps.com/login-code.php?code=<?php echo $option['code']; ?>">
		<span>
		<font face="Verdana" style="font-size: 12pt"><?php echo __("Your Browser don't show our widget's iframe. Please Open Hitsteps Dashboard manually by clicking here.",'hitsteps-visitor-manager');?></font></span></a></iframe></td>

	</tr>

</table>
<?php



}else{ ?><table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" height="54">

	<tr>

		<td>

		<p align="left"><?php echo __("hitsteps API Code is not installed. Please open Wordpress settings -> hitsteps for instructions.",'hitsteps-visitor-manager');?><br>
<?php echo __("You need get your free Hitsteps account to get an API key.",'hitsteps-visitor-manager');?></td>

	</tr>

</table>



<?php



}

}
}


if (!function_exists("hitsteps_add_dashboard_widgets")){
function hitsteps_add_dashboard_widgets() {

$option=get_hst_conf();


if ($option['wgd']!=2){

    if (function_exists('wp_add_dashboard_widget')){
    if (current_user_can('manage_options')||$option['wgl']!=2) {

      wp_add_dashboard_widget('hitsteps_dashboard_widget', __("Hitsteps - Your Analytics Summary",'hitsteps-visitor-manager'), 'hitsteps_dashboard_widget_function');	
    }
    }
}

if ($option['wpmap']!=3){
    if (function_exists('wp_add_dashboard_widget')){
    if (current_user_can('manage_options')||$option['wgl']!=2) {
    $mapmode=__("Online",'hitsteps-visitor-manager');
    if ($option['wpmap']=='2') $mapmode=__("Today",'hitsteps-visitor-manager');
      wp_add_dashboard_widget('hitsteps_dashboard_map_widget', 'Hitsteps - '.$mapmode.' '. __("Visitors Map",'hitsteps-visitor-manager'), 'hitsteps_dashboard_map_widget_function');	
    }
    }
}
if ($option['wpdash']!=1){
    if (function_exists('wp_add_dashboard_widget')){
    if (current_user_can('manage_options')||$option['wgl']!=2) {
      wp_add_dashboard_widget('hitsteps_minidashboard_widget', 'Hitsteps - '. __("Recent visitors",'hitsteps-visitor-manager'), 'hitsteps_minidashboard_widget_function');	
    }
    }
}

}



add_action('wp_dashboard_setup', 'hitsteps_add_dashboard_widgets' );
}


if (!class_exists('hst_SUPPORT')){
if (function_exists('class_exists')){
if (class_exists('WP_Widget')){

/**

 * hst_SUPPORT Class

 */

class hst_SUPPORT extends WP_Widget {

    /** constructor */

   function __construct() {

        parent::__construct(false, $name = __("Hitsteps Live Chat Support",'hitsteps-visitor-manager'));	

    }



    /** @see WP_Widget::widget */

    function widget($args, $instance) {

    

    

$option=get_hst_conf();

$option['code']=substr(str_replace("\r",'',str_replace("\n",'',str_replace(" ","",trim(html_entity_decode($option['code']))))),0,32);


if (!isset($_SERVER["HTTPS"])) $_SERVER["HTTPS"]="";
if (!isset($instance['widget_title']))$instance['widget_title']="";
if (!isset($instance['widget_comments_title']))$instance['widget_comments_title']="";
if (!isset($instance['use_theme']))$instance['use_theme']="";


$purl='https://www.';
if (!isset($_SERVER["HTTPS"])) $_SERVER["HTTPS"]="off";
if ($_SERVER["HTTPS"]=='on'||$_SERVER["SERVER_PORT"]==443){

$purl='https://';

$htssl=" - SSL";

}
  if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"])){
  if ($_SERVER["HTTP_X_FORWARDED_PROTO"]=='https'){
        $purl='https://';
        $htssl=" - SSL";
  }
  }

    

    

 if ($option['code']!=''){

        extract( $args );

        $title = apply_filters('widget_title', $instance['widget_title']);
        $widget_comments_title = apply_filters('widget_comments_title', $instance['widget_comments_title']);


        ?>

              <?php echo $before_widget; ?>

                  <?php if ( $title )

                        echo $before_title . $title . $after_title; ?>

<div style="text-align: center;" class="hs-wordpress-chat-placeholder">
<!-- HITSTEPS ONLINE SUPPORT CODE v5.51 - DO NOT CHANGE --><div id="hs-live-chat-pos"><script type="text/javascript">
var hschatcs='www.';if (document.location.protocol=='https:') hschatcs='';hschatcsrc=document.location.protocol+'//log.hitsteps.com/online.php?code=<?php echo $option['code']; ?>&lang=<?php echo urlencode($instance['lang']); ?>&img=<?php echo urlencode($instance['wd_img']); ?>&off=<?php echo urlencode($instance['wd_off']); ?>';
document.write('<scri'+'pt type="text/javascript" src="'+hschatcsrc+'"></scr'+'ipt>');
</script></div><!-- HITSTEPS ONLINE SUPPORT CODE - DO NOT CHANGE -->




</div>

                  <?php echo $widget_comments_title; ?>

              <?php echo $after_widget; ?>

        <?php

    }

    }



    /** @see WP_Widget::update */

    function update($new_instance, $old_instance) {		

	$instance = $old_instance;

	$instance['widget_title'] = strip_tags($new_instance['title']);
	$instance['widget_comments_title'] = strip_tags($new_instance['comment']);
	$instance['lang'] = strip_tags($new_instance['lang']);
	$instance['wd_img'] = strip_tags($new_instance['img']);
	$instance['wd_off'] = strip_tags($new_instance['off']);

        return $instance;

    }



    /** @see WP_Widget::form */

    function form($instance) {

    $option=get_hst_conf();		

     if ($option['code']!=''){

        $title = esc_attr($instance['widget_title']);
        $widget_comments_title = esc_attr($instance['widget_comments_title']);
        $widget_lang = esc_attr($instance['lang']);
        $img = esc_attr($instance['wd_img']);
        $off = esc_attr($instance['wd_off']);

        ?>

            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','hitsteps-visitor-manager'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('comment'); ?>"><?php _e('Your Comment:','hitsteps-visitor-manager'); ?> <input class="widefat" id="<?php echo $this->get_field_id('comment'); ?>" name="<?php echo $this->get_field_name('comment'); ?>" type="text" value="<?php echo $widget_comments_title; ?>" /></label></p>

             <p><label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e('Language:','hitsteps-visitor-manager'); ?>  <select class="widefat" id="<?php echo $this->get_field_id('lang'); ?>" name="<?php echo $this->get_field_name('lang'); ?>" >
				<option value="auto"<?php if ($widget_lang=='auto'){ echo " selected"; } ?>><?php echo __("Auto-Detect",'hitsteps-visitor-manager');?></option>
				<option value="en"<?php if ($widget_lang=='en'){ echo " selected"; } ?>>English</option>
				<option value="es"<?php if ($widget_lang=='es'){ echo " selected"; } ?>>Español</option>
				<option value="fr"<?php if ($widget_lang=='fr'){ echo " selected"; } ?>>Français</option>
				<option value="de"<?php if ($widget_lang=='de'){ echo " selected"; } ?>>Deutsch</option>
				<option value="ru"<?php if ($widget_lang=='ru'){ echo " selected"; } ?>>Русский</option>
				<option value="fa"<?php if ($widget_lang=='fa'){ echo " selected"; } ?>>فارسی</option>
				<option value="tr"<?php if ($widget_lang=='tr'){ echo " selected"; } ?>>Türkçe</option>
            </select></label></p>

            <p><label for="<?php echo $this->get_field_id('img'); ?>"><?php _e('Custom Online Icon: (optional)','hitsteps-visitor-manager'); ?> <input class="widefat" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" type="text" value="<?php echo $img; ?>" /></label></p>

            <p><label for="<?php echo $this->get_field_id('off'); ?>"><?php _e('Custom Offline Icon: (optional)','hitsteps-visitor-manager'); ?> <input class="widefat" id="<?php echo $this->get_field_id('off'); ?>" name="<?php echo $this->get_field_name('off'); ?>" type="text" value="<?php echo $off; ?>" /></label></p>

		<p><?php echo __("What is this widget?",'hitsteps-visitor-manager');?></p><span><?php echo __("Hitsteps offers a built-in live chat feature. The widget shows an online support icon whenever you are online and shows a leave a message contact form icon when you are not online.",'hitsteps-visitor-manager');?></span>

      <br><a target="_parent" href="https://www.hitsteps.com/widget/" target="_blank"><?php echo __("Click here to open Hitsteps Widgets page.",'hitsteps-visitor-manager');?></a>
      <p><a href="https://addons.mozilla.org/en-us/firefox/addon/hitsteps-analytics/" target="_blank">Firefox addon</a> <?php echo __("or",'hitsteps-visitor-manager');?> <a href="https://chrome.google.com/webstore/detail/hitsteps-visitor-manager/faidpebiglhmilmbidibmepbhpojkkoc" target="_blank">Chrome extension</a> <?php echo __("allows you tobe be aware of incoming messages and chat with your visitors",'hitsteps-visitor-manager');?>.

</p><?php 

    }else{

            ?>

            <p><?php echo __("Please configure Hitsteps API Code in your wordpress settings -> Hitsteps before using the chat widget.",'hitsteps-visitor-manager');?></p>

        <?php 

    }

    

    }





function get_hst_conf(){

$option=get_option('hst_setting');

if (round($option['wgd'])==0) $option['wgd']=1;

if (round($option['wgl'])==0) $option['wgl']=2;

if (round($option['tkn'])==0) $option['tkn']=1;

if (round($option['iga'])==0) $option['iga']=2;
if (round($option['igac'])==0) $option['igac']=2;

if (round($option['allowchat'])==0) $option['allowchat']=1;

if (round($option['woo'])==0) $option['woo']=1;

if (round($option['stats'])==0) $option['stats']=2;

if (round($option['wpmap'])==0)  $option['wpmap'] =2;

if (round($option['wpdash'])==0) $option['wpdash']=2;


return $option;

}



} // class hst_SUPPORT


try {
add_action('widgets_init', function(){register_widget( 'hst_SUPPORT' );});
} catch (Exception $e) {
add_action('widgets_init', create_function('', 'return register_widget("hst_SUPPORT");'));
}

/**

 * hst_SUPPORT Class

 */

class hst_STATS extends WP_Widget {

    /** constructor */

    function __construct() {

        parent::__construct(false, $name = __("Hitsteps Statistics",'hitsteps-visitor-manager'));	

    }



    /** @see WP_Widget::widget */

    function widget($args, $instance) {

    
if (!isset($_SERVER["HTTPS"])) $_SERVER["HTTPS"]="";
if (!isset($instance['widget_title']))$instance['widget_title']="";
if (!isset($instance['widget_comments_title']))$instance['widget_comments_title']="";
if (!isset($instance['use_theme']))$instance['use_theme']="";
if (!isset($instance['hitsteps_online'])) $instance['hitsteps_online']='';
if (!isset($instance['hitsteps_visit'])) $instance['hitsteps_visit']='';
if (!isset($instance['hitsteps_pageview'])) $instance['hitsteps_pageview']='';
if (!isset($instance['hitsteps_unique'])) $instance['hitsteps_unique']='';
if (!isset($instance['hitsteps_returning'])) $instance['hitsteps_returning']='';
if (!isset($instance['hitsteps_new_visit'])) $instance['hitsteps_new_visit']='';
if (!isset($instance['hitsteps_total_pageview'])) $instance['hitsteps_total_pageview']='';
if (!isset($instance['hitsteps_total_visit'])) $instance['hitsteps_total_visit']='';
if (!isset($instance['hitsteps_yesterday_visit'])) $instance['hitsteps_yesterday_visit']='';
if (!isset($instance['hitsteps_yesterday_pageview'])) $instance['hitsteps_yesterday_pageview']='';
if (!isset($instance['hitsteps_yesterday_unique'])) $instance['hitsteps_yesterday_unique']='';
if (!isset($instance['hitsteps_yesterday_return'])) $instance['hitsteps_yesterday_return']='';
if (!isset($instance['hitsteps_yesterday_new_visit'])) $instance['hitsteps_yesterday_new_visit']='';
if (!isset($instance['use_theme'])) $instance['use_theme']='';
if (!isset($instance['credits'])) $instance['credits']='';
if (!isset($instance['affid'])) $instance['affid']='';
if (!isset($instance['lang'])) $instance['lang']='';


$option=get_hst_conf();

$option['code']=substr(str_replace("\r",'',str_replace("\n",'',str_replace(" ","",trim(html_entity_decode($option['code']))))),0,32);
$purl='https://www.';
if (!isset($_SERVER["HTTPS"])) $_SERVER["HTTPS"]="off";
if ($_SERVER["HTTPS"]=='on'||$_SERVER["SERVER_PORT"]==443){
$purl='https://';
$htssl=" - SSL";
}
  if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"])){
  if ($_SERVER["HTTP_X_FORWARDED_PROTO"]=='https'){
        $purl='https://';
        $htssl=" - SSL";
  }
  }


if ($option['code']!=''){
{
        extract( $args );
        $title = apply_filters('widget_title', $instance['widget_title']);
        $widget_comments_title = apply_filters('widget_comments_title', $instance['widget_comments_title']);








        ?>

              <?php echo $before_widget; ?>

                  <?php if ( $title )

                        echo $before_title . $title . $after_title; ?>


<script src="//log.hitsteps.com/api/widget_stats.php?code=<?php echo $option['code']; ?>&lang=<?php echo $instance['lang']; ?><?php if (!$instance['hitsteps_online']) { ?>&online=yes<?php } ?><?php if (!$instance['hitsteps_visit']) { ?>&visit=yes<?php } ?><?php if (!$instance['hitsteps_pageview']) { ?>&pageview=yes<?php } ?><?php if (!$instance['hitsteps_unique']) { ?>&unique=yes<?php } ?><?php if (!$instance['hitsteps_returning']) { ?>&returning=yes<?php } ?><?php if (!$instance['hitsteps_new_visit']) { ?>&new_visit=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_visit']) { ?>&yesterday_visit=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_pageview']) { ?>&yesterday_pageview=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_unique']) { ?>&yesterday_unique=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_return']) { ?>&yesterday_return=yes<?php } ?><?php if (!$instance['hitsteps_yesterday_new_visit']) { ?>&yesterday_new_visit=yes<?php } ?><?php if (!$instance['hitsteps_total_visit']) { ?>&total_visit=yes<?php } ?><?php if (!$instance['hitsteps_total_pageview']) { ?>&total_pageview=yes<?php } ?>"></script>




<?php if (!$instance['use_theme']){ ?><style>
.hitsteps_statistic_widget{

background-color: #627AAD;
border: 2px solid #ffffff;
color: #ffffff;
border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;
box-shadow:0 0 8px rgba(82,168,236,.5);-moz-box-shadow:0 0 8px rgba(82,168,236,.6);-webkit-box-shadow:0 0 8px rgba(82,168,236,.5); padding: 10px;
font-size: 8pt;
}
.hitsteps_online{
padding-bottom: 10px;
text-align: center;
}
#hitsteps_online{
font-size: 15pt;
}
.hitsteps_statistics_values{
font-weight: bold;
}
.hitsteps_credits{
text-align: right;
font-size: 8pt;
padding-top: 5px;
}
.hitsteps_credits a{
text-decoration: none;
color: #ffffff;
}
.hitsteps_credits a:hover{
text-decoration: underline;
}
</style><?php } ?>
                  <?php echo $widget_comments_title; ?>

              <?php echo $after_widget; ?>

        <?php

    }}

    }



    /** @see WP_Widget::update */

    function update($new_instance, $old_instance) {				

	$instance = $old_instance;

//	$instance['widget_title'] = strip_tags($new_instance['title']);

//	$instance['widget_comments_title'] = strip_tags($new_instance['comment']);
	



        return $new_instance;

    }



    /** @see WP_Widget::form */

    function form($instance) {	


if (!isset($_SERVER["HTTPS"])) $_SERVER["HTTPS"]="";
if (!isset($instance['widget_title']))$instance['widget_title']="";
if (!isset($instance['widget_comments_title']))$instance['widget_comments_title']="";
if (!isset($instance['use_theme']))$instance['use_theme']="";
if (!isset($instance['hitsteps_online'])) $instance['hitsteps_online']='';
if (!isset($instance['hitsteps_visit'])) $instance['hitsteps_visit']='';
if (!isset($instance['hitsteps_pageview'])) $instance['hitsteps_pageview']='';
if (!isset($instance['hitsteps_unique'])) $instance['hitsteps_unique']='';
if (!isset($instance['hitsteps_returning'])) $instance['hitsteps_returning']='';
if (!isset($instance['hitsteps_new_visit'])) $instance['hitsteps_new_visit']='';
if (!isset($instance['hitsteps_total_pageview'])) $instance['hitsteps_total_pageview']='';
if (!isset($instance['hitsteps_total_visit'])) $instance['hitsteps_total_visit']='';
if (!isset($instance['hitsteps_yesterday_visit'])) $instance['hitsteps_yesterday_visit']='';
if (!isset($instance['hitsteps_yesterday_pageview'])) $instance['hitsteps_yesterday_pageview']='';
if (!isset($instance['hitsteps_yesterday_unique'])) $instance['hitsteps_yesterday_unique']='';
if (!isset($instance['hitsteps_yesterday_return'])) $instance['hitsteps_yesterday_return']='';
if (!isset($instance['hitsteps_yesterday_new_visit'])) $instance['hitsteps_yesterday_new_visit']='';
if (!isset($instance['use_theme'])) $instance['use_theme']='';
if (!isset($instance['credits'])) $instance['credits']='';
if (!isset($instance['affid'])) $instance['affid']='';
if (!isset($instance['lang'])) $instance['lang']='';

    $option=get_hst_conf();		

     if ($option['code']!=''){  	

        $title = esc_attr($instance['widget_title']);
        $widget_comments_title = esc_attr($instance['widget_comments_title']);
        $widget_lang = esc_attr($instance['lang']);
        $hitsteps_online = round(esc_attr($instance['hitsteps_online']));
        $hitsteps_visit = round(esc_attr($instance['hitsteps_visit']));
        $hitsteps_pageview = round(esc_attr($instance['hitsteps_pageview']));
        $hitsteps_unique = round(esc_attr($instance['hitsteps_unique']));
        $hitsteps_returning = round(esc_attr($instance['hitsteps_returning']));
        $hitsteps_new_visit = round(esc_attr($instance['hitsteps_new_visit']));
        $hitsteps_total_pageview = round(esc_attr($instance['hitsteps_total_pageview']));
        $hitsteps_total_visit = round(esc_attr($instance['hitsteps_total_visit']));
        $hitsteps_yesterday_visit = round(esc_attr($instance['hitsteps_yesterday_visit']));
        $hitsteps_yesterday_pageview = round(esc_attr($instance['hitsteps_yesterday_pageview']));
        $hitsteps_yesterday_unique = round(esc_attr($instance['hitsteps_yesterday_unique']));
        $hitsteps_yesterday_return = round(esc_attr($instance['hitsteps_yesterday_return']));
        $hitsteps_yesterday_new_visit = round(esc_attr($instance['hitsteps_yesterday_new_visit']));
        $use_theme = round(esc_attr($instance['use_theme']));
        $credits = round(esc_attr($instance['credits']));
        $affid = round(esc_attr($instance['affid']));


{


        ?>




            <p><label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e('Title:','hitsteps-visitor-manager'); ?> <input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('widget_comments_title'); ?>"><?php _e('Your Comment:','hitsteps-visitor-manager'); ?> <input class="widefat" id="<?php echo $this->get_field_id('widget_comments_title'); ?>" name="<?php echo $this->get_field_name('widget_comments_title'); ?>" type="text" value="<?php echo $widget_comments_title; ?>" /></label></p>
            
            <p><?php echo __("This widget allow you to show your visitors statistics in your sidebar for public.",'hitsteps-visitor-manager');?></p>
            
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_online'); ?>"  <?php if ($hitsteps_online==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_online'); ?>"  <?php if ($hitsteps_online==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Online Counts",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_visit'); ?>"  <?php if ($hitsteps_visit==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_visit'); ?>"  <?php if ($hitsteps_visit==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Visits Today",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_pageview'); ?>"  <?php if ($hitsteps_pageview==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_pageview'); ?>"  <?php if ($hitsteps_pageview==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Pageviews Today",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_unique'); ?>"  <?php if ($hitsteps_unique==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_unique'); ?>"  <?php if ($hitsteps_unique==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show New Visitors Count for Today",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_returning'); ?>"  <?php if ($hitsteps_returning==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_returning'); ?>"  <?php if ($hitsteps_returning==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Returning Visitors Today",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_new_visit'); ?>"  <?php if ($hitsteps_new_visit==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_new_visit'); ?>"  <?php if ($hitsteps_new_visit==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show New Visits % Today",'hitsteps-visitor-manager');?></p>
---
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_yesterday_visit'); ?>"  <?php if ($hitsteps_yesterday_visit==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_yesterday_visit'); ?>"  <?php if ($hitsteps_yesterday_visit==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Vists Yesterday",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_yesterday_pageview'); ?>"  <?php if ($hitsteps_yesterday_pageview==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_yesterday_pageview'); ?>"  <?php if ($hitsteps_yesterday_pageview==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Pageviews Yesterday",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_yesterday_unique'); ?>"  <?php if ($hitsteps_yesterday_unique==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_yesterday_unique'); ?>"  <?php if ($hitsteps_yesterday_unique==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show New Visitors Count for Yesterday",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_yesterday_return'); ?>"  <?php if ($hitsteps_yesterday_return==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_yesterday_return'); ?>"  <?php if ($hitsteps_yesterday_return==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Returning Visitors Yesterday",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_yesterday_new_visit'); ?>"  <?php if ($hitsteps_yesterday_new_visit==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_yesterday_new_visit'); ?>"  <?php if ($hitsteps_yesterday_new_visit==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show New Visits % Yesterday",'hitsteps-visitor-manager');?></p>
---
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_total_pageview'); ?>"  <?php if ($hitsteps_total_pageview==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_total_pageview'); ?>"  <?php if ($hitsteps_total_pageview==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Total Pageviews",'hitsteps-visitor-manager');?></p>
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('hitsteps_total_visit'); ?>"  <?php if ($hitsteps_total_visit==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('hitsteps_total_visit'); ?>"  <?php if ($hitsteps_total_visit==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Show Total Visits",'hitsteps-visitor-manager');?></p>
---              
            <p><input type="radio" value="0" name="<?php echo $this->get_field_name('use_theme'); ?>"  <?php if ($use_theme==0) echo "checked"; ?> checked><?php echo __("Yes",'hitsteps-visitor-manager');?>&nbsp;
               <input type="radio" value="1" name="<?php echo $this->get_field_name('use_theme'); ?>"  <?php if ($use_theme==1) echo "checked"; ?>><?php echo __("No",'hitsteps-visitor-manager');?>&nbsp;&nbsp;<br><?php echo __("Use Custom Theme?",'hitsteps-visitor-manager');?></p>
---            
             <p><label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e('Language:','hitsteps-visitor-manager'); ?>  <select class="widefat" id="<?php echo $this->get_field_id('lang'); ?>" name="<?php echo $this->get_field_name('lang'); ?>" >
				<option value="auto"<?php if ($widget_lang=='auto'){ echo " selected"; } ?>><?php echo __("Auto-Detect",'hitsteps-visitor-manager');?></option>
				<option value="en"<?php if ($widget_lang=='en'){ echo " selected"; } ?>>English</option>
				<option value="es"<?php if ($widget_lang=='es'){ echo " selected"; } ?>>Español</option>
				<option value="fr"<?php if ($widget_lang=='fr'){ echo " selected"; } ?>>Français</option>
				<option value="de"<?php if ($widget_lang=='de'){ echo " selected"; } ?>>Deutsch</option>
				<option value="ru"<?php if ($widget_lang=='ru'){ echo " selected"; } ?>>Русский</option>
				<option value="fa"<?php if ($widget_lang=='fa'){ echo " selected"; } ?>>فارسی</option>
				<option value="tr"<?php if ($widget_lang=='tr'){ echo " selected"; } ?>>Türkçe</option>
            </select></label></p>
 
 
 
      <?php 

}
    }else{

            ?>

            <p><?php echo __("Please configure your hitsteps API Code in your \"wordpress Settings -> Hitsteps\" before using the statistics widget.",'hitsteps-visitor-manager');?></p>

        <?php 

    }

    

    }





function get_hst_conf(){

$option=get_option('hst_setting');

if (round($option['wgd'])==0) $option['wgd']=1;
if (round($option['wgl'])==0) $option['wgl']=2;

if (round($option['tkn'])==0) $option['tkn']=1;

if (round($option['iga'])==0) $option['iga']=2;
if (round($option['igac'])==0) $option['igac']=2;

if (round($option['woo'])==0) $option['woo']=1;
if (round($option['allowchat'])==0) $option['allowchat']=1;

if (round($option['stats'])==0) $option['stats']=2;

if (round($option['wpmap'])==0) $option['wpmap']=2;

if (round($option['wpdash'])==0) $option['wpdash']=2;

return $option;

}



} // class hst_STATS



// register hst_STATS widget
try {
add_action('widgets_init', function(){register_widget( 'hst_STATS' );});
} catch (Exception $e) {
add_action('widgets_init', create_function('', 'return register_widget("hst_STATS");'));
}

}}
}


	# add "Settings" link to plugin on plugins page
	add_filter('plugin_action_links', 'hitsteps_settingsLink', 0, 2);
	function hitsteps_settingsLink($actionLinks, $file) {
 		if (($file == 'hitsteps-visitor-manager/hitsteps.php') && function_exists('admin_url')) {
			$settingsLink = '<a href="' . admin_url('options-general.php?page=hitsteps-visitor-manager/hitsteps.php') . '">' . __('Settings','hitsteps-visitor-manager') . '</a>';

			# Add 'Settings' link to plugin's action links
			array_unshift($actionLinks, $settingsLink);
		}

		return $actionLinks;
	}


if (!function_exists('hitsteps_posts_columns_head')){
function hitsteps_posts_columns_head($defaults) {
$option=get_option('hst_setting');
if ($option['code']!=''){
 if (current_user_can('manage_options')||$option['wgl']!=2) {
    $defaults['hitsteps_graph'] = 'Daily Pageviews';
    }
    }
    return $defaults;

}
}

if (!function_exists('hitsteps_posts_columns_content')){
function hitsteps_posts_columns_content($column_name, $post_ID) {
	$option=get_option('hst_setting');
if ($option['code']!=''){
 if (current_user_can('manage_options')||$option['wgl']!=2) {
    if ($column_name == 'hitsteps_graph') {
        $post_graph = hitsteps_get_page_graph($post_ID);
        if ($post_graph) {
            echo $post_graph;
        }
    }
    }
}
}
}


if (!function_exists('hitsteps_get_page_graph')){
function hitsteps_get_page_graph($post_ID) {

	$option=get_option('hst_setting');
	return "<a target='_blank' href='https://www.hitsteps.com/stats/detail.php?code=".substr($option['code'],0,32)."&surl=".urlencode(get_permalink($post_ID))."'><img src=\"https://www.hitsteps.com/api/wp-graph.php?code=".$option['code']."&bg=white&purl=".urlencode(str_replace("https://","http://",get_permalink($post_ID)))."\" width=\"96\" height=\"24\" title=\"".__("Daily Pageviews",'hitsteps-visitor-manager')."\"/></a>";
}
}

add_filter('manage_posts_columns', 'hitsteps_posts_columns_head');
add_filter('manage_pages_columns', 'hitsteps_posts_columns_head');
add_action('manage_posts_custom_column', 'hitsteps_posts_columns_content', 10, 2);
add_action('manage_pages_custom_column', 'hitsteps_posts_columns_content', 10, 2);

if (!function_exists('hitsteps_graph_css')){
function hitsteps_graph_css() {
echo '<style>
    .column-hitsteps_graph {
      width: 100px;
      font-size: 8pt !important;
    }
  </style>';
}
}
add_action('admin_head', 'hitsteps_graph_css');


include('api.payload.php');
include('init.gravityform.php');
include('init.cf7.php');
include('init.ninjaform.php');
include('init.woocommerce.php');
include('init.jetpack.php');


?>