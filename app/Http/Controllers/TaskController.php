<?php

namespace App\Http\Controllers;

use App\Events\TaskUpdating;
use App\Exceptions\ForbiddenException;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Role;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * @throws ForbiddenException
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $user = auth()->user();

        if ($user && $user->roles->where('id', Role::ADMIN)->count()) {
            event(new TaskUpdating($task, $request->validated()));
        } else {
            throw new ForbiddenException('Не достаточно прав.');
        }
    }
}
