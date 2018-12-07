<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BitType extends GraphQLType {

    protected $attributes = [
        'name' => 'Bit',
        'description' => 'Code bit'
    ];

    public function fields() {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of bit'
            ],
            'user' => [
                'type' => Type::notNull(\GraphQL::type('User')),
                'description' => 'The user that posted a bit'
            ],
            'snippet' => [
                'type' => Type::notNull(Type::int()),
                'description' => 'the code bit'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date a bit was created'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Date a bit was updated'
            ],
            'replies' => [
                'type' => Type::listOf(GraphQL::type('Reply')),
                'description' => 'The replies to a bit'
            ],
            'likes_count' => [
                'type' => Type::int(),
                'description' => 'The number of likes to a bit'
            ],
        ];
    }

    protected function resolveCreatedAtField($root, $args) {
        return (string) $root->created_at;
    }

    protected function resolveUpdatedAtField($root, $args) {
        return (string) $root->updated_at;
    }

    protected function resoveLikesCountField() {
        return $root->likes->count();
    }

}
