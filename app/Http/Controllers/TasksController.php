<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Sub_task;
use DB;


class TasksController extends Controller
{
    
    public function get_tasks(Request $request)
    {


         $data = Task::OrderBy('due_date','asc');
         if($request->title!=""){
            $data->whereLike('title',$request->title);
         }
        return $data->paginate(10);
    }
    public function get_sub_tasks(Request $request)
    {
        
         $data = Sub_task::OrderBy('due_date','asc');
         $data->where('task_id', $request->id);
         return $data->paginate(10);
     }

    public function create_task( Request $request)
    {

        $Task = new Task;
        $Task->title = $request->input('title');
        $Task->description = $request->input('description');
        $Task->status = $request->input('status');
        $Task->due_date = $request->input('due_date');
        $Task->save();

        return "Task Creation Successfully";
    }
    public function create_sub_task( Request $request)
    {

        $sub_Task = new Sub_task;
        $sub_Task->task_id = $request->input('task_id');
        $sub_Task->title = $request->input('title');
        $sub_Task->description = $request->input('description');
        $sub_Task->status = $request->input('status');
        $sub_Task->due_date = $request->input('due_date');
        $sub_Task->save();

        return "Sub Task Creation Successfully";

    }
    public function update_task( Request $request)
    {
        $Task = Task::withTrashed()->find($request->id);
        $Task->status = $request->input('status');
        $Task->save();
        
        if($request->input('status')=='Completed'){
            DB::table('sub_tasks')->where('task_id', $request->id)->update(array('status'=>'Completed'));
        }

        return "Task status changed Successfully";
    }


    public function update_sub_task( Request $request)
    {

        $sub_Task = sub_Task::find($request->id);
        $sub_Task->status = $request->input('status');
        $sub_Task->save();

        return "Sub Task status changed Successfully";
    }

     public function delete_task( Request $request)
    {
        $Task = Task::find($request->id);
        $Task->delete();

        return "Task deleted Successfully";
    }

    public function delete_sub_task( Request $request)
    {
        $Task = Sub_task::find($request->id);
        $Task->delete();

        return "sub Task deleted Successfully";
    }


    public function delete_scheduler( )
    {
        DB::table('tasks')->where('deleted_at', '<', date('Y-m-d H:i:s',strtotime('-30 days')))->delete();
         DB::table('sub_tasks')->where('deleted_at', '<', date('Y-m-d H:i:s',strtotime('-30 days')))->delete();
     return "Old Tasks/subtasks deleted Successfully";

    }

}
