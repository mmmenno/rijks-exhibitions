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
PREFIX crm: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX crm2: <http://www.cidoc-crm.org/cidoc-crm/>
PREFIX la: <https://linked.art/ns/terms/>
PREFIX schema: <http://schema.org/>
PREFIX edm: <http://www.europeana.eu/schemas/edm/>
PREFIX rijks: <https://id.rijksmuseum.nl/>
PREFIX wdt: <http://www.wikidata.org/prop/direct/>

SELECT ?tt ?title ?start ?end ?wdtt
    (COUNT( distinct ?rmobj1) AS ?cRmImg) 
    (COUNT( distinct ?rmobj2) AS ?cRmNoImg) 
    (COUNT( distinct ?rkdobj) AS ?cRkdImg)  
    (COUNT( distinct ?wdobj) AS ?cWdImg)  
    (COUNT( distinct ?cat) AS ?cCat)   
    (COUNT( distinct ?review) AS ?cReview) 
    (COUNT( distinct ?newsreel) AS ?cNewsreel) 
    WHERE {
  ?tt crm:P2_has_type <http://vocab.getty.edu/aat/300054766> .
  ?tt crm:P7_took_place_at rijks:103332 .
  ?tt crm:P1_is_identified_by/crm:P190_has_symbolic_content ?title .
  ?tt crm:P4_has_time-span ?period .
  ?period crm:P82a_begin_of_the_begin ?start .
  ?period crm:P82b_end_of_the_end ?end .
  FILTER(?start < \"" . $end . "\"^^xsd:gYear)
  FILTER(?start > \"" . $start . "\"^^xsd:gYear)
  #FILTER(?tt = rijks:1052465)
  OPTIONAL{
    ?tt crm:P16_used_specific_object ?rmobj1 .
    ?aggr1 edm:aggregatedCHO ?rmobj1 .
    ?aggr1 edm:isShownBy ?img .
    ?aggr1 edm:dataProvider \"Rijksmuseum\" .
  }
  OPTIONAL{
    ?tt crm:P16_used_specific_object ?rmobj2 .
    ?aggr2 edm:aggregatedCHO ?rmobj2 .
    FILTER NOT EXISTS{?aggr2 edm:isShownBy ?img}
    ?aggr2 edm:dataProvider \"Rijksmuseum\" .
  }
  OPTIONAL{
    ?tt crm:P16_used_specific_object ?rkdobj .
    ?aggr3 edm:aggregatedCHO ?rkdobj .
    ?aggr3 edm:isShownBy ?img .
    ?aggr3 edm:dataProvider \"RKD\" .
  }
  OPTIONAL{
    ?tt crm2:P129i_is_subject_of ?cat .
  }
  OPTIONAL{
    ?review schema:itemReviewed ?tt .
  }
  OPTIONAL{
    ?newsreel crm2:P65_shows_visual_item/crm2:P129_is_about ?tt .
  }
  OPTIONAL{
    ?tt skos:closeMatch ?wdtt .
    FILTER STRSTARTS(STR(?wdtt),'http://www.wikidata.org') .
    SERVICE <https://query.wikidata.org/sparql> {
      ?wdobj wdt:P608 ?wdtt .
    }
  }
  
} 
#GROUP BY ?tt ?title ?start ?end
ORDER BY ASC(?start)
LIMIT 1500";


$endpoint = 'https://api.data.netwerkdigitaalerfgoed.nl/datasets/rijksmuseum/RM-PublicDomainImages/services/RM-PublicDomainImages/sparql';

$response = getSparqlResults($endpoint,$sparql);

$exhibitions = json_decode($response,true);


//print_r($exhibitions);

?>