@include('includes.navbar')


        <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet'
          type='text/css'>


</head>

<body>
<form action="/" method="POST" class="text-center">
    Search by address:<br>
    <input type="text" name="search" value="2114 Bigelow Ave"><br>
    <button type="submit">Submit</button>
</form>

</body>

</html>


<?php


require('simple_html_dom.php');

$client = new \GuzzleHttp\Client();

$res = $client->request('GET', 'http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1fx492w1h57_3csw9&address=2114+Bigelow+Ave&citystatezip=Seattle%2C+WA ');
$res2 = $client->request('GET', 'http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1fx492w1h57_3csw9&address=2114+Bigelow+Ave&citystatezip=Seattle%2C+WA');
$xmlParse = ($res->getBody());

libxml_use_internal_errors(true);

$xml = simplexml_load_string($xmlParse);
if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    $address = ($xml->request->address);
    echo "<h1 class='text-center'>" . $address . "</h1>" . "<br>";

    $citystatezip = ($xml->request->citystatezip);
    echo "<h1 class='text-center'>" . $citystatezip . "</h1>" . "<br>";

    var_dump($xml->response->results->result);
}
















/*$client = new \GuzzleHttp\Client();
$response = $client->request('GET', $request_url, [
    'headers' => ['Accept' => 'application/xml'],
    'timeout' => 120
])->getBody()->getContents();*/


/*use Zillow\ZillowClient;

$client = new ZillowClient('ZWSID');

$response = $client->GetSearchResults(['address' => '5400 Tujunga Ave', 'citystatezip' => 'North Hollywood, CA 91601']);*/


/*$url = 'https://www.trulia.com/builder-community/Townhomes-at-Lucaya-Lake-Club-3268866340/';
$html = file_get_contents($url);
echo $html;*/

/*$html = file_get_html('https://www.trulia.com/builder-community/Townhomes-at-Lucaya-Lake-Club-3268866340/');

var_dump($html);*/

/*foreach ( $array->nodes as $home ) {
//	var_dump( $gif->images->original);
    echo $home;
}*/

