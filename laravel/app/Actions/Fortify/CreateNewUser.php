<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use DateTime;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => $this->passwordRules(),
			
            'surname' => ['required', 'string', 'max:255'],
			
            'patronymic' => ['nullable', 'string', 'max:255'],
            'post' => ['nullable', 'string', 'max:255'],
            'phone' => 'nullable', ['string', 'max:50'],
            'city' => ['nullable', 'string', 'max:255'],
            'birthday' => ['nullable', 'max:255'],
            'comments' => ['nullable', 'string', 'max:255'],			
            'domen' => ['nullable', 'string', 'max:20'],			
        ])->validate();
		
		//$birthday = str_replace("/", ".", $input['birthday']);		
		$birthday = new DateTime($input['birthday']);
		//$date->format('Y-m-d H:i:s');

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
			
            'surname' => $input['surname'],
            'patronymic' => $input['patronymic'],
            'phone' => $input['phone'],
            'post' => $input['post'],
            'city' => $input['city'],
            'birthday' => $birthday->format('Y-m-d H:i:s'),
            'comments' => $input['comments'],
            'domen' => $input['domen'],
        ]);
    }
}