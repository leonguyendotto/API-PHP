<?php

$key = 'AIzaSyD5m4XweIlaB3sMAw7fEp4nRK3HX6OAxsc';
$address ='205 Humber College Blvd., Toronto, Ontario, Canada M9W 5L7';

$url ='https://maps.googleapis.com/maps/api/geocode/json?address='.
    $address.'$key='.$key;

echo $url;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Maps API</title>
</head>
<body>
    
    <h1>Google Maps API</h1>

    <hr>

    <h2>Lookup Place Using Address</h2>

    <?php

    $url ='https://maps.googleapis.com/maps/api/geocode/json?address='.
        urlencode($address).'&key='.$key;

    

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);

    
    curl_close($ch);

    $result = json_decode($result, true);

    $place_id = $result['results'][0]['place_id'];
    $lat = $result['results'][0]['geometry']['location']['lat'];
    $lng = $result['results'][0]['geometry']['location']['lng'];
    $formatted_address = $result['results'][0]['formatted_address'];

    echo 'Place ID: '.$place_id.'<br>';
    echo 'Lat: '.$lat.'<br>';
    echo 'Lng: '.$lng.'<br>';
    echo 'Formatted Address: '.$formatted_address.'<br>';


     // echo '<pre>';
    // print_r($result);
    // echo '</pre>';

    ?>

    <h2>Display a Static Map</h2>
    <?php

    $url ='https://maps.googleapis.com/maps/api/staticmap?center='.
    $lat.','.$lng.
    '&size=600x600'.
    '&key='.$key.
    '&maptype=roadmap'.
    '&zoom=15'.
    '&markers=color:red|label:H|'.$lat.','.$lng;

    echo '<img src="'.$url.'">';

    ?>

</body>
</html> 