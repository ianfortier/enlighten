<?php

namespace Styde\Enlighten\CodeExamples;

use Closure;
use Styde\Enlighten\TestInspector;
use Throwable;

class CodeExampleCreator
{
    /**
     * @var \Styde\Enlighten\TestInspector
     */
    private $testInspector;

    /**
     * @var CodeInspector
     */
    private $codeInspector;

    public function __construct(TestInspector $testInspector, CodeInspector $codeInspector)
    {
        $this->testInspector = $testInspector;
        $this->codeInspector = $codeInspector;
    }

    public function createSnippet($key, $callback = null)
    {
        if ($key instanceof Closure) {
            $callback = $key;
            $key = null;
        }

        $testExample = $this->testInspector->getCurrentTestExample();

        if ($testExample->isIgnored()) {
            return $callback();
        }

        $testExample->createSnippet($key, $this->codeInspector->getCodeFrom($callback));

        try {
            $result = call_user_func($callback);

            $testExample->saveSnippetResult(CodeResultTransformer::toArray($result));

            return $result;
        } catch (Throwable $throwable) {
            $testExample->setException($throwable);

            throw $throwable;
        }
    }
}
