<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405222623 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8B03A8386');
        $this->addSql('DROP INDEX IDX_FBD8E0F8B03A8386 ON job');
        $this->addSql('ALTER TABLE job DROP created_by_id');
        $this->addSql('ALTER TABLE job_composite ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_composite ADD CONSTRAINT FK_FFBAE249B03A8386 FOREIGN KEY (created_by_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_FFBAE249B03A8386 ON job_composite (created_by_id)');
        $this->addSql('ALTER TABLE job_cron ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_cron ADD CONSTRAINT FK_900176B9B03A8386 FOREIGN KEY (created_by_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_900176B9B03A8386 ON job_cron (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8B03A8386 FOREIGN KEY (created_by_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8B03A8386 ON job (created_by_id)');
        $this->addSql('ALTER TABLE job_composite DROP FOREIGN KEY FK_FFBAE249B03A8386');
        $this->addSql('DROP INDEX IDX_FFBAE249B03A8386 ON job_composite');
        $this->addSql('ALTER TABLE job_composite DROP created_by_id');
        $this->addSql('ALTER TABLE job_cron DROP FOREIGN KEY FK_900176B9B03A8386');
        $this->addSql('DROP INDEX IDX_900176B9B03A8386 ON job_cron');
        $this->addSql('ALTER TABLE job_cron DROP created_by_id');
    }
}
