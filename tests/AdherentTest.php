<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once '../src/Adherent.php';

class AdherentTest extends TestCase
{
    public function testCanBeCreatedFromStrings(): void
    {
        $this->assertInstanceOf(
            Adherent::class,
            Adherent::fromString('Jampon', 'Gerald', date_create('1964-01-17'))
        );
    }

    public function testNotCaseSensitiveNoWhitespaceNoDash(): void
    {
        $this->assertEquals(
            "BLANCOLAINEGAELLE19640117",
            Adherent::fromString('Blanco-Lainé', 'Gaëlle', date_create('1964-01-17'))
        );

        $this->assertEquals(
            Adherent::fromString('Blanco-Lainé', 'Gaëlle', date_create('1964-01-17'))->__toString(),
            Adherent::fromString('Blanco-Laine', 'Gaelle', date_create('1964-01-17'))->__toString()
        );

        $this->assertEquals(
            Adherent::fromString('Blanco-Lainé', 'Gaëlle', date_create('1964-01-17'))->__toString(),
            Adherent::fromString('blanco-lainé', 'gaëlle', date_create('1964-01-17'))->__toString()
        );

        $this->assertEquals(
            Adherent::fromString('Blanco-Lainé', 'Gaëlle', date_create('1964-01-17'))->__toString(),
            Adherent::fromString('Blanco Lainé', 'Gaëlle', date_create('1964-01-17'))->__toString()
        );
    }
}