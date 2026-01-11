<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TicketFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_ticket()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Test Category']);
        Storage::fake('public');
        $file = UploadedFile::fake()->image('ticket.jpg');

        $response = $this->actingAs($user)->post(route('tickets.store'), [
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'category_id' => $category->id,
            'location' => 'Room 101',
            'image' => $file,
        ]);

        $response->assertRedirect(route('tickets.index'));
        $this->assertDatabaseHas('tickets', [
            'title' => 'Test Ticket',
            'user_id' => $user->id,
        ]);
        Storage::disk('public')->assertExists('tickets/' . $file->hashName());
    }

    public function test_user_can_view_own_ticket()
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Test Category']);
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'My Ticket',
            'description' => 'Desc',
            'location' => 'Loc',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->get(route('tickets.index'));
        $response->assertSee('My Ticket');

        $response = $this->actingAs($user)->get(route('tickets.show', $ticket));
        $response->assertSee('My Ticket');
    }

    public function test_admin_can_update_status()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create();
        $category = Category::create(['name' => 'Test Category']);
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'User Ticket',
            'description' => 'Desc',
            'location' => 'Loc',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->put(route('tickets.update', $ticket), [
            'status' => 'in_progress',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'status' => 'in_progress',
        ]);
    }

    public function test_regular_user_cannot_update_status()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $category = Category::create(['name' => 'Test Category']);
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'User Ticket',
            'description' => 'Desc',
            'location' => 'Loc',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->put(route('tickets.update', $ticket), [
            'status' => 'in_progress',
        ]);

        $response->assertStatus(403);
    }
}
