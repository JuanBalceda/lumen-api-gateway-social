<?php


namespace App\Services;


use App\Traits\ConsumeExternalService;

class BookService
{
    use ConsumeExternalService;

    /**
     * The base url to be used to consume the books service
     * @var string
     */
    public $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.books.baseUrl');
    }
}
