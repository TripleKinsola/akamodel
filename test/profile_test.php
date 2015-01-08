Click <a href="profile_test.php?start">here</a> to launch the <b>Tester</b>!
<br />
<br />
<?php
require '../config/initialize.inc.php';
if (isset($_GET['start'])) {
	// echo "All items are set to go!!!";
	//echo DS;
	// require_once 'users.mig.php';
	// require 'profile.class.php';
	$profiles = new Profile(1);

	//echo $profile->getFullname();
	//die('Start testing....');

	
	echo "<h1>Profile Details</h1>";
	echo "<b>Fullname: </b><code>".$profiles->getFullname()."</code><br />";
	echo "<b>About ".$profiles->getFullname().": </b><code>".$profiles->getAbout()."</code><br />";
	echo "<b>Account Type: </b><code>".$profiles->getAccountType()."</code><br />";
	echo "<b>Date Created: </b><code>".$profiles->getTimeAdded()."</code><br />";
	echo "<b>Is to be reminded: </b><code>".$profiles->getRemeberMe()."</code><br />";
	echo "<b>Username: </b><code>".$profiles->getUsername()."</code><br />";
	echo "<b>Password: </b><code>".$profiles->getPassword()."</code><br />";
	echo "<b>Phone Number: </b><code>".$profiles->getPhoneNumber()."</code><br />";
	echo "<b>Profile URL: </b><code>".$profiles->getUserProfileURL()."</code><br />";
	echo "<b>E-mail Address: </b><code>".$profiles->getEmail()."</code><br />";
	echo "<b>Profile Picture: </b><code>".$profiles->getProfilePic()."</code><br />";
	echo "<b>Tert ID: </b><code>".$profiles->getTertID()."</code><br />";
	echo "<b>Sec Sch Name Address: </b><code>".$profiles->getSecSchName()."</code><br />";
	echo "<b>Gender: </b><code>".$profiles->getGender()."</code><br />";

	echo "<hr />";
	echo "<b>User Forum(s): </b><code>".$profiles->getForumNum()."</code><br />";
	echo "<b>Like(s): </b><code>".$profiles->getLikeNum()."</code><br />";
	echo "<b>Comment Replies: </b><code>".$profiles->getCommentRepliesNum()."</code><br />";
	echo "<b>Message Log: </b><code>".$profiles->getMessageLogNum()."</code><br />";
	echo "<b>Forum Post: </b><code>".$profiles->getForumPostsNum()."</code><br />";
	// echo "<b>Last Login Log: </b><code>".$profiles->()."</code><br />";
	// echo "<b>Notification: </b><code>".$profiles->()."</code><br />";
	// echo "<b>Submitted Course Task: </b><code>".$profiles->()."</code><br />";
	// echo "<b>Unlike: </b><code>".$profiles->()."</code><br />";
	// echo "<b>User Course: </b><code>".$profiles->()."</code><br />";
	// echo "<b>User Download Log: </b><code>".$profiles->()."</code><br />";
	// echo "<b>User Innterest: </b><code>".$profiles->()."</code><br />";
}
?>