<!-- log-in window start -->
        <div class="modal container fade" id="sigm-up" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="form-horizonal" action="proc_sign_up.php" method="post" id="signupn_form">
                        
                        <div class="modal-header" style="background-color:#222222; color:#fff;">
                            <button style="color:#fff;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <div> <h4>Sign up</h4> </div>
                        </div>                    
                        <div class="modal-body">
                            <div class="alert alert-danger" id="error_sign_up" role="alert">You can not sign up...</div>
                            <div class="form-group">
                                <div class="cl-lg-10">
                                    <input id="name" class="form-control" type="text" placeholder="Name" name="name" required maxlength="40" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="cl-lg-10">
                                    <input id="sirname" class="form-control" type="text" placeholder="Sirname" name="sirname" required maxlength="40" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="cl-lg-10">
                                    <input id="email" class="form-control" type="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" required maxlength="40" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="cl-lg-10">
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password" required maxlength="40" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="cl-lg-8">
                                    <input id="re_password" class="form-control" type="password" placeholder="Re-assword" name="re_password" autocomplete="off" maxlength="30" required />
                                </div>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button class="btn btn-md btn-warning" type="submit" form="signupn_form" id="signup_button"> Sign up </button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
        <!-- log-in window end -->