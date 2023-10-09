<?php

namespace App\Modules\User\Services;

use App\Modules\Authentication\Models\User;
use App\Modules\User\Requests\UserCreatePostRequest;
use App\Modules\User\Requests\UserMergePostRequest;
use App\Modules\User\Requests\UserUpdatePostRequest;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class UserService
{

    public function all(): Collection
    {
        return User::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = User::with([
            'roles',
            'staff_profile' => function($query){
                $query->with(['tools', 'client']);
            },
        ])->whereHas('staff_profile', function($qry){
            $qry->with(['tools', 'client'])->where('created_by', auth()->user()->id);
        })->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): User|null
    {
        return User::with([
            'roles',
            'staff_profile' => function($query){
                $query->with(['tools', 'client']);
            },
        ])->whereHas('staff_profile', function($qry){
            $qry->with(['tools', 'client'])->where('created_by', auth()->user()->id);
        })->findOrFail($id);
    }

    public function getByEmail(String $email): User
    {
        return User::where('email', $email)->firstOrFail();
    }

    public function create(UserCreatePostRequest $request): User
    {
        $user = User::create($request->safe()->only([
            'name',
            'email',
            'phone',
            'password',
            'timezone',
        ]));
        $user->syncRoles([$request->role]);
        $profile = $user->staff_profile()->create([
            'billing_rate'=> !empty($request->billing_rate) ? $request->billing_rate : null,
            'client_id'=> !empty($request->client) ? $request->client : null,
            'is_primary_user' => true,
            'created_by' => auth()->user()->id
        ]);

        if($request->role=='Writer' && $request->tool && count($request->tool)>0){
            $user->staff_profile->tools()->sync($request->tool);
        }

        return $user;
    }

    public function update(UserUpdatePostRequest $request, User $user): User
    {
        $password = empty($request->password) ? [] : $request->only('password');
        $data = [...$request->safe()->only([
            'name',
            'email',
            'phone',
            'timezone',
        ]), ...$password];
        $user->update($data);
        $user->staff_profile()->update([
            'billing_rate'=> !empty($request->billing_rate) ? $request->billing_rate : null,
            'client_id'=> !empty($request->client) ? $request->client : null,
        ]);

        if($request->role=='Writer' && $request->tool && count($request->tool)>0){
            $user->staff_profile->tools()->sync($request->tool);
        }

        return $user;
    }

    public function updateWithoutEmailAndPhone(UserUpdatePostRequest $request, User $user): User
    {
        $password = empty($request->password) ? [] : $request->only('password');
        $data = [...$request->safe()->only([
            'name',
            'timezone',
        ]), ...$password];
        $user->update($data);
        $user->staff_profile()->update([
            'billing_rate'=> !empty($request->billing_rate) ? $request->billing_rate : null,
            'client_id'=> !empty($request->client) ? $request->client : null,
        ]);

        if($request->role=='Writer' && $request->tool && count($request->tool)>0){
            $user->staff_profile->tools()->sync($request->tool);
        }

        return $user;
    }

    public function merge(UserMergePostRequest $request, User $user): User
    {
        $user->staff_profile()->create([
            'billing_rate'=> !empty($request->billing_rate) ? $request->billing_rate : null,
            'client_id'=> !empty($request->client) ? $request->client : null,
            'is_primary_user' => true,
            'created_by' => auth()->user()->id
        ]);

        if($user->current_role=='Writer' && $request->tool && count($request->tool)>0){
            $user->staff_profile->tools()->attach($request->tool);
        }

        return $user;
    }

    public function syncRoles(array $roles = [], User $user): void
    {
        $user->syncRoles($roles);
    }

    public function delete(User $user): bool|null
    {
        return $user->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
