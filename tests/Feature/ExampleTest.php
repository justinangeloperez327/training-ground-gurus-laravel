<?php

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('displays welcome page', function () {
    get('/')
    ->assertOk()
    ->assertSeeText("Laravel has an incredibly rich ecosystem.");
});

