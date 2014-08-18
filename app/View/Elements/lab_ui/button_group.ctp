<?php
/**
 * J. Mulle, for app, 5/14/14 4:17 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 *
 * @name button_group
 * @desc
 * @arg $field_name: The name of the parameter or response field
 * @arg $slide_name: The name of the slide requesting this element
 * @arg $type: Whether the field is a param or a response
 * @arg $options: For select fields, button lists, etc. — anything that requires a choice from among options
 * @arg $rset: The current response set in use; used to populate already responed to fields
 * @arg $config: Optional aesthetic and/or structural configurations for the UI element
 */

$_config = array("button_color" => "default","button_size" => "medium", "inline" => false, "class" => array());
extract(array_merge($_config, $config));

// process css classes
$_base_class = array($button_size, "button");
$_class = array_merge($_base_class, $class);


if (!is_string($class) ) { $class = array($class);}

echo $inline ? "<ul class=\"button-group\">" : null;

foreach($options as $opt) {
	$opt['class'] = $_class;
	if ( $rset['data'][$type][$field_name] === $opt['value']) { array_push($opt['class'], "set"); }
	if (!$inline) { array_push($opt['class'], "expand");
?>
<div class="row">
	<div class="small-6 small-centered columns"> <?php // parameterize: enclosing div element(s)?>
		<h2 class="<?php echo implode(" ", $opt['class']);?>"  data-olt-option="<?php echo $opt['value'];?>" data-olt-param="<?php echo $field_name;?>">
			<?php echo $opt['string'];?>
		</h2>
	</div>
</div>
<?php
} else { ?>
	<li class="<?php echo implode(" ", $opt['class']);?>" data-olt-option="<?php echo $opt['value'];?>" data-olt-param="<?php echo $field_name;?>">
		<?php echo $opt['string'];?>
	</li>
<?php }
}
echo $inline ? "</ul>" : null;
?>

