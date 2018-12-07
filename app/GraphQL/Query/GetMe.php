<?php

namespace App\GraphQL\Query;

use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class GetMe extends Query
{
    protected $attributes = [
        'name' => 'getMe',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        return auth()->user();
    }
}