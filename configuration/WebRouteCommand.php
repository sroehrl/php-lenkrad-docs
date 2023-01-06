<?php

namespace Configuration;

use Neoan\Cli\Create\FileCreator;
use Neoan\NeoanApp;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('create:webroute', 'Starter: Creates file implementing Routable')]
class WebRouteCommand extends Command
{

    private NeoanApp $neoanApp;

    public function __construct(NeoanApp $neoanApp, string $name = null)
    {
        $this->neoanApp = $neoanApp;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setHelp('Starter: Creates file implementing Routable')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'fully qualified namespace'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        FileCreator::process('controller', $input->getArgument('name'), $this->neoanApp, $output);
        $viewTemplate = file_get_contents($this->neoanApp->cliPath . '/.templates/ViewTemplate.html');

        $nameParts = explode('\\', $input->getArgument('name'));


        file_put_contents($this->neoanApp->appPath . '/views/docs/' . strtolower(end($nameParts)) . '.html', $viewTemplate);


        return Command::SUCCESS;
    }
}