<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use App\Bit;

class NewBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'NewBit',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('Bit');
    }

    public function args()
    {
        return [
            'snippet' => [
                'name' => 'snippet',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ]
        ];
    }

    public function authenticated($root, $args, $currentUser)
    {
        return !!$currentUser;
    }
    
    

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        
        $bit = new Bit();
        $bit->user_id = auth()->user()->id;
        $bit->snippet =$args['snippet'];
        $bit->save();
        
        
        return $bit;
    }
}