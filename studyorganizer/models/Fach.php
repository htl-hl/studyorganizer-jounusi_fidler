<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Fach".
 *
 * @property int $FachID
 * @property string $Fachname
 * @property string|null $Beschreibung
 *
 * @property Aufgabe[] $aufgabes
 * @property FachLehrer[] $fachLehrers
 * @property Lehrer[] $lehrers
 */
class Fach extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Fach';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Beschreibung'], 'default', 'value' => null],
            [['Fachname'], 'required'],
            [['Beschreibung'], 'string'],
            [['Fachname'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FachID' => Yii::t('app', 'Fach ID'),
            'Fachname' => Yii::t('app', 'Fachname'),
            'Beschreibung' => Yii::t('app', 'Beschreibung'),
        ];
    }

    /**
     * Gets query for [[Aufgabes]].
     *
     * @return \yii\db\ActiveQuery|AufgabeQuery
     */
    public function getAufgabes()
    {
        return $this->hasMany(Aufgabe::class, ['FachID' => 'FachID']);
    }

    /**
     * Gets query for [[FachLehrers]].
     *
     * @return \yii\db\ActiveQuery|FachLehrerQuery
     */
    public function getFachLehrers()
    {
        return $this->hasMany(FachLehrer::class, ['FachID' => 'FachID']);
    }

    /**
     * Gets query for [[Lehrers]].
     *
     * @return \yii\db\ActiveQuery|LehrerQuery
     */
    public function getLehrers()
    {
        return $this->hasMany(Lehrer::class, ['LehrerID' => 'LehrerID'])->viaTable('FachLehrer', ['FachID' => 'FachID']);
    }

    /**
     * {@inheritdoc}
     * @return FachQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FachQuery(get_called_class());
    }

}
