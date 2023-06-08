<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Group;
use App\Models\Modules;
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
        Post::class => PostPolicy::class,
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
        // // định nghĩa gate
        // Gate::define('posts.add',function (User $user){
        //     // dd($user);
        //     return true;
        // });
        // Gate::define('posts.update',function(User $user,Post $post){
        //     // dd($post);
        //     return $user->id==$post->user_id;
        // });
        // sử dụng policy
        // Gate::define('posts.add',[PostPolicy::class,'add']);
         /*
            1. lấy dsnh sách modules
         */
        $moduleList=Modules::all();
        if($moduleList->count()>0){

            foreach($moduleList as $module){
                Gate::define($module->name,function(User $user) use ($module){
                        $roleJson= $user->groups->permissions;
                        if(!empty($roleJson)){
                            $roleArr=json_decode($roleJson,true);
                            $check=isRoleArrActiveBox($roleArr,$module->name);
                            return $check;
                        }
                        return false;
                });
                Gate::define($module->name.'.edit',function(User $user) use ($module){
                    $roleJson= $user->groups->permissions;
                    if(!empty($roleJson)){
                        $roleArr=json_decode($roleJson,true);
                        $check=isRoleArrActiveBox($roleArr,$module->name,'edit');
                        return $check;
                    }
                    return false;
                });
            }
        }
       


    }
}
