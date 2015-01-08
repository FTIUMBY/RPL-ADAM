<?php
/**
 * Kanban Tasks (kanban-tasks)
 * @var $this TaskController * @var $model KanbanTasks * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'kanban-tasks-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<div class="dialog-content">

	<fieldset>

		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages ?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'project_id'); ?>
			<div class="desc">
				<?php if($model->isNewRecord) {?>
					<?php echo $form->textField($model,'project_id',array('maxlength'=>11)); ?>
				<?php } else {?>
					<strong><?php echo Projects::getInfo($model->project_id, 'title');?></strong>
					<?php echo $form->hiddenField($model,'project_id'); ?>				
				<?php }?>
				<?php echo $form->error($model,'project_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'task_name'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model,'cat_id', KanbanTaskCategory::getCategory(1)); ?>
				<?php echo $form->textArea($model,'task_name',array('maxlength'=>64, 'class'=>'span-10 smaller')); ?>
				<?php echo $form->error($model,'task_name'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'task_desc'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'task_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span-10 small')); ?>
				<?php echo $form->error($model,'task_desc'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'current_action'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'current_action',array('maxlength'=>64, 'class'=>'span-8')); ?>
				<?php echo $form->error($model,'current_action'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'user_id'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model,'user_id', ProjectTeam::getTeam($model->project_id, 'array')); ?>
				<?php echo $form->error($model,'user_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'priority'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'priority'); ?>
				<?php echo $form->error($model,'priority'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'due_date'); ?>
			<div class="desc">
				<?php 
				$model->due_date = !$model->isNewRecord ? ($model->due_date != '0000-00-00' ? $model->due_date = date('d-m-Y', strtotime($model->due_date)) : '') : '';
				//echo $form->textField($model,'due_date');
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'model'=>$model, 
					'attribute'=>'due_date',
					//'mode'=>'datetime',
					'options'=>array(
						'dateFormat' => 'dd-mm-yy',
					),
					'htmlOptions'=>array(
						'class' => 'span-4',
					 ),
				)); ?>
				<?php echo $form->error($model,'due_date'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'reschedule_date'); ?>
			<div class="desc">
				<?php 
				$model->reschedule_date = !$model->isNewRecord ? ($model->reschedule_date != '0000-00-00' ? $model->reschedule_date = date('d-m-Y', strtotime($model->reschedule_date)) : '') : '';
				//echo $form->textField($model,'reschedule_date');
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'model'=>$model, 
					'attribute'=>'reschedule_date',
					//'mode'=>'datetime',
					'options'=>array(
						'dateFormat' => 'dd-mm-yy',
					),
					'htmlOptions'=>array(
						'class' => 'span-4',
					 ),
				)); ?>
				<?php echo $form->error($model,'reschedule_date'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'overtime'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model,'overtime', array(
					0 => 'No',
					1 => 'Yes',
				)); ?>
				<?php 
				$model->overtime_date = !$model->isNewRecord ? ($model->overtime_date != '0000-00-00' ? $model->overtime_date = date('d-m-Y', strtotime($model->overtime_date)) : '') : '';
				//echo $form->textField($model,'overtime_date');
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'model'=>$model, 
					'attribute'=>'overtime_date',
					//'mode'=>'datetime',
					'options'=>array(
						'dateFormat' => 'dd-mm-yy',
					),
					'htmlOptions'=>array(
						'class' => 'span-4',
					 ),
				)); ?>
				<?php echo $form->error($model,'overtime_date'); ?>
			</div>
		</div>
		
		<?php if($model->isNewRecord) {
			$model->task_status = 0;
			echo $form->hiddenField($model,'task_status');
		} else {
			$model->old_task_status = $model->task_status;
			echo $form->hiddenField($model,'old_task_status');
		?>
			<div class="clearfix">
				<?php echo $form->labelEx($model,'task_status'); ?>
				<div class="desc">
					<?php echo $form->dropDownList($model,'task_status', KanbanTasks::getTaskStatus()); ?>
					<?php echo $form->error($model,'task_status'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
		<?php }?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'number'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'number'); ?>
				<?php echo $form->error($model,'number'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'publish'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'publish'); ?>
			<?php echo $form->labelEx($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button('Close', array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>
