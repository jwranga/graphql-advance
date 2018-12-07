<?php

namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class LogInMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LogIn',
        'description' => 'User Login'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ]

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        
        $creditials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];
        
        $token = auth()->attempt($creditials);
        
        
        if(!$token){
            throw new \Exception('Unauthorized!');
        }
        
        return $token;        
    }
}