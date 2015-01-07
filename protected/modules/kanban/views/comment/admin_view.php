<?php
/**
 * Kanban Task Comments (kanban-task-comment)
 * @var $this CommentController * @var $model KanbanTaskComment *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

$this->breadcrumbs=array(
	'Kanban Task Comments'=>array('manage'),
	$model->comment_id,
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
		'comment_id',
		'publish',
		'task_id',
		'user_id',
		'comment',
		'creation_date',
	),
)); ?>

<div class="dialog-submit">
	<input id="closed" name="yt0" type="button" value="Cancel" /></div>
