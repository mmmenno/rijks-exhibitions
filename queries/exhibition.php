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
PREFIX crm: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX crm2: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX schema: <http://schema.org/>
PREFIX la: <https://linked.art/ns/terms/>
PREFIX edm: <http://www.europeana.eu/schemas/edm/>
PREFIX rijks: <https://id.rijksmuseum.nl/>

SELECT ?exhtitle ?cat ?wdtt ?start ?end ?obj ?permalink 
        ?review ?reviewheadline ?reviewpaper ?reviewdate 
        ?newsreel ?newsreelmakerlabel ?newsreeltitle ?newsreelfile
        (SAMPLE(?title) AS ?title) ?img (SAMPLE(?desc) AS ?desc) (SAMPLE(?artist) AS ?artist) WHERE {
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
    FILTER(LANG(?title)=\"nl\") .
    FILTER STRSTARTS(STR(?permalink),'http://hdl.handle.net/10934') .
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
  OPTIONAL{
    ?tt skos:closeMatch ?wdtt .
  }
  OPTIONAL{
    ?tt crm2:P129i_is_subject_of ?cat .
  }
  OPTIONAL{
    ?review schema:itemReviewed ?tt .
    ?review schema:headline ?reviewheadline .
    ?review schema:publisher ?reviewpaper .
    ?review schema:datePublished ?reviewdate .
  }
  OPTIONAL{
    ?newsreel crm2:P65_shows_visual_item/crm2:P129_is_about ?tt .
    ?newsreel crm2:P1_is_identified_by/crm2:P190_has_symbolic_content ?newsreeltitle .
    ?newsreel crm2:P65_shows_visual_item/crm2:P65i_is_shown_by ?newsreelfile .
    ?newsreel crm2:P94i_was_created_by/crm2:P14_carried_out_by ?newsreelmaker .
    ?newsreelmaker rdfs:label ?newsreelmakerlabel .
  }
} LIMIT 1001";


$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/RM-PublicDomainImages/services/RM-PublicDomainImages/sparql';

$response = getSparqlResults($endpoint,$sparql);

$exhibition = json_decode($response,true);


//print_r($exhibition);

?>