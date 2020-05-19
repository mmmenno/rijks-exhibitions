<?php


$sparql = "
PREFIX wdt: <http://www.wikidata.org/prop/direct/>
PREFIX crm: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX rijks: <https://id.rijksmuseum.nl/>

SELECT ?tt (COUNT(?wdobj) AS ?cWdobj) WHERE {
   ?tt crm:P2_has_type <http://vocab.getty.edu/aat/300054766> .
   ?tt crm:P7_took_place_at rijks:103332 .
   ?tt skos:closeMatch ?wdtt .
   FILTER STRSTARTS(STR(?wdtt),'http://www.wikidata.org') .
   SERVICE <https://query.wikidata.org/sparql> {
      ?wdobj wdt:P608 ?wdtt .
   }
} 
GROUP BY ?tt
LIMIT 1500
";


$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/RM-PublicDomainImages/services/RM-PublicDomainImages/sparql';

$response = getSparqlResults($endpoint,$sparql);

$wikidatacount = json_decode($response,true);

//print_r($wikidatacount);

?>