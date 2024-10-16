<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;

use Hash;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
	protected function domen(){
		return str_replace("-", "_", substr(request()->getHost(), 0, strpos(request()->getHost(), ".")));
	}
	
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->configurePermissions();

		Jetstream::createTeamsUsing(CreateTeam::class);
		Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
		Jetstream::addTeamMembersUsing(AddTeamMember::class);
		Jetstream::deleteTeamsUsing(DeleteTeam::class);
		Jetstream::deleteUsersUsing(DeleteUser::class);
		// Below code is for your customization
		Fortify::authenticateUsing(function (Request $request) {
			
			$user = User::where('email', $request->email)->where('domen', $this->domen())->first();
			
			if(!$user){ # пробуем зайти под главным админом
				$user = User::where('email', $request->email)->where('domen', 'all')->first();				
			}
		   
		   if ($user && Hash::check($request->password, $user->password)) {
				if ($user->active == 1) {  // it will return if active == 1
					 return $user;
				}
		   }

		});
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
