<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/json'); ?>
<?php echo json_encode($content); ?>
<?php $this->endContent(); ?>