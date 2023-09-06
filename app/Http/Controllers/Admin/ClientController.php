<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\ClientType;
use Illuminate\Http\Request;
use App\Http\Traits\CurlTrait;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\client\CreateClientRequest;
use App\Http\Requests\client\UpdateClientRequest;

class ClientController extends Controller
{
    use ImageTrait,CurlTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Clients Management';
        $data['breadcrumbs'] = [
            [
                'name' => 'Clients',
                'active' => true
            ]
        ];

        $data['clientList'] = Client::filter(request(['is_active', 'client_type_id']))->orderBy('name')->get();

        return view('admin.client.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Client';
        $data['breadcrumbs'] = [
            [
                'name' => 'Clients',
                'link' => route('client.index'),
                'active' => false
            ], [
                'name' => 'Create',
                'active' => true
            ]
        ];

        $data['clientTypeList'] = ClientType::where('status', '1')->orderBy('name')->get();
        $data['countryList'] = $this->getCountryList();

        return view('admin.client.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClientRequest $request)
    {
        $fields = $request->validated();

        //profile
        if ($request->hasFile('profile_image')) {
            $img = $request->file('profile_image');
            $path = $img->store('client/profile', 'public');

            $fields['profile_image'] = $path;
        }

        DB::transaction(function () use ($fields) {
            Client::create($fields);
        });

        return to_route('client.index')->with('status', 'Client created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $data['title'] = 'View';
        $data['breadcrumbs'] = [
            [
                'name' => 'Clients',
                'link' => route('client.index'),
                'active' => false
            ], [
                'name' => 'View',
                'active' => true
            ]
        ];

        $data['client'] = $client;

        return view('admin.client.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $data['title'] = 'Edit Client';
        $data['breadcrumbs'] = [
            [
                'name' => 'Clients',
                'link' => route('client.index'),
                'active' => false
            ], [
                'name' => 'Edit',
                'active' => true
            ]
        ];

        $data['client'] = $client;
        $data['clientTypeList'] = ClientType::where('status', '1')->orderBy('name')->get();
        $data['countryList'] = $this->getCountryList();

        return view('admin.client.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $updateFields = $request->validated();

        //profile
        if ($request->hasFile('profile_image')) {
            $img = $request->file('profile_image');
            $path = $img->store('client/profile', 'public');

            $updateFields['profile_image'] = $path;

            $clientProfile = $client->profile_image;
            $this->deleteImage($imgDisk = 'public', $imgPath = $clientProfile);
        }

        DB::transaction(function () use ($client, $updateFields) {
            $client->update($updateFields);
        });

        return to_route('client.index')->with('status', 'Client updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $clientProfile = $client->profile_image;

        DB::transaction(function () use ($client, $clientProfile) {
            $client->delete();

            $this->deleteImage($imgDisk = 'public', $imgPath = $clientProfile, false);
        });

        return to_route('client.index')->with('status', 'Client deleted');
    }

    public function countryStateList(){
        return $this->getCountryStateList();
    }
}
