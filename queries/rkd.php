<?php

if(!isset($_GET['id'])){
	die("exhibition id missing");
}

$sparql = "
PREFIX geo: <http://www.opengis.net/ont/geosparql#>
PREFIX dct: <http://purl.org/dc/terms/>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX crm: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX la: <https://linked.art/ns/terms/>
PREFIX edm: <http://www.europeana.eu/schemas/edm/>
PREFIX rijks: <https://id.rijksmuseum.nl/>

SELECT ?inst ?instLabel ?wkt ?obj ?permalink ?title ?img ?desc ?artist ?artistLabel WHERE {
  VALUES ?tt { rijks:" . $_GET['id'] . " }

  ?tt crm:P16_used_specific_object ?obj .
  ?aggr edm:aggregatedCHO ?obj .
  ?aggr edm:isShownAt ?permalink .
  ?obj dc:title ?title .
  ?obj dct:isPartOf ?inst .
  ?inst rdfs:label ?instLabel .
  OPTIONAL{
    ?inst geo:hasGeometry/geo:asWKT ?wkt .
  }
  OPTIONAL{
    ?obj dc:creator ?artist .
    ?artist rdfs:label ?artistLabel .
  }
  ?aggr edm:isShownBy ?img .  
} LIMIT 1000";


//$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/RM-PublicDomainImages/services/RM-PublicDomainImages/sparql';
$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/collection/services/collection/sparql';

$response = getSparqlResults($endpoint,$sparql);

$rkdimages = json_decode($response,true);




?>