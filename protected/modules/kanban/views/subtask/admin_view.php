<?php
/**
 * Kanban Task Subs (kanban-task-sub)
 * @var $this SubtaskController * @var $model KanbanTaskSub *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

$this->breadcrumbs=array(
	'Kanban Task Subs'=>array('manage'),
	$model->subtask_id,
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
		'subtask_id',
		'done_status',
		'task_id',
		'user_id',
		'subtask_name',
		'action_date',
		'action_by',
		'creation_date',
	),
)); ?>

<div class="dialog-submit">
	<input id="closed" name="yt0" type="button" value="Cancel" /></div>
