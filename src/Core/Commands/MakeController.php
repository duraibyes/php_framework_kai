<?php

namespace App\Core\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeController extends Command
{

    protected function configure()
    {
        $this
            ->setName('make:controller')
            ->setDescription('Creates a new controller')
            ->addArgument('name', InputArgument::REQUIRED, 'Controller name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');  // e.g., "admin/TestController"
        $parts = explode('/', $name);
        $class = array_pop($parts);           // "TestController"
        $subDir = implode('/', $parts);       // "admin"

        $namespacePart = $subDir ? '\\' . str_replace('/', '\\', $subDir) : '';
        $folderPath = __DIR__ . '/../../Apps/Controllers/' . $subDir;
        $filePath = $folderPath . '/' . $class . '.php';

        // Create directory if it doesn't exist
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        if (file_exists($filePath)) {
            $output->writeln("<error>⚠️ Controller [$name] already exists.</error>");
            return Command::FAILURE;
        }

        // Build namespace dynamically
        $namespace = 'App\\Apps\\Controllers' . $namespacePart;

        $template = <<<PHP
<?php

namespace $namespace;

use App\\Core\\Http\\Request;

class $class
{
    public function index(Request \$request)
    {
        echo "🚀 $class Controller is ready!";
    }
}
PHP;

        file_put_contents($filePath, $template);
        $output->writeln("<info>✅ Controller [$name] created at: $filePath</info>");

        return Command::SUCCESS;
    }
}
