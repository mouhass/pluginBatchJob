<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220401152605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE historique ADD created_at_id INT DEFAULT NULL, DROP created_at');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC5F0218B FOREIGN KEY (created_at_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_EDBFD5EC5F0218B ON historique (created_at_id)');
        $this->addSql('ALTER TABLE job DROP historique');
        $this->addSql('ALTER TABLE job_composite DROP historique');
        $this->addSql('ALTER TABLE job_cron DROP historique');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC5F0218B');
        $this->addSql('DROP INDEX IDX_EDBFD5EC5F0218B ON historique');
        $this->addSql('ALTER TABLE historique ADD created_at DATETIME NOT NULL, DROP created_at_id');
        $this->addSql('ALTER TABLE job ADD historique LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE job_composite ADD historique LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE job_cron ADD historique LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
