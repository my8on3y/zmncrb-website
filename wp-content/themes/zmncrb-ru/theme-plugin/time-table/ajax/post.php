<?php

global $wpdb;
echo $wpdb -> get_var('SELECT name FROM wp_tt_doctors WHERE id = $_POST['a']');