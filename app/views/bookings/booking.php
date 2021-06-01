<?php require_once APPROOT.'/views/inc/header.php'; ?>
<?php require_once APPROOT.'/views/inc/navbar.php'; ?>
<a href="<?php echo URLROOT; ?>posts" class="btn btn-light"> <i class="fa fa-backward"></i> Back</a>
 
    <div class="card card-body bg-light mt-5">
        
        <h2>Book your car</h2>
        <p>You can create reserve your choosen car using this form</p>
        <form action="<?php echo URLROOT.'bookings/booking' ?>" method="post">
            <div class='form-group mb-3'>
            <label for="vehicleId">VehicleId: <sup>*</sup></label>
            <input type="number" name="vehicleId" class="form-control form-control-lg <?php echo (!empty($data['vehicleId_err'])) ? 'is-invalid' :''; ?>" value="<?php echo $data['vehicleId'][0] ?>">
            <span class="invalid-feedback"><?php echo $data['vehicleId_err'] ?></span>
            </div> 
            <div class='form-group mb-3'>
            <label for="description">Decription: <sup>*</sup></label>
            <input type="text" name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' :''; ?>" value="<?php echo $data['description'] ?>">
            <span class="invalid-feedback"><?php echo $data['description_err'] ?></span>
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
          
            <div class='form-group mb-3'>
            <label for="rate">Rental Rate: <sup>*</sup></label>
            <input type="number" name="rate" class="form-control form-control-lg <?php echo (!empty($data['rate_err'])) ? 'is-invalid' :''; ?>" value="<?php echo $data['rate'] ?>">
            <span class="invalid-feedback"><?php echo $data['rate_err'] ?></span>
            </div> 
            <div class='form-group mb-3'>
            <label for="dateOut">Date of pick up: <sup>*</sup></label>
            <input type="date" name="dateOut" value="<?php echo $data['dateOut'] ?>">
            </div>
            <div class='form-group mb-3'>
            <label for="dateReturned">Date of drop off: <sup>*</sup></label>
            <input type="date" name="dateReturned"  value="<?php echo $data['dateReturned'] ?>">
            </div> 
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="paymentMethod">Method of payment</label>
                </div>
                    <select name="paymentMethod" class="custom-select" id="inputGroupSelect01">
                        <option value="Cash" selected>Cash</option>
                        <option value="Card">Card</option>
                        <option value="Bank Wire">Bank wire</option>
                    </select>
            </div>
            
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>
  



<?php require_once APPROOT.'/views/inc/footer.php'; ?>
