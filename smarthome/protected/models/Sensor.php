<?php

/**
 * This is the model class for table "sensor".
 *
 * The followings are the available columns in table 'sensor':
 * @property integer $id
 * @property string $type
 * @property string $unit
 * @property string $name
 * @property string $com_id
 * @property integer $system_id
 * @property string $date_created
 * @property string $value_fields
 * @property string $serial
 */
class Sensor extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
	return 'sensor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('type, unit, name, com_id, system_id, date_created, value_fields, serial', 'required'),
	    array('system_id', 'numerical', 'integerOnly' => true),
	    array('type, unit, name, com_id, serial', 'length', 'max' => 255),
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    array('id, type, unit, name, com_id, system_id, date_created, value_fields, serial', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'id' => 'ID',
	    'type' => 'Type',
	    'unit' => 'Unit',
	    'name' => 'Name',
	    'com_id' => 'Com',
	    'system_id' => 'System',
	    'date_created' => 'Date Created',
	    'value_fields' => 'Value Fields',
	    'serial' => 'Serial',
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
    public function search() {
	// @todo Please modify the following code to remove attributes that should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('id', $this->id);
	$criteria->compare('type', $this->type, true);
	$criteria->compare('unit', $this->unit, true);
	$criteria->compare('name', $this->name, true);
	$criteria->compare('com_id', $this->com_id, true);
	$criteria->compare('system_id', $this->system_id);
	$criteria->compare('date_created', $this->date_created, true);
	$criteria->compare('value_fields', $this->value_fields, true);
	$criteria->compare('serial', $this->serial, true);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Sensor the static model class
     */
    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

    public function getSensorNameIdType($sid) {
	$sData = Yii::app()->db->createCommand()
		->from('sensor')
		->join('sensor_type', 'sensor_type.id=sensor.type')
		->where('sensor.id=' . $sid)
		->andWhere('sensor.system_id=' . Yii::app()->session['system_id'])
		->order('sensor.id')
		->queryAll();

	return isset($sData[0]) ? $sData[0] : '';
    }

    public function getSensorNameId() {
	$sData = Yii::app()->db->createCommand()
		->select('id,name')
		->from('sensor')
		->where('sensor.system_id=' . Yii::app()->session['system_id'])
		->order('sensor.id')
		->queryAll();
	$slist = array('' => 'None');
	foreach ($sData as $oneS) {
	    $slist[$oneS['id']] = $oneS['name'];
	}
	return $slist;
    }

}
