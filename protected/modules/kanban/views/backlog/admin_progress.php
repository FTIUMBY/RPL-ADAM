<?php
/**
 * Kanban Task Categories (kanban-task-category)
 * @var $this CategoryController * @var $model KanbanTaskCategory *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<div id="partial-kanban-task-category">
	<?php //begin.Messages ?>
	<div id="ajax-message">
	<?php
		if(Yii::app()->user->hasFlash('error'))
			echo Utility::flashError(Yii::app()->user->getFlash('error'));
		if(Yii::app()->user->hasFlash('success'))
			echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
	?>
	</div>
	<?php //begin.Messages ?>

	<div class="boxed">
		<?php //begin.Grid Item ?>
		<?php $this->widget('application.components.system.OGridView', array(
			'id'=>'kanban-task-category-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns' => array(
				array(
					'header' => 'No',
					'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
				),
				array(
					'name'=>'title',
					'value'=>'$data->title',
				),
				array(
					'name'=>'client_id',
					'value'=>'$data->client->client_name',
				),
				array(
					'header'=>'Team',
					'value'=>'implode(", ", ProjectTeam::getTeam($data->project_id, "array"))',
					'type'=>'raw',
				),
				array(
					'name'=>'start_date',
					'value'=>'$data->start_date',
					'htmlOptions' => array(
						'class' => 'center',
					),
				),
				array(
					'name'=>'finish_date',
					'value'=>'$data->finish_date != "0000-00-00" ? $data->finish_date : "-"',
					'htmlOptions' => array(
						'class' => 'center',
					),
				),
				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'buttons' => array(
						'view' => array(
							'label' => 'view',
							'options' => array(							
								'class' => 'view',
								'title' => 'View Board',
							),
							'url' => 'Yii::app()->controller->createUrl("board",array("pid"=>$data->primaryKey))',
						),
						'add' => array(
							'label' => 'add',
							'options' => array(							
								'class' => 'add',
								'title' => 'Add Task',
							),
							'url' => 'Yii::app()->controller->createUrl("add",array("pid"=>$data->primaryKey))',
						),
					),
					'template' => '{view}|{add}',
				),
			),
			'pager' => array('header' => ''),
		));?>
		<?php //end.Grid Item ?>
	</div>
</div>