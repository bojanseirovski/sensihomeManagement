<?php

/**
 * This is the model class for table "actuator".
 *
 * The followings are the available columns in table 'actuator':
 * @property integer $aid
 * @property string $type
 * @property string $state
 * @property string $name
 * @property string $com_id
 * @property integer $system_id
 * @property string $date_created
 * @property string $value_fields
 * @property string $serial
 */
class Actuator extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'actuator';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, state, name, date_created, value_fields, serial', 'required'),
            array('system_id', 'numerical', 'integerOnly' => true),
            array('type, state, name, com_id, serial', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('aid, type, state, name, com_id, system_id, date_created, value_fields, serial', 'safe', 'on' => 'search'),
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
            'aid' => 'Aid',
            'type' => 'Type',
            'state' => 'State',
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

        $criteria->compare('aid', $this->aid);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('state', $this->state, true);
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
     * @return Actuator the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getAll($offset = 0, $page = 25, $id = null) {
        $filterOne = '';
        if (isset($id)) {
            $filterOne = 'AND `actuator`.`aid`=' . $id . '  ';
        }

        $qry = 'SELECT * FROM `actuator` '
                . 'JOIN `actuator_type` ON `actuator_type`.`id`=`actuator`.`type` '
                . 'WHERE `actuator`.`system_id`=' . Yii::app()->session['system_id'] . ' '
                . $filterOne
                . 'ORDER BY `actuator`.`aid` ASC '
                . 'LIMIT ' . $offset . ',' . $page . ' ;';
        return Yii::app()->
                        db->
                        createCommand($qry)->
                        queryAll();
    }

    public static function getData($offset = 0, $page = 25, $id = null) {
        $filterOne = '';
        if (isset($id)) {
            $filterOne = 'AND `measurement`.sensor_id=' . $id . '  ';
        }

        $qry = 'SELECT * FROM `actuator` '
                . 'JOIN `actuator_type` ON actuator_type.id=actuator.type '
                . 'JOIN `measurement` ON `measurement`.sensor_id=`actuator`.aid '
                . 'WHERE `measurement`.sensor=0 '
                . 'AND actuator.system_id=' . Yii::app()->session['system_id'] . ' '
                . $filterOne
                . 'ORDER BY `measurement`.`id` ASC '
                . 'LIMIT ' . $offset . ',' . $page . ' ;';
        return Yii::app()->
                        db->
                        createCommand($qry)->
                        queryAll();
    }

    public function getActuatorNameIdType($sid) {
        $sData = Yii::app()->db->createCommand()
                ->from('actuator')
                ->join('actuator_type', 'actuator_type.id=actuator.type')
                ->where('actuator.aid=' . $sid)
                ->andWhere('actuator.system_id=' . Yii::app()->session['system_id'])
                ->queryAll();

        return isset($sData[0]) ? $sData[0] : '';
    }

    public function getActuatorNameId() {
        $sData = Yii::app()->db->createCommand()
                ->from('actuator')
                ->where('actuator.system_id=' . Yii::app()->session['system_id'])
                ->order("actuator.aid")
                ->queryAll();

        $slist = array('' => 'None');
        foreach ($sData as $oneS) {
            $slist[$oneS['aid']] = $oneS['name'];
        }
        return $slist;
    }

}
