<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Favorite;

class FavoriteTest extends TestCase
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

        Author::create([
            'name' => 'test setup author1',
        ]);
        Author::create([
            'name' => 'test setup author2',
        ]);

        Publisher::create([
            'name' => 'test setup publisher1',
        ]);
        Publisher::create([
            'name' => 'test setup publisher2',
        ]);

        Book::create([
            "isbn" => "xxx-xxx1",
            "name" => "テスト出版本",
            "published_at" => "1981/12/04",
            "author_id" => 1,
            "publisher_id" => 1
        ]);

        Book::create([
            "isbn" => "xxx-xxx1",
            "name" => "テスト出版本2",
            "published_at" => "1981/12/04",
            "author_id" => 2,
            "publisher_id" => 1
        ]);

        Book::create([
            "isbn" => "xxx-xxx1",
            "name" => "テスト出版本2",
            "published_at" => "1981/12/04",
            "author_id" => 1,
            "publisher_id" => 2
        ]);

        Favorite::create([
            'user_id' => 1,
            'book_id' => 1
        ]);

        // login
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
    }

    /**
     * create test.
     */
    public function test_create(): void
    {
        // normal case
        $response = $this->post(
            '/api/favorite',
            [
                'book_id' => 2,
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
            '/api/favorite',
            [
                'book_id' => 2,
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/favorite',
            [
                'book_id' => 999,
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/favorite',
            [
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->get(
            '/api/logout',
            [
                'Accept' => 'application/json'
            ]
        );
        $response = $this->post(
            '/api/favorite',
            [
                'book_id' => 3,
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * read test.
     */
    public function test_read(): void
    {
        // normal case
        $response = $this->get(
            '/api/favorite',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertIsArray($obj);

        // error case
        $response = $this->get(
            '/api/logout',
            [
                'Accept' => 'application/json'
            ]
        );
        $response = $this->get(
            '/api/favorite',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * update test.
     */
    public function test_update(): void
    {
        // normal case
        $response = $this->put(
            '/api/favorite/1',
            [
                'book_id' => 2,
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
            '/api/favorite/1',
            [
                'book_id' => 999,
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->put(
            '/api/favorite/2',
            [
                'book_id' => 2,
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->get(
            '/api/logout',
            [
                'Accept' => 'application/json'
            ]
        );
        $response = $this->put(
            '/api/favorite/1',
            [
                'book_id' => 2,
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * delete test.
     */
    public function test_delete(): void
    {
        // normal case
        $response = $this->delete(
            '/api/favorite/1',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertEquals($obj->result, Controller::API_RESULT_OK);

        // error case
        $response = $this->delete(
            '/api/favorite/999',
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
        $response = $this->get(
            '/api/logout',
            [
                'Accept' => 'application/json'
            ]
        );
        Author::truncate();
        Publisher::truncate();
        Book::truncate();
        User::truncate();
        Favorite::truncate();
    }
}
