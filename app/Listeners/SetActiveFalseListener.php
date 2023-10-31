<?php

namespace App\Listeners;

use App\Events\TaskUpdating;

class SetActiveFalseListener
{
    public function handle(TaskUpdating $event): void
    {
        $event->data['active'] = 0;
        $event->task->update($event->data);
    }
}
