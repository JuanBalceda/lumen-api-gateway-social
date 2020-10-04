<?php


namespace App\Services;


use App\Traits\ConsumeExternalService;

class AuthorService
{
    use ConsumeExternalService;

    /**
     * The base url to be used to consume the authors service
     * @var string
     */
    public $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.authors.baseUrl');
    }
}
