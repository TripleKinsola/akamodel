Click <a href="test.php?start">here</a> to launch the <b>Tester</b>!
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

	echo "<b>Fullname: </b><code>".$profiles->getFullname()."</code><br />";
	echo "<b>About: ".$profiles->getFullname().": </b><code>".$profiles->getAbout()."</code><br />";
	echo "<b>Account Type: </b><code>".$profiles->getAccountType()."</code><br />";
	echo "<b>Date Created: </b><code>".$profiles->getTimeAdded()."</code><br />";
	echo "<b>Is to be reminded: </b><code>".$profiles->getRemeberMe()."</code><br />";
	echo "<b>Username: </b><code>".$profiles->getUsername()."</code><br />";
	echo "<b>Password: </b><code>".$profiles->getPassword()."</code><br />";
	echo "<b>Phone Number: </b><code>".$profiles->getPhoneNumber()."</code><br />";
	echo "<b>Profile URL: </b><code>".$profiles->getUserProfileURL()."</code><br />";
	echo "<b>E-mail Address: </b><code>".$profiles->getEmail()."</code><br />";
	echo "<b>Profile Picture: </b><code>".$profiles->getProfilePic()."</code><br />";

}
?>
