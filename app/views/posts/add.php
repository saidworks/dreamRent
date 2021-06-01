<?php require_once APPROOT.'/views/inc/header.php'; ?>
<?php require_once APPROOT.'/views/inc/navbar.php'; ?>
<a href="<?php echo URLROOT; ?>posts" class="btn btn-light"> <i class="fa fa-backward"></i> Back</a>
 
    <div class="card card-body bg-light mt-5">
        <h2>Add Post</h2>
        <p>You can create a post with this form</p>
        <form action="<?php echo URLROOT; ?>posts/add" method="post">
            <div class='form-group'>
            <label for="description">Decription: <sup>*</sup></label>
            <input type="text" name="decription" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' :''; ?>" value="<?php echo $data['description'] ?>">
            <span class="invalid-feedback"><?php echo $data['title_err'] ?></span>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="categoryId">Category of the vehicle</label>
                </div>
                    <select name="categoryId" class="custom-select" id="inputGroupSelect01">
                        <option value="1" selected>Car</option>
                        <option value="2">Motocycle</option>
                        <option value="3">Minibus</option>
                    </select>
            </div> 
            <div class='form-group'>
            <label for="body">Body: <sup>*</sup></label>
            <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' :''; ?>"> <?php echo $data['body'] ?> </textarea>
            <span class="invalid-feedback"><?php echo $data['body_err'] ?></span>
            </div> 
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
  



<?php require_once APPROOT.'/views/inc/footer.php'; ?>
