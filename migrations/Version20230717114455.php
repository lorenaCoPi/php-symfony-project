<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717114455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rick_and_morty_locations (rick_and_morty_id INT NOT NULL, locations_id INT NOT NULL, INDEX IDX_F67CA9C142C7229 (rick_and_morty_id), INDEX IDX_F67CA9CED775E23 (locations_id), PRIMARY KEY(rick_and_morty_id, locations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rick_and_morty_locations ADD CONSTRAINT FK_F67CA9C142C7229 FOREIGN KEY (rick_and_morty_id) REFERENCES rick_and_morty (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rick_and_morty_locations ADD CONSTRAINT FK_F67CA9CED775E23 FOREIGN KEY (locations_id) REFERENCES locations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rick_and_morty_locations DROP FOREIGN KEY FK_F67CA9C142C7229');
        $this->addSql('ALTER TABLE rick_and_morty_locations DROP FOREIGN KEY FK_F67CA9CED775E23');
        $this->addSql('DROP TABLE rick_and_morty_locations');
    }
}
