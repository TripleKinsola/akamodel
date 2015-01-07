<?php
/**
*Classes/Migrations needed, or to be autoloaded, for this class:
****MySQLbase
****User
****ForumUser
****Like
****Comment_replies
****ForumPost
****LastLoginLog
*
****MessageLog
****Notification
****SubmittedCourseTask
****Unlike
****UserCourse
*
****UserDownloadlog
****UserInnterest
*
*/
class Profile{
	private $id;

	//User Details
	private static $table = "users"; //Db Table

    public $username;
    public $fullname;
    public $password;
    public $sec_sch_name;
    public $phone_num;
    public $email;
    public $gender;
    public $tert_id;
    public $profile_pic;
    public $user_profile_url;
    public $about;
    public $remember_me;
    public $time_added;
    public $account_type;

    //User Public forums
	private static $forum_table = "forum_users"; //Db Table
    public $user_id;
    public $forum_id;

	
	function __construct($user_id){
		if (isset($user_id)) {
			global $data;
			$query = "SELECT * FROM ".self::$table;
			$query .= " WHERE id=".$user_id." LIMIT 1";
			$result = $data->query($query);
			while ($needs=$data->fetch_array($result)) {
				$this->id = $user_id;
	    		$this->username = $needs['username'];
	    		$this->fullname = $needs['fullname'];
	    		$this->password = $needs['password'];
	    		$this->sec_sch_name = $needs['sec_sch_name'];
	    		$this->phone_num = $needs['phone_num'];
	    		$this->email = $needs['email'];
	    		$this->gender = $needs['gender'];
	    		$this->tert_id = $needs['tert_id'];
	    		$this->profile_pic = $needs['profile_pic'];
	    		$this->user_profile_url = $needs['user_profile_url'];
	    		$this->about = $needs['about'];
	    		$this->remember_me = $needs['remember_me'];
	    		$this->time_added = $needs['time_added'];
	    		$this->account_type = $needs['account_type'];
			}
		}else{
			die("We do not know who this user is.... Please specify!");
		}
	}
	//Details Methods..
	///////////////////////
	//Returns the user's full name
	///////////////////////
	public function getFullname(){
		return $this->fullname;
	}
	///////////////////////
	//Returns details about the user
	///////////////////////
	public function getAbout(){
		return $this->about;
	}
	///////////////////////
	//Returns the user account type
	///////////////////////
	public function getAccountType(){
		return $this->account_type;
	}
	///////////////////////
	//Returns the time the user was created
	///////////////////////
	public function getTimeAdded(){
		return $this->time_added;
	}
	///////////////////////
	//Returns maybe the user is to stay logged in in his/her agent
	///////////////////////
	public function getRemeberMe(){
		return $this->remember_me;
	}
	///////////////////////
	//Returns User's username
	///////////////////////
	public function getUsername(){
		return $this->username;
	}
	///////////////////////
	//Returns user's password
	///////////////////////
	public function getPassword(){
		return $this->password;
	}
	///////////////////////
	//Returns user's phone number
	///////////////////////
	public function getPhoneNumber(){
		return $this->phone_num;
	}
	///////////////////////
	//Returns the user $_GET config URL for profile
	///////////////////////
	public function getUserProfileURL(){
		return $this->user_profile_url;
	}
	///////////////////////
	//Returns user's e-mail details
	///////////////////////
	public function getEmail(){
		return $this->email;
	}
	///////////////////////
	//Returns the path/dir or details about users picture
	///////////////////////
	public function getProfilePic(){
		return $this->profile_pic;
	}
	///////////////////////
	//Returns user's tertiary institution Identity
	///////////////////////
	public function getTertID(){
		return $this->tert_id;
	}
	///////////////////////
	//Returns user sec_sch_name
	///////////////////////
	public function getSecSchName(){
		return $this->sec_sch_name;
	}
	///////////////////////
	//Returns user's gender
	///////////////////////
	public function getGender(){
		return $this->gender;
	}


	//Forums Details
	///////////////////////
	//Return User's forum number
	///////////////////////
	public function getForumNum(){
        global $data;
        $sql = "SELECT COUNT(*) FROM ".self::$forum_table;
        $sql = " WHERE user_id = ".$this->id;
        $result_set = $data->query($sql);
        $row = $data->fetch_array($result_set);
        return array_shift($row);
	}
	public function getForum(){
        global $data;
        $sql = "SELECT u.user_id AS u.user, u.forum_id AS forum, f.id AS forum_id, f.title AS forum_title, f.description AS forum_describ FROM ".self::$forum_table;
        $sql = " JOIN ".self::$forum_table." ON u.forum_id = f.id";
        $sql = " WHERE u.user_id = ".$this->id;
        $result_set = $data->query($sql);
        //What to be returned to the VIEWS api...
        return $row = $data->fetch_array($result_set);
	}
}
?>