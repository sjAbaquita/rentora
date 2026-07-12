<?php

namespace Tests\Feature;

use App\Domains\Document\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_document_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $document = Document::factory()->create();

        $this->actingAs($user)
            ->get('/documents')
            ->assertOk()
            ->assertSee('Documents')
            ->assertSee($document->title);
    }
}