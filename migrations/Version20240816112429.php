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
                id int primary key not null,
                total_memory int not null, 
                total_process int not null,
                machine_id int
            );
        ");

        $this->addSql('create sequence processes_id_seq increment by 1 minvalue 1 start 1');

        $this->addSql("comment on column public.processes.id is 'Process identifier';");
        $this->addSql("comment on column public.processes.total_memory is 'Total count of process memory';");
        $this->addSql("comment on column public.processes.total_process is 'Total count of using processes';");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("drop table if exists public.processes");
        $this->addSql('DROP SEQUENCE processes_id_seq CASCADE');
    }
}
