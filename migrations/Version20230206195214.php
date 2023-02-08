<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230206195214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
       $this->addSql("CREATE TABLE IF NOT EXISTS carts ( 
                cart_id INTEGER PRIMARY KEY,
                product_id INTEGER NOT NULL,
                product_name TEXT NOT NULL,
                unit_price INTEGER NOT NULL,
                quantity INTEGER NOT NULL,
                purchase_identifier TEXT NOT NULL
            )"
       );
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('carts');

    }
}
