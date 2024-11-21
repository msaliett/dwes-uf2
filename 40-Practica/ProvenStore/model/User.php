<?php

class User{
    private string $username;
    private string $password;
    private string $role;
    private string $email;
    
    public function __construct(string $username, string $password, string $role, string $email) {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->email = $email;
    }


    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function __toString(): string {
        return "User[username=" . $this->username
                . ", password=" . $this->password
                . ", role=" . $this->role
                . ", email=" . $this->email
                . "]";
    }
}

