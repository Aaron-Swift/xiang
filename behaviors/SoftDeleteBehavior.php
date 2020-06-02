<?php

namespace xiang\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * soft delete behavior
 */
class SoftDeleteBehavior extends Behavior
{
    /**
     * @var string the attribute that will receive timestamp value
     */
    public $deletedAtAttribute = 'deleted_at';

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'softDelete',
        ];
    }

    /**
     * soft delete behavior
     * @param Event $event
     */
    public function softDelete($event)
    {
        // set timestamp
        $this->owner->setAttribute($this->deletedAtAttribute, time());
        $this->owner->save(false);
        
        // set soft delete 
        $event->isValid = false;
    }

    /**
     * force delete 
     */
    public function forceDelete()
    {
        // detach behavoir
        $this->detach();
        // force delete
        $this->owner->delete();
    }
}
