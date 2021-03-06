<?php

namespace Tests\Unit\Models;

use Styde\Enlighten\Models\Example;
use Styde\Enlighten\Models\ExampleGroup;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    function gets_the_path_to_the_file()
    {
        $example = new Example([
            'line' => 3,
        ]);
        $example->group = new ExampleGroup([
            'class_name' => 'Tests\Feature\Admin\CreateUsersTest',
        ]);

        $this->assertSame(1, preg_match('@phpstorm://open\?file=(.*?)Tests%2FFeature%2FAdmin%2FCreateUsersTest.php&line=3@', $example->file_link));
    }

    /** @test */
    function get_the_example_url()
    {
        $exampleGroup = new ExampleGroup([
            'run_id' => 1,
            'slug' => 'feature-api-request'
        ]);

        $example = new Example([
            'group' => $exampleGroup,
            'slug' => 'list-users'
        ]);

        $this->assertSame('http://localhost/enlighten/run/1/feature-api-request/list-users', $example->url);
    }
}
