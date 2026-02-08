<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_user_flow_through_architecture()
    {
        Storage::fake('public');

        // 1. Registration (Tests RegisteredUserController -> UserService -> CreateUserAction -> Repository)
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $user = User::where('email', 'test@example.com')->first();

        // 2. Dashboard Access
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Painel de Controle'); // From dashboard.blade.php

        // 3. Profile Update (Tests ProfileController -> UserService -> UpdateUserAction -> Repository)
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->patch('/profile', [
            'name' => 'Updated Name',
            'email' => 'test@example.com',
            'profile_image' => $file,
        ]);

        $response->assertRedirect(route('profile.edit'));
        $response->assertSessionHas('status', 'profile-updated');

        $user->refresh();

        $this->assertEquals('Updated Name', $user->name);
        $this->assertNotNull($user->profile_image);

        Storage::disk('public')->assertExists($user->profile_image);
    }

    public function test_login_page_renders_without_error()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_profile_page_renders_without_error()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
    }

    public function test_password_update_flow()
    {
        $user = User::factory()->create([
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $response = $this->actingAs($user)->put('/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('status', 'password-updated');

        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('new-password', $user->fresh()->password));
    }
}
