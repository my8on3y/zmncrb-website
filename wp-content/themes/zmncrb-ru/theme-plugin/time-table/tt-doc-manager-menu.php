<?php 
// Форма добавления нового врача в базу
?>

<h2>Форма добавления врача</h2>
<hr> <?php

global $wpdb;

$file_json = file_get_contents( 'specialty.json', true );
$json_spec_list = json_decode( $file_json, true );
unset( $file_json );

$file_json = file_get_contents( 'profile.json', true );
$json_profile_list = json_decode( $file_json, true );
unset( $file_json );

class db_action {  
    private function dataNormalize( $value ) {
        return mb_strtoupper(mb_substr($value,0,1,'UTF-8')) . mb_substr( mb_strtolower($value), 1);
    }    
    private $db_id;
    private $db_last_name;
    private $db_name;
    private $db_patronymic;
    private $db_specialty;
    private $db_profile;
    private $db_cabinet;
    
    public function insertDocInDb() {        
        $db_last_name = $this -> dataNormalize($_POST['last_name']);
        $db_name = $this -> dataNormalize($_POST['name']);
        $db_patronymic = $this -> dataNormalize($_POST['patronymic']);
        $db_specialty = $_POST['specialty'];
        $db_profile = $_POST['profile'];
        $db_cabinet = $_POST['cabinet'];
        if( ($db_last_name && $db_name && $db_patronymic && $db_specialty && $db_profile && $db_cabinet) == null ) :
            echo '<h3 style="color: red;">Заполните все поля!</h3>';
        else:
            global $wpdb;
            $wpdb -> insert(
                'wp_tt_doctors',
                array ('last_name' => $db_last_name, 'name' => $db_name, 'patronymic' => $db_patronymic, 'specialty' => $db_specialty, 'profile' => $db_profile, 'cabinet' => $db_cabinet )
            );
            echo '<h3 style="color: green;">Запись успешно добавлена!</h3>';
        endif;
    }

    function updateDocInDb() {
        $db_last_name = $this -> dataNormalize( $_POST['last_name'] );
        $db_name = $this -> dataNormalize( $_POST['name'] );
        $db_patronymic = $this -> dataNormalize( $_POST['patronymic'] );
        $db_specialty = $this -> dataNormalize( $_POST['specialty'] );
        $db_specialty = $_POST['specialty'];
        $db_profile = $_POST['profile'];
        $db_cabinet = $_POST['cabinet'];
        if( ( $db_last_name && $db_name && $db_patronymic && $db_specialty && $db_profile && $db_cabinet  ) == null ) :
            echo '<h3 style="color: red;">Заполните все поля!</h3>';
        else:
            global $wpdb;
            $wpdb -> update(
                'wp_tt_doctors',
                array ( 'last_name' => $db_last_name, 'name' => $db_name, 'patronymic' => $db_patronymic, 'specialty' => $db_specialty, 'profile' => $db_profile, 'cabinet' => $db_cabinet  ),
                array ( 'id' => $_POST['id'])
            );
            echo '<h3 style="color: green;">Запись успешно обновлена!</h3>';
        endif;
    }

    function deleteDocInDb(){
        if( $_POST['DB_DELETE_COMFIRM'] == 'Удалить') {
            global $wpdb;
            $wpdb -> delete(
                'wp_tt_doctors',
                array ( 'id' => $_POST['id'] )
            );
            echo '<h3 style="color: green;">Запись успешно удалена!</h3>';
        }
        else { echo '<h3 style="color: red;">Запись не удалена! Для удаления записи введите слово "Удалить" в поле рядом.</h3>'; }
    }
}


$wpdb_action = new db_action();

if($_POST['DB_ADD']) {
    $wpdb_action -> insertDocInDb();
}

if($_POST['DB_UPDATE']) {
    $wpdb_action -> updateDocInDb();
}

if($_POST['DB_DELETE']) {
    $wpdb_action -> deleteDocInDb();        
}

