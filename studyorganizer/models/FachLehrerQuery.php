<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FachLehrer]].
 *
 * @see FachLehrer
 */
class FachLehrerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FachLehrer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FachLehrer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
