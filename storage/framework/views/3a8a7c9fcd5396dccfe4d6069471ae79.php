<?php if(Session::has('success')): ?>
    <div class = "alert alert-success">
        <?php echo e((Session::get('success'))); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('error')): ?>
    <div class = "alert alert-danger">
        <?php echo e((Session::get('error'))); ?>

    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\book-review-app\resources\views/layouts/message.blade.php ENDPATH**/ ?>