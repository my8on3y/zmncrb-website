<?php
/*
Template Name: time-table template
*/


get_header();
global $wpdb;

$tt_id          = $wpdb -> get_col( "SELECT id FROM wp_tt_doctors" );
$tt_last_name   = $wpdb -> get_col( "SELECT last_name FROM wp_tt_doctors" );
$tt_name        = $wpdb -> get_col( "SELECT name FROM wp_tt_doctors" );
$tt_patronymic  = $wpdb -> get_col( "SELECT patronymic FROM wp_tt_doctors" );
$tt_specialty   = $wpdb -> get_col( "SELECT specialty FROM wp_tt_doctors" );
$tt_profile     = $wpdb -> get_col( "SELECT profile FROM wp_tt_doctors" );
$tt_cabinet     = $wpdb -> get_col( "SELECT cabinet FROM wp_tt_doctors" );
$tt_tt          = $wpdb -> get_col( "SELECT time_table FROM wp_tt_doctors" );
$tt_disabled    = $wpdb -> get_col( "SELECT disabled FROM wp_tt_doctors" );


?>
<section class="time-table">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 sidebar-doctors-name">
                <div class="sidebar-doctors-name">
                <input type="text" id="tt_filter_doclist" placeholder="Поиск по фамилии" style="font-size: 0.8em" size="35">
                <ul class="doc_query_list mCustomScrollbar" id="doc_query_list">
                    <?php
                    
                    $uniqueSpecialty = $wpdb -> get_col( "SELECT specialty FROM wp_tt_doctors" );
                    $uniqueSpecialty = array_unique ( $uniqueSpecialty );
                    foreach ( $uniqueSpecialty as $value ) {
                        $specArr[$i] = $value;
                        $i++;
                    };

                    foreach ($specArr as $spec_value){
                        $queryArr = $wpdb -> get_results("SELECT * FROM wp_tt_doctors WHERE specialty = '$spec_value'");
                        echo '<h3 style="margin: 0;">'. $spec_value .  '</h3><br>';
                        foreach ($queryArr as $query) {
                            echo '<li><a class="doc_link_ajax" href="#%%" specialty="' . $spec_value . '" queryVal="' . $query -> id .'">' . $query -> last_name .' '. $query -> name . ' ' .  $query -> patronymic . '</a></li>';                           
                        }
                        echo '<hr>';
                    }
                    ?>
                </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="time-table-time-board text-center">
                    <h1 class="inform-title">Расписание приема врачей</h1>
                    <?php
                        echo '<i class="fa fa-user-md" style="font-size: 1.5em; color: #6d6c6c;"></i><span> </span><h1 id="tt_doc_name" style="display: inline;">Доктор</h1><br>'; 
                        echo '<i class="fa fa-tags" style="font-size: 1.1em; color: #6d6c6c;"></i><span> </span><span id="tt_doc_specialty">специальность</span><br>';
                        echo '<div class="tt_card_table">';
                        for( $i = 0; $i < 5; $i++ ) {
                            echo '<div class="tt_card">';
                            switch( $i ) {
                                case 0: echo '<i class="fa fa-calendar-check" style="font-size: 0.7em; color: #383838;"></i><span style=""> Пн</span><br>'; break;
                                case 1: echo '<i class="fa fa-calendar-check" style="font-size: 0.7em; color: #383838;"></i><span style=""> Вт</span><br>'; break;
                                case 2: echo '<i class="fa fa-calendar-check" style="font-size: 0.7em; color: #383838;"></i><span style=""> Ср</span><br>'; break;
                                case 3: echo '<i class="fa fa-calendar-check" style="font-size: 0.7em; color: #383838;"></i><span style=""> Чт</span><br>'; break;
                                case 4: echo '<i class="fa fa-calendar-check" style="font-size: 0.7em; color: #383838;"></i><span style=""> Пт</span><br>'; break;
                            }
                            echo ' c ';
                            echo '<span id="tt_hourstart'.$i.'" class="tt_hour"></span>';
                            echo '<span id="tt_minutestart'.$i.'" class="tt_minute"></span>';
                            echo ' до ';
                            echo '<span id="tt_hourend'.$i.'" class="tt_hour"></span>';
                            echo '<span id="tt_minuteend'.$i.'" class="tt_minute"></span>';
                            echo '</div>';
                        }
                        echo '</div>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var ajaxPathUrl = "<?php echo get_template_directory_uri() . '/theme-plugin/time-table/ajax/post.php' ?>";
</script>

<?php
get_footer();