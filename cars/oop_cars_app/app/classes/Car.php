<?php

namespace App\Classes;

class Vehicle {
    protected $make;
    protected $model;
    protected $year;

    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    // Getter za make
    public function getMake() {
        return $this->make;
    }

    // Getter za model
    public function getModel() {
        return $this->model;
    }

    // Getter za year
    public function getYear() {
        return $this->year;
    }
}

trait Color {
    private $color;

    public function setColor($color) {
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }
}

interface Drivable {
    public function startEngine();
    public function stopEngine();
}

class Car extends Vehicle implements Drivable {
    use Color;

    public function __construct($make, $model, $year) {
        parent::__construct($make, $model, $year);
    }

    public function startEngine() {
        return "Engine started for {$this->make} {$this->model}.";
    }

    public function stopEngine() {
        return "Engine stopped for {$this->make} {$this->model}.";
    }

    public function displayInfo() {
        return "{$this->year} {$this->make} {$this->model}, Color: " . $this->getColor();
    }
}


