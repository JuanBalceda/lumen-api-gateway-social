<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponse;

    public $bookService;
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @param BookService $bookService
     * @param AuthorService $authorService
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return book list
     * @return Response
     */
    public function index()
    {
        return $this->successResponse($this->bookService->findAll());
    }

    /**
     * Create an instance of Book
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorService->findById($request->author_id);

        return $this->successResponse($this->bookService->create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Return an instance of Book
     * @param int $idBook
     * @return Response
     */
    public function show($idBook)
    {
        return $this->successResponse($this->bookService->findById($idBook));
    }

    /**
     * Update an specific book
     * @param Request $request
     * @param int $idBook
     * @return Response
     */
    public function update(Request $request, $idBook)
    {
        return $this->successResponse($this->bookService->update($request->all(), $idBook));
    }

    /**
     * Delete an instance of Book
     * @param int $idBook
     * @return Response
     */
    public function destroy($idBook)
    {
        return $this->successResponse($this->bookService->delete($idBook));
    }
}
