<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220401142856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE job_composite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, expression VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, list_destination LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', next_date_exec DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, historique LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', list_sous_jobs LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', historique_sous_job LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_cron (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, expression VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, actif TINYINT(1) NOT NULL, list_destination LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', next_date_exec DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, historique LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', script_exec VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE job_composite');
        $this->addSql('DROP TABLE job_cron');
    }
}
