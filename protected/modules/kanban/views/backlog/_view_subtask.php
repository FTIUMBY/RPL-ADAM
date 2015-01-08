<?php
/**
 * Kanban Task Subs (kanban-task-sub)
 * @var $this KanbanTaskSubController * @var $data KanbanTaskSub *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="sep">
	<?php echo CHtml::encode($data->done_status).' / '; ?>
	<?php echo CHtml::encode($data->subtask_name); ?>
</div>