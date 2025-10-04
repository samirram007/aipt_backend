<?php

namespace App\Modules\AccountsJournal\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\AccountsJournal\Models\AccountsJournal;

class AccountsJournalTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_accounts_journals(): void
    {
        $response = $this->getJson('/api/accounts_journals');
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_AccountsJournal(): void
    {
        $data = ['name' => 'Test AccountsJournal'];

        $response = $this->postJson('/api/accounts_journals', $data);
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('accounts_journals', $data);
    }

    public function test_can_show_AccountsJournal(): void
    {
        $AccountsJournal = AccountsJournal::factory()->create();

        $response = $this->getJson('/api/accounts_journals/' . $AccountsJournal->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'name',
                         'created_at',
                         'updated_at'
                     ],
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_update_AccountsJournal(): void
    {
        $AccountsJournal = AccountsJournal::factory()->create();
        $data = ['name' => 'Updated AccountsJournal'];

        $response = $this->putJson('/api/accounts_journals/' . $AccountsJournal->id, $data);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseHas('accounts_journals', $data);
    }

    public function test_can_delete_AccountsJournal(): void
    {
        $AccountsJournal = AccountsJournal::factory()->create();

        $response = $this->deleteJson('/api/accounts_journals/' . $AccountsJournal->id);
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        $this->assertDatabaseMissing('accounts_journals', ['id' => $AccountsJournal->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        $response = $this->postJson('/api/accounts_journals', []);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
