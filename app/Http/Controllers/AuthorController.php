<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
    }

    /**
     * Create an instance of Author
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
    }

    /**
     * Return an instance of Author
     * @param int $idAuthor
     * @return void
     */
    public function show($idAuthor)
    {
    }

    /**
     * Update an specific author
     * @param Request $request
     * @param int $idAuthor
     * @return void
     */
    public function update(Request $request, $idAuthor)
    {

    }

    /**
     * Delete an instance of Author
     * @param int $idAuthor
     * @return void
     */
    public function destroy($idAuthor)
    {
    }
}
