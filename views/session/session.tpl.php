<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-1 col-xs-offset-0">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Profile</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">Basic Information</a></li>
                                    <li class=""><a href="#password" data-toggle="tab" aria-expanded="false">Change Password</a></li>

                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade active in" id="profile">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="profile-response-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Username</label>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group input-group-addon"><i class="fa fa-lock"></i> </span>
                                                    <input type="text" id="username" disabled class="form-control" value="<?php echo $user->getUsername() ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>First Name</label>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group input-group-addon"><i class="fa fa-user"></i> </span>
                                                    <input type="text" id="first-name" placeholder="John" class="form-control" value="<?php echo $user->getFirstName() ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Last Name</label>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group input-group-addon"><i class="fa fa-user"></i> </span>
                                                    <input type="text" id="last-name" placeholder="Doe" class="form-control" value="<?php echo $user->getLastName() ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Access Rights</label>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group input-group-addon"><i class="fa fa-lock"></i> </span>
                                                    <select id="access" disabled class="form-control">
                                                        <option <?php ((string)$user->getAccess() == '0') ? 'selected' : '' ?> value="0">Read</option>
                                                        <option <?php ((string)$user->getAccess() == '1') ? 'selected' : '' ?> value="1">Read and Write</option>
                                                        <option <?php ((string)$user->getAccess() == '2') ? 'selected' : '' ?> value="2">Master</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-success" id="update-profile-btn"><i class="fa fa-tick"></i> Save</button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="password">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="password-response-msg"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Current Password</label>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group input-group-addon"><i class="fa fa-key"></i> </span>
                                                    <input type="password" id="input-password" placeholder="Type your current password" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>New password</label>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group input-group-addon"><i class="fa fa-key"></i> </span>
                                                    <input type="password" id="newpassword" placeholder="Type new password" class="form-control" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Reenter new password</label>
                                            <div class="form-group form-group-sm">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group input-group-addon"><i class="fa fa-key"></i> </span>
                                                    <input type="password" id="newrepassword" placeholder="Re type your new password" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-success" id="change-password-btn"><i class="fa fa-tick"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var accessRights = ['Read','Read and Write','Master'];
    $(document).ready(function(){

        $("#update-profile-btn").on('click',function(e){

            var firstName = $('#first-name').val();
            var lastName = $('#last-name').val();

            var errorList = [];

            if(!firstName){
                errorList.push('First name is mandatory');
            }

            if(errorList.length){
                var errorMsg = '';
                for(var a=0; a < errorList.length; a++){
                    errorMsg += ('<li>'+errorList[a]+'</li>');
                }
                $("#profile-response-msg").html(
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
                        firstName : firstName,
                        lastName : lastName,
                        page : 'profile_update'
                    },
                    success : function(data){
                        if(data.status){
                            $("#profile-response-msg").html(
                                '<div class="alert alert-dismissible alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                                '<strong>Profile updated successfully</strong>'+
                                '</div>'
                            );

                        }
                        else{
                            var errorMsg = '';
                            for(var prop in data.error){
                                if(data.error.hasOwnProperty(prop)){
                                    errorMsg += ('<li>'+data.error[prop]+'</li>');
                                }
                            }
                            $("#profile-response-msg").html(
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

        $("#change-password-btn").on('click',function(e){

            var password = $('#input-password').val();
            var newPassword = $('#newpassword').val();
            var newRepassword = $('#newrepassword').val();
            console.log(password);
            var errorList = [];

            if(!password){
                errorList.push('Current password is mandatory');
            }

            if(!newPassword){
                errorList.push('New password is mandatory');
            }

            if(newPassword !== newRepassword){
                errorList.push('New passwords does not match');
            }

            if(errorList.length > 0){
                var errorMsg = '';
                for(var a=0; a < errorList.length; a++){
                    errorMsg += ('<li>'+errorList[a]+'</li>');
                }
                $("#password-response-msg").html(
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
                        password : password,
                        newPassword : newPassword,
                        page : 'password_update'
                    },
                    success : function(data){
                        if(data.status){
                            $("#password-response-msg").html(
                                '<div class="alert alert-dismissible alert-success">'+
                                '<button type="button" class="close" data-dismiss="alert">×</button>'+
                                '<strong>Profile updated successfully</strong>'+
                                '</div>'
                            );

                            $('#input-password').val('');
                            $('#newpassword').val('');
                            $('#newrepassword').val('');
                        }
                        else{
                            var errorMsg = '';
                            for(var prop in data.error){
                                if(data.error.hasOwnProperty(prop)){
                                    errorMsg += ('<li>'+data.error[prop]+'</li>');
                                }
                            }
                            $("#password-response-msg").html(
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


    });



</script>