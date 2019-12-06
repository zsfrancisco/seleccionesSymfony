<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204140627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jugador ADD pais_jugador_id INT NOT NULL');
        $this->addSql('ALTER TABLE jugador ADD CONSTRAINT FK_527D6F18AA863871 FOREIGN KEY (pais_jugador_id) REFERENCES pais (id)');
        $this->addSql('CREATE INDEX IDX_527D6F18AA863871 ON jugador (pais_jugador_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jugador DROP FOREIGN KEY FK_527D6F18AA863871');
        $this->addSql('DROP INDEX IDX_527D6F18AA863871 ON jugador');
        $this->addSql('ALTER TABLE jugador DROP pais_jugador_id');
    }
}
