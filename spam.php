<?php
	require_once('facebook.php');
	$id = ''; //id app
	$secret = ''; //secret app
	$url = ''; //url for app
	$userId = ''; // your user id mange and redirect on app setting
	$permissions = 'publish_stream,read_stream, friends_status, friends_photos,friends_status, read_friendlists,user_likes';

	$fb = new Facebook(array('appId'=>$id, 'secret'=>$secret));
	$fbuser = $fb->getUser();
	
	if($fbuser){
			$resp = $fb->api($userId.'/statuses?limit=50','GET');
			foreach($resp['data'] AS $p){
				echo $p['id'].'<br/>';
				$stat = $fb->api('/'.$userId.'_'.$p['id'].'/likes','POST');
				echo $stat;
				echo '<hr/>';
			}
	}else{
		$fbloginurl = $fb->getLoginUrl(array('redirect-uri'=>$returnurl, 'scope'=>$permissions));
        echo '<a href="'.$fbloginurl.'">Login with Facebook</a>';
	}
	
?>