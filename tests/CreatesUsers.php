<?php

namespace Tests;

use ActivismeBe\User;

/**
 * Trait CreatesUsers
 *
 * @package Tests
 */
trait CreatesUsers
{
    /**
     * Create a normal user in the testing system.
     *
     * @return User
     */
    public function createUser(): User
    {
        return factory(User::class)->create();
    }

    /**
     * Create a admin user in the testing system
     *
     * @return User
     */
    public function createAdmin()
    {
        $user = factory(User::class)->create();
        return User::find($user->id)->assignRole('admin');
    }
}