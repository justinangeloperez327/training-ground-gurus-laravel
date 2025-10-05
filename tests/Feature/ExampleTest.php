<?php

use function Pest\Laravel\get;

it('displays welcome page', function (): void {
    get('/')
        ->assertOk()
        ->assertSeeText('Laravel has an incredibly rich ecosystem.');
});
