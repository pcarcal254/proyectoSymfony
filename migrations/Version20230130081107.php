<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130081107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notificacion (id INT AUTO_INCREMENT NOT NULL, usuario_notificacion_id INT NOT NULL, nom_notificacion VARCHAR(255) NOT NULL, desc_reserva LONGTEXT NOT NULL, INDEX IDX_729A19ECA8D71C85 (usuario_notificacion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notificacion ADD CONSTRAINT FK_729A19ECA8D71C85 FOREIGN KEY (usuario_notificacion_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE mesa ADD pred_point POINT NOT NULL COMMENT \'(DC2Type:point)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notificacion DROP FOREIGN KEY FK_729A19ECA8D71C85');
        $this->addSql('DROP TABLE notificacion');
        $this->addSql('ALTER TABLE mesa DROP pred_point');
    }
}
