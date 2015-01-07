<?php
/**
 * KanbanTaskHistory * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
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
 * This is the model class for table "ommu_kanban_task_history".
 *
 * The followings are the available columns in table 'ommu_kanban_task_history':
 * @property string $id
 * @property string $task_id
 * @property integer $move_from
 * @property integer $move_to
 * @property string $updated_date
 * @property string $updated_by
 */
class KanbanTaskHistory extends CActiveRecord
{
	public $defaultColumns = array();
	
	// Variable Search
	public $task_search;
	public $updated_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KanbanTaskHistory the static model class
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
		return 'ommu_kanban_task_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task_id, move_from, move_to, updated_by', 'required'),
			array('move_from, move_to', 'numerical', 'integerOnly'=>true),
			array('task_id, updated_by', 'length', 'max'=>11),
			array('updated_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, task_id, move_from, move_to, updated_date, updated_by,
				task_search, updated_search', 'safe', 'on'=>'search'),
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
			'updatedby' => array(self::BELONGS_TO, 'Users', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task_id' => 'Task',
			'move_from' => 'Move From',
			'move_to' => 'Move To',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'task_search' => 'Task',
			'updated_search' => 'Updated By',
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

		$criteria->compare('t.id',$this->id);
		if(isset($_GET['task'])) {
			$criteria->compare('t.task_id',$_GET['user']);
		} else {
			$criteria->compare('t.task_id',$this->task_id);
		}
		$criteria->compare('t.move_from',$this->move_from);
		$criteria->compare('t.move_to',$this->move_to);
		if($this->updated_date != null && !in_array($this->updated_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.updated_date)',date('Y-m-d', strtotime($this->updated_date)));
		$criteria->compare('t.updated_by',$this->updated_by,true);
		
		// Custom Search
		$criteria->with = array(
			'task' => array(
				'alias'=>'task',
				'select'=>'task_name'
			),
			'updatedby' => array(
				'alias'=>'updatedby',
				'select'=>'displayname'
			),
		);
		$criteria->compare('task.task_name',strtolower($this->task_search), true);
		$criteria->compare('updatedby.displayname',strtolower($this->updated_search), true);

		if(!isset($_GET['KanbanTaskHistory_sort']))
			$criteria->order = 'id DESC';

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
			//$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'task_id';
			$this->defaultColumns[] = 'move_from';
			$this->defaultColumns[] = 'move_to';
			$this->defaultColumns[] = 'updated_date';
			$this->defaultColumns[] = 'updated_by';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'task_search',
				'value' => '$data->task->task_name',
			);
			$this->defaultColumns[] = 'move_from';
			$this->defaultColumns[] = 'move_to';
			$this->defaultColumns[] = array(
				'name' => 'updated_date',
				'value' => 'Utility::dateFormat($data->updated_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this, 
					'attribute'=>'updated_date', 
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'updated_date_filter',
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
				'name' => 'updated_search',
				'value' => '$data->updatedby->displayname',
			);

		}
		parent::afterConstruct();
	}
}