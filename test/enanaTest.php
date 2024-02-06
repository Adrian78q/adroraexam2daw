<?php

use PHPUnit\Framework\TestCase;
include './src/Enana.php';

class EnanaTest extends TestCase {
    
    public function testCreandoEnana() {
        #Se probará la creación de enanas vivas, muertas y en limbo y se comprobará tanto la vida como el estado

        $enanaViva = new Enana("enanaViva", 50);
        $this->assertEquals("enanaViva", $enanaViva->getNombre());
        $this->assertEquals(50, $enanaViva->getPuntosVida());
        $this->assertEquals("viva", $enanaViva->getSituacion());

        $enanaMuerta = new Enana("enanaMuerta", -10);
        $this->assertEquals("enanaMuerta", $enanaMuerta->getNombre());
        $this->assertEquals(-10, $enanaMuerta->getPuntosVida());
        $this->assertEquals("muerta", $enanaMuerta->getSituacion());

        $enanaLimbo = new Enana("enanaLimbo", 0);
        $this->assertEquals("enanaLimbo", $enanaLimbo->getNombre());
        $this->assertEquals(0, $enanaLimbo->getPuntosVida());
        $this->assertEquals("limbo", $enanaLimbo->getSituacion());
    
    }
    public function testHeridaLeveVive() {
        #Se probará el efecto de una herida leve a una Enana con puntos de vida suficientes para sobrevivir al ataque
        #Se tendrá que probar que la vida es mayor que 0 y además que su situación es viva

        $enana = new Enana("enanaViva", 30);
        $enana->heridaLeve();
        $this->assertGreaterThan(0, $enana->getPuntosVida());
        $this->assertEquals("viva", $enana->getSituacion());

    }

    public function testHeridaLeveMuere() {
        #Se probará el efecto de una herida leve a una Enana con puntos de vida insuficientes para sobrevivir al ataque
        #Se tendrá que probar que la vida es menor que 0 y además que su situación es muerta

        $enana = new Enana("enanaMuerta", -10);
        $enana->heridaLeve();
        $this->assertLessThanOrEqual(0, $enana->getPuntosVida());
        $this->assertEquals("muerta", $enana->getSituacion());

    }

    public function testHeridaGrave() {
        #Se probará el efecto de una herida grave a una Enana con una situación de viva.
        #Se tendrá que probar que la vida es 0 y además que su situación es limbo

        $enana = new Enana("enanaLimbo", 0);
        $enana->heridaGrave();
        $this->assertEquals(0, $enana->getPuntosVida());
        $this->assertEquals("limbo", $enana->getSituacion());

    }
    
    public function testPocimaRevive() {
        #Se probará el efecto de administrar una pócima a una Enana muerta pero con una vida mayor que -10 y menor que 0
        #Se tendrá que probar que la vida es mayor que 0 y que su situación ha cambiado a viva

        $enana = new Enana("enanaMuerta", -5);
        $enana->pocima();
        $this->assertGreaterThan(0, $enana->getPuntosVida());
        $this->assertEquals("viva", $enana->getSituacion());

    }

    public function testPocimaNoRevive() {
        #Se probará el efecto de administrar una pócima a una Enana en el libo
        #Se tendrá que probar que la vida y situación no ha cambiado

        $enana = new Enana("enanaLimbo", 0);
        $enana->setSituacion("limbo");
        $vidaInicial = $enana->getPuntosVida();
        $situacionInicial = $enana->getSituacion();
        $enana->pocima();
        $this->assertEquals($vidaInicial, $enana->getPuntosVida());
        $this->assertEquals($situacionInicial, $enana->getSituacion());

    }

    public function testPocimaExtraLimbo() {
        #Se probará el efecto de administrar una pócima Extra a una Enana en el limbo.
        #Se tendrá que probar que la vida es 50 y la situación ha cambiado a viva.

        $enana = new Enana("enanaLimbo", 0);
        $enana->setSituacion("limbo");
        $vidaInicial = $enana->getPuntosVida();
        $situacionInicial = $enana->getSituacion();
        
        $enana->pocimaExtra();
        $this->assertEquals(50, $enana->getPuntosVida());
        $this->assertEquals("viva", $enana->getSituacion());

    }
}
?>