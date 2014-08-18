<?php
/**
 *
 * Created by PhpStorm.
 * User: J.Mulle, this.impetus@gmail.com 
 * Date: 3/21/14
 * Time: 11:41 AM
 *
 */
?>


<div id="jsoneditor"></div>

<script>
	var raw_template = <?php echo $scheme_ob;?>;
	pr(raw_template);
</script>

<?php $this->Html->script("views/labs.schemer", array("block" => "views"));?>