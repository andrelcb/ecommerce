<?php 
namespace Sucata\Model;

use\Sucata\DB\Sql;
use \Sucata\Model;

class Usuario extends Model
{
    public static function login($dadosPost)
    {
        $sql = new Sql();

        $buscaUsuario = $sql->select("SELECT u.iduser, u.desemail, u.despassword FROM db_ecommerce.tb_users u WHERE desemail = :EMAIL", [
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

            $usuario->setiduser($data["iduser"]);
       }
       else
       {
        throw new \Exception("Email ou senha inválida.", 1);
       }
    }
}

?>