<?php if($instanceCount == 1): ?>
    <script src="<?php echo e(asset('vendor/ckeditor/ckeditor.js')); ?>"></script>
<?php endif; ?>
<?php if($name): ?>
    <script>CKEDITOR.replace(<?php echo json_encode($name); ?>, <?php echo json_encode($config); ?>);</script>
<?php endif; ?>