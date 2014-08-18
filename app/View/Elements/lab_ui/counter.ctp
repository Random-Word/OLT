<?php
/**
 * J. Mulle, for app, 6/13/14 5:24 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 *
 * @name counter
 *
 * @desc
 * @arg  (string)  $slide_name
 * @arg  (string)  $param_or_response_name
 * @arg  (bool)    $incrementer
 * @arg  (bool)    $decrementer
 * @arg  (mixed)   $triangles
 * @arg  (array)   $data
 * @arg  (string)  $arrangement
 * @arg  (int)     $increment
 * @arg  (array)   $options
 *
 */


// parse option arguments
$_options = array( "font_size_class" => null,
                   "incrementer_bind" => "click",
                   "decrementer_bind" => "click",
                   "counter_bind" => false,
                   "count_bind" => false);

extract(array_merge($_options, $options));


// create required IDs
$incrementer_id = ___strToSel(array($slide_name, $param_or_response_name, "incrementer"));
$decrementer_id = ___strToSel(array($slide_name, $param_or_response_name, "decrementer"));
$counter_id = ___strToSel(array($slide_name, $param_or_response_name, "counter"));
$count_id = ___strToSel(array($slide_name, $param_or_response_name, "tally"));

// prep class arrays
$counter_classes = array("olt-rui","counter", $arrangement);
$count_classes = array("olt-rui","counter tally", $font_size_class);
$incrementer_classes = array("olt-rui","incrementer");
$decrementer_classes = array("olt-rui","decrementer");

if ($triangles) {
	array_push($incrementer_classes, "olt-triangle up-facing");
	array_push($decrementer_classes, "olt-triangle down-facing");
}

// parse data tags
$_data = array("allow negative" => false, "ceiling" => false, "floor" => false, "start" => 0, "increment" => 1, "decrement" => 1, "type" => "counter");
$data = array_merge($_data, $data);
$incrementer_data = array("value" => $data['increment'], "counter" =>$counter_id, "type" => "incrementer", "bind" => $incrementer_bind);
$decrementer_data = array("value" => $data['decrement'], "counter" =>$counter_id, "type" => "decrementer", "bind" => $incrementer_bind);
$count_data = array("tally" => $data['start'], "type" => "counter-value", "bind" => $incrementer_bind);
$counter_data = ___dA($data, SGL_Q, "int");
?>
<ul id="<?php echo $counter_id;?>" <?php echo ___cD($counter_classes);?>" <?php echo $counter_data;?>>
	<li>
		<a  id="<?php echo $incrementer_id;?>"
			href="#_"
			<?php echo ___cD($incrementer_classes);?>"
			<?php echo ___dA($incrementer_data);?>>
		<?php echo $triangles ?  null : "&#43;";?>
		</a>
	</li
	><li class="tally">
		<span id="<?php echo $count_id;?>" <?php echo ___cD($count_classes);?> <?php echo ___dA($count_data);?>>
			<?php echo $data['start'];?>
		</span>
	</li
	><li>
		<a id="<?php echo $decrementer_id;?>"
		   href="#_"
		   <?php echo ___cD($decrementer_classes);?>"
			<?php echo ___dA($decrementer_data);?>>
		<?php echo $triangles ?  null : "&#45;";?>
		</a>
	</li>
</ul>