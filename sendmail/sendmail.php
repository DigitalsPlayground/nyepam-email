<?php
/*
Plugin Name: Nyepam eMail
Plugin URI: http://variousnetwork.com/
Description: Nyepam email kemana-mana.
Version: 2.0
Author: Aming W. Widono
Author URI: http://variousnetwork.com/
*/
add_action('admin_menu','sendmail_add_page');
if (!function_exists('sendmail_add_page')) { //gak dipake
	function sendmail_add_page() {
		add_submenu_page('options-general.php', 'Nyepam eMail - by Om Aming.id', 'Send Mail', 'manage_options', 'sendmail', 'sendmail');
	}
}
if (!function_exists('sendmail')) { // kagak dipake
	function sendmail() {
	global $current_user;
		if (!current_user_can('manage_options'))  {
			wp_die( __('Lu kagak punya akses dimari tong!') );
		}
		?><div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2>Nyepam eMail</h2>

<?php
$name = $_POST["name"];
$email = $_POST["email"];
$to = $_POST["to"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$success = '<div id="message" class="updated fade"><p>Ndan, Email sukses terkirim ke <em><strong>'.$to.'</strong></em> <a href="options-general.php?page=sendmail">Kembali</a>.</p></div>';
$error = array('Nama harus dan wajib di gangbang Kapten','Masukin email Sampeyan dulu kapten','Masukkan email tujuannya kapten','Subject tidak boleh kapten','Message gag boleh kosong kapten');
?>

<?php
if(isset($_POST['email'])) {
	if ($name == '' ) {
		_e('<div style="background-color:#FFDFDF;border:solid #FF0000 1px;margin-top:1em;padding:1em">'.$error[0].'</div>');
	} elseif ($email == '' ) {
		_e('<div style="background-color:#FFDFDF;border:solid #FF0000 1px;margin-top:1em;padding:1em">'.$error[1].'</div>');
	} elseif ($to == '' ) {
		_e('<div style="background-color:#FFDFDF;border:solid #FF0000 1px;margin-top:1em;padding:1em">'.$error[2].'</div>');
	} elseif ($subject == '' ) {
		_e('<div style="background-color:#FFDFDF;border:solid #FF0000 1px;margin-top:1em;padding:1em">'.$error[3].'</div>');
	} elseif ($message == '' ) {
		_e('<div style="background-color:#FFDFDF;border:solid #FF0000 1px;margin-top:1em;padding:1em">'.$error[4].'</div>');
	} else {
	$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
	wp_mail($to, $subject, $message, $headers); //, $attachments <= jika ingin tambah file
	_e($success);
	}
} else {
?>
<form action="" method="post"> 
<table class="form-table" border="0">
<tbody>
<tr valign="top">
<td><label for="name">Your name <strong style="color:#FF0000">*</strong></label></td>
<td><input name="name" type="text" id="name" value="<?php echo $current_user->display_name; ?>" size="32"> <small><em>Akan tampil sebagai nama pengirim</em></small></td> 
</tr> 
<tr valign="top">
<td><label for="email">Email address <strong style="color:#FF0000">*</strong></label></td> 
<td><input name="email" type="text" id="email" value="<?php echo $current_user->user_email; ?>" size="32"> <small><em>Akan tampil sebagai email pengirim</em></small></td> 
</tr> 
<tr> 
<td><label for="to">To <strong style="color:#FF0000">*</strong></label></td> 
<td><input name="to" type="text" id="to" value="" size="32"> <small><em>Pisahkan dengan koma jika lebih dari email</em></small></td>
</tr>
<tr valign="top">
<td><label for="subject">Subject <strong style="color:#FF0000">*</strong></label></td> 
<td><input name="subject" type="text" id="subject" value="" size="32"> <small><em>Judul email anda</em></small></td> 
</tr>
<tr valign="top">
<td><label for="message">Message <strong style="color:#FF0000">*</strong></label></td> 
<td><textarea name="message" cols="45" rows="6" id="message" class="bodytext"></textarea></small></td> 
</tr> 
<tr valign="top">
<td>&nbsp;</td> 
<td align="left" valign="top"><input name="submit" value="Send" class="button-primary" type="submit"></td> 
</tr> 
</tbody>
</table> 
</form>
<?php } //end if isset
}
}
?>
