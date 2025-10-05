<?php

use App\Models\Item;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function (): void {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

it('displays items', function (): void {
    $items = Item::factory()->count(5)->create();
    $item = $items->first();

    get('items')
        ->assertOk()
        ->assertSeeText([
            $item->name,
            $item->sku,
            $item->reoder_level,
        ]);
});
