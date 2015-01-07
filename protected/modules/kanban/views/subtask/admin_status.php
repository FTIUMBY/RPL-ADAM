<?php
/**
 * Kanban Task Subs (kanban-task-sub)
 * @var $this SubtaskController * @var $model KanbanTaskSub * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

$this->breadcrumbs=array(
	'Kanban Task Subs'=>array('manage'),
	'Publish',
);
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'kanban-task-sub-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div class="dialog-content">
		<?php echo $model->done_status == 1 ? 'Are you sure you want to undone this item?' : 'Are you sure you want to done this item?'?>
	</div>
	<div class="dialog-submit">
		<?php echo CHtml::submitButton($title, array('onclick' => 'setEnableSave()')); ?>
		<?php echo CHtml::button('Cancel', array('id'=>'closed')); ?>
	</div>
	
<?php $this->endWidget(); ?>
