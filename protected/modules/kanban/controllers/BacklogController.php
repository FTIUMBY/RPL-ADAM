<?php
/**
 * SettingController
 * @var $this SettingController
 * @var $model KanbanTaskCategory * @var $form CActiveForm
 * Copyright (c) 2013, Ommu Platform (ommu.co). All rights reserved.
 * version: 0.0.1
 * Reference start
 *
 * TOC :
 *	Index
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 *----------------------------------------------------------------------------------------------------------
 */

class BacklogController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() 
	{
		if(!Yii::app()->user->isGuest) {
			if(Yii::app()->user->level == 1) {
				$arrThemes = Utility::getCurrentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
			} else {
				$this->redirect(Yii::app()->createUrl('site/login'));
			}
		} else {
			$this->redirect(Yii::app()->createUrl('site/login'));
		}
	}

	/**
	 * @return array action filters
	 */
	public function filters() 
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() 
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('progress',
					'add','edit'),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level == 1)',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() 
	{
		$this->redirect(array('progress'));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionProgress() 
	{
		$model=new Projects('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Projects'])) {
			$model->attributes=$_GET['Projects'];
		}

		$columnTemp = array();
		if(isset($_GET['GridColumn'])) {
			foreach($_GET['GridColumn'] as $key => $val) {
				if($_GET['GridColumn'][$key] == 1) {
					$columnTemp[] = $key;
				}
			}
		}
		$columns = $model->getGridColumn($columnTemp);

		$this->pageTitle = 'Backlog Progress';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_progress',array(
			'model'=>$model,
			'columns' => $columns,
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionBoard() 
	{
		$pid = $_GET['pid'];

		$this->pageTitle = 'Backlog Board';
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('admin_board',array(
			'pid'=>$pid,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd() 
	{
		$pid = $_GET['pid'];
		$model=new KanbanTasks;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['KanbanTasks'])) {
			$model->attributes=$_POST['KanbanTasks'];
			
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;

			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 5,
							'get' => Yii::app()->controller->createUrl('edit', array('taskid'=>$model->task_id, 'pid'=>$model->project_id)),
							'id' => 'partial-kanban-tasks',
							'msg' => '<div class="errorSummary success"><strong>KanbanTasks success created.</strong></div>',
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
			
		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('board', array('pid'=>$pid));
			
			$this->pageTitle = 'Create Kanban Tasks';
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_add_task',array(
				'model'=>$model,
				'pid'=>$pid,
			));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionEdit($taskid) 
	{
		$model=$this->loadModel($taskid);
		$pid = $model->project_id;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['KanbanTasks'])) {
			$model->attributes=$_POST['KanbanTasks'];
			
			$jsonError = CActiveForm::validate($model);
			if(strlen($jsonError) > 2) {
				echo $jsonError;

			} else {
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
					if($model->save()) {
						echo CJSON::encode(array(
							'type' => 5,
							'get' => Yii::app()->controller->createUrl('edit', array('taskid'=>$model->task_id, 'pid'=>$model->project_id)),
							'id' => 'partial-kanban-tasks',
							'msg' => '<div class="errorSummary success"><strong>KanbanTasks success updated.</strong></div>',
							'clear' => 'off',
						));
					} else {
						print_r($model->getErrors());
					}
				}
			}
			Yii::app()->end();
			
		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('board', array('pid'=>$pid));

			$this->pageTitle = 'Update Kanban Tasks';
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_edit_task',array(
				'model'=>$model,
				'pid'=>$pid,
			));
		}
	}
	
	/**
	 * Lists all models.
	 */
	public function actionSubtask($taskid) 
	{
		$pid = $_GET['pid'];

		$criteria=new CDbCriteria; 
		$criteria->condition = 'task_id = :task'; 
		$criteria->params = array(
			':task'=>$taskid,
		); 
		$criteria->order = 'creation_date DESC'; 

		$dataProvider = new CActiveDataProvider('KanbanTaskSub', array( 
			'criteria'=>$criteria, 
			'pagination'=>array( 
				'pageSize'=>10, 
			), 
		)); 
		
		$model=new KanbanTaskSub; 

		// Uncomment the following line if AJAX validation is needed 
		$this->performAjaxValidation($model); 

		if(isset($_POST['KanbanTaskSub'])) { 
			$model->attributes=$_POST['KanbanTaskSub']; 
			
			$jsonError = CActiveForm::validate($model); 
			if(strlen($jsonError) > 2) { 
				echo $jsonError; 

			} else { 
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) { 
					if($model->save()) { 
						echo CJSON::encode(array( 
							'type' => 5, 
							'get' => Yii::app()->controller->createUrl('subtask', array('taskid'=>$model->task_id, 'pid'=>$pid)), 
						)); 
					} else {
						print_r($model->getErrors()); 
					} 
				} 
			} 
			Yii::app()->end(); 
			
		} else {		
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('board', array('pid'=>$pid));

			$this->pageTitle = 'Backlog Subtask';
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_subtask',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
				'pid'=>$pid,
			));		
		}
	}
	
	/**
	 * Lists all models.
	 */
	public function actionComment($taskid) 
	{
		$pid = $_GET['pid'];

		$criteria=new CDbCriteria; 
		$criteria->condition = 'publish = :publish AND task_id = :task'; 
		$criteria->params = array(
			':publish'=>1,
			':task'=>$taskid,
		); 
		$criteria->order = 'creation_date DESC'; 

		$dataProvider = new CActiveDataProvider('KanbanTaskComment', array( 
			'criteria'=>$criteria, 
			'pagination'=>array( 
				'pageSize'=>10, 
			), 
		));
		
		$model=new KanbanTaskComment; 

		// Uncomment the following line if AJAX validation is needed 
		$this->performAjaxValidation($model); 

		if(isset($_POST['KanbanTaskComment'])) { 
			$model->attributes=$_POST['KanbanTaskComment']; 
			
			$jsonError = CActiveForm::validate($model); 
			if(strlen($jsonError) > 2) { 
				echo $jsonError; 

			} else { 
				if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) { 
					if($model->save()) { 
						echo CJSON::encode(array( 
							'type' => 5, 
							'get' => Yii::app()->controller->createUrl('comment', array('taskid'=>$model->task_id, 'pid'=>$pid)),
						)); 
					} else { 
						print_r($model->getErrors()); 
					} 
				} 
			} 
			
		} else {		
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('board', array('pid'=>$pid));

			$this->pageTitle = 'Backlog Board';
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_comment',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
				'pid'=>$pid,
			));		
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = KanbanTasks::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) 
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kanban-tasks-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
