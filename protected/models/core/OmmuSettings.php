<?php
/**
 * OmmuSettings * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
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
 * This is the model class for table "ommu_core_settings".
 *
 * The followings are the available columns in table 'ommu_core_settings':
 * @property integer $id
 * @property integer $online
 * @property string $site_url
 * @property string $site_title
 * @property string $site_keywords
 * @property string $site_description
 * @property string $site_creation
 * @property string $site_dateformat
 * @property string $site_timeformat
 * @property string $construction_date
 * @property string $construction_text
 * @property string $construction_twitter
 * @property string $banned_ips
 * @property string $banned_emails
 * @property string $banned_usernames
 * @property string $banned_words
 * @property integer $analytic
 * @property string $analytic_id
 */
class OmmuSettings extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OmmuSettings the static model class
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
		return 'ommu_core_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_url, site_title, site_keywords, site_description, site_dateformat, site_timeformat', 'required', 'on'=>'general'),
			//array('analytic_id', 'required', 'on'=>'analytic'),
			array('id, online, analytic', 'numerical', 'integerOnly'=>true),
			array('site_url, construction_twitter, analytic_id', 'length', 'max'=>32),
			array('site_title, site_keywords, site_description', 'length', 'max'=>256),
			array('site_dateformat, site_timeformat', 'length', 'max'=>8),
			array('site_creation, construction_date, construction_text, banned_ips, banned_emails, banned_usernames, banned_words', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, online, site_url, site_title, site_keywords, site_description, site_creation, site_dateformat, site_timeformat, construction_date, construction_text, construction_twitter, banned_ips, banned_emails, banned_usernames, banned_words, analytic, analytic_id', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'online' => 'Maintenance Mode',
			'site_url' => 'Site Url',
			'site_title' => 'Site Title',
			'site_keywords' => 'Site Keywords',
			'site_description' => 'Site Description',
			'site_creation' => 'Site Creation',
			'site_dateformat' => 'Site Dateformat',
			'site_timeformat' => 'Site Timeformat',
			'construction_date' => 'Maintenance Date',
			'construction_text' => 'Maintenance Text',
			'construction_twitter' => 'Twitter Account',
			'banned_ips' => 'Ban Users by IP Address',
			'banned_emails' => 'Ban Users by Email Address',
			'banned_usernames' => 'Ban Users by Username',
			'banned_words' => 'Censored Words on Profiles and Plugins',
			'analytic' => 'Enabled',
			'analytic_id' => 'Analytic ID',
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
		$criteria->compare('t.online',$this->online);
		$criteria->compare('t.site_url',$this->site_url,true);
		$criteria->compare('t.site_title',$this->site_title,true);
		$criteria->compare('t.site_keywords',$this->site_keywords,true);
		$criteria->compare('t.site_description',$this->site_description,true);
		if($this->site_creation != null && !in_array($this->site_creation, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.site_creation)',date('Y-m-d', strtotime($this->site_creation)));
		$criteria->compare('t.site_dateformat',$this->site_dateformat,true);
		$criteria->compare('t.site_timeformat',$this->site_timeformat,true);
		if($this->construction_date != null && !in_array($this->construction_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.construction_date)',date('Y-m-d', strtotime($this->construction_date)));
		$criteria->compare('t.construction_text',$this->construction_text,true);
		$criteria->compare('t.construction_twitter',$this->construction_twitter,true);
		$criteria->compare('t.banned_ips',$this->banned_ips,true);
		$criteria->compare('t.banned_emails',$this->banned_emails,true);
		$criteria->compare('t.banned_usernames',$this->banned_usernames,true);
		$criteria->compare('t.banned_words',$this->banned_words,true);
		$criteria->compare('t.analytic',$this->analytic);
		$criteria->compare('t.analytic_id',$this->analytic_id,true);

		if(!isset($_GET['OmmuSettings_sort']))
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
		} else {
			//$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'online';
			$this->defaultColumns[] = 'site_url';
			$this->defaultColumns[] = 'site_title';
			$this->defaultColumns[] = 'site_keywords';
			$this->defaultColumns[] = 'site_description';
			$this->defaultColumns[] = 'site_creation';
			$this->defaultColumns[] = 'site_dateformat';
			$this->defaultColumns[] = 'site_timeformat';
			$this->defaultColumns[] = 'construction_date';
			$this->defaultColumns[] = 'construction_text';
			$this->defaultColumns[] = 'construction_twitter';
			$this->defaultColumns[] = 'banned_ips';
			$this->defaultColumns[] = 'banned_emails';
			$this->defaultColumns[] = 'banned_usernames';
			$this->defaultColumns[] = 'banned_words';
			$this->defaultColumns[] = 'analytic';
			$this->defaultColumns[] = 'analytic_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = 'online';
			$this->defaultColumns[] = 'site_url';
			$this->defaultColumns[] = 'site_title';
			$this->defaultColumns[] = 'site_keywords';
			$this->defaultColumns[] = 'site_description';
			$this->defaultColumns[] = 'site_creation';
			$this->defaultColumns[] = 'site_dateformat';
			$this->defaultColumns[] = 'site_timeformat';
			$this->defaultColumns[] = 'construction_date';
			$this->defaultColumns[] = 'construction_text';
			$this->defaultColumns[] = 'construction_twitter';
			$this->defaultColumns[] = 'banned_ips';
			$this->defaultColumns[] = 'banned_emails';
			$this->defaultColumns[] = 'banned_usernames';
			$this->defaultColumns[] = 'banned_words';
			$this->defaultColumns[] = 'analytic';
			$this->defaultColumns[] = 'analytic_id';
		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($id=1, $column=null)
	{
		if($column != null) {
			$model = self::model()->findByPk($id,array(
				'select' => $column
			));
			return $model->$column;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;			
		}
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {		
			if($this->online == 0) {
				if($this->construction_date == '') {
					$this->addError('construction_date', 'Maintenance date cannot be blank.');
				}
				if($this->construction_text == '') {
					$this->addError('construction_text', 'Maintenance text cannot be blank.');
				}
				if($this->construction_twitter == '') {
					$this->addError('construction_twitter', 'Twitter account cannot be blank.');
				}
			}
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$this->construction_date = date('Y-m-d', strtotime($this->construction_date));
		}
		return true;
	}

}