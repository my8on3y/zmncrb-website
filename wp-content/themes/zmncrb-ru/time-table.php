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
                    <ul><?php 
                        foreach ($tt_last_name as $value) {
                            echo '<li><a class="doc_link_ajax" href="#" value="' . $tt_id[$i] .'">'. $value . '</a></li>';
                            $i++;
                        }
                    ?>
                    </ul>
                </div>
                <div class="col-lg-9">Расписание</div>
            </div>
        </div>
    </section>

<script type="text/javascript">
    var ajaxPathUrl = "<?php echo get_template_directory_uri() . '/theme-plugin/time-table/ajax/post.php' ?>";
</script>

<?php
get_footer();
