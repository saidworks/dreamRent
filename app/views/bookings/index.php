<?php require_once APPROOT.'/views/inc/header.php'; ?>
<?php require_once APPROOT.'/views/inc/navbar.php'; ?>
<?php flash('post_message'); ?>
<div class="row">
    <div class="col-md-6">
    <h1> Available Vehicles</h1>
    </div>
</div>
<?php foreach($data["posts"] as $post) : ?>
    <div class="card card-body mb-4">
        <h4 class="card-title"> <?php echo $post->description ?></h4>
        <div class="bg-light p-2 mb-3">
        <img class="img-fluid" src="<?php echo $post->picture ?>" alt="">    
        </div>
        <p class="card-text"><?php echo $post->rate ?></p>
        
        <!-- query string send an array need to check out why -->
        <a href="<?php echo URLROOT; ?>bookings/booking/<?php echo $post->vehicleId; ?>" class="btn btn-dark">Reserve</a>
    </div>
<?php endforeach; ?>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>