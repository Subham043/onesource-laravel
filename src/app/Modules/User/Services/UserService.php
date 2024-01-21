<?php

namespace App\Modules\User\Services;

use App\Modules\Authentication\Models\Profile;
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
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\Sorts\Sort;

class UserService
{

    public function all(): Collection
    {
        return User::all();
    }

    public function allByWriterRole(): Collection
    {
        return User::filterMemberByRoleCreatedByAuth('Writer')->latest()->get();
    }

    public function allByClientRole(): Collection
    {
        return User::filterMemberByRoleCreatedByAuth('Client')->latest()->get();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = User::filterMemberCreatedByAuth();
        return QueryBuilder::for($query)
                ->defaultSort('name')
                ->allowedSorts([
                    AllowedSort::custom('id', new StringLengthSort(), 'id'),
                    AllowedSort::custom('name', new StringLengthSort(), 'name'),
                ])
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): User|null
    {
        return User::filterMemberCreatedByAuth()->findOrFail($id);
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
        $profile = $user->member_profile_created_by_auth()->create([
            'billing_rate'=> !empty($request->billing_rate) ? $request->billing_rate : null,
            'client_id'=> !empty($request->client) ? $request->client : null,
            'is_primary_user' => true,
            'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id,
        ]);

        if($request->role=='Writer' && $request->tool && count($request->tool)>0){
            $user->member_profile_created_by_auth->tools()->sync($request->tool);
        }

        return $user;
    }

    public function update(UserUpdatePostRequest $request, User $user): User
    {
        // $password = empty($request->password) ? [] : $request->only('password');
        $data = [...$request->safe()->only([
            'name',
            // 'email',
            // 'phone',
            'timezone',
        // ]), ...$password];
        ])];
        $user->update($data);
        $user->member_profile_created_by_auth()->update([
            'billing_rate'=> !empty($request->billing_rate) ? $request->billing_rate : null,
            'client_id'=> !empty($request->client) ? $request->client : null,
        ]);

        if($request->role=='Writer' && $request->tool && count($request->tool)>0){
            $user->member_profile_created_by_auth->tools()->sync($request->tool);
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
        $user->member_profile_created_by_auth()->update([
            'billing_rate'=> !empty($request->billing_rate) ? $request->billing_rate : null,
            'client_id'=> !empty($request->client) ? $request->client : null,
        ]);

        if($request->role=='Writer' && $request->tool && count($request->tool)>0){
            $user->member_profile_created_by_auth->tools()->sync($request->tool);
        }

        return $user;
    }

    public function merge(UserMergePostRequest $request, User $user): User
    {
        $user->member_profile_created_by_auth()->create([
            'billing_rate'=> !empty($request->billing_rate) ? $request->billing_rate : null,
            'client_id'=> !empty($request->client) ? $request->client : null,
            'is_primary_user' => true,
            'created_by' => auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id,
        ]);

        if($user->current_role=='Writer' && $request->tool && count($request->tool)>0){
            $user->member_profile_created_by_auth->tools()->attach($request->tool);
        }

        return $user;
    }

    public function syncRoles(array $roles = [], User $user): void
    {
        $user->syncRoles($roles);
    }

    public function delete(Int $id): bool|null
    {
        $user = User::where('id', $id)->firstOrFail();
        $user_check_count = $user->with([
            'member_profile_created_by_auth' => function($query) use($id){
                $query->where('created_by', auth()->user()->id)->where('user_id', $id);
            },
        ])->whereHas('member_profile_created_by_auth', function($qry) use($id){
            $qry->where('created_by', auth()->user()->id)->where('user_id', $id);
        })->firstOrFail();
        if($user_check_count->current_role=='Admin' || $user_check_count->current_role=='Super-Admin' || $user_check_count->current_role=='Super Admin'){
            return Profile::where('created_by', auth()->user()->id)->where('user_id', $id)->delete();
        }else{
            $profile_count = User::where('id', $id)->whereHas('profiles', function($qry) use($id){
                $qry->where('user_id', $id);
            })->firstOrFail();
            if($profile_count->profiles->count()==1){
                return $user_check_count->delete();
            }else{
                return Profile::where('created_by', auth()->user()->id)->where('user_id', $id)->delete();
            }
        }
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

class StringLengthSort implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';

        $query->orderByRaw("LENGTH(`{$property}`) {$direction}")->orderBy($property, $direction);
    }
}
