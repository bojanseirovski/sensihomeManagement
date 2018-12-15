<?php

/**
 * This is the model class for table "alert".
 *
 * The followings are the available columns in table 'alert':
 * @property integer $id
 * @property string $action
 * @property string $scheduled_on
 * @property integer $is_daily
 * @property integer $triggered_by
 * @property string $trigger_value
 * @property integer $enabled
 * @property string $date_created
 * @property integer $actuator_id
 * @property string $actuator_state
 * @property integer $notify
 */
class Alert extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alert';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('action, scheduled_on, triggered_by, trigger_value, enabled, date_created', 'required'),
			array('is_daily, triggered_by, enabled, actuator_id, notify', 'numerical', 'integerOnly'=>true),
			array('action, trigger_value, actuator_state', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, action, scheduled_on, is_daily, triggered_by, trigger_value, enabled, date_created, actuator_id, actuator_state, notify', 'safe', 'on'=>'search'),
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
			'action' => 'Action',
			'scheduled_on' => 'Scheduled On',
			'is_daily' => 'Is Daily',
			'triggered_by' => 'Triggered By',
			'trigger_value' => 'Trigger Value',
			'enabled' => 'Enabled',
			'date_created' => 'Date Created',
			'actuator_id' => 'Actuator',
			'actuator_state' => 'Actuator State',
			'notify' => 'Notify',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('scheduled_on',$this->scheduled_on,true);
		$criteria->compare('is_daily',$this->is_daily);
		$criteria->compare('triggered_by',$this->triggered_by);
		$criteria->compare('trigger_value',$this->trigger_value,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('actuator_id',$this->actuator_id);
		$criteria->compare('actuator_state',$this->actuator_state,true);
		$criteria->compare('notify',$this->notify);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Alert the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
