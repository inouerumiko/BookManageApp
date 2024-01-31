<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * before test.
     */
    protected function setUp(): void
    {
        parent::setUp();

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
    }

    /**
     * create test.
     */
    public function test_create(): void
    {
        // normal case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "name" => "テスト出版本",
                "published_at" => "1981/12/04",
                "author_id" => 1,
                "publisher_id" => 2
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
            '/api/book',
            [
                "isbn" => "0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345",
                "name" => "テスト出版本",
                "published_at" => "1981/12/04",
                "author_id" => 2,
                "publisher_id" => 1
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345",
                "name" => "テスト出版本",
                "published_at" => "1981/12/04",
                "author_id" => 2,
                "publisher_id" => 1
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "name" => "0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345",
                "published_at" => "1981/12/04",
                "author_id" => 2,
                "publisher_id" => 1
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "name" => "テスト出版本",
                "published_at" => "0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345",
                "author_id" => 2,
                "publisher_id" => 1
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "name" => "テスト出版本",
                "published_at" => "1981/12/04",
                "author_id" => 999,
                "publisher_id" => 1
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "name" => "テスト出版本",
                "published_at" => "1981/12/04",
                "author_id" => 2,
                "publisher_id" => 999
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "name" => "テスト出版本",
                "published_at" => "1981/12/04",
                "author_id" => 2,
                "publisher_id" => 999
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "published_at" => "1981/12/04",
                "author_id" => 2,
                "publisher_id" => 999
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "name" => "テスト出版本",
                "author_id" => 2,
                "publisher_id" => 999
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "name" => "テスト出版本",
                "published_at" => "1981/12/04",
                "publisher_id" => 999
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->post(
            '/api/book',
            [
                "isbn" => "xxx-xxx1",
                "name" => "テスト出版本",
                "published_at" => "1981/12/04",
                "author_id" => 2,
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
            '/api/book/1',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertIsArray($obj);

        // error case
        $response = $this->get(
            '/api/book/999',
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
            '/api/book/1',
            [
                "isbn" => "xxx-xxx1 update",
                "name" => "テスト出版本 update",
                "published_at" => "2024/01/31",
                "author_id" => 2,
                "publisher_id" => 1
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
            '/api/book/1',
            [
                'isbn' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345'
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->put(
            '/api/book/1',
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
            '/api/book/1',
            [
                'published_at' => '0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345'
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->put(
            '/api/book/1',
            [
                'author_id' => 999
            ],
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(400, $response->getStatusCode());

        // error case
        $response = $this->put(
            '/api/book/1',
            [
                'publisher_id' => 999
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
            '/api/book/1',
            [
                'Accept' => 'application/json'
            ]
        );
        $this->assertEquals(200, $response->getStatusCode());
        $obj = $response->getData();
        $this->assertEquals($obj->result, Controller::API_RESULT_OK);

        // error case
        $response = $this->delete(
            '/api/book/999',
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
        Publisher::truncate();
        Book::truncate();
    }
}
