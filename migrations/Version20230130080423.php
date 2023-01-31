<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130080423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juego (id INT AUTO_INCREMENT NOT NULL, nom_juego VARCHAR(50) NOT NULL, jugadores_min INT NOT NULL, jugadores_max INT NOT NULL, desc_juego LONGTEXT NOT NULL, tiempo_min_juego INT NOT NULL, tiempo_max_juego INT NOT NULL, anchura_min_juego INT NOT NULL, largo_min_juego INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesa (id INT AUTO_INCREMENT NOT NULL, nom_mesa VARCHAR(25) NOT NULL, ancho_mesa INT NOT NULL, largo_mesa INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva (id INT AUTO_INCREMENT NOT NULL, juego_reservado_id INT NOT NULL, usuario_reserva_id INT NOT NULL, mesa_reserva_id INT NOT NULL, num_reserva VARCHAR(50) NOT NULL, INDEX IDX_188D2E3BBA317906 (juego_reservado_id), INDEX IDX_188D2E3B2541734A (usuario_reserva_id), INDEX IDX_188D2E3BBE99D1D (mesa_reserva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nom_usuario VARCHAR(50) NOT NULL, pass_usuario VARCHAR(50) NOT NULL, rol_usuario INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BBA317906 FOREIGN KEY (juego_reservado_id) REFERENCES juego (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B2541734A FOREIGN KEY (usuario_reserva_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3BBE99D1D FOREIGN KEY (mesa_reserva_id) REFERENCES mesa (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BBA317906');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3B2541734A');
        $this->addSql('ALTER TABLE reserva DROP FOREIGN KEY FK_188D2E3BBE99D1D');
        $this->addSql('DROP TABLE juego');
        $this->addSql('DROP TABLE mesa');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE usuario');
    }
}
