<?php


namespace App\Http\Controllers\CategoryArticle;


use App\Http\Controllers\Controller;
use App\Services\CategoryArticle\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
