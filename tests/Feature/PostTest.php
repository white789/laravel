<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testNoBlogPosts()
    {
        $response = $this->get('posts');

        $response->assertSeeText('No posts found');
    }

    public function testSeeOneBlogPostWhenThereIs1()
    {
        // Arrange
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->AssertSeeText('New title');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function testStoreValid() {
        $params = [
            'title' => 'Valid title',
            'content' => 'Atleast 10 characters'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created!');

    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        // Arrange
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'An updated title',
            'content' => 'Content was updated'
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was updated');

        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'An updated title'
        ]);

    }

    public function testDelete()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was deleted');
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());

    }

    private function createDummyBlogPost() : BlogPost
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of thr blog post';
        $post->save();

        return $post;
    }
}
