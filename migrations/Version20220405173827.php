<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405173827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job DROP dtype');
        $this->addSql('ALTER TABLE job_composite DROP FOREIGN KEY FK_FFBAE249BF396750');
        $this->addSql('ALTER TABLE job_composite ADD name VARCHAR(255) NOT NULL, ADD expression VARCHAR(255) NOT NULL, ADD state VARCHAR(255) NOT NULL, ADD actif TINYINT(1) NOT NULL, ADD list_destination LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD next_date_exec DATETIME NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE job_cron DROP FOREIGN KEY FK_900176B9BF396750');
        $this->addSql('ALTER TABLE job_cron ADD name VARCHAR(255) NOT NULL, ADD expression VARCHAR(255) NOT NULL, ADD state VARCHAR(255) NOT NULL, ADD actif TINYINT(1) NOT NULL, ADD list_destination LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD next_date_exec DATETIME NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job ADD dtype VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE job_composite DROP name, DROP expression, DROP state, DROP actif, DROP list_destination, DROP next_date_exec, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE job_composite ADD CONSTRAINT FK_FFBAE249BF396750 FOREIGN KEY (id) REFERENCES job (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_cron DROP name, DROP expression, DROP state, DROP actif, DROP list_destination, DROP next_date_exec, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE job_cron ADD CONSTRAINT FK_900176B9BF396750 FOREIGN KEY (id) REFERENCES job (id) ON DELETE CASCADE');
    }
}
