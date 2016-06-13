<?php namespace Nhiepphong\Backend\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \Nhiepphong\Backend\Seeder\DatabaseSeeder;

class BackendCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string holds the name of the command
	 */
	protected $name = 'backend:install';

	/**
	 * The console command description.
	 *
	 * @var string holds the description of the command
	 */
	protected $description = 'Installs  Backend  migrations, configs, views and assets.';

	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 */
	public function fire()
	{
        $this->info('        [ Welcome to NhiepPhong Backend Installation ]       ');

		$this->call('migrate', array('--path' => 'vendor/nhiepphong/backend/src/database/migrations'));
		//$this->call('migrate', array('--path' => 'packages/nhiepphong/backend/src/database/migrations'));

		$this->call('db:seed', array('--class' => '\Nhiepphong\Backend\Seeder\DatabaseSeeder'));
		//$this->call('db:seed');
		$this->call('vendor:publish');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}
