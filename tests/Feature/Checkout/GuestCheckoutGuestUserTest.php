<?php

namespace Tests\Feature\Checkout;

use App\Http\Middleware\GuestMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class GuestCheckoutGuestUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware([GuestMiddleware::class])->get('/_test/guest-checkout', function () {
            return response()->json(['guest_id' => session('guest_id')]);
        });
    }

    public function test_guest_middleware_creates_guest_user_and_persists_session_guest_id(): void
    {
        $firstResponse = $this->get('/_test/guest-checkout');

        $firstResponse->assertOk();
        $firstGuestId = (int) $firstResponse->json('guest_id');

        $this->assertGreaterThan(0, $firstGuestId);
        $this->assertDatabaseCount('guest_users', 1);

        $secondResponse = $this->get('/_test/guest-checkout');

        $secondResponse->assertOk();
        $secondGuestId = (int) $secondResponse->json('guest_id');

        $this->assertSame($firstGuestId, $secondGuestId);
        $this->assertDatabaseCount('guest_users', 1);

        $this->assertDatabaseHas('guest_users', [
            'id' => $firstGuestId,
        ]);
    }
}
