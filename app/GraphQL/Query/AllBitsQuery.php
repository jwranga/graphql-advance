<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use App\Bit;

class AllBitsQuery extends Query
{
    protected $attributes = [
        'name' => 'AllBits',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Bit'));
    }

    public function args()
    {
        return [];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        
        $fields = $info->getFieldSelection();
//dd($fields);
        $bits = Bit::query();

        foreach ($fields as $field => $keys) {
          if ($field === 'user') {
            $bits->with('user');
          }

          if ($field === 'replies') {
            $bits->with('replies');
          }

          if ($field === 'likes_count') {
            $bits->with('likes');
          }
          
        }

        return $bits->latest()->get();
    }
}