<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;


class K_Make_Model extends GeneratorCommand
{

    public function __construct(Filesystem $files){
        parent::__construct($files);
        //$this->addArgument("name",null,"","User_Controller");
    }

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:k_model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new K_Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->addArgument("name",null,"","User_Model");

        return parent::fire();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/Stubs/Model/Model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            //['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],
        ];
    }

    protected function buildClass($name)
    {
        $build_class = parent::buildClass($name);
        $build_class = str_replace("Dummy_Table", 'User', $build_class);
        $build_class = str_replace("dummy_belong_to",$this->build_belong_to(),$build_class);
        $build_class = str_replace("dummy_has_many",$this->build_has_many(),$build_class);
        return $build_class;
    }

    protected function getArguments()
    {
        return [
            //['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    protected function build_belong_to(){
        return $this->files->get(__DIR__.'/Stubs/Model/Belong_To.stub');
    }

    protected function build_has_many(){
        return $this->files->get(__DIR__.'/Stubs/Model/Has_Many.stub');
    }

}
