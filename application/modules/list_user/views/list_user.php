<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" src="<?php print base_url(); ?>js/grid/list_user.js"></script>

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
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-th-list font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase"><?php echo $this->lang->line('user_p_heading'); ?></span>
				</div>
				<div class="actions">
					<a href="list_user/add" class="btn green" data-target="#myModal" data-toggle="modal"><?php echo $this->lang->line('add_new'); ?> <i class="fa fa-plus"></i></a>
				</div>
			</div>
			<div class="portlet-body ">
				<div class="table-container">
					<table class="table table-striped table-bordered table-hover" id="grid_user">
						<thead>
							<tr>
								<th width="2%">DB ID</th>
								<th>Role</th>
								<th>Name</th>
								<th>E-mail</th>
								<th>Birth date</th>
								<th>Gender</th>
								<th>Cell phone</th>                    
								<th>Status</th>                    
								<th>Date Added</th>
								<th>Last Updated</th>
								<th><?php echo $this->lang->line('user_p_action'); ?></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>