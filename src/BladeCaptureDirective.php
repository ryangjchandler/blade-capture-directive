<?php

namespace RyanChandler\BladeCaptureDirective;

use Illuminate\Support\Str;

final class BladeCaptureDirective
{
    public static function open(string $expression): string
    {
        [$name, $args] = Str::contains($expression, ',') ?
            Str::of($expression)->trim()->explode(',', 2)->map(fn ($part) => trim($part))->toArray() :
            [$expression, ''];

        return "
            <?php {$name} = (function ({$args}) {
                extract(array_merge(\$this->environment, get_defined_vars()));
                ob_start();
            ?>
        ";
    }

    public static function close()
    {
        return "
            <?php
                return new \Illuminate\Support\HtmlString(ob_get_clean());
            })->bindTo(new class(get_defined_vars()) {
                public function __construct(
                    public array \$environment = []
                ) {}
            }); ?>
        ";
    }
}
