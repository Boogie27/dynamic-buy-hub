                <div class="login-section">
                        <div class="form-container">
                            <div class="login-header">
                                <h2>Login</h2>
                                <i class="fas fa-times" id="closeLogin"></i>
                                <div class="signupFormError"></div>
                            </div>
                            <form action="login.php" method="post" class="loginForm">
                                <div class="form-group">
                                    <label for="email">Email <b class="text-danger">*</b> </label>
                                    <input type="text" class="form-control" id="logineMmail" required>
                                </div>
                                <div class="form-group">
                                    <label for="passowrd">Password <b class="text-danger">*</b> </label>
                                    <input type="password" class="form-control" id="loginPassowrd" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn loginAction">Login</button>
                                </div>
                                <div class="form-group social-container">
                                    <label for="or">Or Login with</label>
                                    <a href="#" class="social-icons"><img src="icons/facebook.svg" alt="facebook">Facebook</a>
                                    <a href="#" class="social-icons"><img src="icons/google.png" alt="google">Google</a>
                                </div>
                            </form>
                        </div>
                </div>