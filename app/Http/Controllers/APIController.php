<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registers;
use Validator;
use response;
use File;

class APIController extends Controller
{
    public function getData(Request $request)
    {
    		return registers::all();
    }

    public function testData(Request $request)
    {
     $rules=array(
     	 'f_name'         =>      'required',
     	 'l_name'         =>      'required',
         'email'          =>      'required|email|unique:registers',
         'password'       =>      'required|min:6',
         'phone_no'       =>      'required|min:10|max:10',
         'subscription'   =>      'required',
         'gender'         =>      'required',
         'subject'        =>      'required',
         'date'           =>      'required|date',
         'age'            =>      'required|numeric',
         'image'          =>      'required',
         
     );
     $validator = Validator::make($request->all(),$rules);
     if($validator->fails()) 	
     {
     	//return $validator->errors();
     	
     	return response()->json($validator->errors(),401);
     }else
     {
     		$registers = new registers;
    		$registers->f_name = $request->f_name;
    		$registers->l_name = $request->l_name;
    		$registers->email = $request->email;
    		$registers->password = md5($request->password);
    		$registers->phone_no = $request->phone_no;
    		$registers->subscription = $request->subscription;
    		$registers->gender = $request->gender;
    		$registers->subject = $request->subject;
    		$registers->date = $request->date;
    		$registers->age = $request->age;
    		$registers->image = $request->image;
    		

    		$result = $registers->save();
    		if($result)
    		{
    			//return ["result"=>"Data has been saved"];	
    			
				  $returnData = array(
				    'success' => 'true',
				    'message' => 'Data saved successfully',
				    'message_code' => '2004',
				    'data' => array(
				    	'status' => 'COMPLETED',
				    	'session' =>'SET'
					)
				    //'status'=>"COMPLETED"   
				);
				return response()->json($returnData, 200);
				
			}

    		}
     }


    public function update(Request $request)
    {
    	$rules=array(
     	 'f_name'         =>      'required',
     	 'l_name'         =>      'required',
         'email'          =>      'required|email|unique:registers',
         'password'       =>      'required|min:6',
         'phone_no'       =>      'required|min:10|max:10',
         'subscription'   =>      'required',
         'gender'         =>      'required',
         'subject'        =>      'required',
         'date'           =>      'required|date',
         'age'            =>      'required|numeric',
         'image'          =>      'required',
         
     );
     $validator = Validator::make($request->all(),$rules);
     if($validator->fails()) 	
     {
     	//return $validator->errors();
     	
     	return response()->json($validator->errors(),401);
     }else
     {
    	$registers = Registers::find($request->id);

    		$registers->f_name = $request->f_name;
    		$registers->l_name = $request->l_name;
    		$registers->email = $request->email;
    		$registers->password = md5($request->password);
    		$registers->phone_no = $request->phone_no;
    		$registers->subscription = $request->subscription;
    		$registers->gender = $request->gender;
    		$registers->subject = $request->subject;
    		$registers->date = $request->date;
    		$registers->age = $request->age;
    		$registers->image = $request->image;


    		$result = $registers->save();
    		if($result)
    		{
    			//return ["result"=>"Data has been saved"];	
    			
				  $returnData = array(
				    'success' => 'true',
				    'message' => 'Data updated successfully',
				    'message_code' => '2005',
				    'data' => array(
				    	'status' => 'COMPLETED',
				    	'session' =>'SET'
					)   
				);
				return response()->json($returnData, 200);
				
			}
		}
    }

    public function delete(Request $request)
    {
    	$registers = Registers::find($request->id);
    	$result = $registers->delete();
    	if($result)
    		{
    			//return ["result"=>"Data has been saved"];	
    			
				  $returnData = array(
				    'success' => 'true',
				    'message' => 'Data deleted successfully',
				    'message_code' => '2006',
				    'status'=>"COMPLETED"   
				);
				return response()->json($returnData, 200);
				
			}
    }

    public function upload(Request $request)
    {
       	
    	 $rules=array(
     	 'file' => 'required|mimes:csv,txt,xlx,xls,pdf,jpg,jpeg',   
     );
     $validator = Validator::make($request->all(),$rules);
     if($validator->fails()) 	
     {
     	//return $validator->errors();
     	
     	return response()->json($validator->errors(),401);
     }else
     {
     	$result = $request->file('file')->store('tests');
     	$returnData = array(
				    'success' => 'true',
				    'message' => 'File uploaded successfully',
				    'message_code' => '2006',
				    'status'=>"COMPLETED"   
				);
				return response()->json($returnData, 200);
     	
     }
    }


    
}

