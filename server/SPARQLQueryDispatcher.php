<?php
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
                    'User-Agent: WikiMaps/1.0 (http://lapobarto.altervista.org/wikimaps/; infowikimaps@gmail.com)', // TODO adjust this; see https://w.wiki/CX6
                ],
            ],
        ];
        $context = stream_context_create($opts);

        $url = $this->endpointUrl . '?query=' . urlencode($sparqlQuery);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }
}
?>