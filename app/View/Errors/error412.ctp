<?php
/**
 * J. Mulle, for app, 6/4/14 5:48 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 *
 * Hey Jono. Forgot what the hell "412" meant yet?
 *
 * http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
 * 412 Precondition Failed
 * "The precondition given in one or more of the request-header fields evaluated to false when it was tested on the server.
 * This response code allows the client to place preconditions on the current resource metainformation (header field data)
 * and thus prevent the requested method from being applied to a resource other than the one intended.
 */
?>
<h2><?php echo $name; ?></h2>
<p class="error">
	<strong><?php echo __d('cake', 'Error'); ?>: </strong>
	<?php printf(
		__d('cake', 'The booger %s was not found on this server.'),
		"<strong>'{$url}'</strong>"
	); ?>
</p>
<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>