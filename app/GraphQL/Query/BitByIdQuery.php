<?php

namespace App\GraphQL\Query;

use GraphQL;
use App\Bit;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class BitByIdQuery extends Query
{
    protected $attributes = [
        'name' => 'BitById',
        'description' => 'A query'
    ];

    public function type()
    {
        return Graphql::Type('Bit');
    }

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        if(!$bit = Bit::find($args['id'])){
            throw new Exception('Resource not found');
        }
        
        return $bit;
        
    }
}