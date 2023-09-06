<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_profile_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profile'));

        $response->assertStatus(200)->assertViewIs('profile.index')->assertViewHas(['user'=>$user,'bloodGroupList']);
    }

    public function test_profile_update()
    {
        $user= User::factory()->create();

        Storage::fake('profile');
        $file = UploadedFile::fake()->image('imageName.jpg');
        Storage::disk('profile')->assertMissing($file);

        $fields = [
            'name' => 'admin-test',
            'email' => 'adminTest@gmail.com',
            'mobile' => '1234567890',
            'profile_image' => $file
        ];
        $response = $this->actingAs($user)->put('profile', $fields);

        $response->assertStatus(302)->assertValid()->assertSessionHas('status','Profile Updated')->assertRedirectToRoute('profile');
    }

    public function test_profile_password_update(){
        $user= User::factory()->create();
    }
}
