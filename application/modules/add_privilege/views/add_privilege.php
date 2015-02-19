<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-12">
        <?php $this->load->view('generic/flash_error'); ?>
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-th-list font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase"><?php echo $this->lang->line('privi_p_heading'); ?></span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body ">
                <?php print form_open('add_privilege/add', array('id' => 'add_privilege_form','name'=>'add_privilege_form')) ."\r\n"; ?>    
    <div class="row">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <?php print form_label($this->lang->line('privi_p_user_role'), 'reg_user_roll_id'); ?>
                <?php print form_dropdown('user_roll_id',$user_roll,'0','id="reg_user_roll_id" class="form-control qtip_user_roll_id" onchange="checked_action(this.value)"'); ?>
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12">
    <div class="dataTables_wrapper">
      <div class="privilege_table">
        <div class="privilege_table_hd">
          <div class="row">
            <div class="col-md-2 menu-hd"> <?php echo $this->lang->line('privi_p_list_hd_menu'); ?> </div>
            <div class="col-md-10 aln-center menu-hd"> <?php echo $this->lang->line('privi_p_list_hd_action'); ?> </div>
          </div>
        </div>
        <div class="privilege_table_in">
         <?php 
        if($previlage_action){
        for($i=0;$i<count($previlage_action);$i++){ ?>
          <div class="row">
            <div class="col-md-2 menu-name"> <?php echo $this->lang->line($previlage_action[$i]['lang_menu_name']); ?> </div>
            <div class="col-md-10">
              <?php 
              if($previlage_action[$i]['menu_action']){ ?>
              <div class="row" data-sync-height="true">
                <div class="col-md-4">&nbsp;</div>
                <?php 
                for($j=0;$j<count($previlage_action[$i]['menu_action']);$j++){ ?>
                <div class="col-md-2">
                  <div class="icheck-list11">
                    <label>
                    <?php 
                    $menu_act_id = $previlage_action[$i]['menu_action'][$j]['menu_id'].'_'.$previlage_action[$i]['menu_action'][$j]['value'];
                    echo form_checkbox('action[]', $menu_act_id, FALSE,'id="chkbox_'.$menu_act_id.'" style="display:none1;"  class="icheck11" onclick=checked_unchecked("'.$menu_act_id.'")');
                    echo $previlage_action[$i]['menu_action'][$j]['name']; ?>
                    </label>
                    <?php /*?><span id="unchk_<?php echo $menu_act_id; ?>" onclick="checked_unchecked('0','<?php echo $menu_act_id;?>')"><?php echo $previlage_action[$i]['menu_action'][$j]['name']; ?></span>
                    <span class="check" id="chk_<?php echo $menu_act_id; ?>" style="display:none;" onclick="checked_unchecked('1','<?php echo $menu_act_id;?>')"><?php echo $previlage_action[$i]['menu_action'][$j]['name']; ?></span><?php */?>
                  </div>
                </div> <?php   
                } ?>
              </div>
              <?php                 
            }else{
                if($previlage_action[$i]['sub_menu']){ 
                    for($j=0;$j<count($previlage_action[$i]['sub_menu']);$j++){ ?>
                        <div class="row" data-sync-height="true">
                        <div class="col-md-4 sub-menu"><?php echo $this->lang->line($previlage_action[$i]['sub_menu'][$j]['lang_menu_name']); ?></div> <?php
                        $menu_action = $previlage_action[$i]['sub_menu'][$j]['menu_action'];
                        if($menu_action){
                        for($k=0;$k<count($menu_action);$k++){
                        ?>
                        <div class="col-md-2">
                          <div class="icheck-list11">
                            <label>
                            <?php 
                            $menu_act_id =$menu_action[$k]['menu_id'].'_'.$menu_action[$k]['value'];
                            echo form_checkbox('action[]', $menu_act_id, FALSE,'id="chkbox_'.$menu_act_id.'" style="display:none1;"  class="icheck11" onclick=checked_unchecked("'.$menu_act_id.'")');
                            echo $menu_action[$k]['name']; ?>
                            </label>
                            <?php /*?><span id="unchk_<?php echo $menu_act_id; ?>" onclick="checked_unchecked('0','<?php echo $menu_act_id;?>')"><?php echo $menu_action[$k]['name']; ?></span>
                            <span class="check" id="chk_<?php echo $menu_act_id; ?>" style="display:none;" onclick="checked_unchecked('1','<?php echo $menu_act_id;?>')"><?php echo $menu_action[$k]['name']; ?></span><?php */?>
                          </div>
                        </div> <?php   
                        }
                        } ?>
                        </div> <?php
                    }
                }
            } ?>
            </div>
          </div> <?php
        }
        } ?>
        </div>
      </div>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="row margin-top-20 text-center">
        <!-- <div class="col-md-2"> -->
            <div class="form-group"><?php print form_submit(array('name' => 'add_privilege_submit', 'id' => 'add_privilege_submit', 'value' => $this->lang->line('privi_p_btn'), 'class' => 'input_submit btn btn-lg green')) ."<br />\r\n"; ?> </div>
        <!-- </div> -->
        </div>
    </div>
    </div>
      
                <?php print form_close() ."\r\n"; ?> 
            </div>
        </div>
    </div>
</div>