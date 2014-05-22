<?php

use Mockery as m;
use Lucor\Auth\FileUserProvider;

class AuthFileUserProviderTest extends PHPUnit_Framework_TestCase
{

    protected $users;

    public function setUp()
    {
        parent::setUp();
        $this->users = array(
            'user_id' => array(
                'username' => 'luca',
                'password' => 'plain',
                'mail' => 'user@example.com',
            )
        );
    }

    public function tearDown()
    {
        m::close();
    }


    private function getProvider() {
        $hasher = m::mock('Illuminate\Hashing\HasherInterface');
        $hasher->shouldReceive('check')->atMost(1)->with('plain', 'hash')->andReturn(true);
        $cache = new \Illuminate\Cache\CacheManager(NULL);
        return new FileUserProvider($this->users, $hasher, $cache);
    }

    public function testRetrieveByIdReturnsUserWhenUserIsFound()
    {
        $provider = $this->getProvider();
        $user = $provider->retrieveByID('user_id');

        $this->assertInstanceOf('Illuminate\Auth\GenericUser', $user);
        $this->assertEquals('user_id', $user->getAuthIdentifier());
        $this->assertEquals('luca', $user->username);
    }


    public function testRetrieveByIdReturnsNullWhenUserIsNotFound()
    {

        $provider = $this->getProvider();
        $user = $provider->retrieveByID('notExists');

        $this->assertNull($user);
    }


    public function testRetrieveByCredentialsReturnsUserWhenUserIsFound()
    {
        $provider = $this->getProvider();
        $user = $provider->retrieveByCredentials(array('username' => 'luca', 'password' => 'plain'));

        $this->assertInstanceOf('Illuminate\Auth\GenericUser', $user);
        $this->assertEquals('user_id', $user->getAuthIdentifier());
        $this->assertEquals('luca', $user->username);
    }


    public function testRetrieveByCredentialsReturnsNullWhenUserIsFound()
    {
        $provider = $this->getProvider();
        $user = $provider->retrieveByCredentials(array('username' => 'notExists'));

        $this->assertNull($user);
    }


    public function testCredentialValidation()
    {
        $provider = $this->getProvider();
        $user = m::mock('Illuminate\Auth\UserInterface');
        $user->shouldReceive('getAuthPassword')->once()->andReturn('hash');
        $result = $provider->validateCredentials($user, array('password' => 'plain'));

        $this->assertTrue($result);
    }

}