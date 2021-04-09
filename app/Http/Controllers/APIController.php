<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registers;


class APIController extends Controller
{
    public function getData(Request $request)
    {
    		return registers::all();
    }

    public function add(Request $request)
    {
    		$request->validate([
                'f_name'        =>      'required',
                'l_name'        =>      'required',
                'email'         =>      'required|email|unique:registers',
                'password'      =>      'required|min:6',
                'phone_no'      =>      'required|max:10',
                'subscription'  =>      'required',
            ]);

    		$registers = new registers;
    		$registers->f_name = $request->f_name;
    		$registers->l_name = $request->l_name;
    		$registers->email = $request->email;
    		$registers->password = md5($request->password);
    		$registers->phone_no = $request->phone_no;
    		$registers->subscription = $request->subscription;
    		

    		$result = $registers->save();
    		if($result)
    		{
    			return ["result"=>"Data has been saved"];	
    		}else
    		{
    			return ["result"=>"Add Operation failed!"];
    		}

    		
    }


    public function update(Request $request)
    {
    	$registers = Registers::find($request->id);
    	$registers->f_name = $request->f_name;
    		$registers->l_name = $request->l_name;
    		$registers->email = $request->email;
    		$registers->password = md5($request->password);
    		$registers->phone_no = $request->phone_no;
    		$registers->subscription = $request->subscription;


    		$result = $registers->save();
    		if($result)
    		{
    			return ["result"=>"Data has been updated"];	
    		}else
    		{
    			return ["result"=>"Update Operation failed!"];
    		}
    }

    public function delete(Request $request)
    {
    	$registers = Registers::find($request->id);
    	$result = $registers->delete();
    	if($result)
    	{
    		return ["result"=>"Data has been deleted"];
    	}else
    	{
    		return ["result"=>"Delete operation failed!"];
    	}
    }

    public function upload(Request $request)
    {
    	
    	$request->validate([
        'image' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048|min:100'
        ]);

    	$request->file('image')->store('tests');
    }
}
