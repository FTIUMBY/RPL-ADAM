<?php

/**
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
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
 * This is the model class for table "ommu_core_content_menu".
 *
 * The followings are the available columns in table 'ommu_core_content_menu':
 * @property string $menu_id
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property integer $enabled
 * @property integer $orders
 * @property string $name
 * @property string $icon
 * @property string $class
 * @property string $url
 * @property integer $dialog
 * @property string $attr
 * @property string $creation_date
 */
class OmmuContentMenu extends CActiveRecord
{
	public $defaultColumns = array();
	public $params;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OmmuContentMenu the static model class
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
		return 'ommu_core_content_menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('controller, action, name', 'required'),
			array('enabled, orders, dialog', 'numerical', 'integerOnly'=>true),
			array('icon, class', 'length', 'max'=>16),
			array('module, controller, action, name', 'length', 'max'=>32),
			array('url, attr', 'length', 'max'=>128),
			array('name, creation_date, params', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('menu_id, module, controller, action, enabled, orders, name, icon, class, url, dialog, attr, creation_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'menu_id' => 'Menu',
			'module' => 'Module',
			'controller' => 'Controller',
			'action' => 'Action',
			'enabled' => 'Enabled',
			'orders' => 'Order',
			'name' => 'Title Menu',
			'icon' => 'Icons',
			'class' => 'CSS Class',
			'url' => 'Url/Hyperlink',
			'dialog' => 'Dialog',
			'attr' => 'Attribute',
			'creation_date' => 'Creation Date',
			'params' => 'Parameter',
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.menu_id',$this->menu_id,true);
		if(isset($_GET['module'])) {
			$criteria->compare('t.module',$_GET['module']);
		} else {			
			$criteria->compare('t.module',strtolower($this->module),true);
		}
		$criteria->compare('t.controller',strtolower($this->controller),true);
		$criteria->compare('t.action',strtolower($this->action),true);
		$criteria->compare('t.enabled',$this->enabled);
		$criteria->compare('t.orders',$this->orders);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.icon',$this->icon,true);
		$criteria->compare('t.class',$this->class,true);
		$criteria->compare('t.url',strtolower($this->url),true);
		$criteria->compare('t.dialog',$this->dialog);
		$criteria->compare('t.attr',$this->attr,true);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		
		if(!isset($_GET['OmmuContentMenu_sort']))
			$criteria->order = 'menu_id DESC';

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
			//$this->defaultColumns[] = 'menu_id';
			$this->defaultColumns[] = 'module';
			$this->defaultColumns[] = 'controller';
			$this->defaultColumns[] = 'action';
			$this->defaultColumns[] = 'enabled';
			$this->defaultColumns[] = 'orders';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'icon';
			$this->defaultColumns[] = 'class';
			$this->defaultColumns[] = 'url';
			$this->defaultColumns[] = 'dialog';
			$this->defaultColumns[] = 'attr';
			$this->defaultColumns[] = 'creation_date';
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
				'name' => 'name',
				'value' => '$data->name',
			);
			if(!isset($_GET['module'])) {
				$this->defaultColumns[] = array(
					'name' => 'module',
					'value' => '$data->module',
					'htmlOptions' => array(
						//'class' => 'center',
					),
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'controller',
				'value' => '$data->controller',
				'htmlOptions' => array(
					//'class' => 'center',
				),
			);
			$this->defaultColumns[] = array(
				'name' => 'action',
				'value' => '$data->action',
				'htmlOptions' => array(
					//'class' => 'center',
				),
			);
			$this->defaultColumns[] = array(
				'name' => 'dialog',
				'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("dialog",array("id"=>$data->menu_id)), $data->dialog, 4)',
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
				'name' => 'enabled',
				'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("enabled",array("id"=>$data->menu_id)), $data->enabled, 3)',
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
		parent::afterConstruct();
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			if(($this->module == '') || ($this->controller == '') || ($this->action == '')) {
				$this->addError('params', Yii::t('', 'Parameter cannot be blank.'));
			}
			if($this->isNewRecord) {
				$this->orders = 1;
			}		
		}
		return true;
	}
}