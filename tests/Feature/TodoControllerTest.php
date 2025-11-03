<?php

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithAuthenticatedUser;

class TodoControllerTest extends TestCase
{

    use WithAuthenticatedUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticate();
    }

    # view own todo should be ok
    public function test_user_view_own_todo_should_be_ok()
    {
        [$ownTodo] = $this->authenticatedUser->todo;

        $this->getJson("/api/todo/{$ownTodo->id}")
            ->assertStatus(200);
    }

    # view not own todo should be not ok
    public function test_user_get_403_on_not_owner_todo()
    {
        $user = User::factory()->hasTodo(3)->create();
        [$notOwnTodo] = $user->todo;

        $this->getJson("/api/todo/{$notOwnTodo->id}")
            ->assertStatus(403);
    }
    
    # try update own todo should be ok
    public function test_user_update_own_todo_should_be_ok()
    {
        [$ownTodo] = $this->authenticatedUser->todo;

        $this->putJson("/api/todo/{$ownTodo->id}", [
            'item' => 'i can update my own todo'
        ])->assertStatus(200)
            ->assertJsonFragment([
                'id' => $ownTodo->id,
                'item' => 'i can update my own todo'
            ]);
    }
    
    # try updated not own todo should be not ok
    public function test_user_update_not_own_todo_should_be_not_ok()
    {
        $user = User::factory()->hasTodo(3)->create();
        [$notOwnTodo] = $user->todo;

        $this->putJson("/api/todo/{$notOwnTodo->id}", [
            'item' => 'i can update my own todo'
        ])->assertStatus(403);
    }
    
    # try delete own todo should be ok
    public function test_user_delete_own_todo_should_be_ok()
    {
        [$ownTodo] = $this->authenticatedUser->todo;

        $this->deleteJson("/api/todo/{$ownTodo->id}")
            ->assertStatus(200);
    }
    
    # try delete not own todo should be not ok
    public function test_user_delete_not_own_todo_should_be_not_ok()
    {
        $user = User::factory()->hasTodo(3)->create();
        [$notOwnTodo] = $user->todo;

        $this->deleteJson("/api/todo/{$notOwnTodo->id}")
            ->assertStatus(403);
    }
    
    # try to see unexistent todo should be not ok
    public function test_user_get_404_on_unexistent_todo()
    {
        $this->getJson("/api/todo/999999999")
            ->assertStatus(404);
    }

}