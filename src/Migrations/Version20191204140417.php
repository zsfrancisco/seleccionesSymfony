<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204140417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipo ADD pais_equipo_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipo ADD CONSTRAINT FK_C49C530B96A799B4 FOREIGN KEY (pais_equipo_id) REFERENCES pais (id)');
        $this->addSql('CREATE INDEX IDX_C49C530B96A799B4 ON equipo (pais_equipo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipo DROP FOREIGN KEY FK_C49C530B96A799B4');
        $this->addSql('DROP INDEX IDX_C49C530B96A799B4 ON equipo');
        $this->addSql('ALTER TABLE equipo DROP pais_equipo_id');
    }
}
