<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204142124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jugador ADD equipo_jugador_id INT NOT NULL');
        $this->addSql('ALTER TABLE jugador ADD CONSTRAINT FK_527D6F1878A1FFD3 FOREIGN KEY (equipo_jugador_id) REFERENCES equipo (id)');
        $this->addSql('CREATE INDEX IDX_527D6F1878A1FFD3 ON jugador (equipo_jugador_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE jugador DROP FOREIGN KEY FK_527D6F1878A1FFD3');
        $this->addSql('DROP INDEX IDX_527D6F1878A1FFD3 ON jugador');
        $this->addSql('ALTER TABLE jugador DROP equipo_jugador_id');
    }
}
