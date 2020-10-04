<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponse;

    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @param AuthorService $authorService
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return author list
     * @return string
     */
    public function index()
    {
        return $this->successResponse($this->authorService->findAll());
    }

    /**
     * Create an instance of Author
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Return an instance of Author
     * @param int $idAuthor
     * @return Response
     */
    public function show($idAuthor)
    {
        return $this->successResponse($this->authorService->findById($idAuthor));
    }

    /**
     * Update an specific author
     * @param Request $request
     * @param int $idAuthor
     * @return Response
     */
    public function update(Request $request, $idAuthor)
    {
        return $this->successResponse($this->authorService->update($request->all(), $idAuthor));
    }

    /**
     * Delete an instance of Author
     * @param int $idAuthor
     * @return Response
     */
    public function destroy($idAuthor)
    {
        return $this->successResponse($this->authorService->delete($idAuthor));
    }
}
