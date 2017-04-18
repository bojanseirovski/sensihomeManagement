<?php

/**
 * This is the model class for table "alert_log".
 *
 * The followings are the available columns in table 'alert_log':
 * @property integer $id
 * @property integer $sid
 * @property integer $aid
 * @property integer $alid
 * @property string $alname
 * @property string $svalue
 * @property string $astate
 * @property string $date
 */
class AlertLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alert_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alid, alname, svalue, astate, date', 'required'),
			array('sid, aid, alid', 'numerical', 'integerOnly'=>true),
			array('alname, svalue, astate', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sid, aid, alid, alname, svalue, astate, date', 'safe', 'on'=>'search'),
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
			'sid' => 'Sid',
			'aid' => 'Aid',
			'alid' => 'Alid',
			'alname' => 'Alname',
			'svalue' => 'Svalue',
			'astate' => 'Astate',
			'date' => 'Date',
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
		$criteria->compare('sid',$this->sid);
		$criteria->compare('aid',$this->aid);
		$criteria->compare('alid',$this->alid);
		$criteria->compare('alname',$this->alname,true);
		$criteria->compare('svalue',$this->svalue,true);
		$criteria->compare('astate',$this->astate,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AlertLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
