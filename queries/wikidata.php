<?php

if(!isset($_GET['id'])){
	die("wd id missing");
}

$sparql = "
PREFIX wd: <http://www.wikidata.org/entity/>
PREFIX wdt: <http://www.wikidata.org/prop/direct/>
PREFIX wikibase: <http://wikiba.se/ontology#>
PREFIX p: <http://www.wikidata.org/prop/>
PREFIX ps: <http://www.wikidata.org/prop/statement/>
PREFIX pq: <http://www.wikidata.org/prop/qualifier/>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX bd: <http://www.bigdata.com/rdf#>

SELECT ?work ?workLabel ?workarticle ?makerLabel ?collection ?collectionLabel
        (SAMPLE(?img) AS ?img) 
        (SAMPLE(?coords) AS ?coords) 
        (SAMPLE(?supercoords) AS ?supercoords) 
        (SAMPLE(?article) AS ?article) 
        WHERE {
  ?work wdt:P608 <" . $wdtt . "> .
  ?work wdt:P18 ?img .
  ?work wdt:P170 ?maker .
  ?work p:P195 ?colstatement .
  ?colstatement ps:P195 ?collection .
  FILTER NOT EXISTS { ?colstatement pq:P582 ?endtime . }
  OPTIONAL{
    ?collection wdt:P625 ?coords .
  }
  OPTIONAL{
    ?collection wdt:P361 ?super .
    ?super wdt:P625 ?supercoords .
  }
  OPTIONAL{
    ?article schema:about ?collection .
    ?article schema:inLanguage \"nl\" .
  }
  OPTIONAL{
    ?workarticle schema:about ?work .
    ?workarticle schema:inLanguage \"nl\" .
  }
  SERVICE wikibase:label { bd:serviceParam wikibase:language \"nl,en\". }
}
GROUP BY ?work ?workLabel ?workarticle ?makerLabel ?supercoords ?article ?collection ?collectionLabel
";


$endpoint = 'https://query.wikidata.org/sparql';

$response = getSparqlResults($endpoint,$sparql);

$wdimages = json_decode($response,true);



?>