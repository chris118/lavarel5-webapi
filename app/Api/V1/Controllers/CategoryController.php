<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Model\Category;
use App\Api\V1\Transformers\CommonTransformer;
use App\Api\V1\Serializers\CustomSerializer;

class CategoryController extends BaseController
{
    public function index()
    {
       $categories = Category::all();
        if($categories == null)
        {
            return $this->response->errorNotFound();
        }
        
        return $this->response->collection($categories, new CommonTransformer());       

//        return $this->response->collection($categories, new CommonTransformer(), function ($resource, $fractal) {
//            $fractal->setSerializer(new CustomSerializer());
//        });
    }
}
