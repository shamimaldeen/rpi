<?php
$CI = & get_instance();
$CI->load->model('Web_settings');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>
<!-- Sales Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('datewise_sale_details') ?></h1>
            <small><?php echo display('datewise_sale_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('datewise_sale_details') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">

        <!-- Sales report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 
                        <?php echo form_open('Cinvoice/dateWiseInvoice', array('class' => 'form-inline', 'method' => 'get')) ?>
                        <?php
                        date_default_timezone_set("Asia/Dhaka");
                        $today = date('Y-m-d');
                        ?>
                        <div class="form-group">
<!--                            <label class="" for="customer_id">--><?php //echo display('customer_name') ?><!--</label>-->
                            <select  name="customer_id" class="form-control" id="customer_id" required>
                                <option value=""> -- Select a Customer -- </option>
                                <?php
                                foreach ($all_customer as $customer) {
                                    ?>
                                    <option value="<?php echo $customer->customer_id; ?>"><?php echo $customer->customer_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="" for="from_date"><?php echo display('start_date') ?></label>
                            <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo (!empty($from_date)?$from_date:$today) ?>" required>
                        </div> 

                        <div class="form-group">
                            <label class="" for="to_date"><?php echo display('end_date') ?></label>
                            <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo (!empty($to_date)?$to_date:$today) ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="" for="invoice_no"><?php echo display('invoice_no') ?></label>
                            <input type="text" name="invoice_no" class="form-control" id="invoice_no" placeholder="<?php echo display('invoice_no') ?>" value="<?php echo (!empty($invoice_no)?$invoice_no:'') ?>" required>
                        </div>

                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
<!--                        <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')">--><?php //echo display('print') ?><!--</a>-->
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($invoice_all_data) && count($invoice_all_data)>0){
            $customer_name     = $invoice_all_data[$product_id]['customer_name'];
            $customer_address  = $invoice_all_data[$product_id]['customer_address'];
            $customer_mobile   = $invoice_all_data[$product_id]['customer_mobile'];
            $customer_email    = $invoice_all_data[$product_id]['customer_email'];
            $final_date        = $invoice_all_data[$product_id]['final_date'];
            $invoice_details   = $invoice_all_data[$product_id]['invoice_details'];
//            $total_amount      = number_format($invoice_detail[0]['total_amount']+$invoice_detail[0]['prevous_due'], 2, '.', ',');
//            $subTotal_quantity = $subTotal_quantity;
//            $total_discount    = number_format($invoice_detail[0]['total_discount'], 2, '.', ',');
//            $total_tax         = number_format($invoice_detail[0]['total_tax'], 2, '.', ',');
//            $subTotal_ammount  = number_format($subTotal_ammount, 2, '.', ',');
//            $paid_amount       = number_format($invoice_detail[0]['paid_amount'], 2, '.', ',');
//            $due_amount        = number_format($invoice_detail[0]['due_amount'], 2, '.', ',');
//            $previous          = number_format($invoice_detail[0]['prevous_due'], 2, '.', ',');
//            $shipping_cost     = number_format($invoice_detail[0]['shipping_cost'], 2, '.', ',');
        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div id="printableArea">
                        <div class="panel-body">
                            <div class="row print_header">

                                <div class="col-sm-8 company-content">
                                    {company_info}
                                    <img src="<?php
                                    if (isset($Web_settings[0]['invoice_logo'])) {
                                        echo html_escape($Web_settings[0]['invoice_logo']);
                                    }
                                    ?>" class="img-bottom-m" alt="" >
                                    <br>
                                    <span class="label label-success-outline m-r-15 p-10" ><?php echo display('billing_from') ?></span>
                                    <address class="margin-top10">
                                        <strong class="company_name_p">{company_name}</strong><br>
                                        {address}<br>
                                        <abbr><b><?php echo display('mobile') ?>:</b></abbr> {mobile}<br>
                                        <abbr><b><?php echo display('email') ?>:</b></abbr>
                                        {email}<br>
                                        <abbr><b><?php echo display('website') ?>:</b></abbr>
                                        {website}<br>
                                        {/company_info}
                                        <abbr>{tax_regno}</abbr>
                                    </address>

                                </div>


                                <div class="col-sm-4 text-left invoice-address">
                                    <h2 class="m-t-0"><?php echo display('invoice') ?></h2>
                                    <div><?php echo display('invoice_no') ?>: {invoice_no}</div>
                                    <div class="m-b-15"><?php echo display('billing_date') ?>: <?php echo $final_date; ?></div>

                                    <span class="label label-success-outline m-r-15"><?php echo display('billing_to') ?></span>

                                    <address class="customer_name_p">
                                        <strong  class="c_name" ><?php echo $customer_name; ?> </strong><br>
                                        <?php if ($customer_address) {
                                            echo $customer_address;
                                        } ?>
                                        <br>
                                        <abbr><b><?php echo display('mobile') ?>:</b></abbr>
                                        <?php if ($customer_mobile) {
                                            echo $customer_mobile;
                                            }if ($customer_email) {
                                        ?>
                                        <br>
                                        <abbr><b><?php echo display('email') ?>:</b></abbr>
                                        <?php
                                        echo $customer_email;
                                        } ?>
                                    </address>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped" id="invoice_details">
                                    <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('sl') ?></th>
                                        <th class="text-center"><?php echo display('product_name') ?></th>
                                        <th class="text-center"><?php if($is_unit !=0){ echo display('unit');
                                            }?></th>
                                        <th class="text-center"><?php if($is_desc !=0){ echo display('item_description');} ?></th>
                                        <th class="text-center"><?php if($is_serial !=0){ echo display('serial_no');} ?></th>
                                        <th class="text-right"><?php echo display('quantity') ?></th>
                                        <th></th>
                                        <th class="text-right"><?php echo display('rate') ?></th>
                                        <th class="text-right"><?php echo display('ammount') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($invoice_all_data as $data): ?>
                                    <tr class="details productdatalineheight">
                                        <td class="text-center"><?= $data['sl'] ?></td>
                                        <td class="text-center"><div><?= $data['product_name'].' - ('.$data['product_model'].')'; ?></div></td>
                                        <td class="text-center"><div><?= $data['unit'] ?></div></td>
                                        <td align="center"><?= $data['description'] ?></td>
                                        <td align="center"><?= $data['serial_no'] ?></td>
                                        <td align="right"><?= $data['quantity'] ?></td>
                                        <td></td>
                                        <td align="right"><?php echo (($position == 0) ? "$currency " . $data['rate'] : $data['rate']." $currency") ?></td>
                                        <td align="right"><?php echo (($position == 0) ? "$currency ".$data['total_price'] : $data['total_price']." $currency") ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td class="text-left" colspan="4"></td>
                                        <td algin="right"><b><?php echo display('total_quantity') ?></b></td>
                                        <td align="right" ><b>{subTotal_quantity}</b></td>
                                        <td></td>
                                        <td algin="right"><b><?php echo display('total_balance') ?></b></td>
                                        <td align="right" ><b><?php echo (($position == 0) ? "$currency {subTotal_ammount}" : "{subTotal_ammount} $currency") ?></b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">

                                <div class="col-xs-8 invoicefooter-content">

                                    <p></p>
                                    <p><strong>WORD IN TAKA </strong>: {am_inword} Taka Only</p>
                                    <p><strong><?php echo $invoice_details; ?></strong></p>
                                    <p><b><u>AFTER SUBMITTING OUR BILLS, 15 DAYS CHAQUE OR CASH WILL BE REQUIRED</u></b></p>
                                </div>
                                <div class="col-xs-4 inline-block">

                                    <table class="table">
<!--                                        --><?php
//                                        if ($total_discount != 0) {
//                                            ?>
<!--                                            <tr>-->
<!--                                                <th class="border-bottom-top">--><?php //echo display('total_discount') ?><!-- : </th>-->
<!--                                                <td class="text-right border-bottom-top" >--><?php //echo html_escape((($position == 0) ? "$currency {total_discount}" : "{total_discount} $currency")) ?><!-- </td>-->
<!--                                            </tr>-->
<!--                                            --><?php
//                                        }
//                                        if ($total_tax != 0) {
//                                            ?>
<!--                                            <tr>-->
<!--                                                <th class="text-left border-bottom-top" >--><?php //echo display('tax') ?><!-- : </th>-->
<!--                                                <td  class="text-right border-bottom-top" >--><?php //echo html_escape((($position == 0) ? "$currency {total_tax}" : "{total_tax} $currency")) ?><!-- </td>-->
<!--                                            </tr>-->
<!--                                        --><?php //} ?>
<!--                                        --><?php //if ($shipping_cost != 0) {
//                                            ?>
<!--                                            <tr>-->
<!--                                                <th class="text-left border-bottom-top" >--><?php //echo 'Shipping Cost' ?><!-- : </th>-->
<!--                                                <td class="text-right border-bottom-top" >--><?php //echo html_escape((($position == 0) ? "$currency {shipping_cost}" : "{shipping_cost} $currency")) ?><!-- </td>-->
<!--                                            </tr>-->
<!--                                        --><?php //} ?>
<!--                                        <tr>-->
<!--                                            <th class="text-left grand_total">--><?php //echo display('previous'); ?><!-- :</th>-->
<!--                                            <td class="text-right grand_total">--><?php //echo html_escape((($position == 0) ? "$currency {previous}" : "{previous} $currency")) ?><!--</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th class="text-left grand_total">--><?php //echo display('grand_total') ?><!-- :</th>-->
<!--                                            <td class="text-right grand_total">--><?php //echo html_escape((($position == 0) ? "$currency {total_amount}" : "{total_amount} $currency")) ?><!--</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th class="text-left grand_total border-bottom-top">--><?php //echo display('paid_ammount') ?><!-- : </th>-->
<!--                                            <td class="text-right grand_total border-bottom-top">--><?php //echo html_escape((($position == 0) ? "$currency {paid_amount}" : "{paid_amount} $currency")) ?><!--</td>-->
<!--                                        </tr>-->
<!--                                        --><?php
//                                        if ($due_amount != 0) {
//                                            ?>
<!--                                            <tr>-->
<!--                                                <th class="text-left grand_total">--><?php //echo display('due') ?><!-- : </th>-->
<!--                                                <td  class="text-right grand_total">--><?php //echo html_escape((($position == 0) ? "$currency {due_amount}" : "{due_amount} $currency")) ?><!--</td>-->
<!--                                            </tr>-->
<!--                                        --><?php
//                                        }
//                                        ?>
                                    </table>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="inv-footer-left">
                                        <?php echo display('received_by') ?>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="inv-footer-right">
                                        <?php echo display('authorised_by') ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel-footer text-left">
                        <a  class="btn btn-danger" href="<?php echo base_url('Cinvoice'); ?>"><?php echo display('cancel') ?></a>
                        <button  class="btn btn-info" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>

                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </section>
</div>
<!-- Sales Report End -->