<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" src="<?php print base_url(); ?>js/grid/home_visit.js"></script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
        	<div class="modal-header">
              <h2>Loading....</h2>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><br />
            </div>
            <div class="modal-body"><div style="text-align:center;"><i class="fa fa-spinner fa fa-6x fa-spin" id="animate-icon"></i></div></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
		 </div>	
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->		

<div class="row">
	<div class="col-md-12">
		<?php $this->load->view('generic/flash_error'); ?>
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-th-list font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase"><?php echo $this->lang->line('home_visit'); ?></span>
				</div>
				<div class="actions">
					<?php if($this->session->userdata('role_id') == '1' || in_array("add",$this->arrAction)) { ?>
					<a href="home_visit/add" class="btn green"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_new'); ?></a>
					<?php } ?>
				</div>
			</div>
			<div class="portlet-body ">
				<div class="table-container">
					<table class="table table-striped table-bordered table-hover" id="grid_home_visit">
						<thead>
							<tr>
				                <th><?php echo $this->lang->line('db_id'); ?></th>
				                <th><?php echo $this->lang->line('date_of_visit'); ?></th>
				                <th><?php echo $this->lang->line('location_of_visit'); ?></th>
				                <th><?php echo $this->lang->line('id_no'); ?></th>
				                <th><?php echo $this->lang->line('full_name_of_family_visited'); ?></th>
				                <th><?php echo $this->lang->line('name_of_visitor_from_association'); ?></th>
				                <th><?php echo $this->lang->line('month'); ?></th>
				                <th><?php echo $this->lang->line('year'); ?></th>
								<th><?php echo $this->lang->line('created_date'); ?></th>
								<th><?php echo $this->lang->line('action'); ?></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>