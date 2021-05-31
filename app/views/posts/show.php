<?php require_once APPROOT.'/views/inc/header.php'; ?>
<?php require_once APPROOT.'/views/inc/navbar.php'; ?>
<a href="<?php echo URLROOT; ?>posts" class="btn btn-light"> <i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-2">written by <?php echo $data['user']->name.' on '.$data['post']->created_at ?> </div>
<p><?php echo $data['post']->body ?></p>
<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
    <hr>
    <a href="<?php echo URLROOT; ?>posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>
    <form class="float-end" action="<?php echo URLROOT.'posts/delete/'.$data['post']->id[0]; ?>" method="post">
    <input type="submit" class="btn btn-danger" value="delete">
    </form>
<?php endif; ?>
<?php require_once APPROOT.'/views/inc/footer.php'; ?>