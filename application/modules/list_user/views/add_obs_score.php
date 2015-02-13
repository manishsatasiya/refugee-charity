<script type="text/javascript" src="<?php print base_url(); ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php print base_url(); ?>js/validation.js"></script>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
print form_open('list_user/add_obs_score/'.$id.'/', array('id' => 'add_obs_score','name'=>'formmain')) ."\r\n";
?>
<div class="modal-header">
  <h2><?php echo 'Add Score'; ?></h2>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><br />
</div>
<div class="modal-body">
	<?php $this->load->view('generic/flash_error'); ?>
	<div class="containerfdfdf"></div>
    
	<div class="row form-row">
		<div class="col-md-6">
			<div class="form_label2"><?php print form_label('Observation Score', 'score'); ?></div>
			<div class="input_box_thin">
				<?php print form_dropdown('score',array(''=>'Select','1'=> '1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','exempt'=>'exempt','n/a'=>'n/a'),$observation_1,'id="score" class="select2 form-control" readonly="readonly"'); ?>
            </div>
		</div>
        <div class="col-md-6">
			<div class="form_label2"><?php print form_label('EdTech Score', 'et_score'); ?></div>
			<div class="input_box_thin">
				<?php print form_dropdown('et_score',array(''=>'Select','1'=> '1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','exempt'=>'exempt','n/a'=>'n/a'),$ed_tech_score_1,'id="et_score" class="select2 form-control"'); ?>
            </div>
		</div>
    </div>   
    
    
    <div class="row form-row">
		<div class="col-md-6">
			<div class="form_label2"><?php print form_label('Observation Score 2', 'score2'); ?></div>
			<div class="input_box_thin">
				<?php print form_dropdown('score2',array(''=>'Select','1'=> '1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','exempt'=>'exempt','n/a'=>'n/a'),$observation_2,'id="score2" class="select2 form-control"'); ?>
            </div>
		</div>
        <div class="col-md-6">
			<div class="form_label2"><?php print form_label('EdTech Score 2', 'et_score2'); ?></div>
			<div class="input_box_thin">
				<?php print form_dropdown('et_score2',array(''=>'Select','1'=> '1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','exempt'=>'exempt','n/a'=>'n/a'),$ed_tech_score_2,'id="et_score2" class="select2 form-control"'); ?>
            </div>
		</div>
	</div>	
    <script>
    <?php
	if($ed_tech_score_1 <> '' && $observation_1 <> '')
	{ ?>
    	$('#score').select2('readonly', true);
		$('#et_score').select2('readonly', true);
    <?php
	}else{ ?>
		$('#score2').select2('readonly', true);
		$('#et_score2').select2('readonly', true);
	<?php
	} ?>
	</script>	
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<input type="submit" name="student_submit" id="student_submit" value="<?php echo 'Add'; ?>" class="btn btn-primary"/>
</div>	
<?php	
print form_close() ."\r\n";
?>