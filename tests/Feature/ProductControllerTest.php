<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    // test
    public function test_create_product(): void
    {
        $data = [
            'name' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'price' => 19.99,
        ];

        $this->post(route('products.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('products.index'))
            ->assertSessionHas('success', 'Product created successfully');

        $this->assertDatabaseHas('products', $data);
    }

    /** @test */
    public function test_update_product()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Product',
            'description' => 'Updated description.',
            'price' => 29.99,
        ];

        $this->put(route('products.update', $product->id), $data)
            ->assertStatus(302)
            ->assertRedirect(route('products.index'))
            ->assertSessionHas('success', 'Product updated successfully');

        $this->assertDatabaseHas('products', $data);
    }

    /** @test */
    public function test_delete_product()
    {
        $product = Product::factory()->create();

        $this->delete(route('products.destroy', $product->id))
            ->assertStatus(302)
            ->assertRedirect(route('products.index'))
            ->assertSessionHas('success', 'Product deleted successfully');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
