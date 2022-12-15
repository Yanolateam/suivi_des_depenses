<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215135151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_user (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, location_id INT DEFAULT NULL, activity_id INT DEFAULT NULL, depense VARCHAR(255) NOT NULL, INDEX IDX_D4F804C7A76ED395 (user_id), INDEX IDX_D4F804C764D218E (location_id), INDEX IDX_D4F804C781C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C764D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE info_user ADD CONSTRAINT FK_D4F804C781C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C7A76ED395');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C764D218E');
        $this->addSql('ALTER TABLE info_user DROP FOREIGN KEY FK_D4F804C781C06096');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE info_user');
        $this->addSql('DROP TABLE location');
    }
}
