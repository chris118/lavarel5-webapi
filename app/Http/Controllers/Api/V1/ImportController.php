<?php

namespace App\Http\Controllers\Api\V1;

use App\Import;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
    use Helpers;
    
    public function index()
    {
        //http://laravel.dev/api/imports?page=3
        $imports = Import::paginate();
        return $this->response->array($imports->toArray());
    }
}
