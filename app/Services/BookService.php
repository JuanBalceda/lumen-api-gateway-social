<?php


namespace App\Services;


use App\Traits\ConsumeExternalService;

class BookService
{
    use ConsumeExternalService;

    /**
     * The base uri to be used to consume the books service
     * @var string
     */
    public $base_uri;

    /**
     * The secret to be used to consume the books service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->base_uri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * Retrieve full list of books
     * @return string
     */
    public function findAll()
    {
        return $this->performRequest('GET', '/books');
    }

    /**
     * Create a new book
     * @param array $data
     * @return string
     */
    public function create($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * Retrieve book by id
     * @param int $idBook
     * @return string
     */
    public function findById($idBook)
    {
        return $this->performRequest('GET', "/books/{$idBook}");
    }

    /**
     * Update an book
     * @param array $data
     * @param int $idBook
     * @return string
     */
    public function update($data, $idBook)
    {
        return $this->performRequest('PUT', "/books/{$idBook}", $data);
    }

    /**
     * Update an book
     * @param int $idBook
     * @return string
     */
    public function delete($idBook)
    {
        return $this->performRequest('DELETE', "/books/{$idBook}");
    }

}
