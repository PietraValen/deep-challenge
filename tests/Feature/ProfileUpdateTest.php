<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
    }

    public function test_password_is_not_updated_if_empty(): void
    {
        $user = User::factory()->create([
            'password' => 'old-password',
        ]);
        $oldPasswordHash = $user->password;

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
                'password' => '',
                'password_confirmation' => '',
            ]);

        $response->assertSessionHasNoErrors();

        $user->refresh();
        $this->assertSame($oldPasswordHash, $user->password);
    }

    public function test_password_is_updated_if_provided(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response->assertSessionHasNoErrors();

        $user->refresh();
        $this->assertTrue(Hash::check('new-password', $user->password));
    }

    public function test_profile_image_can_be_uploaded(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => $user->email,
                'profile_image' => $file,
            ]);

        $response->assertSessionHasNoErrors();

        $user->refresh();
        $this->assertNotNull($user->profile_image);
        $this->assertTrue(Storage::disk('public')->exists($user->profile_image));
    }

    public function test_email_must_be_unique(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create(['email' => 'other@example.com']);

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'other@example.com',
            ]);

        $response->assertSessionHasErrors('email');
    }
}
