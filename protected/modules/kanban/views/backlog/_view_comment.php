<?php
/**
 * Kanban Task Comments (kanban-task-comment)
 * @var $this KanbanTaskCommentController * @var $data KanbanTaskComment *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="sep">	
	<?php echo CHtml::encode($data->comment).' / '; ?>
	<?php echo $data->user->displayname.' / '; ?>
	<?php echo CHtml::encode($data->creation_date); ?>
</div>