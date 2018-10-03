<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'zmncrb_db');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         't8djuLMW77H[141~~Y}4QS%}duF>Qr?5yj{<[2~6*:Eea oC`*FMVSMi1m1:} GY');
define('SECURE_AUTH_KEY',  '0Psi9P!TT+)6mjouq}Oi:Vg=)(_a?**jt@A%7X{p5_YDv5S6HmM;^vVp _n8vXnN');
define('LOGGED_IN_KEY',    'OWbPCW<1O(o (BZv5G2pl>O}aVLs3y>!=raz2fnxcm^KCV)1WxFqegF659C|Kzl^');
define('NONCE_KEY',        'uA|x^<UCAFV@nI~N#C%&e?;D^lNNADF2MBkJ|!fz/quO!^#H~}0.Xib*q/LlS0]Q');
define('AUTH_SALT',        'K{.kCS*W*Ha#R+,=+8Wto.`)<G2b~(}$RG=SY;J*af{YHjm*;8vd^y~&bVa5ooiJ');
define('SECURE_AUTH_SALT', ')^!Z=Zs Q(w!$m:I>R`]ROfXmwz$aL3-dKw:7.u>i~x]J|7#z2^*`KFum|$hyMpA');
define('LOGGED_IN_SALT',   '+J1&mQhPB`vs}qubdImE9!&~{1TnEqUoI]k~r}X5agW:;vZTWgRbf}nLux#VE+F~');
define('NONCE_SALT',       ' c|?DQ(e:%(D[ AZN$(H0>ad9u/c_&e=t6}A=Cvf^C;2ky4_-i~I|Px;LtND7PEr');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
