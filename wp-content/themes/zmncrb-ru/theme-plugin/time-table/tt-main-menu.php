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
    global $wpdb;
    $wpdb -> update( 
        'wp_tt_doctors',
        array ( 'time_table' => json_encode($tt_arr) ),
        array ( 'id' => $_POST['id']  )
    );
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
        echo '<div class="doc_name">' . $query -> last_name .' '. $query -> name . ' ' .  $query -> patronymic . '</div>';
        echo '<form method="POST">';
        echo '<input type="hidden" name="id" value="' . $query -> id . '">';
        echo '----<input type="checkbox" name="disable">нет приёма<br>';
        for ( $i = 0; $i < 5; $i++ ) {
            switch( $i ) {
                case 0: echo '<span style="color: green">Пн:</span>'; break;
                case 1: echo '<span style="color: green">Вт:</span>'; break;
                case 2: echo '<span style="color: green">Ср:</span>'; break;
                case 3: echo '<span style="color: green">Чт:</span>'; break;
                case 4: echo '<span style="color: green">Пт:</span>'; break;
            }
            $query_result = json_decode($query -> time_table, true);
            echo '<div class="time_table_day">';
            echo '<input type="number" name="start_hour'.$i.'" pattern="[0-9]{,2}" placeholder="чч" max="23" min="0" value="' . $query_result[$i]['start_hour'] .'">';
            echo '<input type="number" id="minute_field" name="start_minute'.$i.'" pattern="[0-9]{,2}" placeholder="мм" max="59" min="0" value="' . $query_result[$i]['start_minute'] .'">' . ':' ;
            echo '<input type="number" name="end_hour'.$i.'" pattern="[0-9]{,2}" placeholder="чч" max="23" min="0" value="' . $query_result[$i]['end_hour'] .'">';
            echo '<input type="number" id="minute_field" name="end_minute'.$i.'" pattern="[0-9]{,2}" placeholder="мм" max="59" min="0" value="' . $query_result[$i]['end_minute'] .'">'; 
            echo '</div>'; 
        }
        echo '<input type="submit" name="tt_apply" value="ок">';
        echo '</form>';
        echo '<br>';       
    }
    echo '<hr>';
}


?>

<style>
    input[type="number"] {
        width: 44px;
        text-align: center;
        font-size: 12px;
    }

    #minute_field {
        color: #808080;
    }

    .doc_name {
        min-width: 70px;
        color: blue;
    }

    .time_table_day {
        display: inline;
        margin-right: 15px;
    }
</style>