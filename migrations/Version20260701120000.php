<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260701120000 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE "user" (id SERIAL PRIMARY KEY, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, CONSTRAINT UNIQ_USER_EMAIL UNIQUE (email))');
        $this->addSql('CREATE TABLE expense (id SERIAL PRIMARY KEY, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, category VARCHAR(100) DEFAULT NULL, type VARCHAR(20) DEFAULT NULL, CONSTRAINT FK_EXPENSE_USER FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EXPENSE_USER ON expense (user_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE expense');
        $this->addSql('DROP TABLE "user"');
    }
}
