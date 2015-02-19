<?php
if ($this->session->flashdata('errormessage')) {
?>
	<div class="note note-danger note-bordered">
	  <p><?php print $this->session->flashdata('errormessage'); ?></p>
	</div>
<?php
}
else
{
?>
	<?php
	if ($this->session->flashdata('message')) {
	?>
		<div class="note note-success note-bordered">
		  <p><?php print $this->session->flashdata('message'); ?></p>
		</div>
	<?php
	}
	?>
<?php
}
?>