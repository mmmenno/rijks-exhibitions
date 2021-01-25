<?php


$sparql = "
PREFIX crm: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX edm: <http://www.europeana.eu/schemas/edm/>
PREFIX rijks: <https://id.rijksmuseum.nl/>

SELECT ?tt (COUNT(?img) AS ?cImg) WHERE {
  ?tt crm:P2_has_type <http://vocab.getty.edu/aat/300054766> .
  ?tt crm:P7_took_place_at rijks:103332 .
  ?tt crm:P16_used_specific_object ?rkdobj .
  ?aggr edm:aggregatedCHO ?rkdobj .
  ?aggr edm:isShownBy ?img .
  ?aggr edm:dataProvider \"RKD\" .
} 
GROUP BY ?tt
LIMIT 1000";


//$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/RM-PublicDomainImages/services/RM-PublicDomainImages/sparql';
$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/collection/services/collection/sparql';

$response = getSparqlResults($endpoint,$sparql);

$rkdcount = json_decode($response,true);


//print_r($rkdcount);

?>