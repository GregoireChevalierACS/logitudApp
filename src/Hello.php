<?php


namespace App;

class Hello{
    public function hello(int $input){
        if($input%3 === 0){
            return "Hello";
        }
        if($input%5 === 0){
            return "Salut";
        }
    }
}