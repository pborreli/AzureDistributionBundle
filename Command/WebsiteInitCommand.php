<?php
/**
 * WindowsAzure DistributionBundle
 *
 * LICENSE
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace WindowsAzure\DistributionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WebsiteInitCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('azure:websites:init')
            ->setDescription('Initialize project for deployment on Windows Azure Websites via Git')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernelRoot = $this->getContainer()->getParameter('kernel.root_dir');

        $output->writeln('Copy Files for Windows Azure Websites deployment to project root:');

        copy(__DIR__ . "/../Resources/private/websites/.deployment", $kernelRoot . "/.deployment");
        $output->writeln('[copy] .deployment');

        copy(__DIR__ . "/../Resources/private/websites/build_azure.sh", $kernelRoot . "/build_azure.sh");
        $output->writeln('[copy] build_azure.sh');

        copy(__DIR__ . "/../Resources/private/websites/.user.ini", $kernelRoot . "/.user.ini");
        $output->writeln('[copy] .user.ini');
    }
}
