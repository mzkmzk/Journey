<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArgvInput;

class K_Make_Commond extends GeneratorCommand
{

    private $make_entities = ["User"];

    public function __construct(Filesystem $files){
        parent::__construct($files);
        $this->addArgument("name",null,"","User_Controller");
    }
    /**
     * The name and signature of the console command.
     *
     * @var string

    protected $signature = 'make:K';
     */
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:K';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new K_Series class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', null, InputOption::VALUE_NONE, 'Generate a resource controller class.'],
        ];
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $namespace = $this->getNamespace($name);
        $default_replace = str_replace("use $namespace\Controller;\n", '', parent::buildClass($name));
        return str_replace("Dummy_Model", "User_Model", $default_replace);
    }

    protected function getArguments()
    {
        return [
            //['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
}
