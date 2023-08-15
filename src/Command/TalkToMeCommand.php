<?php

namespace App\Command;

use App\Service\MixesService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:talk-to-me',
    description: 'Add a short description for your command',
)]
//to run the cmd  php bin/console app:talk-to-me args --options

class TalkToMeCommand extends Command
{
    public function __construct(private MixesService $mixesService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'name')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'shal i yell');//InputOption::VALUE_NONE to execute --yell otherwise we execute --yell=value
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name')?:'whoever you are';

            $msg=(sprintf('hello: %s', $name));


        if ($input->getOption('yell')) {
               $msg=sprintf('hello: %s', strtoupper($name));

        }

        $io->success($msg);
        if($io->confirm('Do you want a mix recommendation?'))
        {
            $mixes=$this->mixesService->getAll();
            $mix=$mixes[array_rand($mixes)];
            $io->note('i recommend the mix: '.$mix['title']);

        }
        return Command::SUCCESS;
    }
}
