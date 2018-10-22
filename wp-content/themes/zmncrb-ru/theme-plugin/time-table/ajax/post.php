<?php

// указываем, что нам нужен минимум от WP
define('SHORTINIT', true);

// подгружаем среду WordPress
// WP делает некоторые проверки и подгружает только самое необходимое для подключения к БД
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

// тут мы можем общаться с БД. Но практически никакие функции WP работать не будут.
// Глобальные переменные $wp, $wp_query, $wp_the_query не установлены...
global $wpdb;

$ttQuery = $wpdb -> get_var("SELECT time_table FROM wp_tt_doctors WHERE id=$_POST[myQw]");
$ttQueryArr = json_encode( $ttQuery ); 
echo  $ttQuery;
