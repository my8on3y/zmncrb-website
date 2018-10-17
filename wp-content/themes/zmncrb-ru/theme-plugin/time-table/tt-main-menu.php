<?php

global $wpdb;

if ( $_POST['tt_apply'] ){
    putChangesIntoDb();
}


function putChangesIntoDb() {
    $tt_arr = [];
    for( $i = 0; $i < 5; $i++ ){
            $tt_arr[$i]['start_hour'] = $_POST['start_hour'.$i];
            $tt_arr[$i]['start_minute'] = $_POST['start_minute'.$i];
            $tt_arr[$i]['end_hour'] = $_POST['end_hour'.$i];
            $tt_arr[$i]['end_minute'] = $_POST['end_minute'.$i];
    }
    print_r($tt_arr);
    $result = json_encode($tt_arr);
    echo '<br>';
    print_r (json_decode($result, true));
    global $wpdb;
    $wpdb -> update( 
        'wp_tt_doctors',
        array ( 'time_table' => json_encode($tt_arr) ),
        array ( 'id' => '1'  )
    );
    $db_result = $wpdb -> get_var('SELECT time_table FROM wp_tt_doctors WHERE id = 1');
    echo '<br>ОТВЕТ ИЗ БАЗЫ';
    print_r(json_decode($db_result));
}



$uniqueSpecialty = $wpdb -> get_col( "SELECT specialty FROM wp_tt_doctors" );
$uniqueSpecialty = array_unique ( $uniqueSpecialty );
foreach ( $uniqueSpecialty as $value ) {
    $specArr[$i] = $value;
    $i++;
};



foreach ($specArr as $spec_value){
    $queryArr = $wpdb -> get_results("SELECT * FROM wp_tt_doctors WHERE specialty = '$spec_value'");
    echo '<h2>'. $spec_value .  '</h2><br>';
    foreach ($queryArr as $query) {
        echo '<div class="doc_name">' . $query -> last_name .' '. $query -> name . '</div>';
        echo '<form method="POST">';
        for ( $i = 0; $i < 5; $i++ ) {
            switch( $i ) {
                case 1: echo '<span style="color: green">Пн:</span>'; break;
                case 2: echo '<span style="color: green">Вт:</span>'; break;
                case 3: echo '<span style="color: green">Ср:</span>'; break;
                case 4: echo '<span style="color: green">Чт:</span>'; break;
                case 5: echo '<span style="color: green">Пт:</span>'; break;
            }
            echo '<div class="time_table_day">';
            echo '<input type="text" name="start_hour'.$i.'" size="1" pattern="[0-9]{,2}" placeholder="чч">';
            echo '<input type="text" name="start_minute'.$i.'" size="1" pattern="[0-9]{,2}" placeholder="мм">' . ':' ;
            echo '<input type="text" name="end_hour'.$i.'" size="1" pattern="[0-9]{,2}" placeholder="чч">';
            echo '<input type="text" name="end_minute'.$i.'" size="1" pattern="[0-9]{,2}" placeholder="мм">'; 
            echo '</div>'; 
        }
        echo '<input type="submit" name="tt_apply" value="ок">';
        echo '</form>';
        echo '<br>';       
    }
}


?>

<style>
    input[type="text"] {
        width: 35px;
        text-align: center;
    }

    .doc_name {
        min-width: 70px;
        color: blue;
    }

    .time_table_day {
        display: inline;
        margin-right: 35px;
    }
</style>