<?php
if ($this->session->flashdata('errormessage')) {
?>
	<div class="alert alert-danger">
	  <button data-dismiss="alert" class="close"></button>
	  <span><?php print $this->session->flashdata('errormessage'); ?></span>
	</div>
<?php
}
else
{
?>
	<?php
	if ($this->session->flashdata('message')) {
	?>
		<div class="alert alert-success">
		  <button data-dismiss="alert" class="close"></button>
		  <span><?php print $this->session->flashdata('message'); ?></span>
		</div>
	<?php
	}
	?>
<?php
}
?>