<?php 
namespace Sucata\Model;

use\Sucata\DB\Sql;
use \Sucata\Model;

class Usuario extends Model
{
    const SESSION = "Usuario";

    public static function login($dadosPost)
    {
        $sql = new Sql();

        $buscaUsuario = $sql->select("SELECT u.iduser, u.desemail, u.despassword, u.isadmin FROM db_ecommerce.tb_users u WHERE desemail = :EMAIL", [
            ":EMAIL"=>$dadosPost["email"]
        ]);

        if(count($buscaUsuario) === 0)
        {
            throw new \Exception("Email ou senha inválida...email", 1);
        }
        
        $data = $buscaUsuario[0];

       if(password_verify($dadosPost["senha"], $data["despassword"]) === true)
       {
            $usuario = new Usuario;

            $usuario->setDados($data);

            $_SESSION[Usuario::SESSION]  = $usuario->getValues();

            return $usuario;
       }
       else
       {
        throw new \Exception("Email ou senha inválida.", 1);
       }
    }

    public static function verificaLogin($isadmin = true)
    {
        if(!isset($_SESSION[Usuario::SESSION]) || !$_SESSION[Usuario::SESSION] || !(int)$_SESSION[Usuario::SESSION]["iduser"] > 0 || (bool)$_SESSION[Usuario::SESSION]["isadmin"] !== $isadmin)
        {
            header("Location: /admin/login");
            exit;   
        }
    }

    public static function sair()
    {
        unset($_SESSION[Usuario::SESSION]);
    }
}

?>