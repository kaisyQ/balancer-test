<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240816105918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create "public" schema';
    }

    public function up(Schema $schema): void
    {

        $this->addSql('create schema if not exists public');

    }

    public function down(Schema $schema): void
    { 
        $this->addSql('drop if exists schema public');
    }
}
