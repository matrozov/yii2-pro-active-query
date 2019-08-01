<?php

namespace matrozov\yii2paq;

use yii\db\ActiveQuery;

/**
 * Trait ProActiveQueryTrait
 * @package matrozov\yii2paq
 */
trait ProActiveQueryTrait
{
    /**
     * @return ActiveQuery
     */
    public static function find(): ActiveQuery
    {
        /** @var ActiveQuery $query */
        $query = parent::find();

        $query->attachBehavior('', [
            'class'             => ProActiveQueryBehavior::class,
            'activeRecordClass' => get_called_class(),
        ]);

        return $query;
    }
}
