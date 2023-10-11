<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010143458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phase DROP FOREIGN KEY FK_B1BDD6CB166D1F9C');
        $this->addSql('ALTER TABLE phase DROP FOREIGN KEY FK_B1BDD6CBF3C6560A');
        $this->addSql('DROP TABLE phase');
        $this->addSql('ALTER TABLE deliverables ADD project_id INT NOT NULL, ADD phase INT NOT NULL');
        $this->addSql('ALTER TABLE deliverables ADD CONSTRAINT FK_1A74C3A9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_1A74C3A9166D1F9C ON deliverables (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, deliverable_id INT NOT NULL, nbr_phases INT NOT NULL, UNIQUE INDEX UNIQ_B1BDD6CBF3C6560A (deliverable_id), INDEX IDX_B1BDD6CB166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE phase ADD CONSTRAINT FK_B1BDD6CB166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE phase ADD CONSTRAINT FK_B1BDD6CBF3C6560A FOREIGN KEY (deliverable_id) REFERENCES deliverables (id)');
        $this->addSql('ALTER TABLE deliverables DROP FOREIGN KEY FK_1A74C3A9166D1F9C');
        $this->addSql('DROP INDEX IDX_1A74C3A9166D1F9C ON deliverables');
        $this->addSql('ALTER TABLE deliverables DROP project_id, DROP phase');
    }
}
