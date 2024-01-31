<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublisherTest extends TestCase
{
    /**
     * before test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Publisher::create([
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
            '/api/publisher',
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
            '/api/publisher',
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
            '/api/publisher',
            [
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/publisher',
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
            '/api/publisher/1',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertIsArray($obj);

        // error case
        $response = $this->get(
            '/api/publisher/999',
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
            '/api/publisher/1',
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
            '/api/publisher/1',
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
            '/api/publisher/1',
            [
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->put(
            '/api/publisher/1',
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
            '/api/publisher/1',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertEquals($obj->result, Controller::API_RESULT_OK);

        // error case
        $response = $this->delete(
            '/api/publisher/999',
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
        Publisher::truncate();
    }

}
