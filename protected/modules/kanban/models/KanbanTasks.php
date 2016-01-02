<?php
/**
 * KanbanTasks * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
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
 * This is the model class for table "ommu_kanban_tasks".
 *
 * The followings are the available columns in table 'ommu_kanban_tasks':
 * @property string $task_id
 * @property integer $publish
 * @property string $project_id
 * @property integer $cat_id
 * @property integer $division_id
 * @property string $user_id
 * @property integer $number
 * @property string $current_action
 * @property string $task_name
 * @property string $task_desc
 * @property integer $priority
 * @property string $due_date
 * @property string $reschedule_date
 * @property integer $overtime
 * @property string $overtime_date
 * @property integer $pause
 * @property string $pause_date
 * @property string $pause_condition
 * @property string $unpause_date
 * @property integer $task_status
 * @property string $progress_date
 * @property string $progress_by
 * @property string $done_date
 * @property string $done_by
 * @property string $tested_date
 * @property string $tested_by
 * @property integer $tested_status
 * @property integer $tested_verified
 * @property integer $subtask
 * @property integer $subtask_done
 * @property integer $comment
 * @property string $creation_date
 * @property string $creation_by
 * @property string $updated_date
 * @property string $updated_by
 */
class KanbanTasks extends CActiveRecord
{
	public $defaultColumns = array();
	public $old_task_status;
	
