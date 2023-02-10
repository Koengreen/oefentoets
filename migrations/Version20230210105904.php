<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210105904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE besteling ADD klant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE besteling ADD CONSTRAINT FK_E2864C93C427B2F FOREIGN KEY (klant_id) REFERENCES klant (id)');
        $this->addSql('CREATE INDEX IDX_E2864C93C427B2F ON besteling (klant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE besteling DROP FOREIGN KEY FK_E2864C93C427B2F');
        $this->addSql('DROP INDEX IDX_E2864C93C427B2F ON besteling');
        $this->addSql('ALTER TABLE besteling DROP klant_id');
    }
}
