<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiResponse;

    public $bookService;

    /**
     * Create a new controller instance.
     *
     * @param BookService $bookService
     * @return void
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Return book list
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
    }

    /**
     * Create an instance of Book
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
    }

    /**
     * Return an instance of Book
     * @param int $idBook
     * @return void
     */
    public function show($idBook)
    {
    }

    /**
     * Update an specific book
     * @param Request $request
     * @param int $idBook
     * @return void
     */
    public function update(Request $request, $idBook)
    {
    }

    /**
     * Delete an instance of Book
     * @param int $idBook
     * @return void
     */
    public function destroy($idBook)
    {
    }
}
