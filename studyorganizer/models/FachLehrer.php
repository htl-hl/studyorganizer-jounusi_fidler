<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "FachLehrer".
 *
 * @property int $FachID
 * @property int $LehrerID
 * @property string|null $ZugewiesenAm
 *
 * @property Fach $fach
 * @property Lehrer $lehrer
 */
class FachLehrer extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'FachLehrer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FachID', 'LehrerID'], 'required'],
            [['FachID', 'LehrerID'], 'integer'],
            [['ZugewiesenAm'], 'safe'],
            [['FachID', 'LehrerID'], 'unique', 'targetAttribute' => ['FachID', 'LehrerID']],
            [['FachID'], 'exist', 'skipOnError' => true, 'targetClass' => Fach::class, 'targetAttribute' => ['FachID' => 'FachID']],
            [['LehrerID'], 'exist', 'skipOnError' => true, 'targetClass' => Lehrer::class, 'targetAttribute' => ['LehrerID' => 'LehrerID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FachID' => Yii::t('app', 'Fach ID'),
            'LehrerID' => Yii::t('app', 'Lehrer ID'),
            'ZugewiesenAm' => Yii::t('app', 'Zugewiesen Am'),
        ];
    }

    /**
     * Gets query for [[Fach]].
     *
     * @return \yii\db\ActiveQuery|FachQuery
     */
    public function getFach()
    {
        return $this->hasOne(Fach::class, ['FachID' => 'FachID']);
    }

    /**
     * Gets query for [[Lehrer]].
     *
     * @return \yii\db\ActiveQuery|LehrerQuery
     */
    public function getLehrer()
    {
        return $this->hasOne(Lehrer::class, ['LehrerID' => 'LehrerID']);
    }

    /**
     * {@inheritdoc}
     * @return FachLehrerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FachLehrerQuery(get_called_class());
    }

}
