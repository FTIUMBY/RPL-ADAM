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
		$model->pause_id=>array('view','id'=>$model->pause_id),
		'Update',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/history_pause/_form', array('model'=>$model)); ?>
</div>
