<?php
/**
 * Kanban Task History Pauses (kanban-task-history-pause)
 * @var $this HistorypauseController * @var $model KanbanTaskHistoryPause *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Kanban Task History Pauses'=>array('manage'),
		$model->pause_id,
	);
?>

<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>

<?php $this->widget('application.components.system.FDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pause_id',
		'task_id',
		'pause_date',
		'pause_condition',
		'unpause_date',
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button('Close', array('id'=>'closed')); ?>
</div>
