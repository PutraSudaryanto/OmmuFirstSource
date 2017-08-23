<?php
/**
 * UserNewsletter
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/mod-users
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
 * This is the model class for table "ommu_user_newsletter".
 *
 * The followings are the available columns in table 'ommu_user_newsletter':
 * @property string $newsletter_id
 * @property integer $status
 * @property string $user_id
 * @property string $reference_id
 * @property string $email
 * @property string $subscribe_date
 * @property string $subscribe_id
 * @property string $modified_date
 * @property string $modified_id
 * @property string $updated_date
 * @property string $updated_ip
 */
class UserNewsletter extends CActiveRecord
{
	public $defaultColumns = array();
	public $email_i;
	public $unsubscribe_i;
	public $multiple_email_i;
	
	// Variable Search
	public $level_search;
	public $user_search;
	public $reference_search;
	public $subscribe_search;
	public $modified_search;
	public $register_search;
	public $invite_search;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserNewsletter the static model class
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
		return 'ommu_user_newsletter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('
				email_i', 'required', 'on'=>'singleEmailForm'),
			array('status, user_id, reference_id, subscribe_id, modified_id,
				unsubscribe_i, multiple_email_i', 'numerical', 'integerOnly'=>true),
			array('user_id, reference_id, subscribe_id, modified_id', 'length', 'max'=>11),
			array('email', 'length', 'max'=>32),
			array('updated_ip', 'length', 'max'=>20),
			array('email', 'email'),
			array('email,
				email_i, unsubscribe_i, multiple_email_i', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('newsletter_id, status, user_id, reference_id, email, subscribe_date, subscribe_id, modified_date, modified_id, updated_date, updated_ip,
				level_search, user_search, reference_search, subscribe_search, modified_search, register_search, invite_search', 'safe', 'on'=>'search'),
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
			'view' => array(self::BELONGS_TO, 'ViewUserInviteNewsletter', 'newsletter_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'reference' => array(self::BELONGS_TO, 'Users', 'reference_id'),
			'subscribe' => array(self::BELONGS_TO, 'Users', 'subscribe_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'invites' => array(self::HAS_MANY, 'UserInvites', 'newsletter_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'newsletter_id' => Yii::t('attribute', 'Newsletter'),
			'status' => Yii::t('attribute', 'Status'),
			'user_id' => Yii::t('attribute', 'User'),
			'reference_id' => Yii::t('attribute', 'Reference'),
			'email' => Yii::t('attribute', 'Email'),
			'subscribe_date' => Yii::t('attribute', 'Subscribe Date'),
			'subscribe_id' => Yii::t('attribute', 'Subscribe'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'updated_date' => Yii::t('attribute', 'Updated Date'),
			'updated_ip' => Yii::t('attribute', 'Updated IP'),
			'email_i' => Yii::t('attribute', 'Email'),
			'multiple_email_i' => Yii::t('attribute', 'Multiple Email'),
			'level_search' => Yii::t('attribute', 'Level'),
			'user_search' => Yii::t('attribute', 'User'),
			'reference_search' => Yii::t('attribute', 'Reference'),
			'subscribe_search' => Yii::t('attribute', 'Subscribe'),
			'modified_search' => Yii::t('attribute', 'Modified'),
			'register_search' => Yii::t('attribute', 'Register'),
			'invite_search' => Yii::t('attribute', 'Invites'),
			'invite_users_i' => Yii::t('attribute', 'Invite Users'),
			'first_invite_i' => Yii::t('attribute', 'First Invite'),
			'last_invite_i' => Yii::t('attribute', 'Last Invite'),
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
		
		// Custom Search
		$criteria->with = array(
			'view' => array(
				'alias'=>'view',
			),
			'view.user' => array(
				'alias'=>'view_user',
				'select'=>'level_id, displayname'
			),
			'user' => array(
				'alias'=>'user',
				'select'=>'level_id, displayname'
			),
			'subscribe' => array(
				'alias'=>'subscribe',
				'select'=>'displayname'
			),
			'modified' => array(
				'alias'=>'modified',
				'select'=>'displayname'
			),
		);

		$criteria->compare('t.newsletter_id',$this->newsletter_id);
		$criteria->compare('t.status',$this->status);
		if(isset($_GET['user']))
			$criteria->compare('t.user_id',$_GET['user']);
		else
			$criteria->compare('t.user_id',$this->user_id);
		if(isset($_GET['reference']))
			$criteria->compare('t.reference_id',$_GET['reference']);
		else
			$criteria->compare('t.reference_id',$this->reference_id);
		$criteria->compare('t.email',strtolower($this->email),true);
		if($this->subscribe_date != null && !in_array($this->subscribe_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.subscribe_date)',date('Y-m-d', strtotime($this->subscribe_date)));
		if(isset($_GET['subscribe']))
			$criteria->compare('t.subscribe_id',$_GET['subscribe']);
		else
			$criteria->compare('t.subscribe_id',$this->subscribe_id);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		if(isset($_GET['modified']))
			$criteria->compare('t.modified_id',$_GET['modified']);
		else
			$criteria->compare('t.modified_id',$this->modified_id);
		if($this->updated_date != null && !in_array($this->updated_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.updated_date)',date('Y-m-d', strtotime($this->updated_date)));
		$criteria->compare('t.updated_ip',$this->updated_ip,true);
		
		if($this->view->user_id)
			$criteria->compare('view_user.level_id',$this->level_search);
		else
			$criteria->compare('user.level_id',$this->level_search);
		if($this->view->user_id)
			$criteria->compare('view_user.displayname',strtolower($this->user_search),true);
		else
			$criteria->compare('user.displayname',strtolower($this->user_search),true);
		$criteria->compare('reference.displayname',strtolower($this->reference_search),true);
		$criteria->compare('subscribe.displayname',strtolower($this->subscribe_search),true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search),true);
		$criteria->compare('view.register',$this->register_search);
		$criteria->compare('view.invites',$this->invite_search);
		
		if(!isset($_GET['UserNewsletter_sort']))
			$criteria->order = 't.newsletter_id DESC';

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
			//$this->defaultColumns[] = 'newsletter_id';
			$this->defaultColumns[] = 'status';
			$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'reference_id';
			$this->defaultColumns[] = 'email';
			$this->defaultColumns[] = 'subscribe_date';
			$this->defaultColumns[] = 'subscribe_id';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
			$this->defaultColumns[] = 'updated_date';
			$this->defaultColumns[] = 'updated_ip';
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
			/*
			if(!isset($_GET['user'])) {
				$this->defaultColumns[] = array(
					'name' => 'level_search',
					'value' => '$data->view->user_id ? Phrase::trans($data->view->user->level->name) : ($data->user_id ? Phrase::trans($data->user->level->name) : \'-\')',
					'filter'=>UserLevel::getUserLevel(),
					'type' => 'raw',
				);
				$this->defaultColumns[] = array(
					'name' => 'user_search',
					'value' => '$data->view->user_id ? $data->view->user->displayname : ($data->user_id ? $data->user->displayname : \'-\')',
				);
			}
			*/
			$this->defaultColumns[] = array(
				'name' => 'email',
				'value' => '$data->email',
			);
			$this->defaultColumns[] = array(
				'name' => 'subscribe_date',
				'value' => 'Utility::dateFormat($data->subscribe_date, true)',
				'htmlOptions' => array(
					//'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('application.components.system.CJuiDatePicker', array(
					'model'=>$this, 
					'attribute'=>'subscribe_date', 
					'language' => 'en',
					'i18nScriptFile' => 'jquery-ui-i18n.min.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'subscribe_date_filter',
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
				'name' => 'invite_search',
				'value' => 'CHtml::link($data->view->invites ? $data->view->invites : 0, Yii::app()->controller->createUrl("o/invite/manage",array("newsletter"=>$data->newsletter_id)))',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'register_search',
				'value' => '$data->view->register == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'header' => Yii::t('phrase', 'Status'),
				'name' => 'status',
				'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("subscribe",array("id"=>$data->newsletter_id)), $data->status, 8)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
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
	 * User get information
	 * condition
	 ** 0 = newsletter not null
	 ** 1 = newsletter save
	 ** 2 = newsletter not save
	 */
	public static function insertNewsletter($email)
	{		
		$criteria=new CDbCriteria;
		$criteria->compare('t.email',strtolower($email));
		$model = self::model()->find($criteria);
		
		$condition = 0;
		if($model == null) {
			$newsletter = new UserNewsletter;
			$newsletter->email = $email;
			if($newsletter->save())
				$condition = 1;
			else
				$condition = 2;
		}
		
		return $condition;
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() 
	{
		$controller = strtolower(Yii::app()->controller->id);
		
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				if($this->multiple_email_i == 1) {
					if($this->email_i == '')
						$this->addError('email_i', Yii::t('phrase', 'Email cannot be blank.'));
					
				} else {				
					if($controller == 'o/newsletter' && $this->email_i != '') {
						$this->email = $this->email_i;
						$newsletter = self::model()->findByAttributes(array('email' => $this->email), array(
							'select' => 'email',
						));
						if($newsletter == null) {
							if($this->unsubscribe_i != 0)
								$this->addError('email_i', Yii::t('phrase', 'Anda belum terdaftar dalam newsletter.'));
						} else {
							if($this->unsubscribe_i == 0)
								$this->addError('email_i', Yii::t('phrase', 'Anda Sudah terdaftar dalam newsletter.'));
						}
					}					
				}
				if($this->subscribe_id == 0)
					$this->subscribe_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : 0;
				
			} else {
				if($controller == 'o/newsletter')
					$this->modified_id = Yii::app()->user->id;
			}
			$this->updated_ip = $_SERVER['REMOTE_ADDR'];
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$this->email = strtolower($this->email);
		}
		return true;
	}
	
	/**
	 * After save attributes
	 */
	protected function afterSave() {
		parent::afterSave();
		if($this->isNewRecord) {
			// Guest Subscribe
			if($this->user_id == 0 && $this->status == 1) {
				$email = $this->email;
				$displayname = $this->email;
				
				$message = 'Subscribe Success';
				SupportMailSetting::sendEmail($email, $displayname, 'Subscribe Success', $message);
			}
			
		} else {
			// Guest Unsubscribe
			$email = $this->email;
			$displayname = $this->email;
			// Member Unsubscribe
			if($this->view->user_id != 0) {
				$email = $this->view->user->email;
				$displayname = $this->view->user->displayname;
			}
			
			if($this->status == 0) {
				$message = 'Unsubscribe Success';
				SupportMailSetting::sendEmail($email, $displayname, 'Unsubscribe Success', $message);
			}
		}
	}

}