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
            <div class="col-lg-3 sidebar-doctors-name">
                <ul>
                    <?php 
                        $i = 0;
                        foreach ($tt_id as $value) {
                            echo '<li><a class="doc_link_ajax" href="#" queryVal="' . $value .'">' . $tt_last_name[$i] . ' ' . $tt_name[$i] . ' ' . $tt_patronymic[$i] . '</a></li>';
                            $i++;
                        }
                        unset ($i);
                    ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="time-table-time-board">
                    <?php
                        echo '<h1 id="tt_doc_name"></h1>'; 
                        echo '<div>';
                        for( $i = 0; $i < 5; $i++ ) {
                            echo '<div class="tt_card">';
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