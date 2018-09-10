<?php
namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class MedioUniTest extends TestCase
{

    /**
     * Comprueba que la tarjeta con media franquicia Universitaria puede restar boletos, solo 2 medios
     */
    public function testRestarBoletos()
    {
        $tiempo = new TiempoFalso;
        $medio = new MedioUniversitario(0, $tiempo);
        $this->assertTrue($medio->recargar(100));
        $this->assertEquals($medio->obtenerSaldo(), 100);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 92.6);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(50);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 85.2);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 70.4);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 55.60);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 40.80);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 26.00);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 11.20);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->restarSaldo(), false);
        $this->assertEquals($medio->obtenerSaldo(), 11.20);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 11.20);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), false);

    }

    /**
     * Comprueba que la tarjeta con media franquicia Universitaria puede marcar una vez cada 5 minutos
     */
    public function testTiempoInvalido()
    {
        $tiempo = new TiempoFalso;
        $medio = new MedioUniversitario(0, $tiempo);
        $this->assertTrue($medio->recargar(962.59));
        $this->assertEquals($medio->restarSaldo(), true);
        $tiempo->avanzar(300);
        $this->assertEquals($medio->restarSaldo(), true);
        $tiempo->avanzar(50);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(50);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(50);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(50);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(50);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(50);
        $this->assertEquals($medio->restarSaldo(), true);
        $tiempo->avanzar(265);
        $this->assertEquals($medio->restarSaldo(), false);
        $tiempo->avanzar(584);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->restarSaldo(), false);
    }

    /**
     * Comprueba que la tarjeta con media franquicia Universitaria tiene 2 medios, y cuando pasa el dia se reinician
     */
    public function testPasoDia()
    {
        $tiempo = new TiempoFalso;
        $medio = new MedioUniversitario(0, $tiempo);
        $this->assertTrue($medio->recargar(100));
        $tiempo->avanzar(27000);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 92.6);
        $tiempo->avanzar(18000);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 85.2);
        $tiempo->avanzar(20000);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 70.4);
        $tiempo->avanzar(21500);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 63.0);
        $tiempo->avanzar(1500);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 55.6);
        $tiempo->avanzar(10000);
        $this->assertEquals($medio->restarSaldo(), true);
        $this->assertEquals($medio->obtenerSaldo(), 40.8);
    }
}
