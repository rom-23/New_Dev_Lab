<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211004155854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DB0B464C4');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DB0B464C4 FOREIGN KEY (development_id) REFERENCES development (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DB0B464C4');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DB0B464C4 FOREIGN KEY (development_id) REFERENCES development (id)');
    }
}
