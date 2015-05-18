<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin;

class Generator
{
    private $argc;
    private $argv;

    public function __construct($argc, $argv)
    {
        $this->argc = $argc;
        $this->argv = $argv;
    }

    function error($message)
    {
        print "\033[31m$message.\033[37m\n";
        exit;
    }

    function success($message)
    {
        print "\033[32m$message.\033[37m\n";
        exit;
    }

    public function manual()
    {
        print "...manual...\n";
        exit;
    }

    public function createController($name)
    {
        $nameArray = explode('/', $name);
        if (count($nameArray) == 1) {
            $subPath = '';
        } else {
            $name = $nameArray[count($nameArray)-1];
            array_pop($nameArray);
            $subPath = implode('/', $nameArray) . '/';
        }
        $controllerName = ucfirst(strtolower($name));
        $newControllerFile = CONTROLLERS_PATH . DIRECTORY_SEPARATOR . $subPath . $controllerName . 'Controller.php';
        if (file_exists($newControllerFile)) $this->error('Controller "' . $name . '" already exists');
        $templateFile = TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'Controller';
        if (!file_exists($templateFile)) $this->error('Controller template not found');
        $newControllerContent = file_get_contents($templateFile);
        $newControllerContent = str_replace('{{Name}}', $controllerName, $newControllerContent);
        $newControllerContent = str_replace('{{name}}', $subPath . $name, $newControllerContent);
        if (strlen($subPath) > 0) @mkdir(CONTROLLERS_PATH . DIRECTORY_SEPARATOR .$subPath);
        file_put_contents($newControllerFile, $newControllerContent);
        if (file_exists($newControllerFile)) $this->success('Controller "' . $name . '" created');
    }

    public function deleteController($name)
    {
        $nameArray = explode('/', $name);
        if (count($nameArray) == 1) {
            $subPath = '';
        } else {
            $name = $nameArray[count($nameArray)-1];
            array_pop($nameArray);
            $subPath = implode('/', $nameArray) . '/';
        }
        $controllerName = ucfirst(strtolower($name));
        $controllerFile = CONTROLLERS_PATH . DIRECTORY_SEPARATOR . $subPath . $controllerName . 'Controller.php';
        if (!file_exists($controllerFile)) $this->error('Controller "' . $name . '" not found');
        unlink($controllerFile);
        if (strlen($subPath) > 0) rmdir(CONTROLLERS_PATH . DIRECTORY_SEPARATOR .$subPath);
        if (!file_exists($controllerFile)) $this->success('Controller "' . $name . '" deleted');

    }

    public function createView($name)
    {
        $nameArray = explode('/', $name);
        if (count($nameArray) == 1) $this->error('Sub path missing');

        $name = $nameArray[count($nameArray)-1];
        array_pop($nameArray);
        $subPath = implode('/', $nameArray) . '/';

        $viewName = strtolower($name);
        $newViewFile = VIEWS_PATH . DIRECTORY_SEPARATOR . $subPath . $viewName . '.view.php';
        if (file_exists($newViewFile)) $this->error('View "' . $name . '" already exists');
        $templateFile = TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'View';
        if (!file_exists($templateFile)) $this->error('View template not found');
        $newViewContent = file_get_contents($templateFile);
        $newViewContent = str_replace('{{name}}', $subPath . $name, $newViewContent);
        if (strlen($subPath) > 0) @mkdir(VIEWS_PATH . DIRECTORY_SEPARATOR .$subPath);
        file_put_contents($newViewFile, $newViewContent);
        if (file_exists($newViewFile)) $this->success('View "' . $subPath . $name . '" created');
    }

    public function deleteView($name)
    {
        $nameArray = explode('/', $name);
        if (count($nameArray) == 1) $this->error('Sub path missing');

        $name = $nameArray[count($nameArray)-1];
        array_pop($nameArray);
        $subPath = implode('/', $nameArray) . '/';
        
        $viewName = strtolower($name);
        $viewFile = VIEWS_PATH . DIRECTORY_SEPARATOR . $subPath . $viewName . '.view.php';
        if (!file_exists($viewFile)) $this->error('View "' . $name . '" not found');
        unlink($viewFile);
        if (strlen($subPath) > 0) rmdir(VIEWS_PATH . DIRECTORY_SEPARATOR .$subPath);
        if (!file_exists($viewFile)) $this->success('View "' . $subPath . $name . '" deleted');
    }

    public function createModel($name)
    {
        $nameArray = explode('/', $name);
        if (count($nameArray) == 1) {
            $subPath = '';
        } else {
            $name = $nameArray[count($nameArray)-1];
            array_pop($nameArray);
            $subPath = implode('/', $nameArray) . '/';
        }
        $modelName = ucfirst(strtolower($name));
        $newModelFile = MODELS_PATH . DIRECTORY_SEPARATOR . $subPath . $modelName . 'Model.php';
        if (file_exists($newModelFile)) $this->error('Model "' . $name . '" already exists');
        $templateFile = TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'Model';
        if (!file_exists($templateFile)) $this->error('Model template not found');
        $newModelContent = file_get_contents($templateFile);
        $newModelContent = str_replace('{{Name}}', $modelName, $newModelContent);
        $newModelContent = str_replace('{{name}}', $name, $newModelContent);
        if (strlen($subPath) > 0) @mkdir(MODELS_PATH . DIRECTORY_SEPARATOR .$subPath);
        file_put_contents($newModelFile, $newModelContent);
        if (file_exists($newModelFile)) $this->success('Model "' . $name . '" created');
    }

