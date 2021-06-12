<?php


namespace App\Http\Controllers\News;


use App\Http\Controllers\Controller;
use App\Services\News\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
