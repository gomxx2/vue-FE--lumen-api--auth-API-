<?php

namespace App\Http\Controllers;

use App\Calls;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

class CallsController extends Controller
{
    public function index()
    {
        $call = Calls::all();

        return response()->json([
            'success' => true,
            'message' => 'List Semua Post',
            'data'    => $call
        ], 200);
    }
    //change store_ori to store
    public function store(Request $request)
    {
        // $input = $request->all();
        // return $input;
        $validator = Validator::make($request->all(), [
            'subject'   => 'required',
            'status_call' => 'required',            
            'Parent_type' => 'required',
            'relate' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'kolom tertentu wajib diisi!',
                'data'   => $validator->errors()
            ], 401);
        } else {

            $call = Calls::create([
                'subject'     => $request->input('subject'),
                'Description'   => $request->input('Description'),                
                'status_call'   => $request->input('status_call'),
                'status_direction'   => $request->input('status_direction'),
                'Parent_type'   => $request->input('Parent_type'),
                'relate'   => $request->input('relate'),
                'start_date'   => $request->input('start_date'),
                'calls_owner'   => $request->input('calls_owner'),
                // 'id_contact'   => $request->input('id_contact')
            ]);

            if ($call) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                    'data' => $call
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Disimpan!',
                ], 400);
            }
        }
    }
    // store relation
    public function store_relation(Request $request)
    {
       $input_relasi= DB::table('relation_calls')->insert([
            'id_contact' => $request->input('id_contact'),
            'id_calls' =>$request->input('id_calls')
        ]);
        if ($input_relasi) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
                'data' => $input_relasi
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Disimpan!',
            ], 400);
        }
    }

    public function show($id)
    {
        $call= Calls::find($id);
        return $call;

        if ($call) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Post!',
                'data'      => $call
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
            ], 404);
        }
    }
    public function show_calls(Request $request)
    {
        $input = $request->all();
       
        $id = 0;
        //isset = bila $input[id] blm ada
        if(isset($input['id'])) {
            $id = $input['id'];
        }
        // $call= Calls::find($id);
        // return $call;
        $relation = DB::table('calls')
        ->join('relation_calls', 'calls.id', '=', 'relation_calls.id')             
            //nanti dimasukan melihat status pembayaran         
            ->select('calls.id',
                'relation_calls.id_contact',
                'relation_calls.id_calls',
                'calls.subject',    
                 'calls.Description',
                 'calls.status_call',
                 'calls.status_direction',
                 'calls.Parent_type',
                 'calls.relate',
                 'calls.start_date',
                 'calls_owner'
            )->where('id_contact', '=',$id)
            ->get();
        // return $relation;
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Post!',
            'data'      => $relation
        ], 200);
        return $relation;
    
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subject'   => 'required',
            'status_call' => 'required',            
            'Parent_type' => 'required',
            'relate' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ], 401);
        } else {

            $call = Calls::whereId($id)->update([
                'subject'     => $request->input('subject'),
                'Description'   => $request->input('Description'),                
                'status_call'   => $request->input('status_call'),
                'status_direction'   => $request->input('status_direction'),
                'Parent_type'   => $request->input('Parent_type'),
                'relate'   => $request->input('relate'),
                'start_date'   => $request->input('start_date'),
                'calls_owner'   => $request->input('calls_owner'),
                // 'id_contact'   => $request->input('id_contact')
            ]);

            if ($call) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Diupdate!',
                    'data' => $call
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Diupdate!',
                ], 400);
            }
        }
    }
    public function destroy($id)
    {
        $call= Calls::whereId($id)->first();
        $call->delete();

        if ($call) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        }
    }   
    public function deleteAllTimeline($id)
    {        
        $relation = DB::table('calls')
        ->join('relation_calls', 'calls.id', '=', 'relation_calls.id')             
            //nanti dimasukan melihat status pembayaran         
            ->select('calls.id',
                'relation_calls.id_contact',
                'relation_calls.id_calls',                
            )->where('id_contact', '=',$id)
            ->delete();
        // return $relation;
        return response()->json([
            'success'   => true,
            'message'   => 'Detail Post!',
            'data'      => $relation
        ], 200);
        return $relation;
    }   
}
