<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AlbertMage\Catalog\Api\ProductManagementInterface;


/**
 * A console command that lists all the existing users.
 *
 * To use this command, open a terminal window, enter into your project directory
 * and execute the following:
 *
 *     $ php bin/console app:list-users
 *
 * Check out the code of the src/Command/AddUserCommand.php file for
 * the full explanation about Symfony commands.
 *
 * See https://symfony.com/doc/current/console.html
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class CleanProductCacheCommand extends Command
{

    /**
     * @var ProductManagementInterface
     */
    private $productManagement;

    public function __construct(
        ProductManagementInterface $productManagement
    ) {
        $this->productManagement = $productManagement;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('cache:product:clean')
            ->setDescription('Clean all product cache');
        parent::configure();
    }

    /**
     * This method is executed after initialize(). It usually contains the logic
     * to execute to complete this command task.
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->productManagement->cleanAllProductCache();

        return 1;
    }

}
