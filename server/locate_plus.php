<?php
//$outp['title'] = "Led Zeppelin";

// search and set element's category
include 'set_category.php';   
echo("<p> categorie incluse </p>"); // TEST
echo("<p>".$outp['cat']."</p>"); // TEST
// Algorithm that geolocate a page that is not geolocated on wikipedia
switch ($outp['cat']){
    case "Q5":
        // attiva localizzazione umani
        $code = "P19";
        include 'locate_query.php';
        include 'update_coordinate.php';
        break;
    case "Q735":
        // attiva localizzazione arte
        $code = "P276";
        include 'locate_query.php';
        include 'update_coordinate.php';
        echo("<p>   Nada   </p>");
        $i = 0;
        while( !isset($outp['lat']) && $i<=4 ){
            echo("<p>   Nel Ciclo  </p>");
            preg_match_all('!\d+!', $coordinatesResult['results']['bindings'][0]['city']['value'], $location_id);
            $location_id = $location_id[0][0];
            echo("<p> locatio_id :::   " .$location_id. "   </p>");
            include 'locate_location_byid.php';
            include 'update_coordinate.php';
            $i++;
        }
        break;
    case "Q4830453":
        echo("<p> si è un business </p>"); // TEST
        // attiva localizzazione business
        $code = "P740";
        include 'locate_query.php';
        include 'update_coordinate.php';
        break;
    case "Q41176":
        // attiva localizzazione buildings
        break;
    default:
        echo("<p> si è un NULL </p>"); // TEST
        // attiva localizzazione generica
        include 'locate_query_generic.php';
        if(isset($coordinatesResult['results']['bindings'][0]['coordinate']['value'])){
            echo("ho trovato qualcosa  ");
            include 'update_coordinate.php';
        }else{                   // NON riesce a geolocalizzarla
            $outp['lat'] = "NULL";
            $outp['lon'] = "NULL";
        }
       

}

echo("<p>" .$outp['lat']. "</p>");
echo("<p>" .$outp['lon']. "</p>");


?>