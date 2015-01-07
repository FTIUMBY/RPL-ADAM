<?php
/**
 * @var $this ContentmenuController
 * @var $model OmmuContentMenu
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('menu_id'); ?><br/>
			<?php echo $form->textField($model,'menu_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('module'); ?><br/>
			<?php echo $form->textField($model,'module',array('maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('controller'); ?><br/>
			<?php echo $form->textField($model,'controller',array('maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('action'); ?><br/>
			<?php echo $form->textField($model,'action',array('maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('enabled'); ?><br/>
			<?php echo $form->textField($model,'enabled'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('orders'); ?><br/>
			<?php echo $form->textField($model,'orders'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('name'); ?><br/>
			<?php echo $form->textField($model,'name',array('maxlength'=>32)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('icon'); ?><br/>
			<?php echo $form->textField($model,'icon',array('maxlength'=>16)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('class'); ?><br/>
			<?php echo $form->textField($model,'class',array('maxlength'=>16)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('url'); ?><br/>
			<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>128)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('dialog'); ?><br/>
			<?php echo $form->textField($model,'dialog'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('attr'); ?><br/>
			<?php echo $form->textField($model,'attr',array('size'=>60,'maxlength'=>128)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>
