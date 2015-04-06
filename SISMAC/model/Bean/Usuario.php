<?php

require_once ($path . 'generics/GenericBean.php');

/**
 * 
 */
class Usuario extends GenericBean {

    private $login = '';
    private $senha = '';
    private $idperfil = '';

    function __construct($id = '', $login = '', $senha = '', $perfil = '') {
        $this->setId($id);
        $this->setLogin($login);
        $this->setSenha($senha);
        $this->setIdPerfil($perfil);
    }

    /**
     * Gets the value of login.
     *
     * @return mixed
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * sets the value of login.
     *
     * @param mixed $login the login 
     *
     * @return self
     */
    public function setLogin($login) {
        $this->login = $login;

        return $this;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha() {
        return $this->senha;
    }

    /**
     * sets the value of senha.
     *
     * @param mixed $senha the senha 
     *
     * @return self
     */
    public function setSenha($senha) {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Gets the value of perfil.
     *
     * @return mixed
     */
    public function getIdPerfil() {
        return $this->idperfil;
    }
    public function getPerfil(){
        switch ($this->idperfil){
            case 1:
             //   echo "perfil 1";
                return 'administrador';
                break;
            case 2:
              //  echo "perfil 2";
                return 'usuario';
                break;
            default :
                return 0;
        }
    }

    /**
     * Sets the value of perfil.
     *
     * @param mixed $perfil the perfil 
     *
     * @return self
     */
    public function setIdPerfil($perfil) {
        $this->idperfil = $perfil;

        return $this;
    }

    public function getSenhaMD5() {
        return md5($this->getSenha());
    }

}

?>