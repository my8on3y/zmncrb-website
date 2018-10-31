<?php
/**
* Plugin Name: For The Visually Impaired
* Plugin URI: https://984.ru/for-the-visually-impaired.html
* Description: Add to Widget For The Visually Impaired (Плагин "Для слабовидящих").
* Version: 0.54
* Author: 984.ru
* Author URI: https://984.ru/
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
 
 // Define plugin version for future releases
if (!defined('WFVI_PLUGIN_VERSION_NUM')) {
    define('WFVI_PLUGIN_VERSION_NUM', '0.53');
}
//if (get_option('wfvi_plugin_version')!=WFVI_PLUGIN_VERSION_NUM) {	

//}
update_option('wfvi_plugin_version', WFVI_PLUGIN_VERSION_NUM); 

function vi_load_plugin_textdomain() {

	$domain = 'for-the-visually-impaired';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

	load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
	load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

}
//add_action( 'init', 'vi_load_plugin_textdomain' );
add_action( 'plugins_loaded', 'vi_load_plugin_textdomain' );

function vi_plugin_setup_menu(){
 add_menu_page( __('For The Visually Impaired Settings', 'for-the-visually-impaired'), __('For The Visually Impaired', 'for-the-visually-impaired'), 'manage_options', 'for-the-visually-impaired', 'vi_content_init', plugins_url('img/vi_a_icon.png', __FILE__));
 
 }


function vi_content_init(){
//    check_admin_referer();
    $opt_txt_size = 'ftvi_option_txt_size';
    $opt_sxema = 'ftvi_option_sxema';
    $opt_image = 'ftvi_option_image';
    $opt_font = 'ftvi_option_font';
    $opt_kerning = 'ftvi_option_kerning';
    $opt_line = 'ftvi_option_line';
    $opt_razmer_images = 'ftvi_option_razmer_images';
    $opt_allbackgrnd = 'ftvi_option_allbackgrnd';
    $opt_reload_page = 'ftvi_option_reload_page';
    $opt_auto_p_on = 'ftvi_option_auto_p_on';
    $opt_scrool_panel = 'ftvi_option_scrool_panel';
    $opt_js_in_header = 'ftvi_option_js_in_header';	
    $opt_bcolor = 'ftvi_option_bcolor';
    $opt_btxtcolor = 'ftvi_option_btxtcolor';
    $opt_bimage = 'ftvi_option_bimage';
    $opt_bimage2 = 'ftvi_option_bimage2';
    $opt_btxt = 'ftvi_option_btxt';
    $opt_btxt2 = 'ftvi_option_btxt2';
    
	$hidden_field_name = 'ftvi_option_hidden';
    
	$data_txt_size = 'ftvi_opt_txt_size';
    $data_sxema = 'ftvi_opt_sxema';
    $data_image = 'ftvi_opt_image';
    $data_font = 'ftvi_opt_font';
    $data_kerning = 'ftvi_opt_kerning';
    $data_line = 'ftvi_opt_line';
    $data_razmer_images = 'ftvi_opt_razmer_images';	
    $data_allbackgrnd = 'ftvi_opt_allbackgrnd';
    $data_reload_page = 'ftvi_opt_reload_page';
    $data_auto_p_on = 'ftvi_opt_auto_p_on';
    $data_scrool_panel = 'ftvi_opt_scrool_panel';
    $data_scrool_panel = 'ftvi_opt_js_in_header';	
    $data_bcolor = 'ftvi_opt_bcolor';
    $data_btxtcolor = 'ftvi_opt_btxtcolor';
    $data_bimage = 'ftvi_opt_bimage';
    $data_bimage2 = 'ftvi_opt_bimage2';
    $data_btxt = 'ftvi_opt_btxt';
    $data_btxt2 = 'ftvi_opt_btxt2';


    $opt_val_txt_size = get_option( $opt_txt_size );
    $opt_val_sxema = get_option( $opt_sxema );
    $opt_val_image = get_option( $opt_image );
    $opt_val_font = get_option( $opt_font );
    $opt_val_kerning = get_option( $opt_kerning );
    $opt_val_line = get_option( $opt_line );
    $opt_val_razmer_images = get_option( $opt_razmer_images );
    $opt_val_allbackgrnd = get_option( $opt_allbackgrnd );
    $opt_val_reload_page = get_option( $opt_reload_page );
	$opt_val_auto_p_on = get_option( $opt_auto_p_on );
	$opt_val_scrool_panel = get_option( $opt_scrool_panel ,"1");
	$opt_val_js_in_header = get_option( $opt_js_in_header ,"0");
    $opt_val_bcolor = get_option( $opt_bcolor );
    $opt_val_btxtcolor = get_option( $opt_btxtcolor );
    $opt_val_bimage = get_option( $opt_bimage );
    $opt_val_bimage2 = get_option( $opt_bimage2 );
    $opt_val_btxt = get_option( $opt_btxt );
    $opt_val_btxt2 = get_option( $opt_btxt2 );
	if (!empty($_POST[ $hidden_field_name ])){$optfn=$_POST[ $hidden_field_name ];}else{$optfn="";}
    if ( $optfn== 'Y' ) {
		if (( $opt_val_txt_size ) != $_POST[ $data_txt_size ] ) {$opt_val_txt_size=$_POST[ $data_txt_size ]; update_option( $opt_txt_size, $opt_val_txt_size);}
		if (( $opt_val_sxema ) != $_POST[ $data_sxema ] ) {$opt_val_sxema=$_POST[ $data_sxema ];update_option( $opt_sxema, $opt_val_sxema );}
		if (( $opt_val_image ) != $_POST[ $data_image ] ) {$opt_val_image=$_POST[ $data_image ];update_option( $opt_image, $opt_val_image);}
		if (( $opt_val_font ) != $_POST[ $data_font ] ) {$opt_val_font=$_POST[ $data_font ];update_option( $opt_font, $opt_val_font );}
		if (( $opt_val_kerning ) != $_POST[ $data_kerning ] ) {$opt_val_kerning=$_POST[ $data_kerning ];update_option( $opt_kerning, $opt_val_kerning );}
		if (( $opt_val_line ) != $_POST[ $data_line ] ) {$opt_val_line=$_POST[ $data_line ];update_option( $opt_line, $opt_val_line );}
		if (( $opt_val_razmer_images ) != $_POST[ $data_razmer_images ] ) {$opt_val_razmer_images=$_POST[ $data_razmer_images ] ;update_option( $opt_razmer_images,$opt_val_razmer_images);}
		if (( $opt_val_allbackgrnd ) != $_POST[ $data_allbackgrnd ] ) {$opt_val_allbackgrnd=$_POST[ $data_allbackgrnd ] ;update_option( $opt_allbackgrnd,$opt_val_allbackgrnd);}
		if (( $opt_val_reload_page ) != $_POST[ $data_reload_page ] ) {$opt_val_reload_page=$_POST[ $data_reload_page ];update_option( $opt_reload_page,$opt_val_reload_page);}
		if (( $opt_val_auto_p_on ) != $_POST[ $data_auto_p_on ] ) {$opt_val_auto_p_on=$_POST[ $data_auto_p_on ];update_option( $opt_auto_p_on,$opt_val_auto_p_on);}				
		if (( $opt_val_scrool_panel ) != $_POST[ $data_scrool_panel ] ) {$opt_val_scrool_panel=$_POST[ $data_scrool_panel ];update_option( $opt_scrool_panel,$opt_val_scrool_panel);}		
		if (( $opt_val_js_in_header ) != $_POST[ $data_js_in_header ] ) {$opt_val_js_in_header=$_POST[ $data_js_in_header ];update_option( $opt_js_in_header,$opt_val_js_in_header);}		
		if (( $opt_val_bcolor ) != $_POST[ $data_bcolor ] ) {$opt_val_bcolor=$_POST[ $data_bcolor ];update_option( $opt_bcolor, $opt_val_bcolor);}
		if (( $opt_val_btxtcolor ) != $_POST[ $data_btxtcolor ] ) {$opt_val_btxtcolor=$_POST[ $data_btxtcolor ];update_option( $opt_btxtcolor, $opt_val_btxtcolor);}
		if (( $opt_val_bimage ) != $_POST[ $data_bimage ] ) {$opt_val_bimage=$_POST[ $data_bimage ] ;update_option( $opt_bimage,$opt_val_bimage );}
		if (( $opt_val_bimage2 ) != $_POST[ $data_bimage2 ] ) {$opt_val_bimage2=$_POST[ $data_bimage2 ] ;update_option( $opt_bimage2,$opt_val_bimage2 );}
		if (( $opt_val_btxt ) != $_POST[ $data_btxt ] ) {$opt_val_btxt=$_POST[ $data_btxt ] ;update_option( $opt_btxt, $opt_val_btxt);}
		if (( $opt_val_btxt2 ) != $_POST[ $data_btxt2 ] ) {$opt_val_btxt2=$_POST[ $data_btxt2 ] ;update_option( $opt_btxt2, $opt_val_btxt2);}
?>
<div class="updated"><p><strong><?php _e('Options saved.', 'for-the-visually-impaired' ); ?></strong></p></div>
<?php
    }

        echo '<style>ul#ulxx{list-style-type:square;margin-left:20px;}</style>';
        echo '<div class="wrap">';
		echo '<h1>'.__('For The Visually Impaired','for-the-visually-impaired').'</h1>';
		echo '<h3>он включает в себя:</h3>';
        echo '<ul id="ulxx">';
        echo '<li>Включение и отключения показа изображений(картинок), при отключении - показывается тайтл или алт изображения, режим "черно-белых" изображений;</li>';
		echo '<li>Выбирать шрифт (2 режима) <strong>(Arial, Times New Roman)</strong>;</li>';
        echo '<li>Изменять размер шрифта (5 режимов) <strong>(14px, 16px, 18px, 22px, 26px)</strong>;</li>';
        echo '<li>Изменять межстрочный интервал;</li>';
        echo '<li>Изменять интервал между символами;</li>';
        echo '<li>Изменять фона страницы (5 режимов) <strong>(Черным по белому, Белым по черному, Темно-синим по голубому, Коричневым по бежевому, Зеленым по темно-коричневому)</strong>;</li>';
        echo '<li>Добавлять кнопку в виджетах;</li>';
        echo '<li>Добавлять кнопку в меню;</li>';
        echo '<li>Добавлять шорт код [FTVI]</li>';
        echo '<li>Доступны языки: русский, англ.;</li>';
        echo '</ul>';		
		echo '<h3>Если у вас возникли какие-либо вопросы, задавайте их на странице плагина: <a href="https://984.ru/for-the-visually-impaired.html" target=_blank>For the visually impaired</a></h3>';
		echo '<hr>';		
    echo "<h2>" . __('For The Visually Impaired Settings', 'for-the-visually-impaired') . ":</h2>";
    ?>

<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Text size:", 'for-the-visually-impaired' ); ?> 
<select name="<?php echo $data_txt_size; ?>">
<option value="14" <?php echo ($opt_val_txt_size=="14")?"selected":""; ?>>14</option>\
<option value="16" <?php echo ($opt_val_txt_size=="16")?"selected":""; ?>>16</option>\
<option value="18" <?php echo ($opt_val_txt_size=="18")?"selected":""; ?>>18</option>\
<option value="22" <?php echo ($opt_val_txt_size=="22")?"selected":""; ?>>22</option>\
<option value="26" <?php echo ($opt_val_txt_size=="26")?"selected":""; ?>>26</option>\
</select>
</p><hr />
<p><?php _e("Color Schem:", 'for-the-visually-impaired' ); ?> 
<select name="<?php echo $data_sxema; ?>">
<option value="1" <?php echo ($opt_val_sxema=="1")?"selected>":">"; _e("In black and white", 'for-the-visually-impaired' );?></option>\
<option value="2" <?php echo ($opt_val_sxema=="2")?"selected>":">"; _e("White on black", 'for-the-visually-impaired' );?></option>\
<option value="3" <?php echo ($opt_val_sxema=="3")?"selected>":">"; _e("Dark blue on light blue", 'for-the-visually-impaired' );?></option>\
<option value="4" <?php echo ($opt_val_sxema=="4")?"selected>":">"; _e("Brown on beige", 'for-the-visually-impaired' );?></option>\
<option value="5" <?php echo ($opt_val_sxema=="5")?"selected>":">"; _e("Green on dark brown", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />
<p><?php _e("Image:", 'for-the-visually-impaired' ); ?> 
<select name="<?php echo $data_image; ?>">
<option value="0" <?php echo ($opt_val_image=="0")?"selected>":">"; _e("Disable", 'for-the-visually-impaired' );?></option>\
<option value="1" <?php echo ($opt_val_image=="1")?"selected>":">"; _e("Enable", 'for-the-visually-impaired' );?></option>\
<option value="2" <?php echo ($opt_val_image=="2")?"selected>":">"; _e("White&Black", 'for-the-visually-impaired' );?></option>\
</select>
</p>
<p><?php _e("Image size", 'for-the-visually-impaired' ); ?> :
<select name="<?php echo $data_razmer_images; ?>">
<option value="0" <?php echo ($opt_val_razmer_images=="0")?"selected>":">"; _e("Disable", 'for-the-visually-impaired' );?></option>\
<option value="1" <?php echo ($opt_val_razmer_images=="1")?"selected>":">"; _e("Enable", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />
<p><?php _e("Image_background:", 'for-the-visually-impaired' ); ?> 
<select name="<?php echo $data_allbackgrnd; ?>">
<option value="0" <?php echo ($opt_val_allbackgrnd=="0")?"selected>":">"; _e("Disable", 'for-the-visually-impaired' );?></option>\
<option value="1" <?php echo ($opt_val_allbackgrnd=="1")?"selected>":">"; _e("Enable", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />

<p><?php _e("Font:", 'for-the-visually-impaired' ); ?> 
<select name="<?php echo $data_font; ?>">
<option value="1" <?php echo ($opt_val_font=="1")?"selected>":">"; _e("Arial", 'for-the-visually-impaired' );?></option>\
<option value="2" <?php echo ($opt_val_font=="2")?"selected>":">"; _e("Times New Roman", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />

<p><?php _e("Kerning:", 'for-the-visually-impaired' ); ?> 
<select name="<?php echo $data_kerning; ?>">
<option value="0" <?php echo ($opt_val_kerning=="0")?"selected>":">"; _e("Small", 'for-the-visually-impaired' );?></option>\
<option value="2" <?php echo ($opt_val_kerning=="2")?"selected>":">"; _e("Normal", 'for-the-visually-impaired' );?></option>\
<option value="5" <?php echo ($opt_val_kerning=="5")?"selected>":">"; _e("Big", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />

<p><?php _e("Space line:", 'for-the-visually-impaired' ); ?> 
<select name="<?php echo $data_line; ?>">
<option value="0" <?php echo ($opt_val_line=="0")?"selected>":">"; _e("Small", 'for-the-visually-impaired' );?></option>\
<option value="2" <?php echo ($opt_val_line=="2")?"selected>":">"; _e("Normal", 'for-the-visually-impaired' );?></option>\
<option value="4" <?php echo ($opt_val_line=="4")?"selected>":">"; _e("Big", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />


<p><?php _e("Button colors:", 'for-the-visually-impaired' ); ?> 
<input type="text" name="<?php echo $data_bcolor; ?>" value="<?php echo $opt_val_bcolor; ?>" size="20">
</p>

<p><?php _e("Button text colors:", 'for-the-visually-impaired' ); ?> 
<input type="text" name="<?php echo $data_btxtcolor; ?>" value="<?php echo $opt_val_btxtcolor; ?>" size="20">
</p>

<p><?php _e("Button image on:", 'for-the-visually-impaired' ); ?> 
<fieldset>
	<label><input name="<?php echo $data_bimage; ?>" value="0" type="radio" <?php echo ($opt_val_bimage=="0")?'checked="checked">':">"; _e("No image", 'for-the-visually-impaired' );?></label>
	<label><input name="<?php echo $data_bimage; ?>" value="1" type="radio" <?php echo ($opt_val_bimage=="1")?'checked="checked">':">"; echo "<img src='".plugins_url('img/icon_16.png', __FILE__)."'";?>></label>
	<label><input name="<?php echo $data_bimage; ?>" value="2" type="radio" <?php echo ($opt_val_bimage=="2")?'checked="checked">':">"; echo "<img src='".plugins_url('img/icon_24.png', __FILE__)."'";?>></label>
	<label><input name="<?php echo $data_bimage; ?>" value="3" type="radio" <?php echo ($opt_val_bimage=="3")?'checked="checked">':">"; echo "<img src='".plugins_url('img/icon_41.png', __FILE__)."'";?>></label>
	<label><input name="<?php echo $data_bimage; ?>" value="4" type="radio" <?php echo ($opt_val_bimage=="4")?'checked="checked">':">"; echo "<img src='".plugins_url('img/icon_58.png', __FILE__)."'";?>></label>

</fieldset>

</p>

<p><?php _e("Button image off:", 'for-the-visually-impaired' ); 

	?> 
<fieldset>
	<label><input name="<?php echo $data_bimage2; ?>" value="0" type="radio" <?php echo ($opt_val_bimage2=="0")?'checked="checked">':">"; _e("No image", 'for-the-visually-impaired' );?></label>
	<label><input name="<?php echo $data_bimage2; ?>" value="1" type="radio" <?php echo ($opt_val_bimage2=="1")?'checked="checked">':">"; echo "<img src='".plugins_url('img/icon_16x.png', __FILE__)."'";?>></label>
	<label><input name="<?php echo $data_bimage2; ?>" value="2" type="radio" <?php echo ($opt_val_bimage2=="2")?'checked="checked">':">"; echo "<img src='".plugins_url('img/icon_24x.png', __FILE__)."'";?>></label>
	<label><input name="<?php echo $data_bimage2; ?>" value="3" type="radio" <?php echo ($opt_val_bimage2=="3")?'checked="checked">':">"; echo "<img src='".plugins_url('img/icon_41x.png', __FILE__)."'";?>></label>
	<label><input name="<?php echo $data_bimage2; ?>" value="4" type="radio" <?php echo ($opt_val_bimage2=="4")?'checked="checked">':">"; echo "<img src='".plugins_url('img/icon_58x.png', __FILE__)."'";?>></label>

</fieldset>

</p>

<p><?php _e("Text buttons on:", 'for-the-visually-impaired' ); ?> 
<input type="text" name="<?php echo $data_btxt; ?>" value="<?php echo $opt_val_btxt; ?>" size="80">
</p>
<p><?php _e("Text button off:", 'for-the-visually-impaired' ); ?> 
<input type="text" name="<?php echo $data_btxt2; ?>" value="<?php echo $opt_val_btxt2; ?>" size="80">
</p>
<hr />




<p><?php _e("Reload page:", 'for-the-visually-impaired' ); ?> 
<select name="<?php echo $data_reload_page; ?>">
<option value="0" <?php echo ($opt_val_reload_page=="0")?"selected>":">"; _e("Disable", 'for-the-visually-impaired' );?></option>\
<option value="1" <?php echo ($opt_val_reload_page=="1")?"selected>":">"; _e("Enable", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />

<p><?php _e("Autostart panel", 'for-the-visually-impaired' ); ?>: 
<select name="<?php echo $data_auto_p_on; ?>">
<option value="0" <?php echo ($opt_val_auto_p_on=="0")?"selected>":">"; _e("Disable", 'for-the-visually-impaired' );?></option>\
<option value="1" <?php echo ($opt_val_auto_p_on=="1")?"selected>":">"; _e("Enable", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />
<p><?php _e("Scrool panel", 'for-the-visually-impaired' ); ?> :
<select name="<?php echo $data_scrool_panel; ?>">
<option value="0" <?php echo ($opt_val_scrool_panel=="0")?"selected>":">"; _e("Disable", 'for-the-visually-impaired' );?></option>\
<option value="1" <?php echo ($opt_val_scrool_panel=="1")?"selected>":">"; _e("Enable", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />
<p><?php _e("Javascript in header", 'for-the-visually-impaired' ); ?> :
<select name="<?php echo $data_js_in_header; ?>">
<option value="0" <?php echo ($opt_val_js_in_header=="0")?"selected>":">"; _e("Disable", 'for-the-visually-impaired' );?></option>\
<option value="1" <?php echo ($opt_val_js_in_header=="1")?"selected>":">"; _e("Enable", 'for-the-visually-impaired' );?></option>\
</select>
</p><hr />

<p><?php _e("When you activate the mode for the visually impaired , to the 'body' is added to the class of 'visually-impaired-controls-enable', the transition to the normal class is removed from the 'body'.", 'for-the-visually-impaired' ); ?> 



</p><hr />


<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'for-the-visually-impaired' ) ?>" /> 
<!--<input type="submit" name="Reset" value="<?php _e('Reset Options', 'for-the-visually-impaired' ) ?>" /> -->
</p>

</form>
</div>

<?php
}


function vi_cookie(){
	wp_register_script('vi_cookie',plugin_dir_url( __FILE__ ).'js/js.cookie.js', array('jquery'),'2.1.0', get_option( 'ftvi_option_js_in_header' ));
	wp_enqueue_script('vi_cookie');
}

function add_vi_script(){
	

	wp_register_script('add_vi_script',plugin_dir_url( __FILE__ ).'js/js.for.the.visually.impaired.js', array('jquery'),'0.53', get_option( 'ftvi_option_js_in_header' ));
	wp_enqueue_script('add_vi_script');
	 $opt_val_txt_size = get_option( 'ftvi_option_txt_size' );
    $opt_val_sxema = get_option( 'ftvi_option_sxema' );
    $opt_val_image = get_option( 'ftvi_option_image' );
    $opt_val_font = get_option( 'ftvi_option_font' );
    $opt_val_kerning = get_option( 'ftvi_option_kerning' );
    $opt_val_line = get_option( 'ftvi_option_line' );
    $opt_val_allbackgrnd = get_option( 'ftvi_option_allbackgrnd' );
    $opt_val_reload_page = get_option( 'ftvi_option_reload_page' );
	$opt_val_auto_p_on = get_option( 'ftvi_option_auto_p_on' );
	$opt_val_scrool_panel = get_option( 'ftvi_option_scrool_panel' );
    $opt_val_btxt = get_option( 'ftvi_option_btxt' );
    $opt_val_btxt2 = get_option( 'ftvi_option_btxt2' );
    $opt_val_btxtcolor = get_option( 'ftvi_option_btxtcolor' );
    $opt_val_bcolor = get_option( 'ftvi_option_bcolor' );
	$opt_val_razmer_images = get_option( 'ftvi_option_razmer_images' );


	
	wp_localize_script('add_vi_script', 'js_vi_script', array('txt_size'=>$opt_val_txt_size,'sxema'=>$opt_val_sxema,'image'=>$opt_val_image,'font'=>$opt_val_font,'kerning'=>$opt_val_kerning,'line'=>$opt_val_line,'allbackgrnd'=>$opt_val_allbackgrnd,'reload_page'=>$opt_val_reload_page,'auto_p_on'=>$opt_val_auto_p_on,'scrool_panel'=>$opt_val_scrool_panel,'btxt'=>$opt_val_btxt,'btxt2'=>$opt_val_btxt2,'btxtcolor'=>$opt_val_btxtcolor,'bcolor'=>$opt_val_bcolor,'img_close2' => vi_get_img_src2(), 'razmer_images'=>$opt_val_razmer_images,
	'fs_title1'=>__( 'Small font size', 'for-the-visually-impaired' ),
	'fs_title2'=>__( 'Decrease font size', 'for-the-visually-impaired' ),
	'fs_title3'=>__( 'Normal font size', 'for-the-visually-impaired' ),
	'fs_title4'=>__( 'Larger font size', 'for-the-visually-impaired' ),
	'fs_title5'=>__( 'Large font size', 'for-the-visually-impaired' ),
	'sxem_title'=>__( 'C', 'for-the-visually-impaired' ),
	'sxem_title1'=>__( 'Color Scheme : Black and white', 'for-the-visually-impaired' ),
	'sxem_title2'=>__( 'Color scheme : White on black', 'for-the-visually-impaired' ),
	'sxem_title3'=>__( 'Color Scheme : Dark blue on light blue', 'for-the-visually-impaired' ),
	'sxem_title4'=>__( 'Color scheme : Brown on beige', 'for-the-visually-impaired' ),
	'sxem_title5'=>__( 'Color scheme : Green on dark brown', 'for-the-visually-impaired' ),
	'img_title_on'=>__( 'Enable images', 'for-the-visually-impaired' ),
	'img_title_gs'=>__( 'Black and white images', 'for-the-visually-impaired' ),
	'img_title_off'=>__( 'Disable images', 'for-the-visually-impaired' ),
	'setting_title'=>__( 'Settings', 'for-the-visually-impaired' ),
	'close_title'=>__( 'Return to normal', 'for-the-visually-impaired' ),
	'settings_title'=>__( 'Font Settings', 'for-the-visually-impaired' ),
	'setfont_title'=>__( 'Select a font', 'for-the-visually-impaired' ),
	'setsplet'=>__( 'Spacing between letters', 'for-the-visually-impaired' ),
	'setspline'=>__( 'Line Spacing', 'for-the-visually-impaired' ),
	'standart'=>__( 'Standard', 'for-the-visually-impaired' ),
	'average'=>__( 'Average', 'for-the-visually-impaired' ),
	'big'=>__( 'Big', 'for-the-visually-impaired' ),
	'sel_sxem'=>__( 'Selecting a color scheme', 'for-the-visually-impaired' ),
	'closepanel'=>__( 'Close panel', 'for-the-visually-impaired' ),
	'defsetpanel'=>__( 'Default settings', 'for-the-visually-impaired' ),
	'noimgdescr'=>__( 'no description to the image', 'for-the-visually-impaired' ),
	'picture'=>__( 'Picture', 'for-the-visually-impaired' )
	));	
}


function add_vi_styles() {
    wp_register_style('vi-style',plugin_dir_url( __FILE__ ).'css/styles.css');
    wp_enqueue_style('vi-style');
	
		$opt_val_bimage = get_option( 'ftvi_option_bimage','1' );
		
		$opt_val_bcolor = get_option( 'ftvi_option_bcolor','#DB151C' );
	    $opt_val_btxtcolor = get_option( 'ftvi_option_btxtcolor','#ffffff' );


$imgsz=array('1'=>"16",'2'=>"24",'3'=>"41",'4'=>"58");
	$color = '#FF0000';
	$custom_css = "
		.vi-on-img-button{
  background: url(".plugins_url("img/icon_".$imgsz[$opt_val_bimage], __FILE__).".png) 100% 100% no-repeat;
  background-size: contain;
    display: inline-block;
    vertical-align: middle;
    height: ".$imgsz[$opt_val_bimage]."px;
    width: ".$imgsz[$opt_val_bimage]."px;
    text-decoration: none;
    outline: 0;
		}
#bt_widget-vi-on a {
	text-align: center;
	cursor: pointer;
	background: ".$opt_val_bcolor.";
	box-shadow: 0 -3px 0 rgba(0, 0, 0, 0.1) inset;
	border: 0 none;
	border-radius: 6px;
	overflow: hidden;
    font-size: 15px;
    padding: 13px 18px 16px;
	text-decoration: none;
	display: inline-block;
	font-family: arial;
    font-weight: 700;
	line-height: 100%;
	text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
	margin-top: -3px;
    color: ".$opt_val_btxtcolor.";
    border-radius: 10px;
    vertical-align:middle;

}


#bt_widget-vi-on a:hover {
	-o-box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.14) inset;
	-moz-box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.14) inset;
	-webkit-box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.14) inset;
	box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.14) inset;
	text-decoration: underline;	
}

#bt_widget-vi-on .vi_widget_img {
    vertical-align:middle;
}
#bt_widget-vi-on  {
	    position: relative;
    top: 0;
    left: 0;
    color: #000000;
    font-size: 18px;
    letter-spacing: 0;
    text-align: center;
}
.vi-close{
	vertical-align: middle;
	text-align: center;
	display: flex;
	justify-content: center;
	align-items: center;
	font-size: 16px;
	text-decoration: none;
	font-weight: bold;
	vertical-align: middle;
	word-break: break-all;
    word-wrap: break-word;

}
.bt_widget-vi{
	vertical-align: middle;
	text-align: center;
	
}
		
		";
	wp_add_inline_style( 'vi-style', $custom_css );

}
/////////
function my_register_vi_menu() {
 
$custom_param = array( 0 => '' );
add_meta_box( 'my-menu-test-metabox', 'FTVI-menu', 'my_render_vi_menu', 'nav-menus', 'side', 'default', $custom_param );
 
}

function my_render_vi_menu( $object, $args ) {
 
global $nav_menu_selected_id;
  
$my_items = array(
(object) array( 
'ID' => 1,
 'db_id' => 0,
 'menu_item_parent' => 0,
 'object_id' => 1,
 'post_parent' => 0,
 'type' => 'FTVI-menu',
 'object' => 'my-vi-object',
 'type_label' => 'FTVI-menu',
 'title' => get_option( 'ftvi_option_btxt' ),
 'url' => '#',
 'target' => '',
 'attr_title' => '',
 'description' => '',
 'classes' => array('bt_menu-vi-on'),
 'xfn' => ''
 ),
(object) array( 
 'ID' => 2,
 'db_id' => 0,
 'menu_item_parent' => 0,
 'object_id' => 2,
 'post_parent' => 0,
 'type' => 'FTVI-menu',
 'object' => 'my-vi-object',
 'type_label' => 'FTVI-menu',
 'title' => vi_get_img_src(),
 'url' => '#',
 'target' => '',
 'attr_title' => '',
 'description' => '',
 'classes' => array('bt_menu-vi-on'),
 'xfn' => ''
 ),
(object) array( 
  'ID' => 3,
 'db_id' => 0,
 'menu_item_parent' => 0,
 'object_id' => 3,
 'post_parent' => 0,
 'type' => 'FTVI-menu',
 'object' => 'my-vi-object',
 'type_label' => 'FTVI-menu',
 'title' => vi_get_img_src().' '.get_option( 'ftvi_option_btxt' ),
 'url' => '#',
 'target' => '',
 'attr_title' => '',
 'description' => '',
 'classes' => array('bt_menu-vi-on'),
 'xfn' => ''
 )
 );
$db_fields = false;
//if ( false ) {$db_fields = array( 'parent' => 'parent', 'id' => 'post_parent' );}
$walker = new Walker_Nav_Menu_Checklist( $db_fields );
$removed_args = array(
'action',
'customlink-tab',
'edit-menu-item',
'menu-item',
'page-tab',
'_wpnonce',
); ?>
<div id="my-plugin-div">
<div id="tabs-panel-my-plugin-all" class="tabs-panel tabs-panel-active">
<ul id="my-plugin-checklist-pop" class="categorychecklist form-no-clear" >
<?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $my_items ), 0, (object) array( 'walker' => $walker ) ); ?>
</ul>
<p class="button-controls">
<span class="list-controls">
<a href="<?php
echo esc_url(add_query_arg(
array(
'my-plugin-all' => 'all',
'selectall' => 1,
),
remove_query_arg( $removed_args )
));
?>#my-menu-test-metabox" class="select-all"><?php _e( 'Select All' ); ?></a>
</span>
<span class="add-to-menu">
<input type="submit"<?php wp_nav_menu_disabled_check( $nav_menu_selected_id ); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to Menu' ); ?>" name="add-my-plugin-menu-item" id="submit-my-plugin-div" />
<span class="spinner"></span>
</span>
</p>
</div>
<?php
}

 
function vi_menu( $items ) {
	
	
//foreach ( $items as &$item ) {
 
//if ( $item->object != 'my-vi-object' ) continue;
//$item->url = get_post_type_archive_link( $item->type );
//if ( get_query_var( 'post_type' ) == $item->type ) {
//$item->title = '<a href="#">'.vi_get_img_src().' '.get_option( 'ftvi_option_btxt' ).'</a>';
//$item->classes []= 'current-menu-item';
 
//$item->current = true;
 
//}
 
//}
//$items->title = '<a href="#">'.vi_get_img_src().' '.get_option( 'ftvi_option_btxt' ).'</a>'; 

return $items;
  
}
		
function vi_admin_scripts(){
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		if (function_exists('wp_enqueue_media')){ wp_enqueue_media();}
	}
	wp_enqueue_script('vi-admin-plugin-script', plugins_url('js/js.admin.for.the.visually.impaired.js', __FILE__), array('wp-color-picker'), false, 1 );

}

function vi_get_img_src(){
$img="";

    $opt_val_bimage = get_option( 'ftvi_option_bimage' );
if ($opt_val_bimage=='1') {$img='<img src="'.plugins_url("img/icon_16.png", __FILE__).'" class="vi_widget_img">'; } else
if ($opt_val_bimage=='2') {$img='<img src="'.plugins_url("img/icon_24.png", __FILE__).'" class="vi_widget_img">'; } else 
if ($opt_val_bimage=='3') {$img='<img src="'.plugins_url("img/icon_41.png", __FILE__).'" class="vi_widget_img">'; } else 
if ($opt_val_bimage=='4') {$img='<img src="'.plugins_url("img/icon_58.png", __FILE__).'" class="vi_widget_img">'; } else $img='';
return $img;	
}
function vi_get_img_src2(){
$img="";
    $opt_val_bimage2 = get_option('ftvi_option_bimage2');
if ($opt_val_bimage2=='1') {$img='<img src="'.plugins_url("img/icon_16x.png", __FILE__).'" class="vi_widget_img">'; } else 
if ($opt_val_bimage2=='2') {$img='<img src="'.plugins_url("img/icon_24x.png", __FILE__).'" class="vi_widget_img">'; } else 
if ($opt_val_bimage2=='3') {$img='<img src="'.plugins_url("img/icon_41x.png", __FILE__).'" class="vi_widget_img">'; } else 
if ($opt_val_bimage2=='4') {$img='<img src="'.plugins_url("img/icon_58x.png", __FILE__).'" class="vi_widget_img">'; } else $img='';
return $img;	
}

function vi_shortcode($atts=false) {
	
	    $opt_val_bcolor = get_option( 'ftvi_option_bcolor' );
	    $opt_val_btxtcolor = get_option( 'ftvi_option_btxtcolor' );
    $opt_val_btxt = get_option( 'ftvi_option_btxt' );
    $opt_val_btxt2 = get_option( 'ftvi_option_btxt2' );

	return '<a itemprop="Copy" href="#" class="bt_widget-vi-on">'.vi_get_img_src().' '.$opt_val_btxt.'</a>';
}
function vi_activation_plugin()
    {
if (!get_option('ftvi_option_txt_size')) update_option( 'ftvi_option_txt_size', '16' );
if (!get_option('ftvi_option_sxema')) update_option( 'ftvi_option_sxema', '1' );
if (!get_option('ftvi_option_image')) update_option( 'ftvi_option_image', '0' );
if (!get_option('ftvi_option_font')) update_option( 'ftvi_option_font', '1' );
if (!get_option('ftvi_option_kerning')) update_option( 'ftvi_option_kerning', '0' );
if (!get_option('ftvi_option_line')) update_option( 'ftvi_option_line', '0');
if (!get_option('ftvi_option_allbackgrnd')) update_option( 'ftvi_option_allbackgrnd', '1');
if (!get_option('ftvi_option_reload_page')) update_option( 'ftvi_option_reload_page', '0');
if (!get_option('ftvi_option_auto_p_on')) update_option( 'ftvi_option_auto_p_on', '0');
if (!get_option('ftvi_option_bcolor')) update_option( 'ftvi_option_bcolor', '#DB151C' );
if (!get_option('ftvi_option_btxtcolor')) update_option( 'ftvi_option_btxtcolor', '#000000' );
if (!get_option('ftvi_option_bimage')) update_option( 'ftvi_option_bimage', '0');
if (!get_option('ftvi_option_bimage2')) update_option( 'ftvi_option_bimage2', '0' );
if (!get_option('ftvi_option_btxt')) update_option( 'ftvi_option_btxt', __( 'Version for visually impaired', 'for-the-visually-impaired' ));
if (!get_option('ftvi_option_btxt2')) update_option( 'ftvi_option_btxt2', __( 'BACK TO NORMAL MODE', 'for-the-visually-impaired' ));
	}
add_action( 'admin_enqueue_scripts', 'vi_admin_scripts' );	
add_action('admin_menu', 'vi_plugin_setup_menu');
add_action('wp_enqueue_scripts','vi_cookie');
add_action('wp_enqueue_scripts','add_vi_script');
add_action('wp_enqueue_scripts', 'add_vi_styles');
add_action( 'admin_head-nav-menus.php', 'my_register_vi_menu' );
add_filter('wp_setup_nav_menu_item', 'vi_menu');
add_shortcode( 'FTVI', 'vi_shortcode' );
register_activation_hook( __FILE__, 'vi_activation_plugin' );


class wp_vi_plugin extends WP_Widget {


	function __construct() {
	parent::__construct(
			'wp_vi_plugin', // Base ID
			__( 'For The Visually Impaired', 'for-the-visually-impaired' ), // Name
			array( 'description' => __( 'Button For The Visually Impaired', 'for-the-visually-impaired' ), ) // Args
		);
	}
	
	public function widget($args, $instance) {
    $opt_val_btxt = get_option( 'ftvi_option_btxt' ,'Версия для слабовидящих');
    $opt_val_btxt2 = get_option( 'ftvi_option_btxt2' , 'Обычный режим');
	$custom_button= get_option( 'ftvi_option_button' ,'<a itemprop="Copy" href="#" class="bt_widget-vi-on"><span class="vi-on-img-button"></span> '.$opt_val_btxt.'</a>');

	
		$title = apply_filters('widget_title', $instance['title']);
	   //$title =  (!empty($instance['title'])) ? strip_tags($instance['title']):'Версия для слабовидящих';
	   echo $args['before_widget'];
        if (!empty($title)){echo $args['before_title'].$title.$args['after_title']; }	   

    echo '<div id="bt_widget-vi-on" class="bt_widget-vi">'.$custom_button.'</div>';   
	echo $args['after_widget'];
	}

	public function form($instance) {
		
    $title = ! empty( $instance['title'] ) ? esc_attr($instance['title']) : __( 'For The Visually Impaired Version', 'for-the-visually-impaired' );
	echo '<p>';
	echo '<label for="'.$this->get_field_id('title').'">'._e('Button text:', 'for-the-visually-impaired').'</label>';
	echo '<input class="wide" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />';
	echo '</p>';
	}
	
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']): $old_instance['title'];
        return $instance;
    }

	
}

add_action('widgets_init', create_function('', 'return register_widget("wp_vi_plugin");'));
