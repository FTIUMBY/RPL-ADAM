<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = 'default';

	/**
	 * admin controller
	 */
	public $trashOption = false;
	public $searchOption = false;

	/**
	 * front controller
	 *
	 * Dialog Condition
	 ** example (action in controller)
	 **
	 ** $this->dialogDetail = true;
	 ** $this->dialogWidth = int; int => ???
	 ** $this->dialogGroundUrl = url;
	 *
	 */
	public $dialogDetail = false;
	public $dialogWidth = '';
	public $dialogGroundUrl = '';
	
	/**
	 * Other Content
	 ** example (action in controller)
	 **
	 ** $this->contentOther = true;
	 ** $this->contentAttribute=array(
	 ** 	array('type' => 0, 'id' => '1', 'data' => '1'),			//content
	 ** 	array('type' => 1, 'id' => '2', 'url' => '2'),			//render partial
	 ** );
	 *
	 */
	public $contentType = false;
	public $contentOther = false;
	public $contentAttribute = array();

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();

	/**
	 * custom variable
	 */
	public $pageGuest = false;
	public $dialogFixed = false;
	public $dialogFixedClosed = array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	public $pageDescription;
	public $pageMeta;

	public function render($view, $data = null, $return = false) {
		if ($this->beforeRender($view)) {
			/**
			 * Custom condition
			 ** 
			 * guest page
			 * replace timthumb url
			 * set current date
			 *
			 */
			// guest page
			if($this->dialogFixed == true) {
				$this->pageGuest = true;
			}
			// replace timthumb url
			if(!isset(Yii::app()->session['timthumb_url_replace']) && Yii::app()->params['timthumb_url_replace'] == 1) {
				Yii::app()->session['timthumb_url_replace'] = Yii::app()->params['timthumb_url_replace_website'];
			}
			// set current date
			if(!isset(Yii::app()->session['statistic_current_date']) || (isset(Yii::app()->session['statistic_current_date']) && Yii::app()->session['statistic_current_date'] != date('Y-m-d'))) {
				Yii::app()->session['statistic_current_date'] = date('Y-m-d');
			}
			
			parent::render($view, $data, $return);
		}
	}
 
	/**
	 * Meta description and keyword generate
	 */
	protected function beforeRender($view)
	{
		$model = OmmuSettings::model()->findByPk(1,array(
			'select' => 'site_title, site_keywords, site_description'
		));
		if(!Yii::app()->request->isAjaxRequest) {

			if(parent::beforeRender($view)) {
				// Ommu custom description and keyword
				if (!empty($this->pageDescription)) {
					$description = $this->pageDescription;
				} else {
					$description = $model->site_description;
				}
				Yii::app()->clientScript->registerMetaTag(Utility::hardDecode($description), 'description');
		
				if (!empty($this->pageMeta)) {
					$keywords = $model->site_keywords.','.$this->pageMeta;
				} else {
					$keywords = $model->site_keywords;
				}
				Yii::app()->clientScript->registerMetaTag(Utility::hardDecode($keywords), 'keywords');
			}
			
		} else {
			$this->pageDescription = $this->pageDescription != '' ? $this->pageDescription : $model->site_description;
			$this->pageMeta = $this->pageMeta != '' ? $model->site_keywords.', '.$this->pageMeta : $model->site_keywords;
		}
		return true;
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->pageGuest = true;
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('/site/front_error', $error);
		} else {
			$this->render('/site/front_error', $error);
		}
	}
}