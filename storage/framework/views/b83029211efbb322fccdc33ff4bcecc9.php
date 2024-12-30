<ul class="nav flex-column">
    <?php if(Auth::user()->role == 'admin' ): ?>
    <li class="nav-item">
        <a href="<?php echo e(route('books.index')); ?>">Books</a>                               
    </li>
    
    <?php endif; ?>
    
    <li class="nav-item">
        <a href="<?php echo e(route('account.profile')); ?>">Profile</a>                               
    </li>
    
    <li class="nav-item">
        <a href="change-password.html">Change Password</a>
    </li> 
    <li class="nav-item">
        <a href="<?php echo e(route('account.logout')); ?>">Logout</a>
    </li>                           
</ul><?php /**PATH C:\xampp\htdocs\book-review-app\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>