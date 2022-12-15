<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221215143430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_depense (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, montant NUMERIC(9, 2) NOT NULL, engagement TINYINT(1) NOT NULL, datedeprelevement DATE NOT NULL, datefinengagement DATE NOT NULL, commentaire LONGTEXT DEFAULT NULL, frequence VARCHAR(255) NOT NULL, INDEX IDX_6C08895D670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_depense ADD CONSTRAINT FK_6C08895D670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE user ADD user_depense_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E6BFD38F FOREIGN KEY (user_depense_id) REFERENCES user_depense (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E6BFD38F ON user (user_depense_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E6BFD38F');
        $this->addSql('ALTER TABLE user_depense DROP FOREIGN KEY FK_6C08895D670C757F');
        $this->addSql('DROP TABLE user_depense');
        $this->addSql('DROP INDEX IDX_8D93D649E6BFD38F ON user');
        $this->addSql('ALTER TABLE user DROP user_depense_id');
    }
}
