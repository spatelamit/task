<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Sub_task;
use DB;
use Validator;
use Carbon\Carbon;



class TasksController extends Controller
{
    
    public function get_tasks(Request $request)
    {
        DB::enableQueryLog();
        $validated = Validator::make($request->all(), [ 
            'due_date' => 'in:Today,This Week',
        ]);

        if(!$validated->fails())
        {

         $data = Task::OrderBy('due_date','asc');
         if($request->title!=""){

            $data->whereLike('title',$request->title);
         }
         if($request->due_date!=""){

            if($request->due_date=="Today"){
              $data->where('due_date', date('Y-m-d'));
            }
            elseif($request->due_date=="This Week"){
                $now = Carbon::now();
               $data->whereBetween('due_date', 
                [$now->startOfWeek()->format('Y-m-d'),  
                $now->endOfWeek()->format('Y-m-d')]
            );  
             }
         }
          return $data->paginate(10);
        //return DB::getQueryLog();
        }
        return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
        ], 403);
        
    }


    public function get_sub_tasks(Request $request)
    {
      $validated = Validator::make($request->all(), [ 
            'id' => 'required'
        ]);

        if(!$validated->fails())
        {
        
        return $data = Sub_task::where('task_id', $request->id)->OrderBy('due_date','asc')
         ->paginate(10);
        

        }
        return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
        ], 403);

     }

    public function create_task( Request $request)
    {
        $validated = Validator::make($request->all(), [ 
            'title' => 'required|string|min:4',
            'description' => 'required|string|min:10',
            'status' => 'required|in:Pending',
            'due_date' => 'required|date',
        ]);

        if(!$validated->fails())
        {
            $Task = new Task;
            $Task->title = $request->input('title');
            $Task->description = $request->input('description');
            $Task->status = $request->input('status');
            $Task->due_date = $request->input('due_date');
            $Task->save();
             return response()->json([
                        'message' => 'Task added Successfully',
                        'status' => 200,
                    ], 200);
        }
        return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
        ], 403);

    }
    public function create_sub_task( Request $request)
    {
        $validated = Validator::make($request->all(), [ 
            'title' => 'required|string|min:4',
            'task_id' => 'required|integer',
            'description' => 'required|string|min:10',
            'status' => 'required|in:Pending',
            'due_date' => 'required|date',
        ]);

        if(!$validated->fails())
        {
            $sub_Task = new Sub_task;
            $sub_Task->task_id = $request->input('task_id');
            $sub_Task->title = $request->input('title');
            $sub_Task->description = $request->input('description');
            $sub_Task->status = $request->input('status');
            $sub_Task->due_date = $request->input('due_date');
            $sub_Task->save();
             return response()->json([
                        'message' => 'sub Task added Successfully',
                        'status' => 200,
                    ], 200);
        }
        return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
        ], 403);


    }
    public function update_task( Request $request)
    {
        $validated = Validator::make($request->all(), [ 
            'id' => 'required|integer',
            'status' => 'required|in:Completed'
        ]);

            if(!$validated->fails())
            {

            $Task = Task::withTrashed()->find($request->id);
            $Task->status = $request->input('status');
            $Task->save();
            
            if($request->input('status')=='Completed'){
                DB::table('sub_tasks')->where('task_id', $request->id)->update(array('status'=>'Completed'));
            }
            return response()->json([
                        'message' => 'Task status changed Successfully',
                        'status' => 200,
                    ], 200);
        }
        return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
        ], 403);


    }


    public function update_sub_task( Request $request)
    {
         $validated = Validator::make($request->all(), [ 
            'id' => 'required|integer',
            'status' => 'required|in:Completed'
        ]);

            if(!$validated->fails())
            {
                $sub_Task = sub_Task::find($request->id);
                $sub_Task->status = $request->input('status');
                $sub_Task->save();
                 return response()->json([
                        'message' => 'Sub Task status changed Successfully',
                        'status' => 200,
                    ], 200);
        }
        return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
        ], 403);

    }

     public function delete_task( Request $request)
    {
        $validated = Validator::make($request->all(), [ 
            'id' => 'required|integer'
        ]);

            if(!$validated->fails())
            {
            $Task = Task::find($request->id);
            $Task->delete();
            return response()->json([
                            'message' => 'Task deleted Successfully',
                            'status' => 200,
                        ], 200);
        }
        return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
        ], 403);

    }

    public function delete_sub_task( Request $request)
    {
         $validated = Validator::make($request->all(), [ 
            'id' => 'required|integer'
        ]);

            if(!$validated->fails())
            {
        $Task = Sub_task::find($request->id);
        $Task->delete();

        return response()->json([
                            'message' => 'Sub Task deleted Successfully',
                            'status' => 200,
                        ], 200);
        }
        return response()->json([
            'message' => $validated->errors(),
            'status' => 403,
        ], 403);
    }


    public function delete_scheduler( )
    {
        DB::table('tasks')->where('deleted_at', '<', date('Y-m-d H:i:s',strtotime('-30 days')))->delete();
         DB::table('sub_tasks')->where('deleted_at', '<', date('Y-m-d H:i:s',strtotime('-30 days')))->delete();
     return "Old Tasks/subtasks deleted Successfully";

    }

}
