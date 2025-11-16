<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251116194601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455ED775E23');
        $this->addSql('DROP INDEX IDX_C7440455ED775E23 ON client');
        $this->addSql('ALTER TABLE client DROP locations_id');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FED775E23');
        $this->addSql('DROP INDEX IDX_E9E2810FED775E23 ON voiture');
        $this->addSql('ALTER TABLE voiture DROP locations_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD locations_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455ED775E23 FOREIGN KEY (locations_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_C7440455ED775E23 ON client (locations_id)');
        $this->addSql('ALTER TABLE voiture ADD locations_id INT NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FED775E23 FOREIGN KEY (locations_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FED775E23 ON voiture (locations_id)');
    }
}
