<?php
/**
 * Users * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
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
 * This is the model class for table "ommu_users".
 *
 * The followings are the available columns in table 'ommu_users':
 * @property string $user_id
 * @property string $level_id
 * @property integer $enabled
 * @property integer $verified
 * @property string $username
 * @property string $email
 * @property string $salt
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $displayname
 * @property string $photo
 * @property string $lastlogin_date
 * @property string $creation_date
 * @property string $modified_date
 */
class Users extends CActiveRecord
{
	public $defaultColumns = array();
	public $new_password;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'ommu_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level_id, username, email, first_name, last_name,
				new_password', 'required'),
			array('displayname', 'required', 'on'=>'adminedit'),
			array('enabled, verified', 'numerical', 'integerOnly'=>true),
			array('level_id', 'length', 'max'=>11),
			array('username, email, salt, password, first_name, last_name,
				new_password', 'length', 'max'=>32),
			array('displayname, photo', 'length', 'max'=>64),
			array('salt, photo, lastlogin_date, creation_date, modified_date,
				new_password', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, level_id, enabled, verified, username, email, salt, password, first_name, last_name, displayname, photo, lastlogin_date, creation_date, modified_date', 'safe', 'on'=>'search'),
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
			'level' => array(self::BELONGS_TO, 'UserLevel', 'level_id'),
			
			'ommuUserHistoryEmails' => array(self::HAS_MANY, 'OmmuUserHistoryEmail', 'user_id'),
			'ommuUserHistoryLogins' => array(self::HAS_MANY, 'OmmuUserHistoryLogin', 'user_id'),
			'ommuUserHistoryPasswords' => array(self::HAS_MANY, 'OmmuUserHistoryPassword', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'level_id' => 'Level',
			'enabled' => 'Enabled',
			'verified' => 'Verified',
			'username' => 'Username',
			'email' => 'Email',
			'salt' => 'Salt',
			'password' => 'Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'displayname' => 'Displayname',
			'photo' => 'Photo',
			'lastlogin_date' => 'Lastlogin Date',
			'creation_date' => 'Creation Date',
			'modified_date' => 'Modified Date',
			'new_password' => 'New Password',
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
		$criteria->compare('t.user_id',$this->user_id);
		if(isset($_GET['level'])) {
			$criteria->compare('t.level_id',$_GET['level']);
		} else {
			$criteria->compare('t.level_id',$this->level_id);
		}
		$criteria->compare('t.enabled',$this->enabled);
		$criteria->compare('t.verified',$this->verified);
		$criteria->compare('t.username',$this->username,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.salt',$this->salt,true);
		$criteria->compare('t.password',$this->password,true);
		$criteria->compare('t.first_name',$this->first_name,true);
		$criteria->compare('t.last_name',$this->last_name,true);
		$criteria->compare('t.displayname',$this->displayname,true);
		$criteria->compare('t.photo',$this->photo,true);
		if($this->lastlogin_date != null && !in_array($this->lastlogin_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.lastlogin_date)',date('Y-m-d', strtotime($this->lastlogin_date)));
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));

		if(!isset($_GET['Users_sort']))
			$criteria->order = 'user_id DESC';

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
			//$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'level_id';
			$this->defaultColumns[] = 'enabled';
			$this->defaultColumns[] = 'verified';
			$this->defaultColumns[] = 'username';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = 'salt';
			$this->defaultColumns[] = 'password';
			$this->defaultColumns[] = 'first_name';
			$this->defaultColumns[] = 'last_name';
			$this->defaultColumns[] = 'displayname';
			$this->defaultColumns[] = 'photo';
			$this->defaultColumns[] = 'lastlogin_date';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'modified_date';
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
				'name' => 'level_id',
				'value' => '$data->level->level_name',
				'htmlOptions' => array(
					//'class' => 'center',
				),
				'filter'=>UserLevel::getLevel(),
				'type' => 'raw',
			);
			$this->defaultColumns[] = 'displayname';
			$this->defaultColumns[] = 'username';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = array(
				'name' => 'lastlogin_date',
				'value' => 'Utility::dateFormat($data->lastlogin_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'lastlogin_date',
					'language' => 'ja',
					'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'lastlogin_date_filter',
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
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'enabled',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("enabled",array("id"=>$data->user_id)), $data->enabled, "Enabled,Disabled")',
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
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'verified',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("verified",array("id"=>$data->user_id)), $data->verified, "Verified,Unverified")',
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
	 * User salt codes
	 */
	public static function getUniqueCode() {
		$chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		$i = 0;
		$salt = '' ;

		while ($i <= 15) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 2);
			$salt = $salt . $tmp; 
			$i++;
		}

		return $salt;
	}

	/**
	 * User Salt
	 */
	public static function hashPassword($salt, $password)
	{
		return md5($salt.$password);
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() 
	{
		if(parent::beforeValidate()) {		
			if($this->isNewRecord) {
				$this->salt = self::getUniqueCode();
			}
		}
		return true;
	}
	
	protected function afterValidate()
	{
		parent::afterValidate();
		if($this->isNewRecord) {
			if(count($this->errors) == 0) {
				$this->password = self::hashPassword($this->salt, $this->new_password);
			}
		}
		return true;
	}

	/**
	 * After delete attributes
	 */
	protected function afterDelete() {
		parent::afterDelete();
		//delete user image		
		$user_path = "public/users/".$this->user_id;
		if($this->photo != '')
			rename($user_path.'/'.$this->photo, 'public/users/verwijderen/'.$this->user_id.'_'.$this->photo);
			
		Utility::deleteFolder($user_path);		
	}

}