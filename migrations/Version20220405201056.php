<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405201056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_composite DROP FOREIGN KEY FK_FFBAE2496128735E');
        $this->addSql('DROP INDEX IDX_FFBAE2496128735E ON job_composite');
        $this->addSql('ALTER TABLE job_composite CHANGE historique_id historique_sous_jobs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_composite ADD CONSTRAINT FK_FFBAE249CF715409 FOREIGN KEY (historique_sous_jobs_id) REFERENCES job_cron (id)');
        $this->addSql('CREATE INDEX IDX_FFBAE249CF715409 ON job_composite (historique_sous_jobs_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_composite DROP FOREIGN KEY FK_FFBAE249CF715409');
        $this->addSql('DROP INDEX IDX_FFBAE249CF715409 ON job_composite');
        $this->addSql('ALTER TABLE job_composite CHANGE historique_sous_jobs_id historique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_composite ADD CONSTRAINT FK_FFBAE2496128735E FOREIGN KEY (historique_id) REFERENCES job_cron (id)');
        $this->addSql('CREATE INDEX IDX_FFBAE2496128735E ON job_composite (historique_id)');
    }
}
