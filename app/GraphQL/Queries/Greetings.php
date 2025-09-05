<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\User;

final readonly class Greetings
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $data=User::All();
       return $data  ;
    }
}
