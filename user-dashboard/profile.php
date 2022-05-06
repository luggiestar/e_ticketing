<?php $title = "User-Profile" ?>

<?php include('includes/sidebar.php'); ?>

<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #0db3d7;
    background-color: #0000;
    border-color: #0c155000 #dddfeb00 #0db3d7;
}
</style>

<div class="main_container">
    <?php include('includes/messages.php') ?>
    <?php if($wallet_rows == 1): ?>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#changepassword" role="tab" aria-controls="changepassword" aria-selected="false">Change Password</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- profile tab-pane is active panel -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row justify-content-center">
                    <div class="col-xl-10 pb-3">
                        <div class="card">
                            <div class="card-body">
                                <center><img class="img-profile rounded-circle" src="../assets/img/tz_logo.png"></center>
                                
                                <table class="table mt-2">
                                    <tr>
                                        <th>First Name</th>
                                        <td><?php echo $user_profile['fname'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td><?php echo $user_profile['lname'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sex</th>
                                        <td><?php echo $user_profile['sex'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone Number</th>
                                        <td><?php echo $user_profile['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo $user_profile['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Region</th>
                                        <td><?php echo $user_profile['region'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>District</th>
                                        <td><?php echo $user_profile['district'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>Role</th>
                                        <td><?php echo $user_profile['type'] ?></td>
                                    </tr>
                                </table>
                                <a href="edit-profile.php" class="btn btn-sm btn-info">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="changepassword" role="tabpanel" aria-labelledby="changepassword-tab">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-md-5 mt-4">
                        <div class="form">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="oldpassword">Old Password</label>
                                    <input type="text" name="oldpassword" placeholder="Enter Old Password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword">New Password</label>
                                    <input type="text" id="newpassword" name="newpassword" placeholder="Enter New Password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirmpassword">Confirm Password</label>
                                    <input type="text" id="confirmpassword" name="confirmpassword" placeholder="Re-Enter new Password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif?>
</div>
<?php include('includes/footer.php'); ?>
<script>
$(document).ready(function(){
    $("#myTab a").click(function(e){
        e.preventDefault();
        $(this).tab("show");
    });
});
</script>

