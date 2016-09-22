<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="text-left">Drugs</h3>
                    <?php if(isset($drugQuery)): ?>
                        <p class="text-left">
                            <small class="text-left text-info">Showing results for : <?php echo $drugQuery ?></small>
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
                                        <input type="text" name="q" class="form-control" placeholder="Enter drug to search" />
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Search</button>
                                    </span>
                                    </div>
                                </div>
                                <input type="hidden" name="page" value="drug" />
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group pull-right">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addDrugModal"><i class="fa fa-plus"></i> Add drug</button>
                            </div>
                            <div class="form-group hidden-lg hidden-md hidden-sm">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addDrugModal"><i class="fa fa-plus"></i> Add drug</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Code</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        foreach($drugs as $drug){
                            ?>
                            <tr>
                                <td><?php echo ($i+1)."." ?></td>
                                <td><?php echo $drug->getName() ?></td>
                                <td><?php echo $drug->getCode() ?></td>
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
<div class="modal fade" id="addDrugModal" tabindex="-1" role="dialog" aria-labelledby="addDrugModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Add new drug</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="response-msg"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Name*</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-drug-name" type="text" placeholder="Enter drug name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Code</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-drug-code" type="text" placeholder="Enter drug code" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-modal" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn-add-drug" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $("#btn-add-drug").on('click',function(){
            var drugName = $("#input-drug-name").val();
            var drugCode = $("#input-drug-code").val();

            var errorList = [];
            if(!drugName){
                errorList.push('Drug name is mandatory');
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
                        name : drugName,
                        code : drugCode,
                        page : 'drug'
                    },
                    success : function(data){
                        console.log(data);
                        if(data.status){
                            $("#success-msg").html(
                                '<div class="alert alert-dismissible alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                                '<strong>Drug added successfully</strong>'+
                                '</div>'
                            );
                            var prevCount =  parseInt($("table > tbody > tr").last().children("td").first().html());
                            var rowHtml = '<tr>'+
                                '<td>'+((isNaN(prevCount)) ? 1 : (prevCount+1))+'</td>'+
                                '<td>'+drugName +'</td>'+
                                '<td>'+drugCode +'</td>'+
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
            $("#input-drug-name").val('');
            $("#input-first-code").val('');
        });
    });


</script>