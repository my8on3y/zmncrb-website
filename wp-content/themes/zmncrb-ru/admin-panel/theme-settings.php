<?php

add_action( 'admin_menu', function(){
    add_submenu_page( 'edit-time-board', 'Редактор списка врачей', 'Список врачей', 'manage_options', 'doctors-manager', 'getDoctorsAddMenu' );
    
    function getDoctorsAddMenu() {
        get_template_part( 'admin-panel/content', 'doctors-manager' );
    };
} );



