                <div class="change-password-section">
                        <div class="form-container">
                            <div class="login-header">
                                <h2>Change Password</h2>
                                <i class="fas fa-times" id="closeChangePassword"></i>
                                <div class="signupFormError"></div>
                            </div>
                            <form action="change_password.php" method="post" id="changePasswordForm">
                                <div class="form-group">
                                    <label for="old-password">Old Password <b class="text-danger">*</b> </label>
                                    <input type="password" class="form-control" id="oldPassword" required>
                                </div>
                                <div class="form-group">
                                    <label for="new-password">New Password <b class="text-danger">*</b> </label>
                                    <input type="password" class="form-control" id="newPassword" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password <b class="text-danger">*</b> </label>
                                    <input type="password" id="confirmPassword" class="form-control"  required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn changePassword">Change Password</button>
                                </div>
                            </form>
                        </div>
                </div>

              