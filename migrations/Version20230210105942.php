<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210105942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bestelregel ADD besteling_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bestelregel ADD CONSTRAINT FK_8D814692CC1B6EA8 FOREIGN KEY (besteling_id) REFERENCES besteling (id)');
        $this->addSql('CREATE INDEX IDX_8D814692CC1B6EA8 ON bestelregel (besteling_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bestelregel DROP FOREIGN KEY FK_8D814692CC1B6EA8');
        $this->addSql('DROP INDEX IDX_8D814692CC1B6EA8 ON bestelregel');
        $this->addSql('ALTER TABLE bestelregel DROP besteling_id');
    }
}
