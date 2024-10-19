<?php

declare(strict_types=1);

namespace InterInvest\ClientApiPer\Maker;

use InterInvest\Workflow\Core\Handler\EventMessageInterface;
use InterInvest\Workflow\Core\Workflow\WorkflowInterface;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\MakerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @method string getCommandDescription()
 */
class MakeActivity implements MakerInterface
{

    public static function getCommandName(): string
    {
        return 'make:ii-activity';
    }

    public static function getCommandDescription(): string
    {
        return 'Ajoute une classe Activity à un domaine existant';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig): void
    {
        $command
            ->addArgument('domain', InputArgument::REQUIRED, 'Le nom du domaine (e.g. Finance)')
            ->addArgument('activityName', InputArgument::REQUIRED, 'Le nom de l\'activité');
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
        // TODO: Implement configureDependencies() method.
    }

    public function interact(InputInterface $input, ConsoleStyle $io, Command $command)
    {
        // TODO: Implement interact() method.
    }


    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator): void
    {
        // Récupération des données d'entrée
        $domain = $input->getArgument('domain')??'Finance';
        $nameActivity = $input->getArgument('activityName');

        // Chemin du dossier Activity
        $baseDir = sprintf('src/%s/Activity', $domain);

        // Initialiser le système de fichiers
        $filesystem = new Filesystem();

        // Créer le dossier s'il n'existe pas
        if (!$filesystem->exists($baseDir)) {
            $filesystem->mkdir($baseDir);
        }

        // Contenu du fichier Activity PHP
        $activityClassContent = <<<PHP
        <?php

        declare(strict_types=1);

        namespace App\\$domain\\Activity;

        use InterInvest\ClientApiPer\Activity\AbstractActivity;

        class {$nameActivity}Activity extends AbstractActivity
        {
            public function execute(): string
            {
                return 'Your logic activity here '.__CLASS__;
            }
        }

        PHP;

        // Chemin du fichier Activity PHP
        $activityFile = sprintf('%s/%sActivity.php', $baseDir, $nameActivity);

        // Créer le fichier avec le contenu Activity
        $filesystem->dumpFile($activityFile, $activityClassContent);

        // Confirmation pour l'utilisateur
        $io->success(sprintf('L\'activité "%s" a été générée avec succès dans le domaine "%s".', $nameActivity, $domain));
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getCommandDescription()
    }
}
