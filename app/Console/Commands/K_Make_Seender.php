<?php

namespace App\Console\Commands;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem;



class K_Make_Seeder extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:k_seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new K_Seeder  class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $name = $this->parseName($this->getNameInput());

        $path =  $this->laravel->basePath()."/database/seeds/DatabaSeeder.php";

        if (!$this->files->exists($path)) {
            $this->makeDirectory($path);
            $this->files->put($path, $this->buildClass($name));
        }

        $this->files->put($path, $this->buildClass($name));
        $this->info($this->type.' created successfully.');
    }



    protected function buildClass($name)
    {
        $stub = $this->files->get(__DIR__.'/Stubs/Seeder/Seeder.stub');

        //如何插进去
        return $this->files->get(__DIR__.'/Stubs/Seeder/Seeder.stub');
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


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {

    }
}
