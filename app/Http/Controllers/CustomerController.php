<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function data(){
        $data  = DB::table('customers')->whereBetween('id', [1000, 1010])->get();
        $form = view("data", ['data' => $data]); 
        $darr=array('data'=>''.$form.''); 
        return response()->json($darr);
    }

    public function input(){
        $form = view("create"); 
        $darr=array('data'=>''.$form.''); 
        return response()->json($darr); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $postall = $request->all(); 
        $inputclear = \Arr::except($request->all(), array('_token', '_method')); 
        $email = $request->input('email'); 

        $cek = Customer::where('email', '=', $email)->count(); 
        if($cek) {
            return response()->json([
                'status' => false,
                'info' => "EMAIL Sudah ada di database"
            ], 201);
            return false;
        }

        $post = Customer::create($request->all()); 
        return response()->json([ 
            'status' => true,
            'info' => 'Success'
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique',
            'name' => 'required',
            'no_telp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
 
        $customer = Customer::create($request->all());
        return [
            "status" => true,
            "msg" => "Customer store successfully",
            "data" => $customer
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique',
            'name' => 'required',
            'no_telp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'message' => $validator->errors(),
                'success' => false
            ]);
        }
 
        $customer->update($request->all());
        return [
            "status" => true,
            "msg" => "Customer updated successfully",
            "data" => $customer
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return [
            "status" => 1,
            "data" => $customer,
            "msg" => "Customer deleted successfully"
        ];
    }
}
