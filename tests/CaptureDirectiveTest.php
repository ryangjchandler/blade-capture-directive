<?php

use Illuminate\Auth\Events\OtherDeviceLogout;
use Illuminate\Support\Facades\Blade;

it('can capture a block of code', function () {
    $result = Blade::render(<<<blade
        @capture(\$hello, \$name)
            Hello {{ \$name }}!
        @endcapture

        {{ \$hello('Ryan') }}
        {{ \$hello('Dan') }}
    blade);

    expect($result)
        ->toContain('Hello Ryan!')
        ->toContain('Hello Dan!');
});

it('can capture a block of code with zero arguments', function () {
    $result = Blade::render(<<<blade
        @capture(\$hello)
            Hello!
        @endcapture

        {{ \$hello() }}
    blade);

    expect($result)
        ->toContain('Hello!');
});

it('can capture a block of code with a trailing comma', function () {
    $result = Blade::render(<<<blade
        @capture(\$hello,)
            Hello!
        @endcapture

        {{ \$hello() }}
    blade);

    expect($result)
        ->toContain('Hello!');

    $result = Blade::render(<<<blade
        @capture(\$hello, \$name,)
            Hello {{ \$name }}!
        @endcapture

        {{ \$hello('Ryan') }}
    blade);

    expect($result)
        ->toContain('Hello Ryan!');
});

it('supports default arguments', function () {
    $result = Blade::render(<<<blade
        @capture(\$hello, \$name, \$greeting = 'Hello')
            {{ \$greeting }} {{ \$name }}!
        @endcapture

        {{ \$hello('Ryan') }}
        {{ \$hello('Dan', 'Yo') }}
    blade);

    expect($result)
        ->toContain('Hello Ryan!')
        ->toContain('Yo Dan!');
});
