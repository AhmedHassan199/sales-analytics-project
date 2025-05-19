<?php

namespace Tests\Feature;

use App\Events\DashboardUpdated;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class OrderTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseTransactions;


    /** @test */
    public function it_creates_an_order_and_dispatches_dashboard_updated_event()
    {
        $this->seed();

        Event::fake();

        $product = Product::first();

        $this->assertNotNull($product, 'No products found in the database.');

        // Send a POST request to create an order
        $response = $this->post('/orders', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Assert the response redirects to the orders page
        $response->assertRedirect('/orders');

        // Assert the DashboardUpdated event was dispatched
        Event::assertDispatched(DashboardUpdated::class);
    }
}
