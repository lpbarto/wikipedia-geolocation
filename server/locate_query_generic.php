<?php

$titolo= $outp['title'];
$endpointUrl = 'https://query.wikidata.org/sparql';
$sparqlQueryString = <<< SPARQL
SELECT ?coordinate WHERE {
    OPTIONAL{
      ?item (wdt:P740|wdt:P159|wdt:P495)/wdt:P625 ?coordinate
    }
    VALUES ?lemma {
      "$titolo"@it
    }
      ?sitelink schema:about ?item;
      schema:isPartOf <https://it.wikipedia.org/>;
      schema:name ?lemma.
  }
SPARQL;

$queryDispatcher = new SPARQLQueryDispatcher($endpointUrl);
$coordinatesResult = $queryDispatcher->query($sparqlQueryString);


echo("<p>    Sono in locatequery generic    ");
var_export($coordinatesResult);
echo("     Fine locatequery generic  </p>");

?>