

                <div class="signup-section">
                    <div class="form-container">
                        <div class="signup-header">
                            <h2>Create account</h2>
                            <i class="fas fa-times" id="closeSignup"></i>
                            <div class="signupFormError"></div>
                        </div>
                        <form action="signup.php" method="post" class="signupForm">
                            <div class="form-group">
                                <label for="name">Name <b class="text-danger">*</b> </label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <b class="text-danger">*</b> </label>
                                <input type="text" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="passowrd">Password <b class="text-danger">*</b> </label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password <b class="text-danger">*</b> </label>
                                <input type="password" class="form-control" id="confirm_password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn signUpAction" id="signupButton">Create Account</button>
                            </div>
                            <div class="form-group social-container">
                                <label for="">Or Login with</label>
                                <a href="#" class="social-icons"><img src="icons/facebook.svg" alt="facebook">Facebook</a>
                                <a href="#" class="social-icons"><img src="icons/google.png" alt="google">Google</a>
                            </div>
                        </form>
                    </div>
                </div>