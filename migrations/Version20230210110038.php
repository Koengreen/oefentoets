<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210110038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bestelregel ADD pizza_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bestelregel ADD CONSTRAINT FK_8D814692D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id)');
        $this->addSql('CREATE INDEX IDX_8D814692D41D1D42 ON bestelregel (pizza_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bestelregel DROP FOREIGN KEY FK_8D814692D41D1D42');
        $this->addSql('DROP INDEX IDX_8D814692D41D1D42 ON bestelregel');
        $this->addSql('ALTER TABLE bestelregel DROP pizza_id');
    }
}
