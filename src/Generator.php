<?php

namespace UniMapper\Migration;

use Nette\Utils\Finder;
use UniMapper\Connection;
use UniMapper\Entity\Reflection;

class Generator
{

    private $appDir;

    private $connection;

    /**
     * @param $appDir
     */
    public function __construct($appDir, Connection $connection)
    {
        $this->appDir = $appDir;
        $this->connection = $connection;
    }

    public function generateSchema()
    {
        $schemaFile = $this->getSchemaPath();

        return file_put_contents(
            $schemaFile,
            json_encode($this->getActualSchema())
        );
    }

    public function createSchema()
    {
        foreach (Finder::findFiles("*.php")->from($this->appDir) as $file) {
            include_once $file->getPathName();
        }

        $reflections = [];
        foreach(get_declared_classes() as $class) {

            if (is_subclass_of($class, "UniMapper\Entity")) {
                $reflections[] = Reflection::load($class);
            }
        }
    }

}