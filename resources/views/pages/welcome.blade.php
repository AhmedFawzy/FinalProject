@include('includes.navbar')


        <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!--  Material Dashboard CSS    -->
    <link href="../assets/css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet"/>

    {{--My stylesheet--}}
    <link href="../assets/css/background.css" rel="stylesheet"/>

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

<div class="container">
    <div class="row">

        <?php


        require('simple_html_dom.php');

        $client = new \GuzzleHttp\Client();

        $res = $client->request('GET', 'http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1fx492w1h57_3csw9&address=2114+Bigelow+Ave&citystatezip=Seattle%2C+WA ');
        $xmlParse = ($res->getBody());

        libxml_use_internal_errors(true);

        $xml = simplexml_load_string($xmlParse);
        if ($xml === false) {
            echo "Failed loading XML: ";
            foreach (libxml_get_errors() as $error) {
                echo "<br>", $error->message;
            }
        } else {
            $address = ($xml->request->address);
            echo "<h1 class='text-center'>" . "<h1 class='text-center'> Address: " . $address . "</h1>" . "</h1>" . "<br>";

            $citystatezip = ($xml->request->citystatezip);
            echo "<h1 class='text-center'>" . "<h1 class='text-center'> City: " . $citystatezip . "</h1>" . "</h1>" . "<br>";

            $zipcode = ($xml->response->results->result->address->zipcode);
            echo "<h3 class='text-center'>" . "<h3 class='text-center'> Zipcode: " . $zipcode . "</h3>" . "</h3>" . "<br>";

            $zpid = ($xml->response->results->result->zpid);
            echo "<h3 class='text-center'>" . "<h3 class='text-center'> Zillow ID: " . $zpid . "</h3>" . "</h3>" . "<br>";

            $zestimateAmount = ($xml->response->results->result->zestimate->amount);
            echo "<h3 class='text-center'>" . "<h3 class='text-center'> Zestimate Amount: $" . $zestimateAmount . "</h3>" . "</h3>" . "<br>";


            //var_dump($xml->request);

        }

        $client2 = new \GuzzleHttp\Client();

        $res2 = $client2->request('GET', 'http://www.zillow.com/webservice/GetChart.htm?zws-id=X1-ZWz1fx492w1h57_3csw9&unit-type=percent&zpid=48749425&width=300&height=150');
        $xmlParse2 = ($res2->getBody());

        libxml_use_internal_errors(true);

        $xml2 = simplexml_load_string($xmlParse2);
        if ($xml2 === false) {
            echo "Failed loading XML: ";
            foreach (libxml_get_errors() as $error2) {
                echo "<br>", $error2->message;
            }
        } else {

            $graph = ($xml2->response->url);
            //echo "<img src= " . $graph . " class='text-center'>" . "<br>";

            //var_dump($xml2->response);

        }

        $client3 = new \GuzzleHttp\Client();

        $res3 = $client3->request('GET', 'http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?zws-id=X1-ZWz1fx492w1h57_3csw9&zpid=48749425');
        $xmlParse3 = ($res3->getBody());

        libxml_use_internal_errors(true);

        $xml3 = simplexml_load_string($xmlParse3);
        if ($xml3 === false) {
            echo "Failed loading XML: ";
            foreach (libxml_get_errors() as $error3) {
                echo "<br>", $error3->message;
            }
        } else {

            $image = ($xml3->response->images->image->url);
            echo "<img class='text-center'' src=" . $image . " >" . "<br>";

            //var_dump($xml3->response->links->photoGallery);

        }
        ?>

    </div>
</div>


{{--$client = new \GuzzleHttp\Client();
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

$array = ($html->root);

foreach ( $array->nodes as $home ) {
//	var_dump( $gif->images->original);
    echo $home;
}--}}

