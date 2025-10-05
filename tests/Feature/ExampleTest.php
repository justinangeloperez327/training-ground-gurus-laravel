<?php

use function Pest\Laravel\get;

it('displays welcome page', function () {
    get('/')
        ->assertOk()
        ->assertSeeText('Laravel has an incredibly rich ecosystem.');
});
