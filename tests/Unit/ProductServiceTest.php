<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Services\Products\ProductsService;
use App\Http\Requests\Products\ProductsRequest;
use App\Models\Products\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_creates_a_new_product()
    {
        $this->withoutMiddleware();
        // Simular un usuario autenticado
        $user = User::factory()->create();
        $this->actingAs($user);

        // Arrange: Crear una instancia de ProductsRequest con los datos de prueba
        $request = new ProductsRequest([
            'name' => 'Test Product',
            'img' => 'test-image.jpg',
            'description' => 'This is a test product',
            'quantity' => 10,
            'max_quantity' => 20,
            'min_quantity' => 5,
            'price' => 19.99,
        ]);

        // Instanciar el servicio de productos
        $service = new ProductsService();

        // Act: Llamar al método create del servicio
        $product = $service->create($request);

        // Assert: Verificar que se creó correctamente el producto
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('test-image.jpg', $product->img);
        $this->assertEquals('This is a test product', $product->description);
        $this->assertEquals(10, $product->quantity);
        $this->assertEquals(20, $product->max_quantity);
        $this->assertEquals(5, $product->min_quantity);
        $this->assertEquals(19.99, $product->price);

        // Verificar que los campos de usuario se asignaron correctamente
        $this->assertEquals($user->id, $product->user_id);
        $this->assertEquals($user->id, $product->created_by);
        $this->assertEquals($user->id, $product->modify_by);
    }
}
