<?php
$titolo= $outp['title'];
$endpointUrl = 'https://query.wikidata.org/sparql';
$sparqlQueryString = <<< SPARQL
SELECT ?city ?coordinate WHERE {
  ?item wdt:$code ?city.
  OPTIONAL{?city wdt:P625 ?coordinate}.
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
// echo("<p>    Sono in locatequery    ");
// var_export($coordinatesResult);
// echo("     Fine locatequery  </p>");
?>