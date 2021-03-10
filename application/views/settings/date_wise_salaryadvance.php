<!-- Manage attendance Start -->

<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Salary Advance</h1>
            <small>Datewise Salary Advance Report</small>
            <ol class="breadcrumb">
                <li><a href=""><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('attendance') ?></a></li>
                <li class="active"><?php echo display('datewise_report') ?></li>
            </ol>
        </div>
    </section>

    <section class="content">


        <!-- Manage Category -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <button  class="btn btn-warning" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>
                        </div>
                    </div>
                    <div class="panel-body" >
                        <div class="row" id="printableArea">

                            <table  class="table table-striped" width="100%">


                                <div class="form-group text-center rpthtext">

                                    salary advance report
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        <?php echo "<img src='" .html_escape($ab[0]['image'])."' width=120px; height=120px;>";?>
                                    </div>
                                    <div  class="col-sm-8">

                                        <div class="form-group text-left rptname">

                                            <?php echo display('name') ?>:<?php
                                            echo html_escape($ab[0]['first_name'])." ".html_escape($ab[0]['last_name']) ;?>

                                        </div>
                                        <div class="form-group text-left rptname">

                                            ID NO: <?php

                                            echo html_escape($ab[0]['id']) ;


                                            ?>
                                        </div>

                                        <div class="form-group text-left rptname">

                                            <?php echo display('designation') ?>: <?php  echo html_escape($ab[0]['emdesignation']) ; ?>
                                        </div>
                                    </div>
                                </div>
                            </table>
                            <table class="table table-striped">
                                <tr>
                                    <th> <?php echo display('date') ?></th>
                                    <th> <?php echo display('advance') ?></th>

                                </tr>

                                <tr>
                                    <?php
                                    if ($query) {
                                    ?>
                                    {query}
                                <tr>
                                    <td>{taken_date}</td>
                                    <td> {amount} ৳</td>

                                </tr>
                                {/query}
                                <?php
                                }
                                ?>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>



