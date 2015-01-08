Click <a href="log_test.php?start">here</a> to launch the <b>Tester</b>!
<hr />
<br />
<?php
require '../config/initialize.inc.php';
if (isset($_GET['start'])) {
	echo "Click any of the following links to make its test!<br /><ul>";

	echo "<li><a href='log_test.php?makeMessageLog'>Make Message Log</a></li><br />";

	echo "<li><a href='log_test.php?makeAdminFileLog'>Make Admin File Log</a></li><br />";

	echo "<li><a href='log_test.php?makeLastLoginLog'>Make Last Login Log</a></li><br />";

	echo "<li><a href='log_test.php?makeUserDownloadLog'>Make User Download Log</a></li></ul>";
}
if (isset($_GET['makeMessageLog'])) {
	$thread_id = 1;
	$sender_user_id = 1;
	$recipient_user_id = 1;
	$content = "Testing msg";
	$log = new Log;
	$make = $log->makeMessageLog($thread_id, $sender_user_id, $recipient_user_id, $content);
	if (!$make) {
		die('Failed!');
	}else{
		$msg = "Success!<br /> Log has been made for MessageLog.<br /> Check <b>\"messages_log\"</b> table from the dBase where <code><b>id = ".$log->id."</b></code> to verify";
		die($msg);
	}
}
if (isset($_GET['makeAdminFileLog'])) {
	$log = new Log;
	$log->action = "Log";
	$log->message = "Testing the log for Admin.";
	$log->makeAdminFileLog();
}
if (isset($_GET['makeLastLoginLog'])) {
	$user_id = 2;
	$device = $_SERVER['HTTP_USER_AGENT'];
	$log = new Log;
	$make = $log->makeLastLoginLog($user_id, $device);
	if (!$make) {
		die('Failed!');
	}else{
		$msg = "Success!<br /> Log has been made for LastLoginLog.<br /> Check <b>\"last_login_logs\"</b> table from the dBase where <code><b>id = ".$log->id."</b></code> to verify";
		die($msg);
	}
}
if (isset($_GET['makeUserDownloadLog'])) {
	$user_id = 1; 
	$courseware_id = 1;
	$log = new Log;
	$make = $log->makeUserDownloadLog($user_id, $courseware_id);
	if (!$make) {
		die('Failed!');
	}else{
		$msg = "Success!<br /> Log has been made for UserDownloadLog.<br /> Check <b>\"user_download_log\"</b> table from the dBase where <code><b>id = ".$log->id."</b></code> to verify";
		die($msg);
	}
}
?>