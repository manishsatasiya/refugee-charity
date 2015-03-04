<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" src="<?php print base_url(); ?>js/grid/location_association.js"></script>

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
	<div class="col-md-6">
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet light bg-inverse">
			<div class="portlet-title">
				<div class="caption font-purple-plum">
					<i class="icon-speech font-purple-plum"></i>
					<span class="caption-subject bold uppercase"> <?php echo $this->lang->line('location_of_association'); ?></span>
				</div>
				<div class="actions">
					<a href="refugee_settings/add" data-target="#myModal" data-toggle="modal" class="btn btn-circle red-sunglo btn-sm"> <i class="fa fa-plus"></i> <?php echo $this->lang->line('add_new'); ?> </a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-container">
					<table class="table table-striped table-bordered table-hover" id="grid_location_association">
						<thead>
							<tr role="row" class="heading">
								<th><?php echo $this->lang->line('db_id'); ?></th>
								<th><?php echo $this->lang->line('name'); ?></th>
								<th><?php echo $this->lang->line('action'); ?></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
	<div class="col-md-6">
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet light bg-inverse">
			<div class="portlet-title">
				<div class="caption font-purple-plum">
					<i class="icon-speech font-purple-plum"></i>
					<span class="caption-subject bold uppercase"> Portlet</span>
					<span class="caption-helper">more samples...</span>
				</div>
				<div class="actions">
					<div class="btn-group">
						<a class="btn btn-circle btn-default btn-sm" href="javascript:;" data-toggle="dropdown">
						<i class="fa fa-user"></i> User <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:;">
								<i class="fa fa-pencil"></i> Edit </a>
							</li>
							<li>
								<a href="javascript:;">
								<i class="fa fa-trash-o"></i> Delete </a>
							</li>
							<li>
								<a href="javascript:;">
								<i class="fa fa-ban"></i> Ban </a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="javascript:;">
								<i class="i"></i> Make admin </a>
							</li>
						</ul>
					</div>
					<a href="#" class="btn btn-circle btn-default btn-icon-only fullscreen"></a>
					<a href="javascript:;" class="btn btn-circle red-sunglo btn-sm">
					<i class="fa fa-plus"></i> Add </a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
					<h4>Heading Text</h4>
					<p>
						 Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
					</p>
					<p>
						 nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
					</p>
				</div>
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
</div>