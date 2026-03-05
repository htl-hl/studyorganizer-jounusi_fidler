<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Aufgabe]].
 *
 * @see Aufgabe
 */
class AufgabeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Aufgabe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Aufgabe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
