<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Lehrer".
 *
 * @property int $LehrerID
 * @property string $Name
 * @property string $Email
 * @property int $IsActive
 *
 * @property FachLehrer[] $fachLehrers
 * @property Fach[] $faches
 */
class Lehrer extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Lehrer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IsActive'], 'default', 'value' => 1],
            [['Name', 'Email'], 'required'],
            [['IsActive'], 'integer'],
            [['Name', 'Email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LehrerID' => Yii::t('app', 'Lehrer ID'),
            'Name' => Yii::t('app', 'Name'),
            'Email' => Yii::t('app', 'Email'),
            'IsActive' => Yii::t('app', 'Is Active'),
        ];
    }

    /**
     * Gets query for [[FachLehrers]].
     *
     * @return \yii\db\ActiveQuery|FachLehrerQuery
     */
    public function getFachLehrers()
    {
        return $this->hasMany(FachLehrer::class, ['LehrerID' => 'LehrerID']);
    }

    /**
     * Gets query for [[Faches]].
     *
     * @return \yii\db\ActiveQuery|FachQuery
     */
    public function getFaches()
    {
        return $this->hasMany(Fach::class, ['FachID' => 'FachID'])->viaTable('FachLehrer', ['LehrerID' => 'LehrerID']);
    }

    /**
     * {@inheritdoc}
     * @return LehrerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LehrerQuery(get_called_class());
    }

}
