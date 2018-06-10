<?php
require('Unirest.php');
$response = Unirest\Request::get("https://quotes.p.mashape.com/?category=learning",
  array(
    "X-Mashape-Key" => "ijSVUPAaQ1mshaBtiOdZ34YwDfDwp1F88RLjsnpERnLBU8YlAN",
    "Accept" => "application/json"
  )
);

$json = json_encode($response);
$myarray = json_decode($json);

var_dump($myarray);
?>
