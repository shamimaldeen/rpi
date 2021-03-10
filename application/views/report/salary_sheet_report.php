<script>
    $(function() {
        "use strict";
        $('.monthYearPicker').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy'
        }).focus(function() {
            var thisCalendar = $(this);
            $('.ui-datepicker-calendar').detach();
            $('.ui-datepicker-close').click(function() {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                thisCalendar.datepicker('setDate', new Date(year, month, 1));
            });
        });
    });
</script>
<!-- Sales Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('salary_sheet') ?></h1>
            <small><?php echo display('salary_sheet') ?></small>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('report') ?></a></li>
                <li class="active"><?php echo display('salary_sheet') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">


        <div class="row">
            <div class="col-sm-12">

                  <?php if($this->permission1->method('todays_sales_report','read')->access()){ ?>
                    <a href="<?php echo base_url('Admin_dashboard/todays_sales_report') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('sales_report') ?> </a>
                <?php }?>
        <?php if($this->permission1->method('todays_purchase_report','read')->access()){ ?>
                    <a href="<?php echo base_url('Admin_dashboard/todays_purchase_report') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('purchase_report') ?> </a>
                  <?php }?>
                  <?php if($this->permission1->method('product_sales_reports_date_wise','read')->access()){ ?>
                    <a href="<?php echo base_url('Admin_dashboard/product_sales_reports_date_wise') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('sales_report_product_wise') ?> </a>
                    <?php }?>
    <?php if($this->permission1->method('todays_sales_report','read')->access() && $this->permission1->method('todays_purchase_report','read')->access()){ ?>
                    <a href="<?php echo base_url('Admin_dashboard/total_profit_report') ?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('profit_report') ?> </a>
                    <?php }?>
            </div>
        </div>

        <!-- Sales report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 
                        <?php echo form_open('Creport/salary_sheet_dateWise', array('class' => 'form-inline', 'method' => 'get')) ?>
                        <div class="form-group">
                            <label for="salary_month" class="col-sm-4 col-form-label"><?php echo display('salary_month') ?>* </label>
                            <input name="myDate" class="monthYearPicker form-control" required="" />
                        </div>

                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo display('print') ?></a>
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
                            <h4><?php echo display('salary_sheet'); ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="purchase_div">
                            <table class="print-table" width="100%">

                                <tr>
                                    <td align="left" class="print-table-tr">
                                        <img src="<?php echo $software_info[0]['logo'];?>" alt="logo">
                                    </td>
                                    <td align="center" class="print-cominfo">
                                        <span class="company-txt">
                                            <?php echo $company[0]['company_name'];?>

                                        </span><br>
                                        <?php echo $company[0]['address'];?>
                                        <br>
                                        <?php echo $company[0]['email'];?>
                                        <br>
                                         <?php echo $company[0]['mobile'];?>

                                    </td>

                                     <td align="right" class="print-table-tr">
                                        <date>
                                        <?php echo display('date')?>: <?php
                                        echo date('d-M-Y');
                                        ?>
                                    </date>
                                    </td>
                                </tr>

                        </table>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('SL') ?></th>
                                            <th><?php echo display('name') ?></th>
                                            <th><?php echo display('position') ?></th>
                                            <th><?php echo display('basic_sl') ?></th>
                                            <th><?php echo display('present') ?></th>
                                            <th><?php echo display('total')?></th>
                                            <th><?php echo display('advance1')?></th>
                                            <th><?php echo display('total_salary')?></th>
                                            <th><?php echo display('signature')?></th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        $sl=0;
                                        if ($salary_sheet) {
                                        foreach($salary_sheet as $sheet){
                                            $total_basic = $sheet['total_salary'] - $sheet['advance_detuct'];
                                        ?>
                                        <tr>
                                        <td><?php echo ++$sl; ?></td>
                                        <td>
                                        <?php echo $sheet['first_name'] . ' ' . $sheet['last_name']; ?></td>
                                        <td><?php echo $sheet['designation']?></td>
                                        <td class="text-right">
                                            <?php  if($position == 0){
                                                echo $currency.' '. number_format($sheet['gross_salary'],2);
                                            }else{
                                                echo number_format($sheet['gross_salary'],2).' '.$currency;
                                            }
                                            ?> </td>
                                        <td class="text-center"><?php echo $sheet['working_period']?></td>
                                        <td class="text-right">
                                            <?php  if($position == 0){
                                                echo $currency.' '. number_format($sheet['total_salary'],2);
                                            }else{
                                                echo number_format($sheet['total_salary'],2).' '.$currency;
                                            }
                                            ?></td>
                                        <td class="text-right">
                                            <?php  if($position == 0){
                                                echo $currency.' '. number_format($sheet['advance_detuct'],2);
                                            }else{
                                                echo number_format($sheet['advance_detuct'],2).' '.$currency;
                                            }
                                            ?></td>
                                        <td class="text-right"><?php  if($position == 0){
                                                echo $currency.' '. number_format($total_basic,2);
                                            }else{
                                                echo number_format($total_basic,2).' '.$currency;
                                            }
                                            ?></td>
                                         <td></td>
                                            
                                        </tr>
                                        <?php } ?>
                                        <?php } else { ?>
                                        <tr>
                                            <th class="text-center" colspan="10"><?php echo display('not_found'); ?></th>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                     <tfoot>
                                        <tr>
                                            <td class="text-left"><b><?php echo display('total') ?></b></td>
                                            <td colspan="6" class="text-center text-capitalize"><b><u><?php echo $total_word ?> Taka Only</u></b></td>
                                            <td colspan="2" class="text-right"><b><?php echo (($position == 0) ? $currency.' '. number_format($total_salary) : ($total_salary).' '. $currency) ?></b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="text-right"><?php echo $links ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--Salary Sheet Report End -->