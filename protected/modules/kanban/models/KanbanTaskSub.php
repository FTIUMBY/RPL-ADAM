<?php
/**
 * KanbanTaskSub * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "ommu_kanban_task_sub".
 *
 * The followings are the available columns in table 'ommu_kanban_task_sub':
 * @property string $subtask_id
 * @property integer $done_status
 * @property string $task_id
 * @property string $user_id
 * @property string $subtask_name
 * @property string $action_date
 * @property string $action_by
 * @property string $creation_date
 */
class KanbanTaskSub extends CActiveRecord
{
	public $defaultColumns = array();
	
	// Variable Search
	public $task_search;
	public $user_search;
	public $action_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KanbanTaskSub the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ommu_kanban_task_sub';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task_id, subtask_name', 'required'),
			array('done_status', 'numerical', 'integerOnly'=>true),
			array('task_id, user_id, action_by', 'length', 'max'=>11),
			array('user_id, action_by, action_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('subtask_id, done_status, task_id, user_id, subtask_name, action_date, action_by, creation_date,
				task_search, user_search, action_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'task' => array(self::BELONGS_TO, 'KanbanTasks', 'task_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'actionby' => array(self::BELONGS_TO, 'Users', 'action_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'subtask_id' => 'Subtask',
			'done_status' => 'Done Status',
			'task_id' => 'Task',
			'user_id' => 'User',
			'subtask_name' => 'Subtask Name',
			'action_date' => 'Action Date',
			'action_by' => 'Action By',
			'creation_date' => 'Creation Date',
			'task_search' => 'Task',
			'user_search' => 'User',
			'action_search' => 'Action By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.subtask_id',$this->subtask_id);
		$criteria->compare('t.done_status',$this->done_status);
		if(isset($_GET['task'])) {
			$criteria->compare('t.task_id',$_GET['task']);
		} else {
			$criteria->compare('t.task_id',$this->task_id);
		}
		if(isset($_GET['user'])) {
			$criteria->compare('t.user_id',$_GET['user']);
		} else {
			$criteria->compare('t.user_id',$this->user_id);
		}
		$criteria->compare('t.subtask_name',$this->subtask_name,true);
		if($this->action_date != null && !in_array($this->action_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.action_date)',date('Y-m-d', strtotime($this->action_date)));
		if(isset($_GET['actionby'])) {
			$criteria->compare('t.action_by',$_GET['actionby']);
		} else {
			$criteria->compare('t.action_by',$this->action_by);
		}
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		
		// Custom Search
		$criteria->with = array(
			'task' => array(
				'alias'=>'task',
				'select'=>'task_name'
			),
			'user' => array(
				'alias'=>'user',
				'select'=>'displayname'
			),
			'actionby' => array(
				'alias'=>'actionby',
				'select'=>'displayname'
			),
		);
		$criteria->compare('task.task_name',strtolower($this->task_search), true);
		$criteria->compare('user.displayname',strtolower($this->user_search), true);
		$criteria->compare('actionby.displayname',strtolower($this->action_search), true);

		if(!isset($_GET['KanbanTaskSub_sort']))
			$criteria->order = 'subtask_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
			),
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		}else {
			//$this->defaultColumns[] = 'subtask_id';
			$this->defaultColumns[] = 'done_status';
			$this->defaultColumns[] = 'task_id';
			$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'subtask_name';
			$this->defaultColumns[] = 'action_date';
			$this->defaultColumns[] = 'action_by';
			$this->defaultColumns[] = 'creation_date';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			/*
			$this->defaultColumns[] = array(
				'class' => 'CCheckBoxColumn',
				'name' => 'id',
				'selectableRows' => 2,
				'checkBoxHtmlOptions' => array('name' => 'trash_id[]')
			);
			*/
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'task_search',
				'value' => '$data->task->task_name',
			);
			$this->defaultColumns[] = 'subtask_name';
			$this->defaultColumns[] = array(
				'name' => 'user_search',
				'value' => '$data->user->displayname',
			);
			$this->defaultColumns[] = array(
				'name' => 'action_date',
				'value' => 'Utility::dateFormat($data->action_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this, 
					'attribute'=>'action_date', 
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'action_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = array(
				'name' => 'action_search',
				'value' => '$data->actionby->displayname',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_date',
				'value' => 'Utility::dateFormat($data->creation_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this, 
					'attribute'=>'creation_date', 
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'creation_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'done_status',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("status",array("id"=>$data->subtask_id)), $data->done_status, 5)',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'filter'=>array(
						1=>'Yes',
						0=>'No',
					),
					'type' => 'raw',
				);
			}

		}
		parent::afterConstruct();
	}

	/**
	 * before validate attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {	
			$action = strtolower(Yii::app()->controller->action->id);
			if(!$this->isNewRecord) {
				if($action != 'edit')
					$this->action_by = Yii::app()->user->id;
			}
		}
		return true;
	}

}