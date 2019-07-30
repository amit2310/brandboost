@extends('layouts.main_template') 

@section('title')
<?php echo $title; ?>
@endsection

@section('contents')
<?php list($canRead, $canWrite) = fetchPermissions('Reviews'); ?>
<!-- Content area -->
<div class="content">

    <!--&&&&&&&&&&&& PAGE HEADER &&&&&&&&&&-->
    <div class="page_header">
        <div class="row">
            <!--=============Headings & Tabs menu==============-->
            <div class="col-md-3">
                <h3><img src="<?php echo base_url() ?>assets/images/people_sec_icon.png"> Contacts</h3>
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="active"><a href="#right-icon-tab0" data-toggle="tab">Active Contacts</a></li>
                    <li><a href="#right-icon-tab1" data-toggle="tab">Archive</a></li>
                </ul>
            </div>
            <!--=============Button Area Right Side==============-->
            <div class="col-md-9 text-right btn_area">


                <button type="button" class="btn light_btn importModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID ?>" data-redirect="<?php echo base_url(); ?>admin/contacts/mycontacts"><i class="icon-arrow-up16"></i><span> &nbsp;  Import Contacts</span> </button>
                <a class="btn light_btn ml10" href="<?php echo base_url() ?>admin/subscriber/exportSubscriberCSV?module_name=<?php echo $moduleName; ?>&module_account_id=<?php echo $moduleUnitID; ?>"><i class="icon-arrow-down16"></i><span> &nbsp;  Export Contacts</span> </a>
                <button type="button" class="btn dark_btn dropdown-toggle ml10 addModuleContact" data-modulename="<?php echo $moduleName; ?>" data-moduleaccountid="<?php echo $moduleUnitID ?>"><i class="icon-plus3"></i><span> &nbsp;  Add Contact</span> </button>  
                &nbsp;


            </div>
        </div>
    </div>
    <!--&&&&&&&&&&&& PAGE HEADER END &&&&&&&&&&-->

    <div class="tab-content"> 
        <!--===========TAB 1===========-->
        <?php //$this->load->view("admin/components/smart-popup/contacts");?>
        <?php //$this->load->view('admin/workflow/workflow_subscribers', array('showArchived' => true)); ?>

        @include('admin.workflow2.workflow_subscribers', array('showArchived' => true));
        
    </div>
</div>

<!-- /content area -->

@endsection



