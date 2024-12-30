<?php $__env->startSection('main'); ?>
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header  text-white">
                    Welcome, <?php echo e(Auth::user()->name); ?>                       
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <?php if(Auth::user()->image != " "): ?>
                            <img src="<?php echo e(asset('uploads/profile/'.Auth::user()->image)); ?>" class="img-fluid rounded-circle" alt="Luna John">
                        <?php endif; ?>
                                                    
                    </div>
                    <div class="h5 text-center">
                        <strong><?php echo e(Auth::user()->name); ?> </strong>
                        <p class="h6 mt-2 text-muted">5 Reviews</p>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header  text-white">
                    Navigation
                </div>
                <div class="card-body sidebar">
                    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php echo $__env->make('layouts.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Books
                </div>
                <div class="card-body pb-0">
                    <div class = "d-flex justify-content-between">
                        <a href="<?php echo e(route('books.create')); ?>" class="btn btn-primary">Add Book</a>
                        
                            <form action="" method = "GET">
                                <div class= "d-flex">
                                <input type="text" class= "form-control" value = "<?php echo e(Request::get('keyword')); ?>" name = "keyword" placeholder="Keyword">
                                <button type="submit" class= "btn btn-primary ms-2">Search</button>
                                <a href="<?php echo e(route('books.index')); ?>" class= "btn btn-secondary ms-2">Clear</a>
                                </div>
                            </form>
                        
                    </div>            
                       

                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th width="150">Action</th>
                            </tr>
                            <tbody>
                                <?php if($books -> isNotEmpty()): ?>
                                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($book -> title); ?></td>
                                        <td><?php echo e($book -> author); ?></td>
                                        <td>3.0 (3 Reviews)</td>
                                        <td>
                                            <?php if($book -> status == 1): ?>
                                            <span class = "text-success">Active</span>
                                            <?php else: ?>
                                            <span class = "text-danger">Block</span>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                            <a href="<?php echo e(route('books.edit', $book->id)); ?>" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="#" onclick="deleteBook(<?php echo e($book ->id); ?>);"  class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
       
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="5">
                                            Books not found
                                        </td>
                                    </tr>   
                                <?php endif; ?>
                         </tbody>
                        </thead>
                    </table> 
                    <?php if($books -> isNotEmpty()): ?>  
                        <?php echo e($books -> links()); ?>

                    <?php endif; ?>
                </div>
                
            </div>                
        </div>
    </div>             
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    function deleteBook(id){
        if(confirm("Are You sure you want to delete?")){
            $.ajax({
                url:' <?php echo e(route("books.destroy")); ?>',
                type: 'delete',
                data: {id: id},
                headers:{
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                success: function(response){
                    window.location.href = '<?php echo e(route("books.index")); ?>';
                }
            });
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\book-review-app\resources\views/books/list.blade.php ENDPATH**/ ?>