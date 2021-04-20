<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $posts = Contact::all();

        return response()->json([
            'success' => true,
            'message' => 'List Semua Post',
            'data'    => $posts
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'salutation'   => 'required',
            'first_name' => 'required',            
            'email' => 'required|email',
            'mobile_numb' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ], 401);
        } else {

            $post = Contact::create([
                'salutation'     => $request->input('salutation'),
                'first_name'   => $request->input('first_name'),                
                'email'   => $request->input('email'),
                'mobile_numb'   => $request->input('mobile_numb'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                    'data' => $post
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Disimpan!',
                ], 400);
            }
        }
    }
    public function show($id)
    {
        $post = Contact::find($id);

        if ($post) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Post!',
                'data'      => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'salutation'   => 'required',
            'first_name' => 'required',            
            'email' => 'required',
            'mobile_numb' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ], 401);
        } else {

            $post = Contact::whereId($id)->update([
                'salutation'     => $request->input('salutation'),
                'first_name'   => $request->input('first_name'),                
                'email'   => $request->input('email'),
                'mobile_numb'   => $request->input('mobile_numb'),
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Diupdate!',
                    'data' => $post
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
        $post = Contact::whereId($id)->first();
        $post->delete();

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Dihapus!',
            ], 200);
        }
    }
}
