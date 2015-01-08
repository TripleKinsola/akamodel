<?php
/**
 * <h1>Akaddit v2 Public Profile Class</h1>
 * @author Akinsola Ademola, A [07062671144]
 * @version 2.0, 2014/2015
 * @link http://geekerbyte.blogspot.com => TripleKinsola@gmail.com
 * @copyright date('Y');
 * 
 */
?>
<?php
/**
*Classes/Migrations needed, or to be autoloaded, for this class:
****MySQLbase
****User
****ForumUser
*
****Like
****CommentReplies
****ForumPost //stoped....
****LastLoginLog
*
****MessageLog
****Notification
****SubmittedCourseTask
****Unlike
****UserCourse
*
****UserDownloadLog
****UserInnterest
*
*/
class Profile{
	private $id;

	//User Details
	private static $user_table = "users"; //Db Table

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

	function __construct($user_id){
		if (isset($user_id)) {
			global $data;
			$sql = $data->select_by_where(self::$user_table, 'id', $user_id);
			while ($needs=$data->fetch_array($sql)) {
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
			if ($data->num_rows($sql) < 1) {
				echo "<br /><i>No Data Found!</i><br />";
			}
		}else{
			die("We do not know who this user is.... Please specify by ID!");
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
    //User Public forums
	private static $forum_table = "forum_users"; //Db Table
    public $user_id;
    public $forum_id;
	///////////////////////
	//Return User's forum number
	///////////////////////

	public function getForumNum(){
		global $data;
		$sql = $data->select_by_where(self::$forum_table, 'user_id', $this->id);
        $result_set = $data->num_rows($sql);
		return $result_set;
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

	//Like Details
    //User Public Likes
	private static $like_table = "likes"; //Db Table
    public $item_id;
    public $item_type;
    public $liker_user_id;
		///////////////////////
	//Return User's Like number
	///////////////////////
	public function getLikeNum(){
		global $data;
		$sql = $data->select_by_where(self::$like_table, 'liker_user_id', $this->id);
        $result_set = $data->num_rows($sql);
		return $result_set;
	}
	public function getLike(){
		#code...
	}

	//Comment Replies
    //User Public Comment Replies
	private static $Comment_replies_table = "comment_replies"; //Db Table
    public $comment_id;
    public $reply_text;
    public $replier_user_id;
		///////////////////////
	//Return User's Like number
	///////////////////////
	public function getCommentRepliesNum(){
		global $data;
		$sql = $data->select_by_where(self::$Comment_replies_table, 'replier_user_id', $this->id);
        $result_set = $data->num_rows($sql);
		return $result_set;
	}
	public function getCommentReplies(){
		#code...
	}

	//Message Log
    //User Public Message Log
	private static $messages_log_table = "messages_log"; //Db Table
    public $thread_id;
    public $sender_user_id;
    public $recipient_user_id;
    public $content;
    public $if_read;
	///////////////////////
	//Return
	///////////////////////
	public function getMessageLogNum(){
		global $data;
		$sql = $data->select_by_where(self::$messages_log_table, 'recipient_user_id', $this->id);
        $result_set = $data->num_rows($sql);
		return $result_set;
	}
	public function getMessageLog(){
		#code...
	}
	
	//Forum Post
    //User Public Forum Post
	private static $forum_posts_table = "forum_posts"; //Db Table
    public $subject;
    // public $content;
    // public $forum_id;
    // public $date_added = 'NOW()';//In the DBase, it authomatically set....
    public $author_user_id;
	///////////////////////
	//Return
	///////////////////////
	public function getForumPostsNum(){
		global $data;
		$sql = $data->select_by_where(self::$forum_posts_table, 'author_user_id', $this->id);
        $result_set = $data->num_rows($sql);
		return $result_set;
	}
	public function getForumPosts(){
		#code...
	}
}
?>