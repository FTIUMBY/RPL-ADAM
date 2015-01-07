<?php
/**
* SiteController
* Handle SiteController
* Copyright (c) 2013, Ommu Platform (ommu.co). All rights reserved.
* version: 2.0.0
* Reference start
*
* TOC :
*	Error
*	Index
*	Login
*	Logout
*	Contact
*	SendEmail
*
*	LoadModel
*	performAjaxValidation
*
* @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
* @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
* @link http://company.ommu.co
* @contact (+62)856-299-4114
*
*----------------------------------------------------------------------------------------------------------
*/

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Initialize public template
	 */
	public function init() 
	{
		$arrThemes = Utility::getCurrentTemplate('public');
		Yii::app()->theme = $arrThemes['folder'];
		$this->layout = $arrThemes['layout'];
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('front_error', $error);
		} else {
			$this->render('front_error', $error);
		}
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		//$this->ownerId = 2;
		$setting = OmmuSettings::model()->findByPk(1,array(
			'select' => 'online, site_title, construction_date, construction_text',
		));
		//$this->redirect(Yii::app()->createUrl('project/site/index'));

		if($setting->online == 0 && date('Y-m-d', strtotime($setting->construction_date)) > date('Y-m-d')) {
			$render = 'front_construction';
			/* $this->pageTitle = Phrase::trans(329,0);
			$this->pageDescription = '';
			$this->pageMeta = '';
			$render = 'front_construction'; */

		} else {
			$render = 'front_index';
			/* if(!Yii::app()->user->isGuest) {
				$this->redirect(Yii::app()->createUrl('pose/site/index'));
			} else {
				$render = 'front_index';
			} */
		}

		$this->pageTitle = $setting->site_title;
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render($render, array(
			'setting'=>$setting,
		));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest) {
			$this->redirect(array('site/index'));

		} else {
			$arrThemes = Utility::getCurrentTemplate('admin');
			Yii::app()->theme = $arrThemes['folder'];
			$this->layout = $arrThemes['layout'];
			
			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				
				$jsonError = CActiveForm::validate($model);
				if(strlen($jsonError) > 2) {
					echo $jsonError;

				} else {
					if(isset($_GET['enablesave']) && $_GET['enablesave'] == 1) {
						// validate user input and redirect to the previous page if valid
						if($model->validate() && $model->login()) {
							Users::model()->updateByPk(Yii::app()->user->id, array(
								'lastlogin_date'=>date('Y-m-d H:i:s'), 
							));
							if(isset($_GET['type'])) {
								echo CJSON::encode(array(
									'type' => 6,
								));
							} else {
								echo CJSON::encode(array(
									'redirect' => Yii::app()->user->level == 1 ? Yii::app()->createUrl('admin/index') : Yii::app()->user->returnUrl,
								));
							}
							//$this->redirect(Yii::app()->user->returnUrl);
						} else {
							print_r($model->getErrors());
						}
					}
				}
				Yii::app()->end();
				
			}
			
			// display the login form
			$this->dialogDetail = true;
			$this->dialogWidth = 600;
			
			$this->pageTitle = 'Login';
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('admin_login',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionSendEmail()
	{
		SupportMailSetting::sendEmail('putra.sudaryanto@gmail.com', 'Putra Sudaryanto', 'testing', 'testing', 1);	
	}
}