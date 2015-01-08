<?php
/**
 * <h1>Akaddit v2 Public Log Class</h1>
 * @author Akinsola Ademola, A [07062671144]
 * @version 2.0, 2014/2015
 * @link http://geekerbyte.blogspot.com => TripleKinsola@gmail.com
 * @copyright date('Y');
 * 
 */
?>
<?php
/*
*Logs to make:
    . ... Message Log
    . ... Admin File Log @ "SITE_ROOT.DS.logs.DS.admin_log.txt"
    . ... Last Login Log
    . ... User Download Log
*/
class Log{
	//Admin log properties////////////
	public $action="";
	public $message="";
	/*///////////////////*/

    public $id;

    //Admin File Log @ "SITE_ROOT.DS.logs.DS.admin_log.txt"
	public function makeAdminFileLog(){
		$logfile = SITE_ROOT.DS.'logs'.DS.'admin_log.txt';
		$new = file_exists($logfile) ? false : true;
		if($handle = fopen($logfile, 'a')) { // append
			$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
			$content = "{$timestamp} | ".$this->action.": ".$this->message."\n";
			fwrite($handle, $content);
			fclose($handle);
			if($new) { chmod($logfile, 0755); }

			die('AdminFileLog created! <br />Check in Site root @ <code>logs</code> dir and <code>admin.log.txt</code> file for verifications.');//This line is just used for testing. Cancel or comment it out @ production

		} else {
			echo "Could not open log file for writing.";
		}
	}
	public function makeLastLoginLog($user_id = 0, $device){
		global $data;
		$log = new LastLoginLog;
		//Check first, to see any existing log record
		$is_log_exist = $data->select_by_where('last_login_logs', 'user_id', $user_id);
		$log_exist = $data->num_rows($is_log_exist);
		if ($log_exist > 0) {
			//Log exit, and get the Log ID
			while ($u = $data->fetch_array($is_log_exist)) {
				$id = $u['id'];
			}
			$sql = "UPDATE `last_login_logs` SET `user_id` = '".$user_id."', `time` = NOW(), `device` = '".$device."' WHERE `id` = ".$id;
			$result = $data->query($sql);

			if ($result) {
				$this->id = $id;
				return true;
			}else{
				die('User could not be updated! '.mysql_error());
			}
		}else{
			$log->user_id = $user_id;
			$log->device = $device;
			$make = $log->save();
			if ($make) {
				$this->id = $log->id;
				return true;
			}
		}
	}
	public function makeUserDownloadLog($user_id = 0, $courseware_id = 0){
		$log = new UserDownloadLog;
		$log->user_id = $user_id;
		$log->courseware_id = $courseware_id;
		$make_log = $log->save();
		if ($make_log) {
			$this->id = $log->id;
			return true;
		}else{
			return false;
		}
	}
	public function makeMessageLog($thread_id= 0, $sender_user_id= 0, $recipient_user_id= 0, $content=''){
		$log = new MessageLog;
		$log->thread_id = $thread_id;
		$log->sender_user_id = $sender_user_id;
		$log->recipient_user_id = $recipient_user_id;
		$log->content = $content;

		$make_log = $log->save();
		if ($make_log) {
			$this->id = $log->id;
			return true;
		}else{
			return false;
		}
	}
}
?>