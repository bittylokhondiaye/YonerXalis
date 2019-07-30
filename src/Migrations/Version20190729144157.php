<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729144157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin_partenaire_user_partenaire (admin_partenaire_id INT NOT NULL, user_partenaire_id INT NOT NULL, INDEX IDX_74CACD21461CCCCB (admin_partenaire_id), INDEX IDX_74CACD217650BEFC (user_partenaire_id), PRIMARY KEY(admin_partenaire_id, user_partenaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_partenaire_user_partenaire ADD CONSTRAINT FK_74CACD21461CCCCB FOREIGN KEY (admin_partenaire_id) REFERENCES admin_partenaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_partenaire_user_partenaire ADD CONSTRAINT FK_74CACD217650BEFC FOREIGN KEY (user_partenaire_id) REFERENCES user_partenaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD statut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user_partenaire CHANGE partenaire_id partenaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin_partenaire CHANGE partenaire_id partenaire_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE admin_partenaire_user_partenaire');
        $this->addSql('ALTER TABLE admin_partenaire CHANGE partenaire_id partenaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP statut');
        $this->addSql('ALTER TABLE user_partenaire CHANGE partenaire_id partenaire_id INT NOT NULL');
    }
}
