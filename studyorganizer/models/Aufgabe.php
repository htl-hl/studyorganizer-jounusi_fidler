<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Aufgabe".
 *
 * @property int $AufgabeID
 * @property string $Titel
 * @property string|null $Beschreibung
 * @property string $DueDate
 * @property int $Finished
 * @property int $UserID
 * @property int $FachID
 *
 * @property Fach $fach
 * @property User $user
 */
class Aufgabe extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Aufgabe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Beschreibung'], 'default', 'value' => null],
            [['Finished'], 'default', 'value' => 0],
            [['Titel', 'DueDate', 'UserID', 'FachID'], 'required'],
            [['Beschreibung'], 'string'],
            [['DueDate'], 'safe'],
            [['Finished', 'UserID', 'FachID'], 'integer'],
            [['Titel'], 'string', 'max' => 200],
            [['UserID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['UserID' => 'UserID']],
            [['FachID'], 'exist', 'skipOnError' => true, 'targetClass' => Fach::class, 'targetAttribute' => ['FachID' => 'FachID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AufgabeID' => Yii::t('app', 'Aufgabe ID'),
            'Titel' => Yii::t('app', 'Titel'),
            'Beschreibung' => Yii::t('app', 'Beschreibung'),
            'DueDate' => Yii::t('app', 'Due Date'),
            'Finished' => Yii::t('app', 'Finished'),
            'UserID' => Yii::t('app', 'User ID'),
            'FachID' => Yii::t('app', 'Fach ID'),
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['UserID' => 'UserID']);
    }

    /**
     * {@inheritdoc}
     * @return AufgabeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AufgabeQuery(get_called_class());
    }

    /**
     * Gibt die Farbe basierend auf dem Fälligkeitsdatum zurück
     * - >= 2 Wochen => keine Farbe (standard)
     * - < 2 Wochen, >= 1 Woche => blau
     * - < 1 Woche => gelb
     * - < 1 Tag => rot
     */
    public function getDueDateColor()
    {
        if ($this->Finished) {
            return 'success'; // Grün für erledigte Aufgaben
        }

        $now = new \DateTime();
        $dueDate = new \DateTime($this->DueDate);
        $diff = $now->diff($dueDate);
        $days = (int)$diff->format('%r%a'); // Mit Vorzeichen

        if ($days < 1) {
            return 'danger'; // Rot
        } elseif ($days < 7) {
            return 'warning'; // Gelb
        } elseif ($days < 14) {
            return 'primary'; // Blau
        } else {
            return ''; // Keine spezielle Farbe
        }
    }

    /**
     * Gibt den CSS-Klassen-String für Bootstrap zurück
     */
    public function getDueDateBadgeClass()
    {
        $color = $this->getDueDateColor();
        return $color ? "badge bg-{$color}" : '';
    }

}
