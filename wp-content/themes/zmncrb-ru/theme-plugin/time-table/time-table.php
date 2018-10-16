<?php
// Time-table require file

add_action( 'admin_menu', function(){
    add_menu_page( 'Редактор расписания', 'Расписание', 'manage_options', 'time-table', 'getTtMainMenu' );
    function getTtMainMenu(){
        require ( 'tt-main-menu.php' );
    }
} );

add_action( 'admin_menu', function(){
    add_submenu_page( 'time-table', 'Редактор врачей', 'Добавить врача', 'manage_options', 'time-table-doc-manager', 'getTtDocMenu' );
    function getTtDocMenu(){
        require ( 'tt-doc-manager-menu.php' );
    }
} );