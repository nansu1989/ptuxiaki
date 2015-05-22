<!-- log-in window start -->
        <div class="modal container fade" id="log-in" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="form-horizonal" action="proc_log_in.php" method="post" id="login_form">
                        
                        <div class="modal-header" style="background-color:#222222; color:#fff;">
                            <button style="color:#fff;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div> <h4>Log In</h4> </div>
                        </div>                    
                        <div class="modal-body">
                            <div class="alert alert-danger" id="error_log_in" role="alert">You can not log In...</div>
                            <div class="form-group">
                                <div class="cl-lg-10">
                                    <input id="login_input_email" class="form-control" type="email" placeholder="e-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="login_input_email" required maxlength="40" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="cl-lg-8">
                                    <input id="login_input_password" class="form-control" type="password" placeholder="Password" name="user_password" autocomplete="off" maxlength="30" required />
                                </div>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button class="btn btn-md btn-warning" type="submit" form="login_form" id="login_button"> Log In </button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
        <!-- log-in window end -->