$db_query_doc_list = $wpdb -> get_results("SELECT * FROM wp_tt_doctors");


echo '<form action="" method="POST">';
echo    '<h4 style="margin: 10px;">Фамилия:</h4><input type="text" name="last_name" pattern="^[А-Яа-яЁё]+$"><br>';
echo    '<h4 style="margin: 10px;">Имя:</h4><input type="text" name="name" pattern="^[А-Яа-яЁё]+$"><br>';
echo    '<h4 style="margin: 10px;">Отчество:</h4><input type="text" name="patronymic" pattern="^[А-Яа-яЁё]+$"><br>';
echo    '<div class="doc-flex-section">';
    echo    '<div class="doc-section">';
    echo    '<h4 style="margin: 10px;">Специальность:</h4>';
    echo    '<select name="specialty">';
                foreach( $json_spec_list as $value ):                
                    echo '<option value="' . $value . '">' . $value . '</option>';
                endforeach;
    echo    '</select>';
    echo    '</div>';
    echo    '<div class="doc-section">';
    echo    '<h4 style="margin: 10px;">Профиль:</h4>';
    echo    '<select name="profile">';
                foreach( $json_profile_list as $value ):                
                    echo '<option value="' . $value . '">' . $value . '</option>';
                endforeach;
    echo    '</select>';
    echo    '</div>';
    echo    '<div class="doc-section">';
    echo    '<h4 style="margin: 10px;">№ кабинета:</h4><input type="number" name="cabinet" pattern="[0-9]{,3}" placeholder="каб." max="999" min="0">';
    echo    '</div>';
echo    '</div>';
echo    '<input type="submit" value="Добавить" name="DB_ADD">';
echo    '</form>';
echo    '<hr>';

echo    '<h2>Список врачей изменить/удалить</h2>';

    foreach( $db_query_doc_list as $value ):
echo '<form action="" method="POST">';
echo    '<input type="hidden" name="id" value="' . $value -> id . '">';
echo    '<input type="text" name="last_name" value="' . $value -> last_name . '" pattern="^[А-Яа-яЁё]+$">';
echo    '<input type="text" name="name" value="' . $value -> name . '" pattern="^[А-Яа-яЁё]+$">';
echo    '<input type="text" name="patronymic" value="' . $value -> patronymic . '" pattern="^[А-Яа-яЁё]+$">';
echo    '<select name="specialty">';
echo            '<option value="' . $value -> specialty . '" selected="' . $value -> specialty . '">' . $value -> specialty . '</option>';
            foreach( $json_spec_list as $j_value ):
                if( $j_value != $value -> specialty ) {                
echo            '<option value="' . $j_value . '">' . $j_value . '</option>';
                }
            endforeach;
echo    '</select>';
echo    '<select name="profile">';
echo    '<option value="' . $value -> profile . '" selected="' . $value -> profile . '">' . $value -> profile . '</option>';
                foreach( $json_profile_list as $j_value ):                
                    if( $j_value != $value -> profile ) {                
echo                 '<option value="' . $j_value . '">' . $j_value . '</option>';                                        }
                endforeach;
echo    '</select>';
echo    '<input type="number" name="cabinet" pattern="[0-9]{,3}" placeholder="каб." max="999" min="0" value="' . $value -> cabinet . '">';
echo    '<input type="submit" name="DB_UPDATE" value="Измеинить">';
echo    '<input type="submit" name="DB_DELETE" value="Удалить">';
echo    '<input type="text" name="DB_DELETE_COMFIRM" placeholder="Введите -Удалить-">';
echo '</form>';
echo '<br>';
    endforeach;

?>

<style>
.doc-flex-section {
    display: flex;
    justify-content: space-between;
    width: 40%;
    padding: 15px;
    margin-top: 15px;
    margin-bottom: 15px;
    border: 1px dashed #909090;
}

.doc-flex-section .doc-section {

</style>