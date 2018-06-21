<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Model\Usuario
 *
 * @ORM\Entity()
 * @ORM\Table(name="usuario")
 */
class Usuario
{

    const ALUNO = 0;

    const PROFESSOR = 1;

    const ADMIN = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $curso;

    /**
     * @ORM\Column(type="string", length=20, unique=true)
     */
    protected $matricula;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $grade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $foto;

    /**
     * 0: Aluno
     * 1: Professor
     * 2: Administrador
     *
     * @ORM\Column(type="smallint", options={"default" : 0})
     */
    protected $tipo = 0;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $ira;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 1})
     */
    protected $nivel = 1;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    protected $experiencia = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    protected $inteligencia = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    protected $sabedoria = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    protected $destreza = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    protected $forca = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    protected $carisma = 0;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default" : 0})
     */
    protected $cultura = 0;

    /**
     * @ORM\OneToMany(targetEntity="Certificado", mappedBy="usuario")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id", nullable=false)
     */
    protected $certificados;

    /**
     * @ORM\OneToMany(targetEntity="Nota", mappedBy="usuario")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id", nullable=false)
     */
    protected $notas;

    public function __construct()
    {
        $this->certificados = new ArrayCollection();
        $this->notas = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getPrimeiroNome()
    {
        $part = explode(' ', $this->getNome());
        return $part[0];
    }

    /**
     * @param mixed $nome
     * @return User
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * @param mixed $curso
     * @return User
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * @param mixed $matricula
     * @return User
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param mixed $grade
     * @return User
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     * @return User
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     * @return User
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIra()
    {
        return $this->ira;
    }

    /**
     * @param mixed $ira
     * @return User
     */
    public function setIra($ira)
    {
        $this->ira = $ira;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     * @return User
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExperiencia()
    {
        return $this->experiencia;
    }

    /**
     * @param mixed $experiencia
     * @return User
     */
    public function setExperiencia($experiencia)
    {
        $this->experiencia = $experiencia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInteligencia()
    {
        return $this->inteligencia;
    }

    /**
     * @param mixed $inteligencia
     * @return User
     */
    public function setInteligencia($inteligencia)
    {
        $this->inteligencia = $inteligencia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSabedoria()
    {
        return $this->sabedoria;
    }

    /**
     * @param mixed $sabedoria
     * @return User
     */
    public function setSabedoria($sabedoria)
    {
        $this->sabedoria = $sabedoria;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestreza()
    {
        return $this->destreza;
    }

    /**
     * @param mixed $destreza
     * @return User
     */
    public function setDestreza($destreza)
    {
        $this->destreza = $destreza;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForca()
    {
        return $this->forca;
    }

    /**
     * @param mixed $forca
     * @return User
     */
    public function setForca($forca)
    {
        $this->forca = $forca;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCarisma()
    {
        return $this->carisma;
    }

    /**
     * @param mixed $carisma
     * @return User
     */
    public function setCarisma($carisma)
    {
        $this->carisma = $carisma;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCultura()
    {
        return $this->cultura;
    }

    /**
     * @param mixed $cultura
     * @return User
     */
    public function setCultura($cultura)
    {
        $this->cultura = $cultura;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCertificados()
    {
        return $this->certificados;
    }

    /**
     * @param mixed $certificados
     * @return User
     */
    public function setCertificados($certificados)
    {
        $this->certificados = $certificados;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * @param mixed $notas
     * @return User
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;
        return $this;
    }

    /**
     * @param Nota $nota
     * @return User
     */
    public function addNota(Nota $nota)
    {
        $this->notas[] = $nota;
        $nota->setUsuario($this);

        return $this;
    }

    /**
     * @param Nota $nota
     * @return User
     */
    public function removeNota(Nota $nota)
    {
        $this->notas->removeElement($nota);

        return $this;
    }

    public function getIdentifier()
    {
        return $this->getMatricula();
    }

}