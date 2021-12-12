<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    protected $model ; 
    public function __construct(Employee $model)
    {
      $this->model = $model;
    }
    
    public function index()
    {
      
        $employees = $this->model->with('companies')->get();  
         
        return response()->json($employees);
    }
    public function store(Request $request)
    {
         if(!empty($request->id))
         {
          //in case of added
          $data = array();
          unset($request->id);
          $validation = $request->validate([  
            'first_name'=>'required',
            'last_name'=>'required',
           ]);
      
         
         $udata['first_name'] = $request->first_name;
         $udata['last_name'] = $request->last_name;
         $udata['email'] = $request->email;
         $udata['phone'] = $request->phone;
         $udata['company_id'] = $request->company_id;

        if($this->model->where('id',$request->id)->update($udata))
        {
         
         $data['status'] = 200;
         $data['message'] = 'Successfully updated';
        }
        else
        {
         $data['status'] = 401;
         $data['message'] = 'Something Went to Wrong';
        }

         }
         else
         {
           //in case of added
           unset($request->id);
           $validation = $request->validate([  
            'first_name'=>'required',
            'last_name'=>'required',
           ]);  
           if($this->model->insert($request->all()))
           {
             $data['status'] = 200;
             $data['message'] = 'Successfully Saved';
           }
           else
           {
             $data['status'] = 401;
             $data['message'] = 'Something Went to Wrong';
           }
         }
         
         return response()->json($data);
      
    }

    public function show($id)
    {
        $data = $this->model->where('id',$id)->get()[0];
        return response()->json($data);
    }


  

    public function destroy($id)
    {
        $company=$this->model->find($id);
     
        if($company->delete())
        {
          unlink($company->logo);
          $data['status'] = 200;
          $data['message'] = 'successfully Delete';
        }
        else
        {
          $data['status'] = 401;
          $data['message'] = 'Error in Deletion';
        }
        return response()->json($data);
    }
  
}
