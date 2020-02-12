<?php


class Adherent
{
    private $identifiant;
    private $nom;
    private $prenom;
    private $datenaissance;

    public function __construct(string $nom, string $prenom, DateTime $date)
    {
        $this->datenaissance = $date->format('Y-m-d');
        $this->nom = $nom;
        $this->prenom = $prenom;

        $this->createIdentifiant();
    }

    private function createIdentifiant(){
        $str = $this->nom.$this->prenom.$this->datenaissance;

        $str = $this->str_to_noaccent($str);
        $str = $this->removeDashAndWhitespace($str);
        $str = strtoupper($str);

        $this->identifiant = $str;
    }

    private static function str_to_noaccent($str)
    {
        $str = preg_replace('#Ç#', 'C', $str);
        $str = preg_replace('#ç#', 'c', $str);
        $str = preg_replace('#è|é|ê|ë#', 'e', $str);
        $str = preg_replace('#È|É|Ê|Ë#', 'E', $str);
        $str = preg_replace('#à|á|â|ã|ä|å#', 'a', $str);
        $str = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $str);
        $str = preg_replace('#ì|í|î|ï#', 'i', $str);
        $str = preg_replace('#Ì|Í|Î|Ï#', 'I', $str);
        $str = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $str);
        $str = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $str);
        $str = preg_replace('#ù|ú|û|ü#', 'u', $str);
        $str = preg_replace('#Ù|Ú|Û|Ü#', 'U', $str);
        $str = preg_replace('#ý|ÿ#', 'y', $str);
        $str = preg_replace('#Ý#', 'Y', $str);

        return $str;
    }

    private static function removeDashAndWhitespace($str){
        $str = preg_replace('#-|_|/#','',$str);
        $str =  str_replace(" ", "", $str);
        return $str;
    }

    public static function fromString(string $nom, string $prenom, DateTime $date):self
    {
        return new self($nom, $prenom, $date);
    }

    public function __toString():string
    {
        return $this->identifiant;
    }



}