<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Api\V1\Model;

class CommonTransformer extends TransformerAbstract
{
    public function transform($data)
    {
        return $data; //simplified
    }
}

