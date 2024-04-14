<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Credential;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        $user = $user->load('credentials');
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $requestValidated = Arr::except($request->validated(), 'credential');
        $user->update($requestValidated);
        $this->createOrUpdateCredentials($request->getCredential(), $user);

        return redirect()->route('users.index')->with('message', [
            'status' => 'success',
            'description' => 'User Updated Successfully',
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $requestValidated = Arr::except($request->validated(), 'credential');
            $user = User::create($requestValidated);
            $this->createOrUpdateCredentials($request->getCredential(), $user);
            DB::commit();

            return redirect()->route('users.index')->with('message', [
                'status' => 'success',
                'description' => 'User created successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('users.index')->with('message', [
                'status' => 'error',
                'description' => $e->getMessage(),
            ]);
        }
    }

    public function show(User $user)
    {
        $user = $user->load('credentials');
        return view('users.show', compact('user'));
    }

    private function createOrUpdateCredentials(array $credential, User $user)
    {
        foreach ($credential as $value) {
            $value = Arr::add($value, 'user_id', $user->getKey());
            Credential::updateOrCreate(
                [
                    'id' => $value['id'] ?? '',
                ],
                Arr::except($value, 'id')
            );
        }
    }
}
