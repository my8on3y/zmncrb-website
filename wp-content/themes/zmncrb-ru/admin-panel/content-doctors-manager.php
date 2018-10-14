<?php ?>
<form action="" method="post" page="edit-time-board">
    <fieldset>
        <legend>Редактирование списка врачей</legend>
        <input type="text" name="name">
        <input type="submit">
    </fieldset>
 
</form>

<?php

$db_query = $wpdb->get_results('SELECT name FROM wp_tt_doctors WHERE id = 1', 'OBJECT');

foreach ($db_query as $key) {
    echo $key->name;
};