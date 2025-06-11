<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507194842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes_section DROP FOREIGN KEY FK_B696F9E5A05DD37A');
        $this->addSql('ALTER TABLE dishes_section DROP FOREIGN KEY FK_B696F9E5D823E37A');
        $this->addSql('DROP TABLE dishes_section');
        $this->addSql('ALTER TABLE dishes ADD section_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DD823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('CREATE INDEX IDX_584DD35DD823E37A ON dishes (section_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dishes_section (dishes_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_B696F9E5A05DD37A (dishes_id), INDEX IDX_B696F9E5D823E37A (section_id), PRIMARY KEY(dishes_id, section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dishes_section ADD CONSTRAINT FK_B696F9E5A05DD37A FOREIGN KEY (dishes_id) REFERENCES dishes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes_section ADD CONSTRAINT FK_B696F9E5D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35DD823E37A');
        $this->addSql('DROP INDEX IDX_584DD35DD823E37A ON dishes');
        $this->addSql('ALTER TABLE dishes DROP section_id');
    }
}
