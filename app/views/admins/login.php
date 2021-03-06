<?php require_once APPROOT.'/views/inc/header.php'; ?>
<?php require_once APPROOT.'/views/inc/navbar.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Login</h2>
            <p>Please enter your credentials to login</p>
            <form action="<?php echo URLROOT; ?>admins/login" method="post">
                <div class='form-group'>
                <label for="email">Email: <sup>*</sup></label>
                <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' :''; ?>" value="<?php echo $data['email'] ?>">
                <span class="invalid-feedback"><?php echo $data['email_err'] ?></span>
                </div> 
                <div class='form-group'>
                <label for="password">Password: <sup>*</sup></label>
                <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' :''; ?>" value="<?php echo $data['password'] ?>">
                <span class="invalid-feedback"><?php echo $data['password_err'] ?></span>
                </div> 
               
                <div class="row">
                    <div class="d-grid gap-2 col-6 my-5 mx-auto">
                        <input type="submit" value='Login' class='btn btn-success btn-block'>
                        <small class='text-muted text-center'>Don't have an account? </small>
                        <a class="btn btn-dark btn-block" href="<?php echo URLROOT; ?>users/register" >Register</a>
                        
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<?php require_once APPROOT.'/views/inc/footer.php'; ?>
