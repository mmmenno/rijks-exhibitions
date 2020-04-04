<?php

if(!isset($_GET['startyear'])){
	$_GET['startyear'] = 2010;
}

if($_GET['startyear'] == "all"){
	$start = 1800;
	$end = 2050;
}else{
	$start = $_GET['startyear'];
	$end = $start + 10;
}

$sparql = "
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX crm: <http://www.cidoc-crm.org/rdfs/cidoc_crm_v6.2.1-2018April.rdfs#>
PREFIX la: <https://linked.art/ns/terms/>
PREFIX edm: <http://www.europeana.eu/schemas/edm/>
PREFIX rijks: <https://id.rijksmuseum.nl/>

SELECT ?tt ?title ?start ?end (COUNT(?obj) AS ?objects) WHERE {
  ?tt crm:P2_has_type <http://vocab.getty.edu/aat/300054766> .
  ?tt crm:P7_took_place_at rijks:103332 .
  ?tt crm:P1_is_identified_by/crm:P190_has_symbolic_content ?title .
  ?tt crm:P4_has_time-span ?period .
  ?period crm:P82a_begin_of_the_begin ?start .
  ?period crm:P82b_end_of_the_end ?end .
  FILTER(?start < \"" . $end . "\"^^xsd:gYear)
  FILTER(?start > \"" . $start . "\"^^xsd:gYear)
  OPTIONAL{
  	?tt crm:P16_used_specific_object ?obj .
  }
} 
GROUP BY ?tt ?title ?start ?end
ORDER BY ASC(?start)
LIMIT 2000";


$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/RM-PublicDomainImages/services/RM-PublicDomainImages/sparql';

$response = getSparqlResults($endpoint,$sparql);

$exhibitions = json_decode($response,true);




?>