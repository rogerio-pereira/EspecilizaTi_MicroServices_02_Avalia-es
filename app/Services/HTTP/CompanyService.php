<?php

namespace App\Services\HTTP;

use RogerioPereira\EspecializatiMicroserviceCommon\Services\Traits\ConsumeExternalService;

class CompanyService
{
    use ConsumeExternalService;

    protected $url;
    protected $token;

    public function __construct()
    {
        $this->url = config('services.micro_01.url');
        $this->token = config('services.micro_01.token');
    }

    public function getCompany(string $company)
    {
        //Metodo request está dentro da trait ConsumeExternalService
        return $this->request('get', "/companies/{$company}");
    }
}
