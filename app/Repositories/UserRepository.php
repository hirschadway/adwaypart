<?php

namespace App\Repositories;

use App\Events\Models\User\UserCreated;
use App\Events\Models\User\UserDeleted;
use App\Events\Models\User\UserUpdated;
use App\Exceptions\GeneralJsonExecption;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function create($attributes)
    {
        return DB::transaction(function () use ($attributes) {

            $created = User::query()->create([
                'name' => data_get($attributes, 'name'),
                'email' => data_get($attributes, 'email'),
                'password' => Hash::make(data_get($attributes, 'password')),
            ]);
            throw_if(!$created, GeneralJsonExecption::class, 'Failed to create user');
            if ($user_ids = data_get($attributes, 'user_ids')) {
                $created->users()->sync($user_ids);
            }
            // event(new UserCreated($created));
            return $created;
        });
    }

    public function update($user, $attributes)
    {
        return DB::transaction(function () use ($user, $attributes) {

            $updated = $user->update([
                'name' => data_get($attributes, 'name', $user->name),
                'email' => data_get($attributes, 'email', $user->email),
            ]);
            throw_if(!$updated, GeneralJsonExecption::class, 'Failed to update user');
            // event(new UserUpdated($user));
            return $user;
        });
    }
    public function forceDelete($user)
    {
        return DB::transaction(function () use ($user) {
            $deleted = $user->forceDelete();

            throw_if(!$deleted, GeneralJsonExecption::class, 'Can not delete user');
            // event(new UserDeleted($user));
            return $deleted;
        });
    }
}
