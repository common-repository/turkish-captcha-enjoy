<?php
/*
Plugin Name: Captcha Enjoy Beta (Turkish)
Plugin URI:  https://www.captchaenjoy.com
Description: Captcha Enjoy ile sitenizi botlardan koruyun, site içerigiyle ilgili eglenceli sorularla kullanıcılarınızı göz bozan captchalardan kurtarın.
Version:     0.4
Author:      Yasin Şimşek & MehmetCan Şahin

License:     GPL2
 
{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.

*/
/** Step 2 (from text above). */



add_action( 'admin_menu', 'captcha_enjoy_admin_menu' );

/** Step 1. */
function captcha_enjoy_admin_menu() {
	add_options_page( 'Captcha Enjoy Seçenekler', 'Captcha Enjoy', 'manage_options', 'captcha-enjoy', 'captcha_enjoy_options' );
}

/** Step 3. */
function captcha_enjoy_options() {

	$settings['comment'] = 1;
	$settings['login'] = 1;
	$settings['cf7'] = 1;

	if ( ! get_option( 'captcha_enjoy_options' ) )
		add_option( 'captcha_enjoy_options', $settings );

	/* Get options from the database */
	$captcha_enjoy_options = get_option( 'captcha_enjoy_options' );

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'Bu sayfaya erişim hakkınız bulunmamaktadır.' ) );
	} ?>
	<div class="wrap">
		<h1>Captcha Enjoy Ayarlar</h1>

		<h3>Daha önce sisteme kayıt yaptırmadıysanız, <a href="http://captchaenjoy.com#getcode" target="_blank">
			Sitemizden</a> hızlıca alan adınızı girerek ve konunuzu seçerek sistemimize kayıt olabilirsiniz.</h3>
			<br>
			<form action="" method="post">
				<h3>Hangi Alanlarda Çalışsın?</h3>
				<input type="checkbox" name="captcha_use[]" value="comment" <?php if($captcha_enjoy_options['comment']==1){echo 'checked';} ?>>Yorum Formunda Kullan<br>
				<input type="checkbox" name="captcha_use[]" value="login" <?php if($captcha_enjoy_options['login']==1){echo 'checked';} ?>>Giriş Formunda Kullan<br>
				<input type="checkbox" name="captcha_use[]" value="cf7" <?php if($captcha_enjoy_options['cf7']==1){echo 'checked';} ?>>Contact Form 7 Kullan<br>
				<input type="hidden" name="empty_value" value="empty_value">
				<br>
				<input type="submit" id="captcha_use_select" value="Onayla">
			</form>
		</div>

		<?php

		if($_POST){
			echo "<h2>Değişiklikler başarıyla kaydedildi</h2>";
			$settings['comment'] = 0;
			$settings['login'] = 0;
			$settings['cf7'] = 0;

			if($_POST['captcha_use']){ 
				foreach ($_POST['captcha_use'] as $key ) {
					if($key=="comment"){
						$settings['comment'] = 1;
					}
					if($key=="login"){
						$settings['login'] = 1;
					}
					if($key=="cf7"){
						$settings['cf7'] = 1;
					}	
				}
			}

			update_option( 'captcha_enjoy_options', $settings );
			?>
			<script type="text/javascript">location.reload();</script>
			<?php
		}
	}

	function captcha_enjoy_login_display(  ) {
		echo '<style>.ce_captcha #answer{font-size:14px;}div.ce_false,div.ce_true{margin-top:4px}</style>
		<div class="ce_captcha" data-comment="login" style="margin-bottom:15px;width: 231px;"></div>';
	}

	function input_changer_for_login(){
		echo '<script>
		document.getElementById("wp-submit").type="button";
		document.getElementById("wp-submit").onclick=function(){return ce_check(this);};
	</script>';
}

function captcha_enjoy_comment_display( $args ) {
	echo '<div class="ce_captcha" data-comment="display" style="margin-bottom:15px;"></div>';
}

function captcha_enjoy_comment_defaults_display( $args ) {
	$args['comment_field'] .= '<div class="ce_captcha" data-comment="default" style="margin-bottom:15px;"></div>';
	return $args;
}

function filter_comment_form_submit_button( $submit_button, $args ) {
	$submit_before = '<div class="ce_captcha" data-comment="submit" style="margin-bottom:15px;"></div>';
	$submit_after = '';
	return $submit_before . $submit_button . $submit_after;
}

function input_changer_for_comment(){
	echo '
	<script>
		if(document.getElementById("submit") != null){
			document.getElementById("submit").type="button";
			document.getElementById("submit").onclick=function(){return ce_check(this);};
		}
	</script>';
}

function cf7(){
	echo '<script>
	window.onload = ce_cf7();
	function ce_cf7() {
		if(document.getElementsByClassName("wpcf7")[0] == undefined){
			return;
		}
		var ceHtml = "<p><div class=\'ce_captcha\' data-comment=\'cf7\'></div></p>"; 
		var cf7form = document.getElementsByClassName("wpcf7")[0];
		var cf7submit = cf7form.getElementsByClassName("wpcf7-submit")[0];
		cf7submit.setAttribute("onclick", "return ce_check(this)");
		cf7submit.setAttribute("onload", "ce_init()");
		cf7submit.insertAdjacentHTML("beforebegin", ceHtml);
	}
</script>';
}

