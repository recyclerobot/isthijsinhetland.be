
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>IsThijsInHetLand.be</title>
<style>
body,p,h1 {
	margin: 0;
	padding: 0;
}
body {
	color: #fff;
	background: #000;
	font: 10px "Helvetica", Arial, sans-serif;
	margin-top: 150px;
	text-align: center;
}
.result{
	font: 200px "Helvetica", Arial, sans-serif;
}
h1 {
	font-weight: normal;
	font-size: 14px;
	color: #999;
}
a {
	color: #333;
	text-decoration: none;
}
a:hover, a:active {
	color: #fff;
}
</style>

</head>
<?php 
	require_once("./foursquare_api/FoursquareAPI.class.php");

	// prepare our settings
	$client_key = "xxx";
	$client_secret = "xxx";  
	$redirect_uri = "xxx";
	$current_home_country_code = "BE";
	// get your token with tokenrequest.php
	$token = "xxx";

	// contact foursquare API
	$foursquare = new FoursquareAPI($client_key,$client_secret);
	$foursquare->SetAccessToken($token );

	// set parameters and make self checkins call
	$params = array("USER_ID"=>"self", "limit"=>"1");
	$response = $foursquare->GetPrivate("users/self/checkins",$params);

	// process respons and get returned country code
	$checkin = json_decode($response);
	$country_code = $checkin->response->checkins->items[0]->venue->location->cc;
	$country = $checkin->response->checkins->items[0]->venue->location->country;
	
?>
<body>
<h1>Istie nu feitelijk in het land?</h1>
<div class="result">
	<?php
		if($country_code == $current_home_country_code){
			echo "ja";
		}else{
			?>
			nee
			<h1>en waar isie dan eigelijk?</h1>
			<?php
			echo $country;
		}
	?>
</div>


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-xxx']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>