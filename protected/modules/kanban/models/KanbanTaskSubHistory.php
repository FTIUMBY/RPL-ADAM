<?php
/**
 * KanbanTaskSubHistory * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
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
 * This is the model class for table "ommu_kanban_task_sub_history".
 *
 * The followings are the available columns in table 'ommu_kanban_task_sub_history':
 * @property string $id
 * @property string $subtask_id
 * @property integer $done_status
 * @property string $action_date
 * @property string $action_by
 */
class KanbanTaskSubHistory extends CActiveRecord
{
	public $defaultColumns = array();
	
	// Variable Search
	public $subtask_search;
	public $user_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KanbanTaskSubHistory the static model class
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
		return 'ommu_kanban_task_sub_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subtask_id, done_status, action_by', 'required'),
			array('done_status', 'numerical', 'integerOnly'=>true),
			array('subtask_id, action_by', 'length', 'max'=>11),
			array('action_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subtask_id, done_status, action_date, action_by,
				subtask_search, user_search', 'safe', 'on'=>'search'),
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
			'subtask' => array(self::BELONGS_TO, 'KanbanTaskSub', 'subtask_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'action_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subtask_id' => 'Subtask',
			'done_status' => 'Done Status',
			'action_date' => 'Action Date',
			'action_by' => 'Action By',
			'subtask_search' => 'Subtask',
			'user_search' => 'Action By',
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
		if(isset($_GET['subtask'])) {
			$criteria->compare('t.subtask_id',$_GET['subtask']);
		} else {
			$criteria->compare('t.subtask_id',$this->subtask_id);
		}
		$criteria->compare('t.done_status',$this->done_status);
		if($this->action_date != null && !in_array($this->action_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.action_date)',date('Y-m-d', strtotime($this->action_date)));
		$criteria->compare('t.action_by',$this->action_by,true);
		
		// Custom Search
		$criteria->with = array(
			'subtask' => array(
				'alias'=>'subtask',
				'select'=>'subtask_name'
			),
			'user' => array(
				'alias'=>'user',
				'select'=>'displayname'
			),
		);
		$criteria->compare('subtask.subtask_name',strtolower($this->subtask_search), true);
		$criteria->compare('user.displayname',strtolower($this->user_search), true);

		if(!isset($_GET['KanbanTaskSubHistory_sort']))
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
			$this->defaultColumns[] = 'subtask_id';
			$this->defaultColumns[] = 'done_status';
			$this->defaultColumns[] = 'action_date';
			$this->defaultColumns[] = 'action_by';
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
				'name' => 'subtask_search',
				'value' => '$data->subtask->subtask_name',
			);
			$this->defaultColumns[] = array(
				'name' => 'done_status',
				'value' => '$data->done_status == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>'Yes',
					0=>'No',
				),
				'type' => 'raw',
			);
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

		}
		parent::afterConstruct();
	}

}