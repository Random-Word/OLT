<?php
/**
 * J. Mulle, for app, 5/30/14 1:03 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 *
 *
 * @name save_button
 * @desc
 * @opt (string) $text
 * @opt (mixed)  $class
 * @opt (mixed)  $write
 * @opt (mixed)  $data
 * @opt (array)  $target // id of form
 *
 */

// process css
$save_button_classes = array("button", "expand", "olt-rui", "olt-save");
if (is_array($class) ) {
	$save_button_classes = array_merge($save_button_classes, $class);
}
if (is_string($class) ) {
	$save_button_classes = array_push($save_button_classes, $class);
}

// process display text
if ( !$text ) {
	$text = "Save";
}


if ( is_string($data) ) {
	$data =  array($data => true);
} elseif (!$data) {
	$data = array();
}

$data = array_merge(array("create-keys" => false, "create-after-depth" => 0, "type" => "save", "target" => $target), $data);

if ( !empty($write) ) {
	// $write should be an array of length-2 arrays, each with the keys "to" and "value"
	if ( array_key_exists("to", $write) ) {
		$write = array($write);
	}
	$data['write'] = json_encode($write);
}
?>

<a href="#_" class="<?php echo implode(" ", $save_button_classes);?>"
    <?php echo ___dA($data, SGL_Q);?>>
	<?php echo ucwords($text);?>
</a>