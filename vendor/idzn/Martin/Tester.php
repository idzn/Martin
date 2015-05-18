<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin;

use application\custom\App;
use application\custom\Register;
use Martin\exceptions\RuntimeError;
use Martin\traits\CommonTrait;

class Tester
{
    use CommonTrait;


    /**
     * @var Container
     */
    public $container;

    public function __construct($config)
    {
        $this->container = new Container();
        App::runtime()->config = $config;
    }
    public function run()
    {
        try {
            $testsFiles = scandir(TESTS_PATH);
            array_shift($testsFiles) && array_shift($testsFiles);
            if (!count($testsFiles)) throw new RuntimeError("\033[31mTests not found\033[37m\n");

            echo "Testing...\n";

            $failedTests = [];
            foreach ($testsFiles as $testFile) {

                $testClassName = str_ireplace('.php', '', $testFile);
                $namespacedClassName = 'application\\tests\\' . $testClassName;
                if (!class_exists($namespacedClassName)) throw new RuntimeError("\033[31mWrong test name\033[37m\n");
                $testObject = new $namespacedClassName();

                $classMethodsList = get_class_methods($namespacedClassName);

                $testsList = [];
                foreach ($classMethodsList as $method)
                {
                    if (stripos($method, 'test') === 0) {
                        $testsList[] = $method;
                    }
                }
                if (!count($testsList)) throw new RuntimeError("\033[31mNo tests in $testClassName\033[37m\n");


                foreach ($testsList as $testAction) {

                    $results = $testObject->$testAction();
                    if (!count($results)) throw new RuntimeError("\033[31mNo asserts in $testClassName -> $testAction\033[37m\n");

                    foreach ($results as $assertName => $result) {

                        if (!$result) $failedTests[] = [
                            'file' => $testFile,
                            'action' => $testAction,
                            'assert' => $assertName,
                        ];

                    }

                }

            }
            if (!count($failedTests)) {
                print "\033[32m"."All tests is passed."."\033[37m\n";
            } else {
                print "\033[31m"."Any tests is failed."."\033[37m\n";
                foreach ($failedTests as $failedTest) {
                    print "    $failedTest[file] -> $failedTest[action] -> $failedTest[assert] - \033[31m"."false"."\033[37m\n";
                }
            }

        }
        catch (RuntimeError $e) { echo $e->getMessage(); exit; }
    }

} 