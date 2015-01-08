<?php
/**
 * <h1>Akaddit v2 Function Helpers</h1>
 * @author Akinsola Ademola, A [07062671144]
 * @version 2.0, 2014/2015
 * @link http://geekerbyte.blogspot.com => TripleKinsola@gmail.com
 * @copyright date('Y');
 * 
 */
?>
<?php

function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"\">".$message."</p>";
  } else {
    return "";
  }
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = MODELS_LIB_PATH.DS."db_abstract".DS."migrations".DS."{$class_name}.mig.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.mig.php could not be found.");
	}
}

// spl_autoload_register(function($class){
//   $class = strtolower($class);
//   require_once 'application/helpers/' . $class . '.class.php';
// });

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

?>