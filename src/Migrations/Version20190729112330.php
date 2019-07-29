<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729112330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_partenaire ADD partenaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_partenaire ADD CONSTRAINT FK_9598659F98DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id)');
        $this->addSql('CREATE INDEX IDX_9598659F98DE13AC ON user_partenaire (partenaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_partenaire DROP FOREIGN KEY FK_9598659F98DE13AC');
        $this->addSql('DROP INDEX IDX_9598659F98DE13AC ON user_partenaire');
        $this->addSql('ALTER TABLE user_partenaire DROP partenaire_id');
    }
}
