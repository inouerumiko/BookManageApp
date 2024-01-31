<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * before test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        User::create([
            'name' => 'test name',
            'email' => 'test@test.com',
            'password' => 'tttttest',
        ]);

        User::create([
            'name' => 'test name2',
            'email' => 'test2@test.com',
            'password' => 'tttttest2',
        ]);
    }

    /**
     * login test.
     */
    public function test_login(): void
    {
        // normal case
        $response = $this->post(
            '/api/login',
            [
                'email' => 'test@test.com',
                'password' => 'tttttest',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertEquals($obj->result, Controller::API_RESULT_OK);

        // error case
        $response = $this->post(
            '/api/login',
            [
                'email' => 'test3@test.com',
                'password' => 'tttttest',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(401, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/login',
            [
                'email' => 'test@test.com',
                'password' => 'tttttttt',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(401, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/login',
            [
                'email' => 'test3@test.com',
                'password' => 'tttttttt',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * logout test.
     */
    public function test_logout(): void
    {

        // normal case
        $response = $this->post(
            '/api/login',
            [
                'email' => 'test@test.com',
                'password' => 'tttttest',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $response = $this->get(
            '/api/logout',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertEquals($obj->result, Controller::API_RESULT_OK);

        // error case
        $response = $this->get(
            '/api/logout',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * regist test.
     */
    public function test_regist(): void
    {
        // normal case
        $response = $this->post(
            '/api/regist',
            [
                'name' => 'test regist',
                'email' => 'regist@test.com',
                'password' => 'registtest',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertEquals($obj->result, Controller::API_RESULT_OK);

        // error case
        $response = $this->post(
            '/api/regist',
            [
                'name' => 'test regist',
                'email' => 'test regist',
                'password' => 'registtest',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/regist',
            [
                'name' => 'test regist',
                'email' => 'regist@test.com',
                'password' => '0123456',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/regist',
            [
                'email' => 'regist@test.com',
                'password' => 'registtest',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/regist',
            [
                'name' => 'test regist',
                'password' => 'registtest',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/regist',
            [
                'name' => 'test regist',
                'email' => 'regist@test.com',
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     * after test case.
     */
    protected function tearDown(): void
    {
        User::truncate();
    }
}
