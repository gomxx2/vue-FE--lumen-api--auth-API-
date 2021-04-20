<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function list_book(Request $request)
    {
        $input = $request->all();
        
        $users =auth()->user();
        $users = json_decode(json_encode($users),true);
        //  dd($users);

        $query=Book::get();
        $response =[
            'WITH USER'=>$users,
            'status' => 200,
            'message'=>'Ok',
            'data'=>$query->toArray()
        ];

        return response()->json($response,$response['status']);

    }
}
