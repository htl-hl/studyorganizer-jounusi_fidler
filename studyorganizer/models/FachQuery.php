<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Fach]].
 *
 * @see Fach
 */
class FachQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Fach[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Fach|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
