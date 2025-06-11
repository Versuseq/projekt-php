<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250610225343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish ADD pl_pl_name VARCHAR(255) NOT NULL, ADD pl_pl_description LONGTEXT DEFAULT NULL, CHANGE name en_us_name VARCHAR(255) NOT NULL, CHANGE description en_us_description LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish ADD name VARCHAR(255) NOT NULL, ADD description LONGTEXT DEFAULT NULL, DROP en_us_name, DROP en_us_description, DROP pl_pl_name, DROP pl_pl_description');
    }
}
