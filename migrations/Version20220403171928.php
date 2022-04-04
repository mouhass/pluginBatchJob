<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403171928 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_cron DROP FOREIGN KEY FK_900176B91FDA4828');
        $this->addSql('DROP INDEX IDX_900176B91FDA4828 ON job_cron');
        $this->addSql('ALTER TABLE job_cron ADD script_exec VARCHAR(255) NOT NULL, DROP script_exec_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_cron ADD script_exec_id INT DEFAULT NULL, DROP script_exec');
        $this->addSql('ALTER TABLE job_cron ADD CONSTRAINT FK_900176B91FDA4828 FOREIGN KEY (script_exec_id) REFERENCES job_composite (id)');
        $this->addSql('CREATE INDEX IDX_900176B91FDA4828 ON job_cron (script_exec_id)');
    }
}
