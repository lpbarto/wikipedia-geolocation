<?php
//  $outp['title'] = "Dante Alighieri";   era un TEST

class SPARQLQueryDispatcher
{
    private $endpointUrl;

    public function __construct(string $endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;
    }

    public function query(string $sparqlQuery): array
    {
        // create a new cURL resource
        //$ch = curl_init();
        //curl_setopt($ch, CURLOPT_USERAGENT ,'WikiMaps/1.0 (https://http://lapobarto.altervista.org/ilmessaggero/; bart.sneakers@gmail.com)');
        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'Accept: application/sparql-results+json',
                    'User-Agent: WikiMaps/1.0 (http://lapobarto.altervista.org/ilmessaggero/; bart.sneakers@gmail.com)', // TODO adjust this; see https://w.wiki/CX6
                ],
            ],
        ];
        $context = stream_context_create($opts);

        $url = $this->endpointUrl . '?query=' . urlencode($sparqlQuery);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }
}
// Query on WikiData that selects instance and classes of the page
$titolo= $outp['title'];
$endpointUrl = 'https://query.wikidata.org/sparql';
$sparqlQueryString = <<< SPARQL
 SELECT DISTINCT ?class ?instance WHERE {
      ?item wdt:P31 ?instance.
      ?instance wdt:P279 ?class
          VALUES ?lemma {
    "$titolo"@it
  }
  ?sitelink schema:about ?item;
    schema:isPartOf <https://it.wikipedia.org/>;
    schema:name ?lemma.
} 
SPARQL;

$queryDispatcher = new SPARQLQueryDispatcher($endpointUrl);
$queryResult = $queryDispatcher->query($sparqlQueryString);

var_export($queryResult);  //forse non serve

include 'categories.php';
echo("<p> Includo Categorie </p>"); // TEST 
$elementi = array();
foreach ( $queryResult['results']['bindings'] as $a => $b){

    array_push($elementi, $b['instance']['value'], $b['class']['value']);
  
}
var_export($elementi);  // TEST stampo array elementi

  // assegno categoria giusta
if ( count(array_intersect($elementi, $isHuman)) > 0 ){
    echo("<p> human ok </p>"); // TEST 
    $outp['cat'] = "Q5";
}elseif( count(array_intersect($elementi, $isBuilding)) > 0 ){
    echo("<p> bulding ok </p>"); // TEST 
    $outp['cat'] = "Q41176";
}elseif( count(array_intersect($elementi, $isArt)) > 0 ){
    echo("<p> art ok </p>"); // TEST 
    $outp['cat'] = "Q735";
}elseif( count(array_intersect($elementi, $isBusiness)) > 0 ){
    echo("<p> business ok </p>"); // TEST 
    $outp['cat'] = "Q4830453";
}else{
    echo("<p> NULL ok </p>"); // TEST 
    $outp['cat'] = "NULL";
}

echo("<p> stampo categoria finale" .$outp['cat']. "</p>"); // TEST stampo categoria finale 


?>