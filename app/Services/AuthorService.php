<?php


namespace App\Services;


use App\Traits\ConsumeExternalService;

class AuthorService
{
    use ConsumeExternalService;

    /**
     * The base uri to be used to consume the authors service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.baseUri');
        $this->secret = config('services.authors.secret');
    }

    /**
     * Retrieve full list of authors
     * @return string
     */
    public function findAll()
    {
        return $this->performRequest('GET', '/authors');
    }

    /**
     * Create a new author
     * @param array $data
     * @return string
     */
    public function create($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * Retrieve author by id
     * @param int $idAuthor
     * @return string
     */
    public function findById($idAuthor)
    {
        return $this->performRequest('GET', "/authors/{$idAuthor}");
    }

    /**
     * Update an author
     * @param array $data
     * @param int $idAuthor
     * @return string
     */
    public function update($data, $idAuthor)
    {
        return $this->performRequest('PUT', "/authors/{$idAuthor}", $data);
    }

    /**
     * Update an author
     * @param int $idAuthor
     * @return string
     */
    public function delete($idAuthor)
    {
        return $this->performRequest('DELETE', "/authors/{$idAuthor}");
    }

}
