<?php 
    class Usuarios {
        private $email;
        private $senha;
        private $nome;
        private $id;
        private $pdo;
        private $permissoes;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function Login($email, $senha) {
            $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = :email AND senha = :senha');
            $sql->bindValue(':email', $email);
            $sql->bindValue(':senha', $senha);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $dado = $sql->fetch();

                $_SESSION['logado'] = $dado['id'];

                return true;
            } 

            return false;
        }

        public function setUsuarios($id) {
            $this->id = $id;

            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $dados = $sql->fetch();

                $this->permissoes = explode(',', $dados['permissoes']);
            }
        }

        public function getPermissoes() {
            return $this->permissoes;
        }
        
        public function VerificarPermissao($p) {
            if(in_array($p, $this->permissoes)) {
                return true;
            } else {
                return false;
            }
        }
    }
?>