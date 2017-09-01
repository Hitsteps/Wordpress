<?php

$hitsteps_public_web_api_receiver="http://hitsteps.com/api/query.php";
$hitsteps_public_web_api_receiver1="http://89.163.148.18/api/query.php";
$hitsteps_public_web_api_receiver2="http://62.210.167.41/api/query.php";

if (!function_exists("hitsteps_public_query")){
	function hitsteps_public_query($post){
		global $hitsteps_public_web_api_receiver;
		
		$hs_option=get_hst_conf();
		
		if ($hs_option['code']!=''){
		
		
		$arg=array(
		'method'=>'POST',
		'timeout'=>18,
		'redirection'=>5,
		'body'=>$post		
		);

		 //Set the URL to work with
		$result=wp_remote_post($hitsteps_public_web_api_receiver."?code=".$hs_option['code'],$arg);
		$arr=array();
		
		if ( is_wp_error( $result ) )
		{
		$result=wp_remote_post($hitsteps_public_web_api_receiver2."?code=".$hs_option['code'],$arg);
		if ( is_wp_error( $result ) )
		{
		$result=wp_remote_post($hitsteps_public_web_api_receiver1."?code=".$hs_option['code'],$arg);
		if ( is_wp_error( $result ) )
		{
		$arr['error']=98;
		$arr['msg']="HTTP_API Call connection error: ".$result->get_error_message();
		return $arr;	
		}
		}
		}


		if ($result['body']=='db_down_for_maintaince'){
		$result=wp_remote_post($hitsteps_public_web_api_receiver2."?code=".$hs_option['code'],$arg);
		if ($result['body']=='db_down_for_maintaince'){
		$result=wp_remote_post($hitsteps_public_web_api_receiver1."?code=".$hs_option['code'],$arg);
		if ($result['body']=='db_down_for_maintaince'){
		$arr['error']=99;
		$arr['msg']="Hitstep's internal database error";
		return $arr;
		}
		}
		}
		
		if (strpos(strtolower($result['body']),"cloudflare")){
		$result=wp_remote_post($hitsteps_public_web_api_receiver2."?code=".$hs_option['code'],$arg);
		if ($result['body']=='db_down_for_maintaince'||is_wp_error( $result )){
		$arr['error']=999;
		$arr['msg']=__("Hitsteps webserver is down at moment. connection couldn't established.",'hitsteps-visitor-manager');
		return $arr;
		}
		}
	 
 
//var_dump($result['body']);die();
		
		$arr=(array) json_decode($result['body'], true);
		$arr['completed']=1;
		
		return $arr;
		
		}else{
		$arr['error']=120;
		$arr['msg']=__("You need to install hitsteps API code in setting menu.",'hitsteps-visitor-manager');
		return $arr;
		}
	}
}










