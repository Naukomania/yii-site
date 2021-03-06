<?php

/**
 * This is the model class for table "characters".
 *
 * The followings are the available columns in table 'characters':
 * @property integer $characterId
 * @property string $characterName
 * @property integer $fandomId
 *
 * The followings are the available model relations:
 * @property Fandoms $fandom
 * @property CharactersFanfics[] $charactersFanfics
 */
class Characters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'characters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('characterName, fandomId', 'required'),
			array('fandomId', 'numerical', 'integerOnly'=>true),
			array('characterName', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('characterId, characterName, fandomId', 'safe', 'on'=>'search'),
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
			'fandom' => array(self::BELONGS_TO, 'Fandoms', 'fandomId'),
			'charactersFanfics' => array(self::HAS_MANY, 'CharactersFanfics', 'characterId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'characterId' => 'Character',
			'characterName' => 'Character Name',
			'fandomId' => 'Fandom',
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

		$criteria->compare('characterId',$this->characterId);
		$criteria->compare('characterName',$this->characterName,true);
		$criteria->compare('fandomId',$this->fandomId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Characters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
