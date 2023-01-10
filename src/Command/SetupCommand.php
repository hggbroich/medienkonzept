<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

#[AsCommand(name: 'app:setup', description: 'Sets up the application.')]
class SetupCommand extends Command {

    private PdoSessionHandler $pdoSessionHandler;
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, PdoSessionHandler $pdoSessionHandler, string $name = null) {
        parent::__construct($name);

        $this->em = $em;
        $this->pdoSessionHandler = $pdoSessionHandler;
    }

    public function execute(InputInterface $input, OutputInterface $output): int {
        $style = new SymfonyStyle($input, $output);

        $this->setupSessions($style);

        return 0;
    }

    private function setupSessions(SymfonyStyle $style) {
        $sql = "SHOW TABLES LIKE 'sessions';";
        $row = $this->em->getConnection()->executeQuery($sql);

        if($row->fetchOne() === false) {
            $this->pdoSessionHandler->createTable();
        }

        $style->success('Sessions table ready.');
    }
}