	// Variable Search
	public $project_search;
	public $user_search;
	public $progress_search;
	public $done_search;
	public $tested_search;
	public $creation_search;
	public $updated_search;		

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KanbanTasks the static model class
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
		return 'ommu_kanban_tasks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, current_action, task_name, task_desc, priority, due_date, overtime, task_status', 'required'),
			array('project_id, user_id', 'required'),			
			array('publish, cat_id, division_id, number, priority, overtime, pause, task_status, tested_status, tested_verified, subtask, subtask_done, comment', 'numerical', 'integerOnly'=>true),
			array('project_id, user_id, progress_by, done_by, tested_by, creation_by, updated_by', 'length', 'max'=>11),
			array('current_action, task_name', 'length', 'max'=>64),
			array('reschedule_date, overtime_date,
				pause_date, unpause_date, progress_date, done_date, tested_date, creation_date, updated_date,
				old_task_status', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('task_id, publish, project_id, cat_id, division_id, user_id, number, current_action, task_name, task_desc, priority, due_date, reschedule_date, overtime, overtime_date, pause, pause_date, pause_condition, unpause_date, task_status, progress_date, progress_by, done_date, done_by, tested_date, tested_by, tested_status, tested_verified, subtask, subtask_done, comment, creation_date, creation_by, updated_date, updated_by,
				project_search, user_search, progress_search, done_search, tested_search, creation_search, updated_search', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Projects', 'project_id'),
			'category' => array(self::BELONGS_TO, 'KanbanTaskCategory', 'cat_id'),
			'division' => array(self::BELONGS_TO, 'KanbanUserDivision', 'division_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'progressby' => array(self::BELONGS_TO, 'Users', 'progress_by'),
			'doneby' => array(self::BELONGS_TO, 'Users', 'done_by'),
			'testedby' => array(self::BELONGS_TO, 'Users', 'tested_by'),
			'creationby' => array(self::BELONGS_TO, 'Users', 'creation_by'),
			'updatedby' => array(self::BELONGS_TO, 'Users', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'task_id' => 'Task',
			'publish' => 'Publish',
			'project_id' => 'Project',
			'cat_id' => 'Cat',
			'division_id' => 'Division',
			'user_id' => 'User',
			'number' => 'Number',
			'current_action' => 'Current Action',
			'task_name' => 'Task Name',
			'task_desc' => 'Task Desc',
			'priority' => 'Priority',
			'due_date' => 'Due Date',
			'reschedule_date' => 'Reschedule Date',
			'overtime' => 'Overtime',
			'overtime_date' => 'Overtime Date',
            'pause' => 'Pause',
            'pause_date' => 'Pause Date',
            'pause_condition' => 'Pause Condition',
            'unpause_date' => 'Unpause Date',
			'task_status' => 'Task Status',
			'progress_date' => 'Progress Date',
			'progress_by' => 'Progress By',
			'done_date' => 'Done Date',
			'done_by' => 'Done By',
			'tested_date' => 'Tested Date',
			'tested_by' => 'Tested By',
			'tested_status' => 'Tested Status',
			'tested_verified' => 'Tested Verified',
			'subtask' => 'Subtask',
			'subtask_done' => 'Subtask Done',
			'comment' => 'Comment',
			'creation_date' => 'Creation Date',
			'creation_by' => 'Creation By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'project_search' => 'Project',
			'user_search' => 'User',
			'progress_search' => 'Progress By',
			'done_search' => 'Done By',
			'tested_search' => 'Tested By',
			'creation_search' => 'Creation By',
			'updated_search' => 'Updated By',
			'old_task_status' => 'Old Task Status',
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

		$criteria->compare('t.task_id',$this->task_id);
		if(isset($_GET['type']) && $_GET['type'] == 'publish') {
			$criteria->compare('t.publish',1);
		} elseif(isset($_GET['type']) && $_GET['type'] == 'unpublish') {
			$criteria->compare('t.publish',0);
		} elseif(isset($_GET['type']) && $_GET['type'] == 'trash') {
			$criteria->compare('t.publish',2);
		} else {
			$criteria->addInCondition('t.publish',array(0,1));
			$criteria->compare('t.publish',$this->publish);
		}
		if(isset($_GET['project'])) {
			$criteria->compare('t.project_id',$_GET['project']);
		} else {
			$criteria->compare('t.project_id',$this->project_id);
		}
		if(isset($_GET['cat'])) {
			$criteria->compare('t.cat_id',$_GET['cat']);
		} else {
			$criteria->compare('t.cat_id',$this->cat_id);
		}
		if(isset($_GET['division'])) {
			$criteria->compare('t.division_id',$_GET['division']);
		} else {
			$criteria->compare('t.division_id',$this->division_id);
		}
		if(isset($_GET['user'])) {
			$criteria->compare('t.user_id',$_GET['user']);
		} else {
			$criteria->compare('t.user_id',$this->user_id);
		}
		$criteria->compare('t.number',$this->number);
		$criteria->compare('t.current_action',$this->current_action,true);
		$criteria->compare('t.task_name',$this->task_name,true);
		$criteria->compare('t.task_desc',$this->task_desc,true);
		$criteria->compare('t.priority',$this->priority);
		if($this->due_date != null && !in_array($this->due_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.due_date)',date('Y-m-d', strtotime($this->due_date)));
		if($this->reschedule_date != null && !in_array($this->reschedule_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.reschedule_date)',date('Y-m-d', strtotime($this->reschedule_date)));
		$criteria->compare('t.overtime',$this->overtime);
		if($this->overtime_date != null && !in_array($this->overtime_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.overtime_date)',date('Y-m-d', strtotime($this->overtime_date)));
        $criteria->compare('t.pause',$this->pause);
        if($this->pause_date != null && !in_array($this->pause_date, array('0000-00-00 00:00:00', '0000-00-00')))
            $criteria->compare('date(t.pause_date)',date('Y-m-d', strtotime($this->pause_date)));
        $criteria->compare('t.pause_condition',$this->pause_condition,true);
        if($this->unpause_date != null && !in_array($this->unpause_date, array('0000-00-00 00:00:00', '0000-00-00')))
            $criteria->compare('date(t.unpause_date)',date('Y-m-d', strtotime($this->unpause_date)));
		$criteria->compare('t.task_status',$this->task_status);
		if($this->progress_date != null && !in_array($this->progress_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.progress_date)',date('Y-m-d', strtotime($this->progress_date)));
		$criteria->compare('t.progress_by',$this->progress_by,true);
		if($this->done_date != null && !in_array($this->done_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.done_date)',date('Y-m-d', strtotime($this->done_date)));
		$criteria->compare('t.done_by',$this->done_by,true);
		if($this->tested_date != null && !in_array($this->tested_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.tested_date)',date('Y-m-d', strtotime($this->tested_date)));
		$criteria->compare('t.tested_by',$this->tested_by,true);
		$criteria->compare('t.tested_status',$this->tested_status);
		$criteria->compare('t.tested_verified',$this->tested_verified);
		$criteria->compare('t.subtask',$this->subtask);
		$criteria->compare('t.subtask_done',$this->subtask_done);
		$criteria->compare('t.comment',$this->comment);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		$criteria->compare('t.creation_by',$this->creation_by,true);
		if($this->updated_date != null && !in_array($this->updated_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.updated_date)',date('Y-m-d', strtotime($this->updated_date)));
		$criteria->compare('t.updated_by',$this->updated_by,true);
		
		// Custom Search
		$criteria->with = array(
			'project' => array(
				'alias'=>'project',
				'select'=>'title'
			),
			'user' => array(
				'alias'=>'user',
				'select'=>'displayname'
			),
			'progressby' => array(
				'alias'=>'progressby',
				'select'=>'displayname'
			),
			'doneby' => array(
				'alias'=>'doneby',
				'select'=>'displayname'
			),
			'testedby' => array(
				'alias'=>'testedby',
				'select'=>'displayname'
			),
			'creationby' => array(
				'alias'=>'creationby',
				'select'=>'displayname'
			),
			'updatedby' => array(
				'alias'=>'updatedby',
				'select'=>'displayname'
			),
		);
		$criteria->compare('project.title',strtolower($this->project_search), true);		
		$criteria->compare('user.displayname',strtolower($this->user_search), true);
		$criteria->compare('progressby.displayname',strtolower($this->progress_search), true);
		$criteria->compare('doneby.displayname',strtolower($this->done_search), true);
		$criteria->compare('testedby.displayname',strtolower($this->tested_search), true);
		$criteria->compare('creationby.displayname',strtolower($this->creation_search), true);
		$criteria->compare('updatedby.displayname',strtolower($this->updated_search), true);

		if(!isset($_GET['KanbanTasks_sort']))
			$criteria->order = 'task_id DESC';

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
			//$this->defaultColumns[] = 'task_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'project_id';
			$this->defaultColumns[] = 'cat_id';
			$this->defaultColumns[] = 'division_id';
			$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'number';
			$this->defaultColumns[] = 'current_action';
			$this->defaultColumns[] = 'task_name';
			$this->defaultColumns[] = 'task_desc';
			$this->defaultColumns[] = 'priority';
			$this->defaultColumns[] = 'due_date';
			$this->defaultColumns[] = 'reschedule_date';
			$this->defaultColumns[] = 'overtime';
			$this->defaultColumns[] = 'overtime_date';
            $this->defaultColumns[] = 'pause';
            $this->defaultColumns[] = 'pause_date';
            $this->defaultColumns[] = 'pause_condition';
            $this->defaultColumns[] = 'unpause_date';
			$this->defaultColumns[] = 'task_status';
			$this->defaultColumns[] = 'progress_date';
			$this->defaultColumns[] = 'progress_by';
			$this->defaultColumns[] = 'done_date';
			$this->defaultColumns[] = 'done_by';
			$this->defaultColumns[] = 'tested_date';
			$this->defaultColumns[] = 'tested_by';
			$this->defaultColumns[] = 'tested_status';
			$this->defaultColumns[] = 'tested_verified';
			$this->defaultColumns[] = 'subtask';
			$this->defaultColumns[] = 'subtask_done';
			$this->defaultColumns[] = 'comment';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_by';
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
			if(!isset($_GET['project'])) {
				$this->defaultColumns[] = array(
					'name' => 'project_search',
					'value' => '$data->project->title',
				);
			}
			/*
			$this->defaultColumns[] = array(
				'name' => 'number',
				'value' => '$data->number',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			*/
			$this->defaultColumns[] = 'priority';
			$this->defaultColumns[] = array(
				'name' => 'task_name',
				'value' => '$data->category->name." ".$data->task_name."<br/><span>".Utility::shortText(Utility::hardDecode($data->task_desc),200)."</span>"',
				'htmlOptions' => array(
					'class' => 'bold',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'user_search',
				'value' => '$data->user->displayname',
			);
			$this->defaultColumns[] = 'task_status';
			
			/* Comment
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
            if(!isset($_GET['type'])) {
                $this->defaultColumns[] = array(
                    'name' => 'pause',
                    'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("pause",array("id"=>$data->task_id)), $data->pause, 1)',
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
            $this->defaultColumns[] = array(
                'name' => 'pause_date',
                'value' => 'Utility::dateFormat($data->pause_date)',
                'htmlOptions' => array(
                    'class' => 'center',
                ),
                'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$this,
                    'attribute'=>'pause_date',
                    'language' => 'ja',
                    'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                    //'mode'=>'datetime',
                    'htmlOptions' => array(
                        'id' => 'pause_date_filter',
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
            $this->defaultColumns[] = 'pause_condition';
            $this->defaultColumns[] = array(
                'name' => 'unpause_date',
                'value' => 'Utility::dateFormat($data->unpause_date)',
                'htmlOptions' => array(
                    'class' => 'center',
                ),
                'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$this,
                    'attribute'=>'unpause_date',
                    'language' => 'ja',
                    'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                    //'mode'=>'datetime',
                    'htmlOptions' => array(
                        'id' => 'unpause_date_filter',
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
			*/
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->task_id)), $data->publish, 1)',
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
	
	public static function getTaskPriority() {
		$status = array(
			1 => 'Medium',
			2 => 'High',
			3 => 'Veryhigh',
		);
		
		return $status;
	}
	
	public static function getTaskStatus() {
		$status = array(
			0 => 'To do',
			1 => 'Progress',
			2 => 'Done',
			3 => 'Tested',
		);
		
		return $status;
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {	
			$controller = strtolower(Yii::app()->controller->id);
			$action = strtolower(Yii::app()->controller->action->id);
			if($this->isNewRecord) {
				$this->creation_by = Yii::app()->user->id;
				
			} else {
				if($action == 'edit') {
					if($this->reschedule_date == $this->due_date) {
						$this->addError('reschedule_date', 'Reschedule Date tidak boleh sama dengan Due date.');
					}
					if($this->reschedule_date < $this->due_date) {
						$this->addError('reschedule_date', 'Reschedule Date tidak boleh lebih kecil dari Due date.');
					}
				}		
			}
			if($this->overtime == 1 && $this->overtime_date == '') {
				$this->addError('overtime_date', 'Overtime Date tidak boleh kosong.');
			}
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$controller = strtolower(Yii::app()->controller->id);
			$action = strtolower(Yii::app()->controller->action->id);
			if($this->overtime == 1 && $this->overtime_date != '') {
				$this->overtime_date = date('Y-m-d', strtotime($this->overtime_date));
			}
			if($this->isNewRecord) {
				$this->due_date = date('Y-m-d', strtotime($this->due_date));
				
			} else {
				$this->due_date = date('Y-m-d', strtotime($this->due_date));
				if($this->reschedule_date != '') {
					$this->reschedule_date = date('Y-m-d', strtotime($this->reschedule_date));
				}
				if($action == 'edit') {
					if($this->old_task_status != $this->task_status) {
						$this->updated_by = Yii::app()->user->id;
						if($this->task_status == 1)
							$this->progress_by = Yii::app()->user->id;
						else if($this->task_status == 2)
							$this->done_by = Yii::app()->user->id;
						else if($this->task_status == 3)
							$this->tested_by = Yii::app()->user->id;
					}					
				}
				if($controller == 'backlog') {					
					$this->updated_by = Yii::app()->user->id;
				}
				if($action == 'droptoprogres') {
					$this->progress_by = Yii::app()->user->id;
				} else if($action == 'droptodone') {
					$this->done_by = Yii::app()->user->id;
				} else if($action == 'droptotest') {
					$this->tested_by = Yii::app()->user->id;
				}		
			}
		}
		return true;
	}

}