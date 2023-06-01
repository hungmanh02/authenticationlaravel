<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function ($doctor, string $token) {
            return route('doctors.reset-password',['token'=>$token]).'?email='.$doctor->email;
        });
        // định nghĩa gate
        // Gate::define('posts.add',function (User $user){
        //     // dd($user);
        //     return true;
        // });
        // sử dụng policy
            Gate::define('posts.add',[PostPolicy::class,'add']);
            Gate::define('posts.update',function(User $user,Post $post){
                // dd($post);
                return $user->id==$post->user_id;
            });
    }
}
