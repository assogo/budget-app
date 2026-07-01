<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260701064410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense ADD COLUMN category VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE expense ADD COLUMN type VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__expense AS SELECT id, title, amount, date, user_id FROM expense');
        $this->addSql('DROP TABLE expense');
        $this->addSql('CREATE TABLE expense (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, user_id INTEGER DEFAULT NULL, CONSTRAINT FK_2D3A8DA6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO expense (id, title, amount, date, user_id) SELECT id, title, amount, date, user_id FROM __temp__expense');
        $this->addSql('DROP TABLE __temp__expense');
        $this->addSql('CREATE INDEX IDX_2D3A8DA6A76ED395 ON expense (user_id)');
    }
}
