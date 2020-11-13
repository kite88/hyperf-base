<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\UserService;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Psr\Container\ContainerInterface;

/**
 * @Command
 */
class ForCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('for:command');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        $this->line('Hello Hyperf!', 'info');
        $UserService = new UserService;
        /*for ($i = 0; $i <= 20; $i++) {
            var_dump($UserService->create([
                'username' => 'test' . $i,
                'password' => '123123'
            ]));
        }*/
        /*var_dump($UserService->edit([
            'id' => 3,
            'username'=>'test3',
            'password'=>'123123'
        ]));*/
        /*var_dump($UserService->remove(3));*/

    }
}
