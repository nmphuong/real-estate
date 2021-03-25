

<div class="message-wrapper">
    <ul class="messages">
        
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($message == null): ?>
                <p>NULL</p>
            <?php else: ?>
                <li class="message clearfix">
                    
                    <div class="<?php echo e(($message->from == 1) ? 'sent' : 'received'); ?>">
                        <p><?php echo e($message->message); ?></p>
                        <p class="date"><?php echo e(date('d M y, h:i a', strtotime($message->created_at))); ?></p>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </ul>
</div>

<div class="input-text">
    <input type="text" name="message" class="submit">
</div><?php /**PATH /home/arqyxqvohosting/public_html/nhadatchinhchu.billionaire-land.net/resources/views/Admin/Chat/indexchat.blade.php ENDPATH**/ ?>