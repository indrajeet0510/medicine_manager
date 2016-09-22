<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="text-left">Users</h3>
                    <?php if(isset($userQuery)): ?>
                        <p class="text-left">
                        <small class="text-left text-info">Showing results for : <?php echo $userQuery ?></small>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="success-msg">

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <form name="userSearchForm" method="get" action="./?">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control" placeholder="Enter user to search" />
                                    <span class="input-group-btn">
                                      <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Search</button>
                                    </span>
                                    </div>
                                </div>
                                <input type="hidden" name="page" value="user" />
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group pull-right">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-plus"></i> Add User</button>
                            </div>
                            <div class="form-group hidden-lg hidden-md hidden-sm">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-plus"></i> Add User</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Rights</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                foreach($users as $user){
                                    if($user->getId() == $loginUser->getId()){
                                        continue;
                                    }
                            ?>
                            <tr>
                                <td><?php echo ($i+1)."." ?></td>
                                <td><?php echo $user->getUsername() ?></td>
                                <td><?php echo $user->getFirstName()." ".$user->getLastName() ?></td>
                                <td><?php echo $permissionList[$user->getAccess()] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-info update-btn"
                                            data-access="<?php echo $user->getAccess()?>"
                                            data-username="<?php echo $user->getUsername()?>"
                                            data-id="<?php echo $user->getId() ?>"><i class="fa fa-edit"></i> Edit</button>
                                </td>
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


<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Add new user</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="response-msg"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Username*</label>
                            <br/>
                            <small>Should be unique</small>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-username" type="text" placeholder="Enter username" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>First Name</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-first-name" type="text" placeholder="Type first name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Last Name</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-last-name" type="text" placeholder="Type last name" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Access Right</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <select id="input-access" class="form-control">
                                        <option value="0">Read</option>
                                        <option value="1">Read and Write</option>
                                        <option value="2">Master</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Password</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-password" type="text" placeholder="Type password" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Retype Password</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" id="input-repassword" type="text" placeholder="Retype password" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-modal" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn-add-user" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="myModalLabel">Update user</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="update-response-msg"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Username*</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" data-id="0" id="update-username" disabled type="text" placeholder="Enter username" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Access Right</label>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <select id="update-access" class="form-control">
                                        <option value="0">Read</option>
                                        <option value="1">Read and Write</option>
                                        <option value="2">Master</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-update-modal" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-post-update-user">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var accessRights = ['Read','Read and Write','Master'];
    $(document).ready(function(){
        $("#btn-add-user").on('click',function(){
            var username = $("#input-username").val();
            var firstName = $("#input-first-name").val();
            var lastName = $("#input-last-name").val();
            var password = $("#input-password").val();
            var rePassword = $("#input-repassword").val();
            var access = $("#input-access").val();

            var errorList = [];
            if(!username){
                errorList.push('Username is mandatory');
            }
            if(!firstName){
                errorList.push('Firstname is mandatory');
            }

            if(!password){
                errorList.push('Password cannot be empty');
            }

            if(password !== rePassword){
                errorList.push('Password does not match');
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
                        username : username,
                        firstName : firstName,
                        lastName : lastName,
                        password : password,
                        access : access,
                        page : 'user'
                    },
                    success : function(data){
                        console.log(data);
                        if(data.status){
                            $("#success-msg").html(
                                '<div class="alert alert-dismissible alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                                '<strong>User added successfully</strong>'+
                                '</div>'
                            );
                            var prevCount =  parseInt($("table > tbody > tr").last().children("td").first().html());
                            var rowHtml = '<tr>'+
                                '<td>'+((isNaN(prevCount)) ? 1 : (prevCount+1))+'</td>'+
                                '<td>'+username +'</td>'+
                                '<td>'+firstName + ' '+ ((lastName) ? lastName : '') +'</td>'+
                                '<td>'+accessRights[parseInt(access)] +'</td>'+
                                '<td class="text-center">'+
                                '<button class="btn btn-xs btn-info update-btn" ' +
                                'data-username="'+ username +'" '
                                'data-access="'+ access +'" '
                                'data-id="'+data.id+'"><i class="fa fa-edit"></i> Edit</button>'+
                                '</td>'+
                                '</tr>';

                            $(rowHtml).appendTo("table > tbody");
                            $("#btn-close-modal").trigger('click');
                        }
                        else{
                            var errorMsg = '';
                            for(var prop in data.error){
                                if(data.error.hasOwnProperty(prop)){
                                    errorMsg += ('<li>'+data.error[prop]+'</li>');
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
            $("#input-username").val('');
            $("#input-first-name").val('');
            $("#input-last-name").val('');
            $("#input-password").val('');
            $("#input-repassword").val('');
            $("#input-access").val('0');
        });

        var updateTargetUser = null;

        $(".update-btn").on('click',function(e){
            var target = e.currentTarget;
            updateTargetUser = target;
            $("#updateUserModal").modal('show');
            var id = parseInt($(target).data('id'));
            var username = $(target).data('username');
            var access = $(target).data('access');

            $("#update-username").val(username);
            $("#update-username").data('id',id);
            $("#update-access").val(access);
        });

        $("#btn-post-update-user").on('click',function(e){
            var id = $("#update-username").data('id');
            var access = $("#update-username").data('access');

            $.ajax({
                url : './',
                method : 'POST',
                dataType : 'json',
                data : {
                    user : id,
                    access : (access) ? access.toString() : '0',
                    page : 'user_update'
                },
                success : function(data){
                    if(data.status){
                        $("#success-msg").html(
                            '<div class="alert alert-dismissible alert-success">'+
                            '<button type="button" class="close" data-dismiss="alert">×</button>'+
                            '<strong>User updated successfully</strong>'+
                            '</div>'
                        );

                        if(updateTargetUser){
                            $(updateTargetUser).parent().prev().html(accessRights[parseInt(access)]);
                        }

                        $("#btn-close-update-modal").trigger('click');
                    }
                    else{
                        var errorMsg = '';
                        for(var prop in data.error){
                            if(data.error.hasOwnProperty(prop)){
                                errorMsg += ('<li>'+data.error[prop]+'</li>');
                            }
                        }
                        $("#update-response-msg").html(
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

        });

    });



</script>