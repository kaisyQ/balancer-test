<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240816110802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create machines table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            create table if not exists public.machines (
                id int generated always as identity primary key not null,
                total_memory int not null, 
                total_process int not null
            );
        ");

        $this->addSql("comment on column public.machines.id is 'Machine identifier';");
        $this->addSql("comment on column public.machines.total_memory is 'Total count of machine memory';");
        $this->addSql("comment on column public.machines.total_process is 'Total count of machine working processes';");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("drop table if exists public.machines");
    }
}
