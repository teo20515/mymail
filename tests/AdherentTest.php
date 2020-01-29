<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class AdherentTest extends \PHPUnit\Framework\TestCase
{
    public function testCanBeCreatedFromStrings(): void
    {
        $this->assertInstanceOf(
            Adherent::class,
            Adherent::fromString('Jampon', 'Gerald', strtotime('1964-01-17'))
        );
    }

    public function testNotCaseSensitiveNoWhitespaceNoDash(): void
    {
        $this->assertEquals(
            "BLANCOLAINEGAELLE19640117",
            Adherent::fromString('Blanco-Lainé', 'Gaëlle', strtotime('1964-01-17'))
        );

        $this->assertEquals(
            Adherent::fromString('Blanco-Lainé', 'Gaëlle', strtotime('1964-01-17')),
            Adherent::fromString('Blanco-Laine', 'Gaelle', strtotime('1964-01-17'))
        );

        $this->assertEquals(
            Adherent::fromString('Blanco-Lainé', 'Gaëlle', strtotime('1964-01-17')),
            Adherent::fromString('blanco-lainé', 'gaëlle', strtotime('1964-01-17'))
        );

        $this->assertEquals(
            Adherent::fromString('Blanco-Lainé', 'Gaëlle', strtotime('1964-01-17')),
            Adherent::fromString('Blanco Lainé', 'Gaëlle', strtotime('1964-01-17'))
        );
    }
}