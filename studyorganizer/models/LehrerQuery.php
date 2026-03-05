<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Lehrer]].
 *
 * @see Lehrer
 */
class LehrerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Lehrer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lehrer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
