<?php namespace Lucor\Auth;

use Illuminate\Hashing\HasherInterface;
use Illuminate\Auth\UserProviderInterface;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\GenericUser;

class FileUserProvider implements UserProviderInterface
{

    /**
     * The array containing the users.
     *
     * @var array
     */
    protected $users;

    /**
     * Create a new file user provider.
     *
     * @param  array $users
     * @param  \Illuminate\Hashing\HasherInterface $hasher
     * @return void
     */
    public function __construct(array $users, HasherInterface $hasher)
    {
        $this->users = $users;
        $this->hasher = $hasher;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveById($identifier)
    {
        if (array_key_exists($identifier, $this->users)) {
            $user = new GenericUser((array)$this->users[$identifier]);
            $user->id = $identifier;
            return $user;
        }
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        foreach ($credentials as $key => $value) {
            if (!str_contains($key, 'password')) {
                foreach ($this->users as $identifier => $user_data) {
                    if (array_search($value, $user_data) === $key) {
                        return $this->retrieveById($identifier);
                    }
                }
            }
        }
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }

}