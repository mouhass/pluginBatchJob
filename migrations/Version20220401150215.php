<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220401150215 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D7671179CD6');
        $this->addSql('DROP INDEX IDX_880E0D7671179CD6 ON admin');
        $this->addSql('ALTER TABLE admin DROP name_id');
        $this->addSql('ALTER TABLE job ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8B03A8386 FOREIGN KEY (created_by_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8B03A8386 ON job (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin ADD name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D7671179CD6 FOREIGN KEY (name_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_880E0D7671179CD6 ON admin (name_id)');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8B03A8386');
        $this->addSql('DROP INDEX IDX_FBD8E0F8B03A8386 ON job');
        $this->addSql('ALTER TABLE job DROP created_by_id');
    }
}
