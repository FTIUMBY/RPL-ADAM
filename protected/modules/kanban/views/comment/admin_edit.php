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
		$model->comment_id=>array('view','id'=>$model->comment_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>