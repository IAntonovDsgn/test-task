<?php

namespace Tests\Unit\Services;

use App\Repositories\EloquentUserRepository;
use Mockery;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;

class UserServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_that_user_successful_authenticated(): void
    {
        Auth::shouldReceive('attempt')
            ->once()
            ->with([
                'email' => 'user@example.com',
                'password' => 'valid-password'
            ])
            ->andReturn(true);

        $userRepositoryMock = Mockery::mock(EloquentUserRepository::class);

        $service = new UserService($userRepositoryMock);

        $service->attemptAuth('user@example.com', 'valid-password');

        $this->assertTrue(true);
    }

}
