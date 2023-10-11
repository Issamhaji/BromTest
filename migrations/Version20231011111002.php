<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011111002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deliverables ADD deliverable1_name VARCHAR(255) DEFAULT NULL, ADD deliverable2_name VARCHAR(255) DEFAULT NULL, DROP deliverable1, DROP deliverable2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deliverables ADD deliverable1 VARCHAR(255) DEFAULT NULL, ADD deliverable2 VARCHAR(255) DEFAULT NULL, DROP deliverable1_name, DROP deliverable2_name');
    }
}
