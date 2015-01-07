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
		$model->subtask_id=>array('view','id'=>$model->subtask_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>