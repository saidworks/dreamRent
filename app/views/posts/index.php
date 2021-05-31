<?php require_once APPROOT.'/views/inc/header.php'; ?>
<?php require_once APPROOT.'/views/inc/navbar.php'; ?>
<?php flash('post_message'); ?>
<div class="row">
    <div class="col-md-6">
    <h1> Posts </h1>
    </div>
    <div class="col-md-6">
    <a href="<?php echo URLROOT; ?>posts/add" class="btn btn-primary mt-1 float-end"><i class="fa fa-pencil"></i> Add Post
    </a>
    </div>
</div>
<?php foreach($data["posts"] as $post) : ?>
    <div class="card card-body mb-4">
        <h4 class="card-title"> <?php echo $post->title ?></h4>
        <div class="bg-light p-2 mb3">
        written by <?php echo $post->name.' on '.$post->postDate; ?>
        </div>
        <p class="card-text"><?php echo $post->body ?></p>
        <!-- query string send an array need to check out why -->
        <a href="<?php echo URLROOT; ?>posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">MORE</a>
    </div>
<?php endforeach; ?>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>