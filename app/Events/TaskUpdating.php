<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Queue\SerializesModels;

class TaskUpdating
{
    use SerializesModels;

    public array $data;

    public function __construct(Task $task, array $data)
    {
        $this->data = $data;
        $this->task = $task;
    }
}
