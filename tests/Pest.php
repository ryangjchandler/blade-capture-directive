<?php

use Illuminate\Container\Container;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Component;
use Pest\Expectation;
use RyanChandler\BladeCaptureDirective\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function expectBlade(string $blade, array $data = []): Expectation
{
    if (method_exists(BladeCompiler::class, 'render')) {
        return expect(Blade::render($blade, $data, deleteCachedView: true));
    }

    $component = new class ($blade) extends Component {
        protected $template;

        public function __construct($template)
        {
            $this->template = $template;
        }

        public function render()
        {
            return $this->template;
        }
    };

    $view = Container::getInstance()
        ->make(ViewFactory::class)
        ->make($component->resolveView(), $data);

    return expect(tap($view->render(), function () use ($view) {
        unlink($view->getPath());
    }));
}
