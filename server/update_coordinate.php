<?php

preg_match_all('!-?\d+\.*\d*!', $coordinatesResult['results']['bindings'][0]['coordinate']['value'], $coordinate);

$outp['lat'] = $coordinate[0][0];
$outp['lon'] = $coordinate[0][1];

?>