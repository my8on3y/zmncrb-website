<?php 

if($_POST['DB_ADD']){
    insertDocInDb();
}

function insertDocInDb() {    
    $db_last_name = (strtolower(trim($_POST['last_name'])))[0];
    $db_name = trim($_POST['name']);
    $db_patronymic = trim($_POST['patronymic']);
    $db_specialty = trim($_POST['specialty']);
    
    if( ($db_last_name && $db_name && $db_patronymic && $db_specialty) == null ) :
        echo 'Введите всё!';
    else:
        global $wpdb;
        $wpdb -> insert(
            'wp_tt_doctors',
            array ('last_name' => $_POST['last_name'], 'name' => $_POST['name'], 'patronymic' => $_POST['patronymic'], 'specialty' => $_POST['specialty'] )
        );
    endif;
}



?>

<h2>Форма добавления врача</h2>
<hr>
<form action="" method="POST">
    <h4 style="margin: 0;">Фамилия:</h4><input type="text" name="last_name" pattern="[А-Яа-яЁё]"><br>
    <h4 style="margin: 0;">Имя:</h4><input type="text" name="name" pattern="[А-Яа-яЁё]"><br>
    <h4 style="margin: 0;">Отчество:</h4><input type="text" name="patronymic" pattern="[А-Яа-яЁё]"><br>
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

