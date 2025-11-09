## Actions

```
<?php

namespace App\Actions;

class CreateTodo
{    
    public function handle(User $user, array $attributes): void | Object
    {
        DB::transaction(function () use ($user, $attributes) {
          //DB stuff          
        });

        broadcast(new TodoCreated($todo))->toOthers();
    }
}
```
