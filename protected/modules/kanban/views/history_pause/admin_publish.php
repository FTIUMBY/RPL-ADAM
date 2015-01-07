<?php
/**
 * Kanban Task History Pauses (kanban-task-history-pause)
 * @var $this HistorypauseController * @var $model KanbanTaskHistoryPause * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Kanban Task History Pauses'=>array('manage'),
		'Publish',
	);
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'kanban-task-history-pause-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

	<div class="dialog-content">
		<?php echo $model->publish == 1 ? 'Are you sure you want to unpublish this item?' : 'Are you sure you want to publish this item?'?>
		<?php //echo $model->actived == 1 ? 'Are you sure you want to deactived this item?' : 'Are you sure you want to actived this item?'?>
		<?php //echo $model->enabled == 1 ? 'Are you sure you want to disabled this item?' : 'Are you sure you want to enabled this item?'?>
		<?php //echo $model->status == 1 ? 'Are you sure you want to unresolved this item?' : 'Are you sure you want to resolved this item?'?>
	</div>
	<div class="dialog-submit">
		<?php echo CHtml::submitButton($title, array('onclick' => 'setEnableSave()')); ?>
		<?php echo CHtml::button('Cancel', array('id'=>'closed')); ?>
	</div>
	
<?php $this->endWidget(); ?>
