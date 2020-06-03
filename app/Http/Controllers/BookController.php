<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(BookRequest $request)
    {
        $book = Book::create($request->all());
        Session::flash('success', 'add new success!');
        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($request->get('id'));
        $book->name = $request->get('name');
        $book->save();
        Session::flash('success', 'update success!');
        return redirect(route('books.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Request $request)
    {
        Book::findOrFail($request->get('id'))->delete();
        Session::flash('success', 'delete success!');
        return redirect(route('books.index'));
    }
}
