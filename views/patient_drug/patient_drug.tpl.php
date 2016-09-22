<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="text-left">Patient's Drug Records</h3>
                    <?php if(isset($recordQuery)): ?>
                        <p class="text-left">
                            <small class="text-left text-info">Showing results for : <?php echo $recordQuery ?></small>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="success-msg">

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">

<!--                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
<!--                            <form name="recordSearchForm" method="get" action="./?">-->
<!--                                <div class="form-group">-->
<!--                                    <div class="input-group">-->
<!--                                        <input type="text" name="q" class="form-control" placeholder="Enter patient, national id or drug name to search" />-->
<!--                                    <span class="input-group-btn">-->
<!--                                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Search</button>-->
<!--                                    </span>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <input type="hidden" name="page" value="patient_drug" />-->
<!--                            </form>-->
<!--                        </div>-->
<!--                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">-->
<!--                            <div class="form-group pull-right">-->
<!--                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addRecordModal"><i class="fa fa-plus"></i> Add Record</button>-->
<!--                            </div>-->
<!--                            <div class="form-group hidden-lg hidden-md hidden-sm">-->
<!--                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addRecordModal"><i class="fa fa-plus"></i> Add Record</button>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Patient</th>
                            <th>Drug</th>
                            <th>Quantity</th>
                            <th>Created by</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        foreach($records as $record){
                            ?>
                            <tr>
                                <td><?php echo ($i+1)."." ?></td>
                                <td><?php echo $record["patient_first_name"]." ".$record["patient_last_name"]." (".$record["national_id"].")" ?></td>
                                <td><?php echo $record["drug"] ?></td>
                                <td><?php echo $record["qty"] ?></td>
                                <td><?php echo $record["created_by"] ?></td>
                                <td><?php echo $record["created_on"] ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        <!--                            -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
