<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0">
            <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 hidden-xs">

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            <?php
                                if($error):
                            ?>

                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Error!</strong> <?php echo $error ?>
                            </div>

                            <?php
                                endif;
                            ?>

                            <form name="login" action="./?page=session" method="post">
                                <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="text-left">Login</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Username</label>
                                        <div class="form-group form-group-sm">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group input-group-addon"><i class="fa fa-user"></i> </span>
                                                <input type="text" placeholder="Enter your username" id="username" name="username" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Password</label>
                                        <div class="form-group form-group-sm">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group input-group-addon"><i class="fa fa-key"></i> </span>
                                                <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                <button type="submit" class="btn btn-sm btn-block btn-success"><i class="fa fa-tick"></i> Login</button>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                                <div class="row hidden-lg hidden-md hidden-sm"></div>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                <button type="reset" class="btn btn-sm btn-block btn-danger"><i class="fa fa-reload"></i> Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                </div>
            </div>
        </div>
    </div>
</div>