    public function deleteModel($name)
    {
        $nameArray = explode('/', $name);
        if (count($nameArray) == 1) {
            $subPath = '';
        } else {
            $name = $nameArray[count($nameArray)-1];
            array_pop($nameArray);
            $subPath = implode('/', $nameArray) . '/';
        }
        $modelName = ucfirst(strtolower($name));
        $modelFile = MODELS_PATH . DIRECTORY_SEPARATOR . $subPath . $modelName . 'Model.php';
        if (!file_exists($modelFile)) $this->error('Model "' . $name . '" not found');
        unlink($modelFile);
        if (strlen($subPath) > 0) rmdir(MODELS_PATH . DIRECTORY_SEPARATOR .$subPath);
        if (!file_exists($modelFile)) $this->success('Model "' . $name . '" deleted');

    }

    public function createTest($name)
    {
        $testName = ucfirst(strtolower($name));
        $newTestFile = TESTS_PATH . DIRECTORY_SEPARATOR . $testName . 'Test.php';
        if (file_exists($newTestFile)) $this->error('Test "' . $name . '" already exists');
        $templateFile = TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'Test';
        if (!file_exists($templateFile)) $this->error('Test template not found');
        $newTestContent = file_get_contents($templateFile);
        $newTestContent = str_replace('{{name}}', $testName, $newTestContent);
        file_put_contents($newTestFile, $newTestContent);
        if (file_exists($newTestFile)) $this->success('Test "' . $name . '" created');
    }

    public function deleteTest($name)
    {
        $testName = ucfirst(strtolower($name));
        $testFile = TESTS_PATH . DIRECTORY_SEPARATOR . $testName . 'Test.php';
        if (!file_exists($testFile)) $this->error('Test "' . $name . '" not found');
        unlink($testFile);
        if (!file_exists($testFile)) $this->success('Test "' . $name . '" deleted');
    }

    public function createMigration($name)
    {
        $migrationName = 'm' . time() . '_' . strtolower($name);
        $newMigrationFile = MIGRATIONS_PATH . DIRECTORY_SEPARATOR . $migrationName . '.php';
        if (file_exists($newMigrationFile)) $this->error('Migration "' . $name . '" already exists');
        $templateFile = TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'Migration';
        if (!file_exists($templateFile)) $this->error('Migration template not found');
        $newMigrationContent = file_get_contents($templateFile);
        $newMigrationContent = str_replace('{{name}}', $migrationName, $newMigrationContent);
        $newMigrationContent = str_replace('{{env}}', APP_ENVIRONMENT, $newMigrationContent);
        file_put_contents($newMigrationFile, $newMigrationContent);
        if (file_exists($newMigrationFile)) $this->success('Migration "' . $name . '" created');
    }

    public function deleteMigration($name)
    {
        $migrationName = ucfirst(strtolower($name));
        $migrationFile = MIGRATIONS_PATH . DIRECTORY_SEPARATOR . $migrationName . 'Migration.php';
        if (!file_exists($migrationFile)) $this->error('Migration "' . $name . '" not found');
        unlink($migrationFile);
        if (!file_exists($migrationFile)) $this->success('Migration "' . $name . '" deleted');
    }

    public function run()
    {
        if ($this->argc == 1) $this->manual();

        $availableActions = ['c', 'create', 'd', 'delete'];
        $availableActionParameters = ['controller', 'view', 'test', 'migration', 'model'];

        if (!in_array($this->argv[1], $availableActions)) {
            $this->error('Wrong action ' . '"' . $this->argv[1] . '"');
        }

        if (!isset($this->argv[2])) {
            $this->error('Missig action parameter');
        }

        if (!in_array($this->argv[2], $availableActionParameters)) {
            $this->error('Wrong action parameter ' . '"' . $this->argv[2] . '"');
        }

        switch ($this->argv[2]) {
            case 'controller':
                if (!isset($this->argv[3])) $this->error('No controller name');
                if (in_array($this->argv[1], ['c', 'create'])) $this->createController($this->argv[3]);
                if (in_array($this->argv[1], ['d', 'delete'])) $this->deleteController($this->argv[3]);
                break;
            case 'view':
                if (!isset($this->argv[3])) $this->error('No view name');
                if (in_array($this->argv[1], ['c', 'create'])) $this->createView($this->argv[3]);
                if (in_array($this->argv[1], ['d', 'delete'])) $this->deleteView($this->argv[3]);
                break;
            case 'model':
                if (!isset($this->argv[3])) $this->error('No model name');
                if (in_array($this->argv[1], ['c', 'create'])) $this->createModel($this->argv[3]);
                if (in_array($this->argv[1], ['d', 'delete'])) $this->deleteModel($this->argv[3]);
                break;
            case 'test':
                if (!isset($this->argv[3])) $this->error('No test name');
                if (in_array($this->argv[1], ['c', 'create'])) $this->createTest($this->argv[3]);
                if (in_array($this->argv[1], ['d', 'delete'])) $this->deleteTest($this->argv[3]);
                break;
            case 'migration':
                if (!isset($this->argv[3])) $this->error('No migration name');
                if (in_array($this->argv[1], ['c', 'create'])) $this->createMigration($this->argv[3]);
                if (in_array($this->argv[1], ['d', 'delete'])) $this->deleteMigration($this->argv[3]);
                break;
        }
    }
}