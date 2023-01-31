<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230131112034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, ADD pfp_usuario VARCHAR(255) NOT NULL, DROP pass_usuario, DROP rol_usuario, CHANGE nom_usuario nom_usuario VARCHAR(25) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DE7927C74 ON usuario (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2265B05DE7927C74 ON usuario');
        $this->addSql('ALTER TABLE usuario ADD pass_usuario VARCHAR(50) NOT NULL, ADD rol_usuario INT NOT NULL, DROP email, DROP roles, DROP password, DROP pfp_usuario, CHANGE nom_usuario nom_usuario VARCHAR(50) NOT NULL');
    }
}
