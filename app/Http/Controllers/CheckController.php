<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function check(Request $request)
    {
        $task = Task::find($request->id);

        if($request->val == 'true'){
            $task->update(['status' => 1]);

            $data = [
                'status' => 'success',
                'message' => 'Task Finish',
            ];
        }else{
            $task->update(['status' => 0]);

            $data = [
                'status' => 'success',
                'message' => 'Task not finish',
            ];
        }

        return response()->json($data);
    }
}