function loadStatic()
{
	echo '
	<script>
		function loadStatic(){
			var done = false;
			function handleLoad() {
				if (!done) {
					done = true;
					if( typeof document.getElementsByName("ce_answer") != "object" ){
						ce_init();
					}
				}
			}

			function handleReadyStateChange() {
				var state;

				if (!done) {
					state = scr.readyState;
					if (state === "complete") {
						handleLoad();
					}
				}
			}

			var jsElement = document.createElement("script");
			jsElement.setAttribute("type","text/javascript");
			jsElement.setAttribute("src", "https://api.captchaenjoy.com/static/ce.js");
			jsElement.onreadystatechange = handleReadyStateChange;
			jsElement.onload = handleLoad;

			var cssElement = document.createElement("link");
			cssElement.setAttribute("rel", "stylesheet");
			cssElement.setAttribute("type", "text/css");
			cssElement.setAttribute("href", "https://api.captchaenjoy.com/static/ce.css");

			document.head.appendChild(jsElement);
			document.head.appendChild(cssElement);

			checkInit();
		}
		function checkInit() {
			var interval = setInterval(function(){ 
				if( typeof document.getElementsByName("ce_answer") != "object" ){
					ce_init();
				} else {
					clearInterval(interval);
				}
			}, 1000);
		}
		window.onload = loadStatic();
	</script>
	';
}

add_action( 'wp_head', 'loadStatic' );

$captcha_enjoy_options = get_option( 'captcha_enjoy_options' );

if($captcha_enjoy_options['login']==1){
	add_action( 'login_head', 'loadStatic' );
	add_action( 'login_form', 'captcha_enjoy_login_display' );
	add_action( 'lostpassword_form', 'captcha_enjoy_login_display' );
	add_action("login_footer","input_changer_for_login");
	add_action( 'authenticate', 'captcha_enjoy_check' );	
}

function preprocess_comment_handler( $commentdata ) {
	if ( ce_check() ) {
		unset($_POST["ce_answer"]);
		unset($_POST["ce_tmp"]);
		return $commentdata;
	} else {
		return wp_die("<p><strong>".__("Hata:", "turkish-captcha-enjoy")."</strong> ".__("Lütfen Güvenlik Doğrulamasını Yapınız.", "turkish-captcha-enjoy")."</p>\n\n<p><a href=".wp_get_referer().">&laquo; ".__("Geri", "turkish-captcha-enjoy")."</a>");;
	}
}


if($captcha_enjoy_options['comment']==1){
	global $wp_version;
	if ( version_compare( $wp_version , '4.2' ) >= 0 ) {
		add_filter( 'comment_form_submit_button', 'filter_comment_form_submit_button', 10, 2 );
	} else {
		add_filter('comment_form_defaults', 'captcha_enjoy_comment_defaults_display', 1 );
	}

	// add_action( 'comment_form_after_fields', 'captcha_enjoy_comment_display', 1 );
	// add_action( 'comment_form_logged_in_after', 'captcha_enjoy_comment_display' );
	
	add_action("wp_footer","input_changer_for_comment");


	add_filter( 'preprocess_comment' , 'preprocess_comment_handler' );
}

function ce_check_cf7( $spam ) {
	if ( $spam ) {
		return $spam;
	}

	$contact_form = wpcf7_get_current_contact_form();

	if ( ! $contact_form ) {
		return $spam;
	}

	$spam = ! ce_check();

	return $spam;
}

if($captcha_enjoy_options['cf7'] == 1){
	add_action( 'wp_footer', 'cf7', 9 );
	add_filter( 'wpcf7_spam', 'ce_check_cf7', 9 );
}

//CAPTCHA ENJOY CHECK
function ce_check() {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"https://api.captchaenjoy.com/check");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "answer=" . $_POST['ce_answer'] . "&tmp="  . $_POST['ce_tmp']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec ($ch);
	curl_close ($ch);

	return json_decode($server_output)->status;
}

if ( ! function_exists( 'captcha_enjoy_check' ) ) {
	function captcha_enjoy_check( $user ) {
		// Captcha Enjoy Başlangıç
		if ( ce_check() ) {
			unset($_POST["ce_answer"]);
			unset($_POST["ce_tmp"]);
			return $user;
		} else {
			$error = new WP_Error();
			$error->add( 'cptch_error', '<strong>' . __( 'ERROR', 'captcha' ) . '</strong>:' . '&nbsp;' . $cptch_options['cptch_error_time_limit'] );
			return $error;

			return "Lütfen Güvenlik Doğrulamasını Yapınız!" ;
		}
		// Captcha Enjoy Bitiş
	}
}
/* End function captcha_enjoy_check */

?>
