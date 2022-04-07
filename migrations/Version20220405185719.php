<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405185719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE job_cron_job_composite (job_cron_id INT NOT NULL, job_composite_id INT NOT NULL, INDEX IDX_8EBAE813A2ACEED9 (job_cron_id), INDEX IDX_8EBAE8135EF6B87C (job_composite_id), PRIMARY KEY(job_cron_id, job_composite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_cron_job_composite ADD CONSTRAINT FK_8EBAE813A2ACEED9 FOREIGN KEY (job_cron_id) REFERENCES job_cron (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_cron_job_composite ADD CONSTRAINT FK_8EBAE8135EF6B87C FOREIGN KEY (job_composite_id) REFERENCES job_composite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC5F0218B');
        $this->addSql('DROP INDEX IDX_EDBFD5EC5F0218B ON historique');
        $this->addSql('ALTER TABLE historique ADD created_at DATETIME NOT NULL, DROP created_at_id');
        $this->addSql('ALTER TABLE job ADD historique LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE job_composite ADD list_sous_jobs_id INT DEFAULT NULL, CHANGE list_sous_jobs historique LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE job_composite ADD CONSTRAINT FK_FFBAE249119CDB71 FOREIGN KEY (list_sous_jobs_id) REFERENCES job_cron (id)');
        $this->addSql('CREATE INDEX IDX_FFBAE249119CDB71 ON job_composite (list_sous_jobs_id)');
        $this->addSql('ALTER TABLE job_cron ADD historique LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE job_cron_job_composite');
        $this->addSql('ALTER TABLE historique ADD created_at_id INT DEFAULT NULL, DROP created_at');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC5F0218B FOREIGN KEY (created_at_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_EDBFD5EC5F0218B ON historique (created_at_id)');
        $this->addSql('ALTER TABLE job DROP historique');
        $this->addSql('ALTER TABLE job_composite DROP FOREIGN KEY FK_FFBAE249119CDB71');
        $this->addSql('DROP INDEX IDX_FFBAE249119CDB71 ON job_composite');
        $this->addSql('ALTER TABLE job_composite DROP list_sous_jobs_id, CHANGE historique list_sous_jobs LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE job_cron DROP historique');
    }
}
