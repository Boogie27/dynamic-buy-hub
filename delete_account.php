

                <div class="deleteAccount-section">
                    <div class="form-container">
                        <div class="signup-header">
                            <h2>Account Delete</h2>
                            <i class="fas fa-times" id="closeDeleteAccount"></i>
                            <div class="signupFormError"></div>
                        </div>
                        <form action="delete_account.php" method="post" class="deleteAccountForm">
                            <div class="form-group">
                                <label for="passowrd">Password <b class="text-danger">*</b> </label>
                                <input type="password" class="form-control" id="deletePassword" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn deleteAction" id="deleteButton">Delete Account</button><br><br>
                            </div>
                        </form>
                    </div>
                </div>