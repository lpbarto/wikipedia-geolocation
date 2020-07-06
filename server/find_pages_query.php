<?php
$endpointUrl = 'https://query.wikidata.org/sparql';
$sparqlQueryString = <<< SPARQL
SELECT Distinct ?place ?location ?distance ?name WHERE {
    ?place wdt:P31/wdt:P279 ?category.
    $cat_string
      SERVICE wikibase:around { 
        ?place wdt:P625 ?location . 
        bd:serviceParam wikibase:center "Point($coord)"^^geo:wktLiteral .
        bd:serviceParam wikibase:radius "$radius" . 
        bd:serviceParam wikibase:distance ?distance .
      } 
      SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],it". }
    
    ?sitelink schema:about ?place;
      schema:isPartOf <https://it.wikipedia.org/>;
              schema:name ?name.
    
  } ORDER BY ?distance LIMIT $limit
SPARQL;

$queryDispatcher = new SPARQLQueryDispatcher($endpointUrl);
$placeQueryResult = $queryDispatcher->query($sparqlQueryString);

// echo("<p> sono in    find_pages_query    ");
// var_export($placeQueryResult);
// echo("     Fine find_pages_query  </p>");
?>