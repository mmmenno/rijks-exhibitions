<?php

if(!isset($_GET['id'])){
	die("exhibition id missing");
}

/*
<https://id.rijksmuseum.nl/10110849> 
   a crm:E22_Human-Made_Object ;
   crm:P108i_was_produced_by [ 
      a crm:E12_Production ;
      crm:P4_has_time-span [ 
         a crm:E52_Time-Span ;
         crm:P82a_begin_of_the_begin "1985-04-25"^^xsd:date ;
         crm:P82b_end_of_the_end "1985-12-31"^^xsd:date 
      ] 
   ] ;
   crm:P1_is_identified_by [ 
      a crm:E42_Identifier ;
      crm:P190_has_symbolic_content "HA-0010849" ;
      crm:P2_has_type <http://vocab.getty.edu/aat/300312355> 
   ],
   [ 
      a crm:E33_E41_Linguistic_Appellation ;
      crm:P190_has_symbolic_content "Hoek van een zaal met affiches van in oorlogstijd gehouden tentoonste$
      crm:P2_has_type <http://vocab.getty.edu/aat/300404670> ;
      crm:P72_has_language <http://vocab.getty.edu/aat/300388256> 
   ],
   [ 
      a crm:E33_E41_Linguistic_Appellation ;
      crm:P190_has_symbolic_content "Tentoonstelling Het Rijksmuseum in oorlogstijd" ;
      crm:P2_has_type <http://vocab.getty.edu/aat/300404670> ;
      crm:P72_has_language <http://vocab.getty.edu/aat/300388256> 
   ],
   <http://hdl.handle.net/10934/RM0001.HARCHIEF.10849> ;
   crm:P65_shows_visual_item [ 
      a crm:E36_Visual_Item ;
      crm:P138_represents <https://id.rijksmuseum.nl/1052457> 
   ] ;
*/

$sparql = "
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX crm: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX crm2: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX schema: <http://schema.org/>
PREFIX la: <https://linked.art/ns/terms/>
PREFIX edm: <http://www.europeana.eu/schemas/edm/>
PREFIX rijks: <https://id.rijksmuseum.nl/>

SELECT (SAMPLE(?title) AS ?title) ?img ?permalink WHERE {
   ?visitem crm:P138_represents rijks:" . $_GET['id'] . " .
   ?pic crm:P65_shows_visual_item ?visitem .
   ?pic crm:P1_is_identified_by ?identifier .
   FILTER STRSTARTS(STR(?identifier),'http://hdl.handle.net/10934') .
   ?aggr edm:aggregatedCHO ?identifier .
   ?aggr edm:isShownAt ?permalink .
   ?identifier dc:title ?title .
   FILTER(LANG(?title)=\"nl\") .
   ?aggr edm:isShownBy ?img . 
} 
LIMIT 1000";

//echo $sparql;

$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/RM-PublicDomainImages/services/RM-PublicDomainImages/sparql';

$response = getSparqlResults($endpoint,$sparql);

$exhibitionpics = json_decode($response,true);


//print_r($exhibitionpics);


?>