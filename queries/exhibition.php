<?php

if(!isset($_GET['id'])){
	die("exhibition id missing");
}

$sparql = "
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX crm: <http://www.cidoc-crm.org/rdfs/cidoc_crm_v6.2.1-2018April.rdfs#>
PREFIX la: <https://linked.art/ns/terms/>
PREFIX edm: <http://www.europeana.eu/schemas/edm/>
PREFIX rijks: <https://id.rijksmuseum.nl/>

SELECT ?exhtitle ?start ?end ?obj ?permalink (SAMPLE(?title) AS ?title) ?img (SAMPLE(?desc) AS ?desc) (SAMPLE(?artist) AS ?artist) WHERE {
  VALUES ?tt {rijks:" . $_GET['id'] . "}
  ?tt crm:P7_took_place_at ?place .
  ?tt crm:P1_is_identified_by/crm:P190_has_symbolic_content ?exhtitle .
  ?tt crm:P4_has_time-span ?period .
  ?period crm:P82a_begin_of_the_begin ?start .
  ?period crm:P82b_end_of_the_end ?end .
  OPTIONAL{
    ?tt crm:P16_used_specific_object ?obj .
    ?aggr edm:aggregatedCHO ?obj .
    ?aggr edm:isShownAt ?permalink .
    ?obj dc:title ?title .
    FILTER(LANG(?title)=\"nl\")
    OPTIONAL{
      ?obj dc:description ?desc .
      FILTER(LANG(?desc)=\"nl\")
    }
    OPTIONAL{
      ?obj dc:creator/skos:prefLabel ?artist .
    }
    OPTIONAL{
      ?aggr edm:isShownBy ?img .  
    }
  }
} LIMIT 1000";


$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/RM-PublicDomainImages/services/RM-PublicDomainImages/sparql';

$response = getSparqlResults($endpoint,$sparql);

$exhibition = json_decode($response,true);




?>