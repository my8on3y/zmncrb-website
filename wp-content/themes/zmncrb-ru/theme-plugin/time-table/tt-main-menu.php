<?php

global $wpdb;

$resultsTable = $wpdb -> get_results( "SELECT * FROM wp_tt_doctors" );

foreach( $resultsTable as $result ){
    echo $result -> name . "<br>";
}