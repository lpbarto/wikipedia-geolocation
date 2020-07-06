<?php
$endpointUrl = 'https://query.wikidata.org/sparql';
$sparqlQueryString = <<< SPARQL
SELECT ?city ?coordinate WHERE {
    wd:Q$location_id wdt:$code ?city.
    OPTIONAL{?city wdt:P625 ?coordinate}.
  }
SPARQL;

$queryDispatcher = new SPARQLQueryDispatcher($endpointUrl);
$coordinatesResult = $queryDispatcher->query($sparqlQueryString);

// echo("<p>    Sono in locatequery by id   ");
// var_export($coordinatesResult);
// echo("    Fine locatequery by id     </p>");
?>