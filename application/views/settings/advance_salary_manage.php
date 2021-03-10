<!-- Account List Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('advance_salary_manage') ?></h1>
            <small><?php echo display('advance_salary_manage') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('payroll') ?></a></li>
                <li class="active"><?php echo display('advance_salary_manage') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">

        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>
            </div>
            <?php
            $this->session->unset_userdata('error_message');
        }
        ?>



        <div class="row">
            <div class="col-sm-12">

                   <?php if($this->permission1->method('add_advance','create')->access()){ ?>
                    <a href="<?php echo base_url('Csettings/add_advance')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_advance')?> </a>
               <?php }?>

                    <?php if($this->permission1->method('add_loan','create')->access()){ ?>
                <a href="<?php echo base_url('Csettings/add_loan')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_loan')?> </a>
                <?php }?>

                   <?php if($this->permission1->method('add_payment','create')->access()){ ?>
                  <a href="<?php echo base_url('Csettings/add_payment')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_payment')?> </a>
                  <?php }?>


            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open('Csettings/dateWiseSalaryAdvance', array('class' => 'form-inline', 'method' => 'POST')) ?>
                        <?php
                        date_default_timezone_set("Asia/Dhaka");
                        $today = date('Y-m-d');
                        ?>
                        <div class="form-group row">
                            <label for="employee_id" class="col-sm-3 col-form-label"><?php echo display('employee_name') ?> *</label>
                            <div class="col-sm-9">
                                <select  name="employee_id" class="form-control" id="employee_id" required>
                                  <option value=""> -- Select a Employeee -- </option>
                                    {employee_list}
                                    <option value="{emp_id}">{first_name} {last_name}</option>
                                    {/employee_list}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="" for="from_date"><?php echo display('start_date') ?></label>
                            <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo (!empty($from_date)?$from_date:$today) ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="" for="to_date"><?php echo display('end_date') ?></label>
                            <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo (!empty($to_date)?$to_date:$today) ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <!--                        <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')">--><?php //echo display('print') ?><!--</a>-->
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_advance_salary') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('name') ?></th>
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('advance') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($advance_list) {
                                        ?>
                                        {advance_list}
                                        <tr>
                                            <td>{first_name} {last_name}</td>
                                            <td>{taken_date}</td>
                                            <td><?php echo (($position == 0) ? "$currency {amount}" : "{amount} $currency"); ?></td>
                                        <td>
                                        <center>
                                            <?php echo form_open() ?>
                                            <?php if($this->permission1->method('manage_advance_salary','update')->access()){ ?>
                                            <a href="<?php echo base_url('Csettings/advance_salary_edit/{id}'); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <?php }?>
                                        <?php if($this->permission1->method('manage_person','delete')->access()){ ?>
                                         <a href="<?php echo base_url("Csettings/delete_advance_salary/{id}") ?>" class="btn btn-sm btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
                                         <?php }?>
                                            <?php echo form_close() ?>
                                        </center>
                                        </td>
                                    </tr>
                                    {/advance_list}
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right"><?php echo $links ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Account List End -->

