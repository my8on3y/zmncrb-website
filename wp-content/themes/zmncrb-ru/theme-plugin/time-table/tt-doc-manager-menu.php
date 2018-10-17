<?php 
// Форма добавления нового врача в базу
?>

<h2>Форма добавления врача</h2>
<hr> <?php

if($_POST['DB_ADD']){
    insertDocInDb();
}

function insertDocInDb() {  

    function dataNormalize( $value ) {
        return mb_strtoupper(mb_substr($value,0,1,'UTF-8')) . mb_substr( mb_strtolower($value), 1);
    };

    
    $db_last_name = dataNormalize($_POST['last_name']);
    $db_name = dataNormalize($_POST['name']);
    $db_patronymic = dataNormalize($_POST['patronymic']);
    $db_specialty = dataNormalize($_POST['specialty']);
    
    if( ($db_last_name && $db_name && $db_patronymic && $db_specialty) == null ) :
        echo '<h3 style="color: red;">Заполните все поля!</h3>';
    else:
        global $wpdb;
        $wpdb -> insert(
            'wp_tt_doctors',
            array ('last_name' => $db_last_name, 'name' => $db_name, 'patronymic' => $db_patronymic, 'specialty' => $db_specialty )
        );
        echo '<h3 style="color: green;">Запись успешно добавлена!</h3>';
    endif;

}

?>

<form action="" method="POST">
    <h4 style="margin: 0;">Фамилия:</h4><input type="text" name="last_name" pattern="^[А-Яа-яЁё]+$"><br>
    <h4 style="margin: 0;">Имя:</h4><input type="text" name="name" pattern="^[А-Яа-яЁё]+$"><br>
    <h4 style="margin: 0;">Отчество:</h4><input type="text" name="patronymic" pattern="^[А-Яа-яЁё]+$"><br>
    <h4 style="margin: 0;">Специальность:</h4>
        <select name="specialty"> 
            <option value="Терапевт">Терапевт</option>
            <option value="Хирург">Хирург</option>
            <option value="Окулист">Окулист</option>
            <option value="Детский-Окулист">Детский-Окулист</option>
        </select><br><br>
    <input type="submit" value="Добавить" name="DB_ADD">
</form>
<hr>