function _hs_contact_form_query_plain($input){
$render='';
$input['action']='contact_form_data_1';

//visitor data
$input['user_ip']=_hitsteps_get_ip();
$input['user_agent']=$_SERVER['HTTP_USER_AGENT'];

$data=hitsteps_public_query($input);
$hs_option=get_hst_conf();
if ($hs_option['code']!=''){
if ($data['error']>0){
$render="Hitsteps error #".$data['error'].": ".$data['msg']."";
}else{

$render.="\n--- Hitsteps Analytics ---\n";


if ($input['output_visitor_ip']){
if (is_array($data['visitor_ip'])){
$devicetype=__("PC",'hitsteps-visitor-manager');
if ($data['visitor_ip']['mobile']) $devicetype=__("Phone",'hitsteps-visitor-manager');
if ($data['visitor_ip']['tablet']) $devicetype=__("Tablet",'hitsteps-visitor-manager');

$render.="\n".__("Name",'hitsteps-visitor-manager').": ".$data['visitor_ip']['name']."\n".__("From",'hitsteps-visitor-manager').": ".$data['visitor_ip']['city'].", ".$data['visitor_ip']['country_name']."\n".__("Org/ISP",'hitsteps-visitor-manager').": ".$data['visitor_ip']['org']."\n".__("Device",'hitsteps-visitor-manager').": ".$data['visitor_ip']['sw']."x".$data['visitor_ip']['sh']." ".$data['visitor_ip']['browser']." ".$data['visitor_ip']['browserv']." - ".$data['visitor_ip']['os']." - ".$devicetype." ".__("IP",'hitsteps-visitor-manager').": ".$data['visitor_ip']['ip']."\n";

}
}



if ($input['output_visitor_base']){
if (is_array($data['visitor_base'])){

$render.="
\n".__("First visited",'hitsteps-visitor-manager')." ".$data['visitor_base']['base']." ". __("from",'hitsteps-visitor-manager')." ". $data['visitor_base']['baseref'] ." ". __("landed on",'hitsteps-visitor-manager')." ".$data['visitor_base']['baseland']."\n";
}
}



if ($input['output_visitor_path']){
if (is_array($data['visitor_path'])){

$totalview=$data['visitor_path']['hits'];
$more='';
if ($totalview>50){$totalview="more than 50";
$more='more than ';
}

$render.="\n". __("Recent pageviews are",'hitsteps-visitor-manager')." ".$totalview." ". __("pages, result in spending",'hitsteps-visitor-manager') ." ".$more.round($data['visitor_path']['avg']/60,0)." ". __("minutes",'hitsteps-visitor-manager').":\n";


if (is_array($data['visitor_path']['pages'])){

$count=20;

foreach ($data['visitor_path']['pages'] as $pg){
$count--;
if ($count>0){
$pg['refname']=$pg['ref'];
$pg['reflink']="href='".$pg['ref']."'";
if ($pg['ref']==''){$pg['refname']=__("Direct",'hitsteps-visitor-manager');$pg['reflink']='';}


$render.="\n". __("To",'hitsteps-visitor-manager').": ".$pg['name']." - ". __("visited",'hitsteps-visitor-manager')." ".$pg['short_date']."\n ". __("From",'hitsteps-visitor-manager').": ".$pg['refname']."";

}}

}

$render.="\n";
}
}


if ($input['output_visitor_link']){
if (isset($data['visitor_link'])){

$render.="\n". __("Know more about this visitor",'hitsteps-visitor-manager').": ".$data['visitor_link'];
}
}


$render.="\n";


}
}


return $render;
}








function _hs_contact_form_query_base_raw($input){
$render='';
$input['action']='contact_form_data_1';

//visitor data
$input['user_ip']=_hitsteps_get_ip();
$input['user_agent']=$_SERVER['HTTP_USER_AGENT'];

$data=hitsteps_public_query($input);
$hs_option=get_hst_conf();
if ($hs_option['code']!=''){
if ($data['error']>0){
$render="<small><i>Hitsteps error #".$data['error'].": ".$data['msg']."</i></small>";
}else{




if ($input['output_visitor_baseraw']){
if ($input['output_visitor_base']){
if (is_array($data['visitor_base'])){

$render.= __("First Visited From",'hitsteps-visitor-manager').": ".$data['visitor_base']['baseland']."";
}



}

}else if ($input['output_visitor_external_ref']){{

$render.= __("Most Recent Referral",'hitsteps-visitor-manager').": ".$data['visitor_base']['lastland']."";	
}
}



}
}

return $render;
}























