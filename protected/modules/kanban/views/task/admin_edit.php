<?php
/**
 * Kanban Tasks (kanban-tasks)
 * @var $this TaskController * @var $model KanbanTasks *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Kanban Tasks'=>array('manage'),
		$model->task_id=>array('view','id'=>$model->task_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>