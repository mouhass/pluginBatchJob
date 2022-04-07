<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405200351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE historique ADD historique_job_cron_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC7B02E0BF FOREIGN KEY (historique_job_cron_id) REFERENCES job_cron (id)');
        $this->addSql('CREATE INDEX IDX_EDBFD5EC7B02E0BF ON historique (historique_job_cron_id)');
        $this->addSql('ALTER TABLE job DROP historique');
        $this->addSql('ALTER TABLE job_composite ADD historique_id INT DEFAULT NULL, DROP historique');
        $this->addSql('ALTER TABLE job_composite ADD CONSTRAINT FK_FFBAE2496128735E FOREIGN KEY (historique_id) REFERENCES job_cron (id)');
        $this->addSql('CREATE INDEX IDX_FFBAE2496128735E ON job_composite (historique_id)');
        $this->addSql('ALTER TABLE job_cron DROP historique');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC7B02E0BF');
        $this->addSql('DROP INDEX IDX_EDBFD5EC7B02E0BF ON historique');
        $this->addSql('ALTER TABLE historique DROP historique_job_cron_id');
        $this->addSql('ALTER TABLE job ADD historique LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE job_composite DROP FOREIGN KEY FK_FFBAE2496128735E');
        $this->addSql('DROP INDEX IDX_FFBAE2496128735E ON job_composite');
        $this->addSql('ALTER TABLE job_composite ADD historique LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', DROP historique_id');
        $this->addSql('ALTER TABLE job_cron ADD historique LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