function _hs_contact_form_query($input){
$render='';
$input['action']='contact_form_data_1';

//visitor data
$input['user_ip']=_hitsteps_get_ip();
$input['user_agent']=$_SERVER['HTTP_USER_AGENT'];

$data=hitsteps_public_query($input);
$hs_option=get_hst_conf();
if ($hs_option['code']!=''){
if ($data['error']>0){
$render="<small><i>Hitsteps error #".$data['error'].": ".$data['msg']."</i></small>";
}else{

$render.="<!-- ". __("Hitsteps: You can hide this column",'hitsteps-visitor-manager')." --><div style='margin:15px;padding:5px;padding-bottom:0px;background: #23282D; border:1px solid #eee; font-family: Helvetica, arial, tahoma; font-size: 9pt;'><img src='" . WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)). "logo.png' width='90' height='20' alt='hitsteps analytics' />";


if ($input['output_visitor_ip']){
if (is_array($data['visitor_ip'])){
$devicetype="PC";
if ($data['visitor_ip']['mobile']) $devicetype="Phone";
if ($data['visitor_ip']['tablet']) $devicetype="Tablet";

$render.="<div style='padding:10px;margin-bottom:5px;background: #efefef; '><img style='float: left; margin-right: 5px; margin-bottom:5px;border: #eee 1px solid;' src='http://www.hitsteps.com/responsive/flags/".strtoupper($data['visitor_ip']['country']).".png' width='74' height='50'>". __("Name",'hitsteps-visitor-manager').": ".$data['visitor_ip']['name']."<br>". __("From",'hitsteps-visitor-manager').": ".$data['visitor_ip']['city'].", ".$data['visitor_ip']['country_name']."<br>". __("Org/ISP",'hitsteps-visitor-manager').": ".$data['visitor_ip']['org']."<br>". __("Device",'hitsteps-visitor-manager').": ".$data['visitor_ip']['sw']."x".$data['visitor_ip']['sh']." ".$data['visitor_ip']['browser']." ".$data['visitor_ip']['browserv']." - ".$data['visitor_ip']['os']." - ".$devicetype." ". __("IP",'hitsteps-visitor-manager').": ".$data['visitor_ip']['ip']."</div>";

}
}



if ($input['output_visitor_base']){
if (is_array($data['visitor_base'])){

$render.="
<div style='padding:10px;margin-bottom:5px;background: #efefef; '>". __("First visited",'hitsteps-visitor-manager')." ".$data['visitor_base']['base']." ". __("First visited",'hitsteps-visitor-manager')." ". $data['visitor_base']['baseref'] ." ". __("landed on",'hitsteps-visitor-manager')." ".$data['visitor_base']['baseland']."</div>";
}
}



if ($input['output_visitor_path']){
if (is_array($data['visitor_path'])){

$totalview=$data['visitor_path']['hits'];
$more='';
if ($totalview>50){$totalview=__("more than 50",'hitsteps-visitor-manager');
$more=__("more than",'hitsteps-visitor-manager').' ';
}

$render.="<div style='padding:10px;margin-bottom:5px;background: #efefef; '>". __("Recent pageviews are",'hitsteps-visitor-manager')." ".$totalview." ". __("pages, result in spending",'hitsteps-visitor-manager')." ".$more.round($data['visitor_path']['avg']/60,0)." ". __("minutes",'hitsteps-visitor-manager').":<br><br>";


if (is_array($data['visitor_path']['pages'])){

$count=20;

foreach ($data['visitor_path']['pages'] as $pg){
$count--;
if ($count>0){
$pg['refname']=$pg['ref'];
$pg['reflink']="href='".$pg['ref']."'";
if ($pg['ref']==''){$pg['refname']='Direct';$pg['reflink']='';}


$render.="<div style='padding:5px; margin: 3px;margin-bottom:5px;background: #fff; line-height: 15pt;'>To: <a style='text-decoration: none;color: #666;' href='".$pg['url']."'>".$pg['name']."</a> - ". __("visited",'hitsteps-visitor-manager')." ".$pg['short_date']."<br><i style='text-decoration: none;color: #999;'>". __("From",'hitsteps-visitor-manager').": <a style='text-decoration: none;color: #999;' ".$pg['reflink'].">".$pg['refname']."</a></i></div>";

}}

}

$render.="</div>";
}
}


if ($input['output_visitor_link']){
if (isset($data['visitor_link'])){

$render.="<a style='display:block; padding:10px; background: #23282D;color: #fff; text-decoration: none;' href='".$data['visitor_link']."'>". __("Know more about this visitor",'hitsteps-visitor-manager')."</a>";
}
}


$render.="</div>";


}
}


return $render;
 }


	 function _hitsteps_get_ip()
    {
			$ip=$_SERVER["HTTP_CF_CONNECTING_IP"];
			if ($ip=='') {$ip=$_SERVER["HTTP_X_FORWARDED"];}
			if ($ip=='') {$ip=$_SERVER["HTTP_FORWARDED_FOR"];}
			if ($ip=='') {$ip=$_SERVER["HTTP_CLIENT_IP"];}
			if ($ip=='') {$ip=$_SERVER["REMOTE_ADDR"];}
			return $ip;
	}

?>