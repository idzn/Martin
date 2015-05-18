<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin;

use application\custom\App;
use application\custom\Register;
use Martin\traits\CommonTrait;

class Migrator
{
    use CommonTrait;


    private $argc;
    private $argv;
    private $position;

    /**
     * @var Container
     */
    public $container;

    public function __construct($argc, $argv, $config)
    {
        $this->argc = $argc;
        $this->argv = $argv;

        $this->container = new Container();
        App::runtime()->config = $config;

        $this->loadPosition();

    }

    function error($message)
    {
        print "\033[31m$message.\033[37m\n";
        exit;
    }

    function success($message)
    {
        print "\033[32m$message\033[37m\n";
    }

    public function manual()
    {
        print "...manual...\n";
        exit;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function loadPosition()
    {
        $currentMigrationFile = MIGRATIONS_PATH . '/../position.' . APP_ENVIRONMENT;
        $this->position = trim(file_get_contents($currentMigrationFile));
    }

    public function setPosition($migration)
    {
        $positionFile = MIGRATIONS_PATH . '/../position.' . APP_ENVIRONMENT;
        file_put_contents($positionFile, $migration);
        $this->loadPosition();
    }

    public function status()
    {
        $position = ($this->getPosition() === '') ? ' - ' : $this->getPosition();
        $this->success('Position: ' . $position);
    }

    public function up()
    {
        $migrationsFiles = scandir(MIGRATIONS_PATH);
        array_shift($migrationsFiles) && array_shift($migrationsFiles);
        if (!count($migrationsFiles)) throw new RuntimeError("\033[31mMigrations not found\033[37m\n");
        sort($migrationsFiles);

        $position = $this->getPosition();
        $begin = (empty($position)) ? true : false;
        $migratedCount = 0;
        foreach ($migrationsFiles as $migration) {
            if ($this->getPosition() == $migration) {
                $begin = true;
                continue;
            }
            if ($begin) {
                $migrationClassName = str_ireplace('.php', '', $migration);
                $namespacedClassName = 'application\\db\\migrations\\' . APP_ENVIRONMENT . '\\' . $migrationClassName;
                if (!class_exists($namespacedClassName)) $this->error('Migration class not found');
                $migrationObject = new $namespacedClassName();
                $migrationObject->up();
                $this->success($migration . ' is successful migrated');
                $position = $migration;
                $migratedCount ++;
            }
        }
        if ($begin) {
            if ($migratedCount > 0) {
                $this->setPosition($position);
                $this->success('Done');
                return;
            }
        }
        $this->success('Migrations is actual');
    }

    public function down()
    {
        $migrationsFiles = scandir(MIGRATIONS_PATH);
        array_shift($migrationsFiles) && array_shift($migrationsFiles);
        if (!count($migrationsFiles)) throw new RuntimeError("\033[31mMigrations not found\033[37m\n");
        rsort($migrationsFiles);

        $rolled = false;
        $lastMigration = '';
        foreach ($migrationsFiles as $migration) {

            if ($rolled) {
                $lastMigration = $migration;
                break;
            }

            if ($migration != $this->getPosition()) continue;

            $migrationClassName = str_ireplace('.php', '', $migration);
            $namespacedClassName = 'application\\db\\migrations\\' . APP_ENVIRONMENT . '\\' . $migrationClassName;
            if (!class_exists($namespacedClassName)) $this->error('Migration class not found');
            $migrationObject = new $namespacedClassName();
            $migrationObject->down();
            $rolled = true;
            $this->success($migration . ' is successful rollback');


        }
        $this->setPosition($lastMigration);
        if ($this->getPosition() == '') {
            $this->success('Migrations is actual');
        } else {
            $this->success('Done');
        }

    }

    public function run()
    {
        if ($this->argc == 1) $this->manual();

        $availableActions = ['up' , 'u', 'down', 'd', 'status', 's'];

        if (!in_array($this->argv[1], $availableActions)) {
            $this->error('Wrong action ' . '"' . $this->argv[1] . '"');
        }

        switch ($this->argv[1]) {
            case 'up':
            case 'u':
                $this->up();
                $this->status();
                break;
            case 'down':
            case 'd':
                $this->down();
                $this->status();
                break;
            case 'status':
            case 's':
                $this->status();
                break;
        }
    }
}