<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    /**
     * before test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Author::create([
            'name' => 'test setup',
        ]);
    }

    /**
     * create test.
     */
    public function test_create(): void
    {
        // normal case
        $response = $this->post(
            '/api/author',
            [
                'name' => 'test insert'
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
            '/api/author',
            [
                'name' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345'
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/author',
            [
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/author',
            [
                'name1' => 'test insert'
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     * read test.
     */
    public function test_read(): void
    {
        // normal case
        $response = $this->get(
            '/api/author/1',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertIsArray($obj);

        // error case
        $response = $this->get(
            '/api/author/999',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     * update test.
     */
    public function test_update(): void
    {
        // normal case
        $response = $this->put(
            '/api/author/1',
            [
                'name' => 'test update'
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertEquals($obj->result, Controller::API_RESULT_OK);

        // error case
        $response = $this->put(
            '/api/author/1',
            [
                'name' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345'
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->put(
            '/api/author/1',
            [
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->put(
            '/api/author/1',
            [
                'name1' => 'test update'
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());
    }

    /**
     * delete test.
     */
    public function test_delete(): void
    {
        // normal case
        $response = $this->delete(
            '/api/author/1',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertEquals($obj->result, Controller::API_RESULT_OK);

        // error case
        $response = $this->delete(
            '/api/author/999',
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
        Author::truncate();
    }
}
