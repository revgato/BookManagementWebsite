<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::all();

        return response()->json($books, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $book = Books::create($request->all());

        return $book;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Books::where('id', '=', $id)->get();

        // echo $book[0]->tittle;

        if ($book != null) {
            return response()->json($book, 200);
        } else {
            return response()->json(['Can not get book', 400]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $book = Books::find($id);
        if ($book == null) {
            return response()->json(['Cant find this book to edit', 400]);
        } else {
            // echo $request->quantity;
            $book->update(['quantity' => $request->quantity]);
            return response()->json(['Updated successful', 200]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Books::find($id);
        if ($book == null) {
            return response()->json(['Cant find this book to edit', 400]);
        } else {
            // var_dump($request->all());
            // echo array($request->all());
            if($book->update($request->all()) == true) {
                return response()->json(['Updated successful', 200]);
            } else {
                return response()->json(['Updated failed', 400]);
            };
            // return $book;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Books::destroy($id);

        if ($book != null) {
            return response()->json(['Deleted successful!', 200]);
        } else {
            return response()->json(['Delete failed!', 400]);
        }
    }
}