<?php
date_default_timezone_set("Asia/Dhaka");
$queryplace='dhaka';

if(isset($_POST['place']))
{
	$queryplace = $_POST['place'];
}



$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://community-open-weather-map.p.rapidapi.com/find?q=".$queryplace."&cnt=1&mode=null&lon=0&type=accurate&lat=0&units=%20metric",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: community-open-weather-map.p.rapidapi.com",
		"x-rapidapi-key: e10e3da51cmsh211c3a19452fb33p1876bbjsn018ec244dd36"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$data = json_decode($response,true);

$place = $data['list']['0']['name'];
$date = date("l, j F Y");
$temp = ceil($data['list']['0']['main']['temp']-273.15);
$feels = ceil($data['list']['0']['main']['feels_like']-273.15);
$humidity = $data['list']['0']['main']['humidity'];



?>

<div class="widget">
            
            <div class="left-panel panel">
                <div class="date">
					<?php echo $date ?>
                </div>

                <div class="city">
                    <?php echo $place ?>
                </div>

                <div class="temp">

                   <?php echo $temp ?>&deg;
                </div>
				<p>Feels Like :  <?php echo $feels ?>&deg;</p>
				<p>Humidity : <?php echo $humidity ?>%</p>
            </div>

			
				<div class="right-panel panel">
					<form action="" method="POST">
					<select name='place'>
						<option value=''>Select Division</option>
						<option value="dhaka">Dhaka</option>
						<option value="chittagong">Chittagong</option>
						<option value="barisal">Barisal</option>
						<option value="khulna">Khulna</option>
						<option value="mymensingh">Mymensingh</option>
						<option value="rajshahi">Rajshahi</option>
						<option value="rangpur">Rangpur</option>
						<option value="sylhet">Sylhet</option>
					</select><br><br>

					<div align="right">
						<button>Submit</button>
					</div>

				</form>
				</div>
			
</div>

<style>
			
		button
			{
				background-color: white;
				border: green solid 2px;
				color: green;
				padding: 8px 16px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 15px;
				margin: 4px 2px;
				transition-duration: 0.4s;
				cursor: pointer;
				border-radius: 8px;
				
			}

		button:hover
		{
			background-color: #4CAF50;
  			color: white;
		}

		select
		{
			padding: 8px 16px;
		}
		
		body
			{
			font-family: 'Roboto', sans-serif;
			overflow: hidden;
			background: #d22222;;
			}

		div.widget
			{
			position: relative;
			width: 25%;
			height: 25%;
			margin: 150px auto;
			background-color: #fcfdfd;
			border-radius: 9px;
			padding: 25px;
			padding-right: 30px;
			box-shadow: 0px 31px 35px -26px #080c21;
			}

		

		div.date
			{
			font-size: 14px;
			font-weight: bold;
			color: rgba(0,0,0,0.5);
			}

		div.city
			{
			font-size: 21px;
			font-weight: bold;
			text-transform: uppercase;
			padding-top: 5px;
			color: rgba(0,0,0,0.7);
			}

		div.temp
			{
			font-size: 81px;
			color: rgba(0,0,0,0.9);
			font-weight: 100;
			}

		div.panel
			{
			display: inline-block;
			}

		div.right-panel
			{
			position: right;
			float: right;
			top: 0;
			margin-top: 35px;
			padding-left: 10px;
			}

</style>