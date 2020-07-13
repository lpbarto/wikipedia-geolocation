<?php

$endpointUrl = 'https://query.wikidata.org/sparql';
$sparqlQueryString = <<< SPARQL
SELECT DISTINCT ?coor
WHERE
{
 
  ?place wdt:P31 wd:Q515.
  ?place wdt:P625 ?coor.
 
  ?sitelink schema:about ?place;
      schema:isPartOf <https://it.wikipedia.org/>;
              schema:name "$titolo"@it.

}

SPARQL;

$queryDispatcher = new SPARQLQueryDispatcher($endpointUrl);
$coordinatesResult = $queryDispatcher->query($sparqlQueryString);


// echo("<p>    Sono in locatequery generic    ");
// var_export($coordinatesResult);
// echo("     Fine locatequery generic  </p>");

?>