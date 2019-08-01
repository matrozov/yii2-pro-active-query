<?php

namespace matrozov\yii2paq;

use yii\base\Behavior;
use yii\base\InvalidCallException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class ProActiveQueryBehavior
 * @package matrozov\yii2paq
 *
 * @property ActiveQuery  $owner
 * @property ActiveRecord $activeRecordClass
 */
class ProActiveQueryBehavior extends Behavior
{
    public $activeRecordClass;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasMethod($name): bool
    {
        return method_exists($this->activeRecordClass, 'query' . $name);
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return ActiveQuery
     */
    public function __call($name, $params): ActiveQuery
    {
        if (!$this->hasMethod($name)) {
            throw new InvalidCallException('Unknown method!');
        }

        call_user_func_array([$this->activeRecordClass, 'query' . $name], array_merge([&$this->owner], $params));

        return $this->owner;
    }
}
