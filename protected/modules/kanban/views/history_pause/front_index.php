<?php
/**
 * Kanban Task History Pauses (kanban-task-history-pause)
 * @var $this HistorypauseController * @var $model KanbanTaskHistoryPause * @var $dataProvider CActiveDataProvider
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Kanban Task History Pauses',
	);
?>

<?php $this->widget('application.components.system.FListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/history_pause/_view',
	'pager' => array(
		'header' => '',
	), 
	'summaryText' => '',
	'itemsCssClass' => 'items clearfix',
	'pagerCssClass'=>'pager clearfix',
)); ?>
