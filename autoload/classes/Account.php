<?php

class Account {

    private int $id;
    private string $name;
    
    use Logger;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->log('Account created!');
    }

    public function getId(): int {
        return $this->id;  
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
}
