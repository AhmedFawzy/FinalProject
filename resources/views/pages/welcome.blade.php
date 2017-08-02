@include('includes.navbar')

<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

</head>

<body>
<form action="/" method="POST">
    Search by address:<br>
    <input type="text" name="search" value="2114 Bigelow Ave"><br>
    <button type="submit">Submit</button>
</form>

</body>

</html>

@include('includes.footer')

<?php

$client = new \GuzzleHttp\Client();

$res = $client->request('GET', 'http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1fx492w1h57_3csw9&address=2114+Bigelow+Ave&citystatezip=Seattle%2C+WA ');
//echo $res->getStatusCode();
// 200
//echo $res->getHeaderLine('content-type');
// 'application/json; charset=utf8'
echo $res->getBody();
// '{"id": 1420053, "name": "guzzle", ...}'

// Send an asynchronous request.
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://www.zillow.com/webservice/GetSearchResults.htm?zws-id=X1-ZWz1fx492w1h57_3csw9&address=2114+Bigelow+Ave&citystatezip=Seattle%2C+WA ');
$promise = $client->sendAsync($request)->then(function ($response) {
    echo 'I completed! ' . $response->getBody();
});
$promise->wait();



