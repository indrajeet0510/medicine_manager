<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="text-left">Patients</h3>
                    <?php if(isset($patientQuery)): ?>
                        <p class="text-left">
                            <small class="text-left text-info">Showing results for : <?php echo $patientQuery ?></small>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="success-msg">

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <form name="drugSearchForm" method="get" action="./?">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control" placeholder="Enter patient to search" />
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Search</button>
                                    </span>
                                    </div>
                                </div>
                                <input type="hidden" name="page" value="patient" />
                            </form>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group pull-right">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addPatientModal"><i class="fa fa-plus"></i> Add patient</button>
                            </div>
                            <div class="form-group hidden-lg hidden-md hidden-sm">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addPatientModal"><i class="fa fa-plus"></i> Add patient</button>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Patient Name</th>
                            <th>National ID</th>
                            <th></th>
                        </tr>
                        </thead>
                        <!--                        <tbody>-->
                        <!--                        <tr>-->
                        <!--                            <td>1.</td>-->
                        <!--                            <td>Rinku</td>-->
                        <!--                            <td>21</td>-->
                        <!--                        </tr>-->
                        <!--                        <tr>-->
                        <!--                            <td>2.</td>-->
                        <!--                            <td>Sahil</td>-->
                        <!--                            <td>32</td>-->
                        <!--                        </tr>-->

                        <?php

                        $i = 0;
                        foreach($patients as $patient){
                            ?>
                            <tr>
                                <td><?php echo ($i+1)."." ?></td>
                                <td><?php echo $patient->getFirstName()." ".$patient->getLastName() ?></td>
                                <td><?php echo $patient->getNationalId() ?></td>
                                <td>
                                    <form action="./?" method="get" name="searchFormPatient<?php echo $patient->getId() ?>">
                                        <input type="hidden" name="p" value="<?php echo $patient->getId() ?>" />
                                        <input type="hidden" name="page" value="patient_drug" />
                                        <button class="btn btn-xs btn-info" type="submit">View</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-warning drug-add-btn" data-patient="<?php echo $patient->getId() ?>" data-patient-name="<?php echo $patient->getFirstName()." ".$patient->getLastName() ?>"><i class="fa fa-plus"></i> Add Drug</button>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Add new patient</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="response-msg"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>National ID</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-national-id" type="text" placeholder="Enter patient's National ID" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>First Name*</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-first-name" type="text" placeholder="Enter patient's first name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Last Name</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-last-name" type="text" placeholder="Enter patient's last name" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-modal" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn-add-patient" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Add new drug record</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="record-response-msg"></div>
                    </div>
                    <div class="row">



                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <p class="text-danger">Adding drug record for patient <strong id="record-patient-name"></strong></p>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Drug*</label>
                            <div class="form-group form-group-sm">
                                <select class="form-control js-example-basic-single" id="record-drug">
                                    <?php for($i=0; $i < count($drugs); $i++){ ?>
                                        <option value="<?php echo $drugs[$i]->getId() ?>"><?php echo $drugs[$i]->getName() ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Quantity*</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="record-qty" value="1" type="text" placeholder="Quantity" />
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="record-patient" id="record-patient" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-record-modal" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn-add-record" class="btn btn-primary">Save Record</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $("#btn-add-patient").on('click',function(){
            var nationalId = $("#input-national-id").val();
            var firstName = $("#input-first-name").val();
            var lastName = $("#input-last-name").val();

            var errorList = [];
            if(!nationalId){
                errorList.push('National ID is mandatory');
            }
            if(!firstName){
                errorList.push('First name is mandatory');
            }

            if(errorList.length){
                var errorMsg = '';
                for(var a=0; a < errorList.length; a++){
                    errorMsg += ('<li>'+errorList[a]+'</li>');
                }
                $("#response-msg").html(
                    '<div class="alert alert-dismissible alert-danger">'+
                    '<button type="button" class="close" data-dismiss="alert">×</button>'+
                    '<strong>Please check the following errors!</strong>'+
                    '<ul>'+
                    errorMsg +
                    '</ul>'+
                    '</div>'
                );
            }
            else{
                $.ajax({
                    url : './',
                    method : 'POST',
                    dataType : 'json',
                    data : {
                        nationalId : nationalId,
                        firstName : firstName,
                        lastName : lastName,
                        page : 'patient'
                    },
                    success : function(data){
                        console.log(data);
                        if(data.status){
//                            $("#input-national-id").val('');
//                            $("#input-first-name").val('');
//                            $("#input-last-name").val('');
                            $("#success-msg").html(
                                '<div class="alert alert-dismissible alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                                '<strong>Patient added successfully</strong>'+
                                '</div>'
                            );
                            var prevCount =  parseInt($("table > tbody > tr").last().children("td").first().html());
                            var rowHtml = '<tr>'+
                                '<td>'+((isNaN(prevCount)) ? 1 : (prevCount+1))+'</td>'+
                                '<td>'+nationalId +'</td>'+
                                '<td>'+firstName + ' '+ lastName +'</td>'+
                                '<td>'+
                                '<form action="./?" method="get" name="searchFormPatient'+data.data.id+'">'+
                                '<input type="hidden" name="p" value="'+data.data.id +'" />'+
                                '<input type="hidden" name="page" value="patient_drug" />'+
                                '<button class="btn btn-xs btn-info" type="submit">View</button>'+
                                '</form>'+
                                '</td>'+
                                '</tr>';

                            $(rowHtml).appendTo("table > tbody");
                            $("#btn-close-modal").trigger('click');
                        }
                        else{
                            var errorMsg = '';
                            for(var prop in data.error){
                                if(data.error.hasOwnProperty(prop)){
                                    errorMsg += ('<li>'+data.error[a]+'</li>');
                                }
                            }
                            $("#response-msg").html(
                                '<div class="alert alert-dismissible alert-danger">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                                '<strong>'+data.message+'</strong>'+
                                '<ul>'+
                                errorMsg +
                                '</ul>'+
                                '</div>'
                            );
                        }


                    },
                    error : function(){

                    },
                    timeout : function(){

                    }
                });
            }
        });

        $("#btn-close-modal").on('click',function(){
            $("#input-national-id").val('');
            $("#input-first-name").val('');
            $("#input-last-name").val('');
        });

        $("#btn-close-record-modal").on('click',function(){
            $("#record-patient").val('');
            $("#record-patient-name").html('');
            $("#record-drug").val('');
            $("#record-qty").val(1);
        });




        $(".drug-add-btn").on('click',function(e){
            var targetElem = e.currentTarget;
            var patient = $(targetElem).data("patient");
            var patientName = $(targetElem).data("patientName");
            $("#addRecordModal").modal().show();
            $("#addRecordModal").on('shown.bs.modal', function () {
               $("#record-patient").val(patient);
               $("#record-patient-name").html(patientName);
            })

        });


        $("#btn-add-record").on('click',function(){
            var patient = $("#record-patient").val();
            var qty = $("#record-qty").val();
            var drug = $("#record-drug").val();

            var errorList = [];
            if(!drug){
                errorList.push('Please select a drug from the list');
            }
            if(isNaN(parseInt(patient)) || parseInt(patient) < 1){
                errorList.push('Please select a patient');
            }
            if(isNaN(parseInt(qty)) || parseInt(qty) < 1){
                errorList.push('Quantity should be greater than zero');
            }

            if(errorList.length){
                var errorMsg = '';
                for(var a=0; a < errorList.length; a++){
                    errorMsg += ('<li>'+errorList[a]+'</li>');
                }
                $("#record-response-msg").html(
                    '<div class="alert alert-dismissible alert-danger">'+
                    '<button type="button" class="close" data-dismiss="alert">×</button>'+
                    '<strong>Please check the following errors!</strong>'+
                    '<ul>'+
                    errorMsg +
                    '</ul>'+
                    '</div>'
                );
            }
            else{
                $.ajax({
                    url : './',
                    method : 'POST',
                    dataType : 'json',
                    data : {
                        patient : patient,
                        qty : qty,
                        drug : drug,
                        page : 'patient_drug'
                    },
                    success : function(data){
                        console.log(data);
                        if(data.status){
//                            $("#input-national-id").val('');
//                            $("#input-first-name").val('');
//                            $("#input-last-name").val('');
                            $("#success-msg").html(
                                '<div class="alert alert-dismissible alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                                '<strong>Drug record added successfully</strong>'+
                                '</div>'
                            );
                            $("#btn-close-record-modal").trigger('click');
                        }
                        else{
                            var errorMsg = '';
                            for(var prop in data.error){
                                if(data.error.hasOwnProperty(prop)){
                                    errorMsg += ('<li>'+data.error[a]+'</li>');
                                }
                            }
                            $("#record-response-msg").html(
                                '<div class="alert alert-dismissible alert-danger">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                                '<strong>'+data.message+'</strong>'+
                                '<ul>'+
                                errorMsg +
                                '</ul>'+
                                '</div>'
                            );
                        }


                    },
                    error : function(){

                    },
                    timeout : function(){

                    }
                });
            }
        });


        var selectInit = false;
        $('#addRecordModal').on('shown.bs.modal', function () {
//            window.setTimeout(function(){
//                if(!selectInit){
//                    $(".js-example-basic-single").select2();
//                    selectInit = true;
//                }
//            },1000);

        })

    });


    $(document).ready(function() {

    });

</script>

