<?php
/**
 * User: matteo
 * Date: 04/03/13
 * Time: 12.28
 * Just for fun...
 */
namespace Cypress\LessElephantBundle\Command;

use LessElephant\LessProject;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LessCompileCommand
 *
 * @package Cypress\LessElephantBundle\Command
 */
class LessCompileCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cypress:less:compile')
            ->setDescription('Compile your less projects')
            ->addArgument('name', InputArgument::OPTIONAL, 'the name of the less project to compile, default to all');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $projects = $this->getContainer()->get('cypress_less_elephant.project_collection');
        foreach ($projects as $project) {
            $this->manageProject($project, $output);
        }
    }

    private function manageProject(LessProject $project, OutputInterface $output)
    {
        //var_dump($project);die;
        $output->writeln(sprintf('Compiling project <info>%s</info>', $project->getName()));
        $project->compile();
    }
}