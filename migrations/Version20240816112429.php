<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20240816112429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create process table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            create table if not exists public.processes (
                id int generated always as identity primary key not null,
                total_memory int not null, 
                total_process int not null
            );
        ");

        $this->addSql("comment on column public.processes.id is 'Process identifier';");
        $this->addSql("comment on column public.processes.total_memory is 'Total count of process memory';");
        $this->addSql("comment on column public.processes.total_process is 'Total count of using processes';");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("drop table if exists public.processes");
    }
}
