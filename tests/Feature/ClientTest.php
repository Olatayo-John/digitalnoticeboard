<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientType;
use Illuminate\Http\UploadedFile;
use Database\Seeders\ClientSeeder;
use Database\Seeders\ClientTypeSeeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_list()
    {
        $user = User::factory()->create();

        $clients = Client::get();
        $response = $this->actingAs($user)->get(route('client.index'));

        $response->assertStatus(200)->assertViewIs('admin.client.index')->assertViewHasAll(['title', 'breadcrumbs', 'clientList' => $clients]);
    }

    public function test_client_create_form()
    {
        $user = User::factory()->create();
        $clientTypeList = ClientType::get();

        $response = $this->actingAs($user)->get(route('client.create'));

        $response->assertStatus(200)->assertViewIs('admin.client.add')->assertViewHasAll(['title', 'breadcrumbs', 'clientTypeList' => $clientTypeList, 'countryList']);
    }

    public function test_client_create()
    {
        $user = User::factory()->create();

        Storage::fake('client/profile');
        $file = UploadedFile::fake()->image('profileImageName.jpg');
        Storage::disk('client/profile')->assertMissing($file);

        $client = [
            "client_type_id" => 2,
            "name" => "Ms. Eula Ryan",
            "profile_image" => $file,
            "email" => "testclientmail@mail.com",
            "mobile" => "1111111111",
            "linkedin" => "kemmer.net",
            "skype" => "emard.info",
            "slack" => "jast.biz",
            "company_name" => "Heaney-Emard",
            "company_country" => "Pakistan",
            "company_state" => "Indiana",
            "business_since" => "1985-08-21",
            "is_active" => "1",
        ];

        $response = $this->actingAs($user)->post(route('client.store'), $client);
        $response->assertStatus(302)->assertValid()->assertSessionHas('status', 'Client created')->assertRedirectToRoute('client.index');
    }

    public function test_client_show()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        $response = $this->actingAs($user)->get(route('client.show', $client));
        $response->assertStatus(200)->assertViewIs('admin.client.view')->assertViewHasAll(['title', 'breadcrumbs', 'client' => $client]);
    }

    public function test_client_update_form()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();
        $clientTypeList = ClientType::get();

        $response = $this->actingAs($user)->get(route('client.edit', $client));
        $response->assertStatus(200)->assertViewIs('admin.client.edit')->assertViewHasAll(['title', 'breadcrumbs', 'client' => $client, 'clientTypeList' => $clientTypeList, 'countryList']);
    }

    public function test_client_update()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        Storage::fake('client/profile');
        $file= UploadedFile::fake()->image('profileImageEditName.png');
        Storage::disk('client/profile')->assertMissing($file);

        $updateFields = [
            "client_type_id" => 1,
            "name" => "client-name-update",
            "profile_image" => $file,
            "email" => "client_update@mail.com",
            "mobile" => "2222222222",
            "linkedin" => "kemmer.net",
            "skype" => "emard.info",
            "slack" => "jast.biz",
            "company_name" => "Heaney-Emard",
            "company_country" => "India",
            "company_state" => "Indiana",
            "business_since" => "1985-08-21",
            "is_active" => "0",
        ];

        $response = $this->actingAs($user)->put(route('client.update', $client), $updateFields);
        $response->assertStatus(302)->assertValid()->assertSessionHas('status', 'Client updated')->assertRedirectToRoute('client.index');
    }

    public function test_client_delete()
    {
        $user = User::factory()->create();
        $client = Client::factory()->create();

        $response = $this->actingAs($user)->delete(route('client.destroy', $client->id));
        $response->assertStatus(302)->assertValid()->assertSessionHas('status', 'Client deleted')->assertRedirectToRoute('client.index');
    }
}
