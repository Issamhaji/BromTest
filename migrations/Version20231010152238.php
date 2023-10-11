<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010152238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, value INT NOT NULL, INDEX IDX_B1BDD6CB166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE phase ADD CONSTRAINT FK_B1BDD6CB166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE deliverables DROP FOREIGN KEY FK_1A74C3A9166D1F9C');
        $this->addSql('DROP INDEX IDX_1A74C3A9166D1F9C ON deliverables');
        $this->addSql('ALTER TABLE deliverables ADD phase_id INT NOT NULL, DROP project_id, DROP phase');
        $this->addSql('ALTER TABLE deliverables ADD CONSTRAINT FK_1A74C3A999091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('CREATE INDEX IDX_1A74C3A999091188 ON deliverables (phase_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deliverables DROP FOREIGN KEY FK_1A74C3A999091188');
        $this->addSql('ALTER TABLE phase DROP FOREIGN KEY FK_B1BDD6CB166D1F9C');
        $this->addSql('DROP TABLE phase');
        $this->addSql('DROP INDEX IDX_1A74C3A999091188 ON deliverables');
        $this->addSql('ALTER TABLE deliverables ADD phase INT NOT NULL, CHANGE phase_id project_id INT NOT NULL');
        $this->addSql('ALTER TABLE deliverables ADD CONSTRAINT FK_1A74C3A9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_1A74C3A9166D1F9C ON deliverables (project_id)');
    }
}
