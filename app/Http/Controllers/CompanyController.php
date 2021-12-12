<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Image;
class CompanyController extends Controller
{
    protected $model ; 
    public function __construct(Company $model)
    {
      $this->model = $model;
    }
    
    public function index()
    {
        $companies = Company::all();       
        return response()->json($companies);
    }
    public function store(Request $request)
    {
         if(!empty($request->id))
         {
          //in case of added
          $data = array();
          unset($request->id);
          $validation = $request->validate([  
            'name'=>'required',
           ]);
           if($request->logo!=0)
           {
              $position = strpos($request->logo,';');    
              $sub = substr($request->logo,0,$position);
              $ext = explode('/',$sub)[1];
              $name = time().'.'.$ext;
              $img = Image::make($request->logo)->resize(100,100);
              $path = 'uploads/company_logo/';
              $image_url = $path.$name;
              $img->save($image_url);
              $request['logo'] = $image_url;   
           }
           else
           {
            
             $request['logo'] = null;
           }
         if(!empty($request->logo))
         {
         $data['logo'] = $request->logo;
         } 
         $udata['name'] = $request->name;
         $udata['email'] = $request->email;
         $udata['website'] = $request->website;

        if($this->model->where('id',$request->id)->update($udata))
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
         else
         {
           //in case of added
           unset($request->id);
          $validation = $request->validate([  
            'name'=>'required|unique:companies',
           ]);
           if($request->logo)
           {
              $position = strpos($request->logo,';');    
              $sub = substr($request->logo,0,$position);
              $ext = explode('/',$sub)[1];
              $name = time().'.'.$ext;
              $img = Image::make($request->logo)->resize(100,100);
              $path = 'uploads/company_logo/';
              $image_url = $path.$name;
              $img->save($image_url);
              $request['logo'] = $image_url;
             
           }
           else
           {
            
             $request['logo'] = null;
           }
           
           if($this->model->insert($request->all()))
           {
             $this->sendInvitationEmail($request->email);
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
    function sendInvitationEmail($email)
    {
      Mail::to($email)->send(new WelcomeMail()); 
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
