<?php

class Ingredient
{
    private int $id;
    private string $name;
    private string $url_pic;

    /**
     * Ingredient constructor.
     */
    public function __construct(int $id, string $name, string $url_pic)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function getUrlPic(): string
    {
        return $this->url_pic;
    }

    public function setUrlPic(string $url_pic): void
    {
        $this->url_pic = $url_pic;
    }
}